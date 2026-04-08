<?php
session_start();

    $v_session = $_SESSION['v_session'];
    if ($v_session != 1) 
    {
    echo "<!-- Bootstrap version 5.3.0 -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css'>";
    echo "<meta charset=utf-8>";

    echo "<div class='alert alert-danger'><i class='fa-solid fa-triangle-exclamation'></i> <b>optique manager</b> : Echec de connexion... | Vous n'avez pas le droit d'accéder à cette page sans authentification...</div>";
    exit();
}
else
{

require('../fpdf/fpdf.php');

require("../connexion.php");


$r = "SELECT c.idcommande, c.datecommande, CONCAT(cl.nom, ' ', cl.prenom) as client_nom, p.nomproduit, c.statut
FROM commande c, client cl, produit p
WHERE c.idclient = cl.idl AND c.idproduit = p.idproduit";
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


$pdf->Cell(0, 10, 'Liste des Commandes', 0, 1, 'C');
$pdf->Ln(6);


$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 220, 255); 

$pdf->Cell(20, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Date', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Client', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Produit', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Statut', 1, 0, 'C', true);
$pdf->Ln();


$pdf->SetFont('Arial', '', 9);
while ($data = mysqli_fetch_assoc($res)) {
    $pdf->Cell(20, 10, $data['idcommande'], 1);
    $pdf->Cell(30, 10, $data['datecommande'], 1);
    $pdf->Cell(50, 10, substr($data['client_nom'], 0, 22), 1);
    $pdf->Cell(60, 10, substr($data['nomproduit'], 0, 28), 1);
    $pdf->Cell(30, 10, substr($data['statut'], 0, 12), 1);
    $pdf->Ln();
}


$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0,10, 'Page ' . $pdf->PageNo() . ' sur {nb}', 0, 0, 'L');


mysqli_close($con);


$pdf->Output();
}
?>
