<?php
session_start();

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

require('../fpdf/fpdf.php');
require("../connexion.php");


$r = "SELECT cf.idcommande, cf.datecommande, cf.statut, f.nom as fournisseur_nom
FROM commandes_fournisseur cf, fournisseur f
WHERE cf.idfournisseur = f.idf
ORDER BY cf.datecommande DESC";
$res = mysqli_query($con, $r);

if (!$res) {
    mysqli_close($con);
    exit('Erreur de requête: ' . mysqli_error($con));
}

$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);


$pdf->Image('../images/lap2.png', 10, 10, 0, 5);
$pdf->Ln(10);

$pdf->Cell(0, 10, 'Liste des Commandes Fournisseur', 0, 1, 'C');
$pdf->Ln(6);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 220, 255);

$pdf->Cell(30, 10, 'ID Commande', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Date Commande', 1, 0, 'C', true);
$pdf->Cell(70, 10, 'Fournisseur', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Statut', 1, 0, 'C', true);
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
$fill = false;
while ($data = mysqli_fetch_assoc($res)) {
    if ($fill) {
        $pdf->SetFillColor(240, 240, 240);
    } else {
        $pdf->SetFillColor(255, 255, 255);
    }
    
    $pdf->Cell(30, 8, $data['idcommande'], 1, 0, 'C', $fill);
    $pdf->Cell(40, 8, date('d/m/Y', strtotime($data['datecommande'])), 1, 0, 'C', $fill);
    $pdf->Cell(70, 8, substr($data['fournisseur_nom'], 0, 30), 1, 0, 'L', $fill);
    $pdf->Cell(50, 8, ucfirst($data['statut']), 1, 0, 'C', $fill);
    $pdf->Ln();
    $fill = !$fill;
}


$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0,10, 'Page ' . $pdf->PageNo() . ' sur {nb}', 0, 0, 'L');


mysqli_close($con);


$pdf->Output();
}
?>
