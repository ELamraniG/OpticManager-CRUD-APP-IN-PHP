<?php
require("../connexion.php");
require("../fonctions.php");
$id = isset($_POST['id']) ? mysqli_real_escape_string($con, $_POST['id']) : '';

$idpatient = isset($_POST['idpatient']) ? mysqli_real_escape_string($con, $_POST['idpatient']) : '';
$dateconsultation = isset($_POST['dateconsultation']) ? mysqli_real_escape_string($con, $_POST['dateconsultation']) : '';
$motif = isset($_POST['motif']) ? mysqli_real_escape_string($con, $_POST['motif']) : '';
$observations = isset($_POST['observations']) ? mysqli_real_escape_string($con, $_POST['observations']) : '';
$prescriptionpdf = isset($_POST['prescriptionpdf']) ? mysqli_real_escape_string($con, $_POST['prescriptionpdf']) : '';

$parties = array();
$parties[] = "`idpatient` = '" . $idpatient . "'";
$parties[] = "`dateconsultation` = '" . $dateconsultation . "'";
$parties[] = "`motif` = '" . $motif . "'";
$parties[] = "`observations` = '" . $observations . "'";
$parties[] = "`prescriptionpdf` = '" . $prescriptionpdf . "'";

$r = "update `consultations` set " . implode(", ", $parties) . " where `idconsultation` = '" . $id . "'";
mysqli_query($con, $r);
redirection("consultations-list.php");
?>
