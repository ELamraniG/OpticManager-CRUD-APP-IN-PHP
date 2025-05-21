<?php
require("../connexion.php");
require("../fonctions.php");

$idfournisseur = isset($_POST['idfournisseur']) ? mysqli_real_escape_string($con, $_POST['idfournisseur']) : '';
$datecommande = isset($_POST['datecommande']) ? mysqli_real_escape_string($con, $_POST['datecommande']) : '';
$statut = isset($_POST['statut']) ? mysqli_real_escape_string($con, $_POST['statut']) : '';

$r = "insert into `commandes_fournisseur` (`idfournisseur`, `datecommande`, `statut`) values ('" . $idfournisseur . "', '" . $datecommande . "', '" . $statut . "')";
mysqli_query($con, $r);
redirection("commandes-fournisseur-list.php");
?>
