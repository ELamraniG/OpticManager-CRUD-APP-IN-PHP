<?php
require("../connexion.php");
require("../fonctions.php");

$idc = isset($_POST['idc']) ? mysqli_real_escape_string($con, $_POST['idc']) : '';
$titrec = isset($_POST['titrec']) ? mysqli_real_escape_string($con, $_POST['titrec']) : '';

$r = "insert into `categorie` (`idc`, `titrec`) values ('" . $idc . "', '" . $titrec . "')";
mysqli_query($con, $r);
redirection("categorie-list.php");
?>
