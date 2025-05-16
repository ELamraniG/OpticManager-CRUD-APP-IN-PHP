<?php
require("../connexion.php");
require("../fonctions.php");

$idc = isset($_POST['idc']) ? mysqli_real_escape_string($con, $_POST['idc']) : '';
$idf = isset($_POST['idf']) ? mysqli_real_escape_string($con, $_POST['idf']) : '';
$nomproduit = isset($_POST['nomproduit']) ? mysqli_real_escape_string($con, $_POST['nomproduit']) : '';
$marque = isset($_POST['marque']) ? mysqli_real_escape_string($con, $_POST['marque']) : '';
$notes = isset($_POST['notes']) ? mysqli_real_escape_string($con, $_POST['notes']) : '';
$prixdachat = isset($_POST['prixdachat']) ? mysqli_real_escape_string($con, $_POST['prixdachat']) : '';
$tvaappliquee = isset($_POST['tvaappliquee']) ? mysqli_real_escape_string($con, $_POST['tvaappliquee']) : '';
$prixdevente = isset($_POST['prixdevente']) ? mysqli_real_escape_string($con, $_POST['prixdevente']) : '';
$qteenstock = isset($_POST['qteenstock']) ? mysqli_real_escape_string($con, $_POST['qteenstock']) : '';
$seuildalerte = isset($_POST['seuildalerte']) ? mysqli_real_escape_string($con, $_POST['seuildalerte']) : '';

$r = "insert into `produit` (`idc`, `idf`, `nomproduit`, `marque`, `notes`, `prixdachat`, `tvaappliquee`, `prixdevente`, `qteenstock`, `seuildalerte`) values ('" . $idc . "', '" . $idf . "', '" . $nomproduit . "', '" . $marque . "', '" . $notes . "', '" . $prixdachat . "', '" . $tvaappliquee . "', '" . $prixdevente . "', '" . $qteenstock . "', '" . $seuildalerte . "')";
mysqli_query($con, $r);
redirection("produit-list.php");
?>
