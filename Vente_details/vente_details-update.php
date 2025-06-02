<?php
require("../connexion.php");
require("../fonctions.php");
$id = isset($_POST['id']) ? mysqli_real_escape_string($con, $_POST['id']) : '';

$idvente = isset($_POST['idvente']) ? mysqli_real_escape_string($con, $_POST['idvente']) : '';
$idproduit = isset($_POST['idproduit']) ? mysqli_real_escape_string($con, $_POST['idproduit']) : '';
$quantite = isset($_POST['quantite']) ? mysqli_real_escape_string($con, $_POST['quantite']) : '';
$prixunitaire = isset($_POST['prixunitaire']) ? mysqli_real_escape_string($con, $_POST['prixunitaire']) : '';

$parties = array();
$parties[] = "`idvente` = '" . $idvente . "'";
$parties[] = "`idproduit` = '" . $idproduit . "'";
$parties[] = "`quantite` = '" . $quantite . "'";
$parties[] = "`prixunitaire` = '" . $prixunitaire . "'";

$r = "update `vente_details` set " . implode(", ", $parties) . " where `iddetail` = '" . $id . "'";
mysqli_query($con, $r);
redirection("vente_details-list.php");
?>
