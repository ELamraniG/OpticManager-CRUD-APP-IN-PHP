<?php
require("../connexion.php");
require("../fonctions.php");

$nom = isset($_POST['nom']) ? mysqli_real_escape_string($con, $_POST['nom']) : '';
$prenom = isset($_POST['prenom']) ? mysqli_real_escape_string($con, $_POST['prenom']) : '';
$datenaissance = isset($_POST['datenaissance']) ? mysqli_real_escape_string($con, $_POST['datenaissance']) : '';
$sexe = isset($_POST['sexe']) ? mysqli_real_escape_string($con, $_POST['sexe']) : '';
$telephone = isset($_POST['telephone']) ? mysqli_real_escape_string($con, $_POST['telephone']) : '';
$email = isset($_POST['email']) ? mysqli_real_escape_string($con, $_POST['email']) : '';
$adresse = isset($_POST['adresse']) ? mysqli_real_escape_string($con, $_POST['adresse']) : '';
$datecreation = isset($_POST['datecreation']) ? mysqli_real_escape_string($con, $_POST['datecreation']) : '';

$r = "insert into `patients` (`nom`, `prenom`, `datenaissance`, `sexe`, `telephone`, `email`, `adresse`, `datecreation`) values ('" . $nom . "', '" . $prenom . "', '" . $datenaissance . "', '" . $sexe . "', '" . $telephone . "', '" . $email . "', '" . $adresse . "', '" . $datecreation . "')";
mysqli_query($con, $r);
redirection("patients-list.php");
?>
