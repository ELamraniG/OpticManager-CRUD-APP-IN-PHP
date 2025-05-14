<?php
require("../connexion.php");
require("../fonctions.php");
$id = isset($_POST['id']) ? mysqli_real_escape_string($con, $_POST['id']) : '';

$nom = isset($_POST['nom']) ? mysqli_real_escape_string($con, $_POST['nom']) : '';
$prenom = isset($_POST['prenom']) ? mysqli_real_escape_string($con, $_POST['prenom']) : '';
$adresse = isset($_POST['adresse']) ? mysqli_real_escape_string($con, $_POST['adresse']) : '';
$telephone = isset($_POST['telephone']) ? mysqli_real_escape_string($con, $_POST['telephone']) : '';
$email = isset($_POST['email']) ? mysqli_real_escape_string($con, $_POST['email']) : '';
$dateNaissance = isset($_POST['dateNaissance']) ? mysqli_real_escape_string($con, $_POST['dateNaissance']) : '';
$ordonnances = isset($_POST['ordonnances']) ? mysqli_real_escape_string($con, $_POST['ordonnances']) : '';
$historiqueAchats = isset($_POST['historiqueAchats']) ? mysqli_real_escape_string($con, $_POST['historiqueAchats']) : '';

$parties = array();
$parties[] = "`nom` = '" . $nom . "'";
$parties[] = "`prenom` = '" . $prenom . "'";
$parties[] = "`adresse` = '" . $adresse . "'";
$parties[] = "`telephone` = '" . $telephone . "'";
$parties[] = "`email` = '" . $email . "'";
$parties[] = "`dateNaissance` = '" . $dateNaissance . "'";
$parties[] = "`ordonnances` = '" . $ordonnances . "'";
$parties[] = "`historiqueAchats` = '" . $historiqueAchats . "'";

$r = "update `client` set " . implode(", ", $parties) . " where `idl` = '" . $id . "'";
mysqli_query($con, $r);
redirection("client-list.php");
?>
