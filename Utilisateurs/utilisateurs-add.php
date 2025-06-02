<?php
require("../connexion.php");
require("../fonctions.php");

$nomutilisateur = isset($_POST['nomutilisateur']) ? mysqli_real_escape_string($con, $_POST['nomutilisateur']) : '';
$motdepasse = isset($_POST['motdepasse']) ? $_POST['motdepasse'] : '';
$role = isset($_POST['role']) ? mysqli_real_escape_string($con, $_POST['role']) : '';
$nomcomplet = isset($_POST['nomcomplet']) ? mysqli_real_escape_string($con, $_POST['nomcomplet']) : '';
$actif = isset($_POST['actif']) ? mysqli_real_escape_string($con, $_POST['actif']) : '';

$r = "insert into `utilisateurs` (`nomutilisateur`, `motdepasse`, `role`, `nomcomplet`, `actif`) values ('" . $nomutilisateur . "', MD5('" . mysqli_real_escape_string($con, $motdepasse) . "'), '" . $role . "', '" . $nomcomplet . "', '" . $actif . "')";
mysqli_query($con, $r);
redirection("utilisateurs-list.php");
?>
