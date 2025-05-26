<?php
require("../connexion.php");
require("../fonctions.php");

$idpatient = isset($_POST['idpatient']) ? mysqli_real_escape_string($con, $_POST['idpatient']) : '';
$dateconsultation = isset($_POST['dateconsultation']) ? mysqli_real_escape_string($con, $_POST['dateconsultation']) : '';
$motif = isset($_POST['motif']) ? mysqli_real_escape_string($con, $_POST['motif']) : '';
$observations = isset($_POST['observations']) ? mysqli_real_escape_string($con, $_POST['observations']) : '';
$prescriptionpdf = isset($_POST['prescriptionpdf']) ? mysqli_real_escape_string($con, $_POST['prescriptionpdf']) : '';

$r = "insert into `consultations` (`idpatient`, `dateconsultation`, `motif`, `observations`, `prescriptionpdf`) values ('" . $idpatient . "', '" . $dateconsultation . "', '" . $motif . "', '" . $observations . "', '" . $prescriptionpdf . "')";
mysqli_query($con, $r);
redirection("consultations-list.php");
?>
