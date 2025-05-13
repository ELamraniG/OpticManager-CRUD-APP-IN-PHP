<?php
require("../connexion.php");
require("../fonctions.php");

$nom = isset($_POST['nom']) ? mysqli_real_escape_string($con, $_POST['nom']) : '';
$prenom = isset($_POST['prenom']) ? mysqli_real_escape_string($con, $_POST['prenom']) : '';
$adresse = isset($_POST['adresse']) ? mysqli_real_escape_string($con, $_POST['adresse']) : '';
$telephone = isset($_POST['telephone']) ? mysqli_real_escape_string($con, $_POST['telephone']) : '';
$email = isset($_POST['email']) ? mysqli_real_escape_string($con, $_POST['email']) : '';
$dateNaissance = isset($_POST['dateNaissance']) ? mysqli_real_escape_string($con, $_POST['dateNaissance']) : '';
$ordonnances = isset($_POST['ordonnances']) ? mysqli_real_escape_string($con, $_POST['ordonnances']) : '';
$historiqueAchats = isset($_POST['historiqueAchats']) ? mysqli_real_escape_string($con, $_POST['historiqueAchats']) : '';

$r = "insert into `client` (`nom`, `prenom`, `adresse`, `telephone`, `email`, `dateNaissance`, `ordonnances`, `historiqueAchats`) values ('" . $nom . "', '" . $prenom . "', '" . $adresse . "', '" . $telephone . "', '" . $email . "', '" . $dateNaissance . "', '" . $ordonnances . "', '" . $historiqueAchats . "')";
mysqli_query($con, $r);
redirection("client-list.php");
?>
