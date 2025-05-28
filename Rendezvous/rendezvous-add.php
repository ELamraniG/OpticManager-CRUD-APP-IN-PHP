<?php
require("../connexion.php");
require("../fonctions.php");

$daterendezvous = isset($_POST['daterendezvous']) ? mysqli_real_escape_string($con, $_POST['daterendezvous']) : '';
$heurerendezvous = isset($_POST['heurerendezvous']) ? mysqli_real_escape_string($con, $_POST['heurerendezvous']) : '';
$idclient = isset($_POST['idclient']) ? mysqli_real_escape_string($con, $_POST['idclient']) : '';
$idcabinet = isset($_POST['idcabinet']) ? mysqli_real_escape_string($con, $_POST['idcabinet']) : '';
$notes = isset($_POST['notes']) ? mysqli_real_escape_string($con, $_POST['notes']) : '';
$niveaudecredibilite = isset($_POST['niveaudecredibilite']) ? mysqli_real_escape_string($con, $_POST['niveaudecredibilite']) : '';

$r = "insert into `rendezvous` (`daterendezvous`, `heurerendezvous`, `idclient`, `idcabinet`, `notes`, `niveaudecredibilite`) values ('" . $daterendezvous . "', '" . $heurerendezvous . "', '" . $idclient . "', '" . $idcabinet . "', '" . $notes . "', '" . $niveaudecredibilite . "')";
mysqli_query($con, $r);
redirection("rendezvous-list.php");
?>
