<?php
require("../connexion.php");
require("../fonctions.php");
$id = isset($_POST['id']) ? mysqli_real_escape_string($con, $_POST['id']) : '';

$daterendezvous = isset($_POST['daterendezvous']) ? mysqli_real_escape_string($con, $_POST['daterendezvous']) : '';
$heurerendezvous = isset($_POST['heurerendezvous']) ? mysqli_real_escape_string($con, $_POST['heurerendezvous']) : '';
$idclient = isset($_POST['idclient']) ? mysqli_real_escape_string($con, $_POST['idclient']) : '';
$idcabinet = isset($_POST['idcabinet']) ? mysqli_real_escape_string($con, $_POST['idcabinet']) : '';
$notes = isset($_POST['notes']) ? mysqli_real_escape_string($con, $_POST['notes']) : '';
$niveaudecredibilite = isset($_POST['niveaudecredibilite']) ? mysqli_real_escape_string($con, $_POST['niveaudecredibilite']) : '';

$parties = array();
$parties[] = "`daterendezvous` = '" . $daterendezvous . "'";
$parties[] = "`heurerendezvous` = '" . $heurerendezvous . "'";
$parties[] = "`idclient` = '" . $idclient . "'";
$parties[] = "`idcabinet` = '" . $idcabinet . "'";
$parties[] = "`notes` = '" . $notes . "'";
$parties[] = "`niveaudecredibilite` = '" . $niveaudecredibilite . "'";

$r = "update `rendezvous` set " . implode(", ", $parties) . " where `idrendezvous` = '" . $id . "'";
mysqli_query($con, $r);
redirection("rendezvous-list.php");
?>
