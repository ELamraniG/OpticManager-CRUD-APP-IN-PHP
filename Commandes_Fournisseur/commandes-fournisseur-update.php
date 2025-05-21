<?php
require("../connexion.php");
require("../fonctions.php");
$id = isset($_POST['id']) ? mysqli_real_escape_string($con, $_POST['id']) : '';

$idfournisseur = isset($_POST['idfournisseur']) ? mysqli_real_escape_string($con, $_POST['idfournisseur']) : '';
$datecommande = isset($_POST['datecommande']) ? mysqli_real_escape_string($con, $_POST['datecommande']) : '';
$statut = isset($_POST['statut']) ? mysqli_real_escape_string($con, $_POST['statut']) : '';

$parties = array();
$parties[] = "`idfournisseur` = '" . $idfournisseur . "'";
$parties[] = "`datecommande` = '" . $datecommande . "'";
$parties[] = "`statut` = '" . $statut . "'";

$r = "update `commandes_fournisseur` set " . implode(", ", $parties) . " where `idcommande` = '" . $id . "'";
mysqli_query($con, $r);
redirection("commandes-fournisseur-list.php");
?>
