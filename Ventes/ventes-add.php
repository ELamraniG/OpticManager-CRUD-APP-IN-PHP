<?php
require("../connexion.php");
require("../fonctions.php");

$idpatient = isset($_POST['idpatient']) ? mysqli_real_escape_string($con, $_POST['idpatient']) : '';
$datevente = isset($_POST['datevente']) ? mysqli_real_escape_string($con, $_POST['datevente']) : '';
$montanttotal = isset($_POST['montanttotal']) ? mysqli_real_escape_string($con, $_POST['montanttotal']) : '';
$modepaiement = isset($_POST['modepaiement']) ? mysqli_real_escape_string($con, $_POST['modepaiement']) : '';
$statutpaiement = isset($_POST['statutpaiement']) ? mysqli_real_escape_string($con, $_POST['statutpaiement']) : '';

$r = "insert into `ventes` (`idpatient`, `datevente`, `montanttotal`, `modepaiement`, `statutpaiement`) values ('" . $idpatient . "', '" . $datevente . "', '" . $montanttotal . "', '" . $modepaiement . "', '" . $statutpaiement . "')";
mysqli_query($con, $r);
redirection("ventes-list.php");
?>
