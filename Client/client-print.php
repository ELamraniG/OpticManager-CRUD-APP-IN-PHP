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


$r = "SELECT * FROM client";
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


$pdf->Cell(0, 10, 'Liste des Clients', 0, 1, 'C');
$pdf->Ln(6);


$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 220, 255); 

$pdf->Cell(25, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Nom', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Prenom', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Telephone', 1, 0, 'C', true);
$pdf->Cell(55, 10, 'Email', 1, 0, 'C', true);
$pdf->Ln();


$pdf->SetFont('Arial', '', 9);
while ($data = mysqli_fetch_assoc($res)) {
    $pdf->Cell(25, 10, $data['idl'], 1);
    $pdf->Cell(40, 10, substr($data['nom'], 0, 18), 1);
    $pdf->Cell(40, 10, substr($data['prenom'], 0, 18), 1);
    $pdf->Cell(30, 10, $data['telephone'], 1);
    $pdf->Cell(55, 10, substr($data['email'], 0, 25), 1);
    $pdf->Ln();
}


$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0,10, 'Page ' . $pdf->PageNo() . ' sur {nb}', 0, 0, 'L');



mysqli_close($con);

$pdf->Output();
}
?>
