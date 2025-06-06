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

if(isset($_GET['id'])) {
    // Imprimer une vente spécifique
    $id = $_GET['id'];
    $r = "SELECT v.*, CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet, p.telephone, p.email 
          FROM ventes v, patients p 
          WHERE v.idpatient = p.idpatient 
          AND v.id_vente = $id";
} else {
    // Imprimer toutes les ventes
    $r = "SELECT v.*, CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet 
          FROM ventes v, patients p 
          WHERE v.idpatient = p.idpatient 
          ORDER BY v.datevente DESC";
}

$res = mysqli_query($con, $r);

// Vérifier si la requête a réussi
if (!$res) {
    mysqli_close($con);
    exit('Erreur de requête: ' . mysqli_error($con));
}

// Créer un objet FPDF
$pdf = new FPDF();
$pdf->AliasNbPages();

if(isset($_GET['id'])) {
    // Format facture pour une vente spécifique
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    
    // Ajouter une image en haut de la page
    $pdf->Image('../images/lap2.png', 10, 10, 0, 5);
    $pdf->Ln(10);
    
    $pdf->Cell(0, 10, 'OPTI-RENT - FACTURE VENTE', 0, 1, 'C');
    $pdf->Ln(10);
    
    if($vente = mysqli_fetch_assoc($res)) {
        $pdf->SetFont('Arial', '', 12);
        
        // Informations client
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'INFORMATIONS CLIENT', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 8, 'Patient:', 0, 0, 'L');
        $pdf->Cell(0, 8, $vente['patient_nom_complet'], 0, 1, 'L');
        $pdf->Cell(50, 8, utf8_decode('Téléphone:'), 0, 0, 'L');
        $pdf->Cell(0, 8, $vente['telephone'], 0, 1, 'L');
        $pdf->Cell(50, 8, 'Email:', 0, 0, 'L');
        $pdf->Cell(0, 8, $vente['email'], 0, 1, 'L');
        $pdf->Ln(10);
        
        // Informations vente
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'INFORMATIONS VENTE', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 8, 'ID Vente:', 0, 0, 'L');
        $pdf->Cell(0, 8, $vente['id_vente'], 0, 1, 'L');
        $pdf->Cell(50, 8, 'Date:', 0, 0, 'L');
        $pdf->Cell(0, 8, date('d/m/Y H:i', strtotime($vente['datevente'])), 0, 1, 'L');
        $pdf->Cell(50, 8, 'Mode de paiement:', 0, 0, 'L');
        $pdf->Cell(0, 8, ucfirst($vente['modepaiement']), 0, 1, 'L');
        $pdf->Cell(50, 8, 'Statut:', 0, 0, 'L');
        $pdf->Cell(0, 8, ucfirst(str_replace('_', ' ', $vente['statutpaiement'])), 0, 1, 'L');
        $pdf->Ln(10);
        
        // Montant
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'MONTANT TOTAL: ' . number_format($vente['montanttotal'], 2) . ' €', 0, 1, 'R');
    }
} else {
    // Format liste pour toutes les ventes
    $pdf->AddPage('L');
    $pdf->SetFont('Arial', 'B', 16);
    
    // Ajouter une image en haut de la page
    $pdf->Image('../images/lap2.png', 10, 10, 0, 5);
    $pdf->Ln(10);
    
    $pdf->Cell(0, 10, 'Liste des Ventes', 0, 1, 'C');
    $pdf->Ln(6);
    
    // Entête du tableau
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(200, 220, 255);
    
    $pdf->Cell(20, 10, 'ID', 1, 0, 'C', true);
    $pdf->Cell(60, 10, 'Patient', 1, 0, 'C', true);
    $pdf->Cell(35, 10, 'Date', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Montant', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Mode Paiement', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Statut', 1, 0, 'C', true);
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
        
        $pdf->Cell(20, 8, $data['id_vente'], 1, 0, 'C', $fill);
        $pdf->Cell(60, 8, substr($data['patient_nom_complet'], 0, 26), 1, 0, 'L', $fill);
        $pdf->Cell(35, 8, date('d/m/Y H:i', strtotime($data['datevente'])), 1, 0, 'C', $fill);
        $pdf->Cell(30, 8, number_format($data['montanttotal'], 2) . ' €', 1, 0, 'R', $fill);
        $pdf->Cell(40, 8, ucfirst($data['modepaiement']), 1, 0, 'C', $fill);
        $pdf->Cell(40, 8, ucfirst(str_replace('_', ' ', $data['statutpaiement'])), 1, 0, 'C', $fill);
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
