<?php
require("../connexion.php");
require("../fonctions.php");
$id = isset($_POST['id']) ? mysqli_real_escape_string($con, $_POST['id']) : '';

$nomutilisateur = isset($_POST['nomutilisateur']) ? mysqli_real_escape_string($con, $_POST['nomutilisateur']) : '';
$motdepasse = isset($_POST['motdepasse']) ? $_POST['motdepasse'] : '';
$role = isset($_POST['role']) ? mysqli_real_escape_string($con, $_POST['role']) : '';
$nomcomplet = isset($_POST['nomcomplet']) ? mysqli_real_escape_string($con, $_POST['nomcomplet']) : '';
$actif = isset($_POST['actif']) ? mysqli_real_escape_string($con, $_POST['actif']) : '';

$parties = array();
$parties[] = "`nomutilisateur` = '" . $nomutilisateur . "'";
if ($motdepasse != '') {
    $motdepasse = mysqli_real_escape_string($con, $motdepasse);
    $parties[] = "`motdepasse` = MD5('" . $motdepasse . "')";
}
$parties[] = "`role` = '" . $role . "'";
$parties[] = "`nomcomplet` = '" . $nomcomplet . "'";
$parties[] = "`actif` = '" . $actif . "'";

$r = "update `utilisateurs` set " . implode(", ", $parties) . " where `idutilisateur` = '" . $id . "'";
mysqli_query($con, $r);
redirection("utilisateurs-list.php");
?>
