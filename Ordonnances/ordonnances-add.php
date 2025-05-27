<?php
require("../connexion.php");
require("../fonctions.php");

$idconsultation = isset($_POST['idconsultation']) ? mysqli_real_escape_string($con, $_POST['idconsultation']) : '';
$oeil = isset($_POST['oeil']) ? mysqli_real_escape_string($con, $_POST['oeil']) : '';
$sphere = isset($_POST['sphere']) ? mysqli_real_escape_string($con, $_POST['sphere']) : '';
$cylindre = isset($_POST['cylindre']) ? mysqli_real_escape_string($con, $_POST['cylindre']) : '';
$axe = isset($_POST['axe']) ? mysqli_real_escape_string($con, $_POST['axe']) : '';
$addition = isset($_POST['addition']) ? mysqli_real_escape_string($con, $_POST['addition']) : '';
$typecorrection = isset($_POST['typecorrection']) ? mysqli_real_escape_string($con, $_POST['typecorrection']) : '';

$r = "insert into `ordonnances` (`idconsultation`, `oeil`, `sphere`, `cylindre`, `axe`, `addition`, `typecorrection`) values ('" . $idconsultation . "', '" . $oeil . "', '" . $sphere . "', '" . $cylindre . "', '" . $axe . "', '" . $addition . "', '" . $typecorrection . "')";
mysqli_query($con, $r);
redirection("ordonnances-list.php");
?>
