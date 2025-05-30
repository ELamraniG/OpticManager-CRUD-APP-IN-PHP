<?php
require("../connexion.php");
require("../fonctions.php");

$idvente = isset($_POST['idvente']) ? mysqli_real_escape_string($con, $_POST['idvente']) : '';
$idproduit = isset($_POST['idproduit']) ? mysqli_real_escape_string($con, $_POST['idproduit']) : '';
$quantite = isset($_POST['quantite']) ? mysqli_real_escape_string($con, $_POST['quantite']) : '';
$prixunitaire = isset($_POST['prixunitaire']) ? mysqli_real_escape_string($con, $_POST['prixunitaire']) : '';

$r = "insert into `vente_details` (`idvente`, `idproduit`, `quantite`, `prixunitaire`) values ('" . $idvente . "', '" . $idproduit . "', '" . $quantite . "', '" . $prixunitaire . "')";
mysqli_query($con, $r);
redirection("vente_details-list.php");
?>
