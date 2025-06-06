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

// Vérifier la connexion à la base de données
if (!$con) {
    exit('Erreur de connexion à la base de données');
}

    // Imprimer toutes les ordonnances - Fixed query to match schema
    $r = "SELECT o.*, 
          CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet,
          c.dateconsultation,
          c.motif,
          p.nom as patient_nom,
          p.prenom as patient_prenom
          FROM ordonnances o 
          LEFT JOIN consultations c ON o.idconsultation = c.idconsultation
          LEFT JOIN patients p ON c.idpatient = p.idpatient
          ORDER BY c.dateconsultation DESC";

$res = mysqli_query($con, $r);

// Vérifier si la requête a réussi
if (!$res) {
    $error_message = mysqli_error($con);
    mysqli_close($con);
    exit('Erreur de requête: ' . $error_message);
}

// Créer un objet FPDF
$pdf = new FPDF();
$pdf->AliasNbPages();

if(isset($_GET['id'])) {
    // Format détaillé pour une ordonnance
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    
    // Ajouter une image en haut de la page
    $pdf->Image('../images/lap2.png', 10, 10, 0, 5);
    $pdf->Ln(10);
    
    $pdf->Cell(0, 10, 'ORDONNANCE MEDICALE', 0, 1, 'C');
    $pdf->Ln(10);
    
    if($ordonnance = mysqli_fetch_assoc($res)) {
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(50, 8, 'Patient:', 0, 0, 'L');
        $pdf->Cell(0, 8, $ordonnance['patient_nom'] . ' ' . $ordonnance['patient_prenom'], 0, 1, 'L');
        $pdf->Cell(50, 8, 'Date:', 0, 0, 'L');
        $pdf->Cell(0, 8, date('d/m/Y', strtotime($ordonnance['dateconsultation'])), 0, 1, 'L');
        $pdf->Cell(50, 8, 'Oeil:', 0, 0, 'L');
        $pdf->Cell(0, 8, $ordonnance['oeil'], 0, 1, 'L');
        $pdf->Ln(10);
        
        // Détails optiques
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, utf8_decode('CORRECTION OPTIQUE'), 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        
        $pdf->Cell(30, 8, '', 0, 0);
        $pdf->Cell(25, 8, utf8_decode('Sphère'), 1, 0, 'C');
        $pdf->Cell(25, 8, 'Cylindre', 1, 0, 'C');
        $pdf->Cell(20, 8, 'Axe', 1, 0, 'C');
        $pdf->Cell(25, 8, 'Addition', 1, 0, 'C');
        $pdf->Cell(30, 8, 'Type', 1, 0, 'C');
        $pdf->Ln();
        
        $pdf->Cell(30, 8, $ordonnance['oeil'] . ':', 0, 0);
        $pdf->Cell(25, 8, $ordonnance['sphere'], 1, 0, 'C');
        $pdf->Cell(25, 8, $ordonnance['cylindre'], 1, 0, 'C');
        $pdf->Cell(20, 8, $ordonnance['axe'], 1, 0, 'C');
        $pdf->Cell(25, 8, $ordonnance['addition'], 1, 0, 'C');
        $pdf->Cell(30, 8, $ordonnance['typecorrection'], 1, 0, 'C');
        $pdf->Ln();
        
        $pdf->Ln(5);
        $pdf->Cell(50, 8, 'Motif consultation:', 0, 0);
        $pdf->Cell(0, 8, $ordonnance['motif'], 0, 1);
    }
} else {
    // Format liste pour toutes les ordonnances
    $pdf->AddPage('L');
    $pdf->SetFont('Arial', 'B', 16);
    
    // Ajouter une image en haut de la page
    $pdf->Image('../images/lap2.png', 10, 10, 0, 5);
    $pdf->Ln(10);
    
    $pdf->Cell(0, 10, 'Liste des Ordonnances', 0, 1, 'C');
    $pdf->Ln(6);
    
    // Entête du tableau
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(200, 220, 255);
    
    $pdf->Cell(15, 10, 'ID', 1, 0, 'C', true);
    $pdf->Cell(50, 10, 'Patient', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Date', 1, 0, 'C', true);
    $pdf->Cell(20, 10, 'Oeil', 1, 0, 'C', true);
    $pdf->Cell(25, 10, utf8_decode('Sphère'), 1, 0, 'C', true);
    $pdf->Cell(25, 10, 'Cylindre', 1, 0, 'C', true);
    $pdf->Cell(20, 10, 'Axe', 1, 0, 'C', true);
    $pdf->Cell(25, 10, 'Addition', 1, 0, 'C', true);
    $pdf->Cell(35, 10, 'Type', 1, 0, 'C', true);
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
        
        $pdf->Cell(15, 8, $data['idordonnance'], 1, 0, 'C', $fill);
        $pdf->Cell(50, 8, substr($data['patient_nom_complet'], 0, 22), 1, 0, 'L', $fill);
        $pdf->Cell(30, 8, date('d/m/Y', strtotime($data['dateconsultation'])), 1, 0, 'C', $fill);
        $pdf->Cell(20, 8, $data['oeil'], 1, 0, 'C', $fill);
        $pdf->Cell(25, 8, $data['sphere'], 1, 0, 'C', $fill);
        $pdf->Cell(25, 8, $data['cylindre'], 1, 0, 'C', $fill);
        $pdf->Cell(20, 8, $data['axe'], 1, 0, 'C', $fill);
        $pdf->Cell(25, 8, $data['addition'], 1, 0, 'C', $fill);
        $pdf->Cell(35, 8, substr($data['typecorrection'], 0, 15), 1, 0, 'C', $fill);
        $pdf->Ln();
        $fill = !$fill;
    }
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
