<?php
require('../fpdf/fpdf.php');
require("../connexion.php");
extract($_POST);
$etat = $_GET['etat'];

//Si la 1ère option de imprimer est choisie
if ($etat == 1) {
    //Recherche des données de pointage
    $r = "select employe.*, pointage.*
from pointage, employe
where pointage.idemploye = employe.idemploye
and datepointage between '". $dp1 . "' and '" . $dp2 . "'"; 
}

//Si la 2ème option de imprimer est choisie
if ($etat == 2) {
    //Recherche des données de pointage
    $r = "select employe.*, pointage.*
from pointage, employe
where pointage.idemploye = employe.idemploye
and pointage.idemploye = $idemploye
and datepointage between '". $dp1 . "' and '" . $dp2 . "'"; 
}

//Si la 3ème option de imprimer est choisie
if ($etat == 3) {
    //Recherche des données de pointage
$r = "select employe.*, pointage.*
from pointage, employe, affecter
where pointage.idemploye = employe.idemploye
and affecter.idemploye = employe.idemploye
and affecter.idservice = '". $idservice . "' 
and datepointage between '". $dp1 . "' and '" . $dp2 . "'"; 
}

//Exécution de la requête
$res = mysqli_query($con, $r);
$pdf = new FPDF();
$pdf->AliasNbPages(); 
$pdf->AddPage();

//Entête de la page
$pdf->SetFont('Arial', 'B', 16);
$pdf->Image('../images/lap2.png', 10, 10, 0, 5);
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Liste des pointages ', 0, 1, 'C');
if ($etat == 2)
{
    $r_employe = "select * from employe where idemploye = " . $idemploye;
    $res_employe = mysqli_query($con, $r_employe);
    $data_employe = mysqli_fetch_assoc($res_employe);
    $nom_prenom = strtoupper($data_employe['nom']) . " " . strtoupper($data_employe['prenom']);
    $pdf->Ln(0);
    $pdf->Cell(0, 10, $nom_prenom, 0, 1, 'C');
}
if ($etat == 3)
{
    $r_service = "select * from service where idservice = '" . $idservice . "'";
    $res_service = mysqli_query($con, $r_service);
    $data_employe = mysqli_fetch_assoc($res_service);
    $nomservice = strtoupper($data_employe['nomservice']);
    $pdf->Ln(0);
    $pdf->Cell(0, 10, $nomservice, 0, 1, 'C');
}

$pdf->SetFont('Arial', '', 16);
$pdf->Cell(0, 8, $employe, 0, 1, 'C');
$pdf->Ln(6);

//Entête du tableau
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 220, 255); 
$cellWidth = ($pdf->GetPageWidth()-20)/6 ;
$pdf->Cell($cellWidth, 8, 'Date ', 0, 0, 'C', true);
$pdf->Cell($cellWidth, 8, utf8_decode('Heure d entrée'), 0, 0, 'C', true);
$pdf->Cell($cellWidth, 8, 'Heure de sortie', 0, 0, 'C', true);
$pdf->Cell($cellWidth, 8, utf8_decode('Heures travaillées'), 0, 0, 'C', true);
$pdf->Cell($cellWidth*2, 8, utf8_decode('Notes'), 0, 0, 'C', true);
$pdf->Ln();

//Contenu du tableau, impression des lignes de pointage
$pdf->SetFont('Arial', '', 10);
while ($data = mysqli_fetch_assoc($res)) 
{
    if ($fill) {
        $pdf->SetFillColor(240, 240, 240); 
    } else {
        $pdf->SetFillColor(255, 255, 255); 
    }
    $he = date('H:i', strtotime($data['heuredentree']));
    $hs = date('H:i', strtotime($data['heuresortie']));

    $pdf->Cell($cellWidth, 8, $data['datepointage'], 0, 0, 'C', $fill);
    $pdf->Cell($cellWidth, 8, $he, 0, 0, 'C', $fill);
    $pdf->Cell($cellWidth, 8, $hs, 0, 0, 'C', $fill);
    $heuretravaillees = $data['heuresortie'] - $data['heuredentree'];
    $heuretravaillees .= " H";
    $pdf->Cell($cellWidth, 8, $heuretravaillees, 0, 0, 'C', $fill);
    $pdf->Cell($cellWidth*2, 8, $data['notes'], 0, 0, 'C', $fill);
    $pdf->Ln();
    $fill = !$fill; 
}
//Numéro de page
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0,10, 'Page ' . $pdf->PageNo() . ' sur {nb}', 0, 0, 'L');
mysqli_close($con);
$pdf->Output();

?>
