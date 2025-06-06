<?php
session_start();
/* Vérifier si cette page est authentifié */
$v_session = $_SESSION['v_session'];
if ($v_session != 1) 
{
    echo "<!-- Bootstrap version 5.3.0 -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css'>";
    echo "<meta charset=utf-8>";
    echo "<div class='alert alert-danger'><i class='fa-solid fa-triangle-exclamation'></i> <b>LaPduP</b> : Echec de connexion... | Vous n'avez pas le droit d'accéder à cette page sans authentification...</div>";
    exit();
}
else
{
// Inclure la bibliothèque FPDF
require('../fpdf/fpdf.php');
require("../connexion.php");

// Récupérer les données des consultations
$r = "SELECT c.idconsultation, c.dateconsultation, c.motif, c.observations, c.prescriptionpdf, 
      CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet
      FROM consultations c, patients p
      WHERE c.idpatient = p.idpatient
      ORDER BY c.dateconsultation DESC";
$res = mysqli_query($con, $r);

// Vérifier si la requête a réussi
if (!$res) {
    mysqli_close($con);
    exit('Erreur de requête: ' . mysqli_error($con));
}

// Créer un objet FPDF
$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L'); // Mode paysage

// Définir la police
$pdf->SetFont('Arial', 'B', 16);

// Ajouter une image en haut de la page
$pdf->Image('../images/lap2.png', 10, 10, 0, 5);
$pdf->Ln(10);

// Titre
$pdf->Cell(0, 10, 'Liste des Consultations', 0, 1, 'C');
$pdf->Ln(6);

// Entête du tableau
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetFillColor(200, 220, 255);

$pdf->Cell(20, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Patient', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Date', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Motif', 1, 0, 'C', true);
$pdf->Cell(80, 10, 'Observations', 1, 0, 'C', true);
$pdf->Cell(35, 10, 'Prescription', 1, 0, 'C', true);
$pdf->Ln();

// Afficher les données
$pdf->SetFont('Arial', '', 8);
$fill = false;
while ($data = mysqli_fetch_assoc($res)) {
    if ($fill) {
        $pdf->SetFillColor(240, 240, 240);
    } else {
        $pdf->SetFillColor(255, 255, 255);
    }
    
    $pdf->Cell(20, 8, $data['idconsultation'], 1, 0, 'C', $fill);
    $pdf->Cell(50, 8, substr($data['patient_nom_complet'], 0, 22), 1, 0, 'L', $fill);
    $pdf->Cell(30, 8, date('d/m/Y', strtotime($data['dateconsultation'])), 1, 0, 'C', $fill);
    $pdf->Cell(60, 8, substr($data['motif'], 0, 28), 1, 0, 'L', $fill);
    $pdf->Cell(80, 8, substr($data['observations'], 0, 35), 1, 0, 'L', $fill);
    $pdf->Cell(35, 8, $data['prescriptionpdf'] ? 'Oui' : 'Non', 1, 0, 'C', $fill);
    $pdf->Ln();
    $fill = !$fill;
}

// Numéro de page
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0,10, 'Page ' . $pdf->PageNo() . ' sur {nb}', 0, 0, 'L');

// Fermer la connexion à la base de données
mysqli_close($con);

// Afficher le PDF dans le navigateur
$pdf->Output();
}
?>
