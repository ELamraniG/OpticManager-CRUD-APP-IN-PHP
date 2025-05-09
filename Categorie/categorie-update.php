<?php
require("../connexion.php");
require("../fonctions.php");
$id = isset($_POST['id']) ? mysqli_real_escape_string($con, $_POST['id']) : '';

$titrec = isset($_POST['titrec']) ? mysqli_real_escape_string($con, $_POST['titrec']) : '';

$parties = array();
$parties[] = "`titrec` = '" . $titrec . "'";

$r = "update `categorie` set " . implode(", ", $parties) . " where `idc` = '" . $id . "'";
mysqli_query($con, $r);
redirection("categorie-list.php");
?>
