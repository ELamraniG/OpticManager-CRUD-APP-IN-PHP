<?php
require("../connexion.php");
require("../fonctions.php");

$datecommande = isset($_POST['datecommande']) ? mysqli_real_escape_string($con, $_POST['datecommande']) : '';
$idclient = isset($_POST['idclient']) ? mysqli_real_escape_string($con, $_POST['idclient']) : '';
$idproduit = isset($_POST['idproduit']) ? mysqli_real_escape_string($con, $_POST['idproduit']) : '';
$statut = isset($_POST['statut']) ? mysqli_real_escape_string($con, $_POST['statut']) : '';

$r = "insert into `commande` (`datecommande`, `idclient`, `idproduit`, `statut`) values ('" . $datecommande . "', '" . $idclient . "', '" . $idproduit . "', '" . $statut . "')";
mysqli_query($con, $r);
redirection("commande-list.php");
?>
