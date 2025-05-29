<?php
require("../connexion.php");
require("../fonctions.php");
$id = isset($_POST['id']) ? mysqli_real_escape_string($con, $_POST['id']) : '';

$idpatient = isset($_POST['idpatient']) ? mysqli_real_escape_string($con, $_POST['idpatient']) : '';
$datevente = isset($_POST['datevente']) ? mysqli_real_escape_string($con, $_POST['datevente']) : '';
$montanttotal = isset($_POST['montanttotal']) ? mysqli_real_escape_string($con, $_POST['montanttotal']) : '';
$modepaiement = isset($_POST['modepaiement']) ? mysqli_real_escape_string($con, $_POST['modepaiement']) : '';
$statutpaiement = isset($_POST['statutpaiement']) ? mysqli_real_escape_string($con, $_POST['statutpaiement']) : '';

$parties = array();
$parties[] = "`idpatient` = '" . $idpatient . "'";
$parties[] = "`datevente` = '" . $datevente . "'";
$parties[] = "`montanttotal` = '" . $montanttotal . "'";
$parties[] = "`modepaiement` = '" . $modepaiement . "'";
$parties[] = "`statutpaiement` = '" . $statutpaiement . "'";

$r = "update `ventes` set " . implode(", ", $parties) . " where `id_vente` = '" . $id . "'";
mysqli_query($con, $r);
redirection("ventes-list.php");
?>
