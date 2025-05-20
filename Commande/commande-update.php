<?php
require("../connexion.php");
require("../fonctions.php");
$id = isset($_POST['id']) ? mysqli_real_escape_string($con, $_POST['id']) : '';

$datecommande = isset($_POST['datecommande']) ? mysqli_real_escape_string($con, $_POST['datecommande']) : '';
$idclient = isset($_POST['idclient']) ? mysqli_real_escape_string($con, $_POST['idclient']) : '';
$idproduit = isset($_POST['idproduit']) ? mysqli_real_escape_string($con, $_POST['idproduit']) : '';
$statut = isset($_POST['statut']) ? mysqli_real_escape_string($con, $_POST['statut']) : '';

$parties = array();
$parties[] = "`datecommande` = '" . $datecommande . "'";
$parties[] = "`idclient` = '" . $idclient . "'";
$parties[] = "`idproduit` = '" . $idproduit . "'";
$parties[] = "`statut` = '" . $statut . "'";

$r = "update `commande` set " . implode(", ", $parties) . " where `idcommande` = '" . $id . "'";
mysqli_query($con, $r);
redirection("commande-list.php");
?>
