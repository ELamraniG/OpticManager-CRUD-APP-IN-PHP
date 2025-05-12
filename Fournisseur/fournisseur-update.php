<?php
require("../connexion.php");
require("../fonctions.php");
$id = isset($_POST['id']) ? mysqli_real_escape_string($con, $_POST['id']) : '';

$nom = isset($_POST['nom']) ? mysqli_real_escape_string($con, $_POST['nom']) : '';
$contact = isset($_POST['contact']) ? mysqli_real_escape_string($con, $_POST['contact']) : '';
$tel = isset($_POST['tel']) ? mysqli_real_escape_string($con, $_POST['tel']) : '';
$email = isset($_POST['email']) ? mysqli_real_escape_string($con, $_POST['email']) : '';
$adresse = isset($_POST['adresse']) ? mysqli_real_escape_string($con, $_POST['adresse']) : '';
$ville = isset($_POST['ville']) ? mysqli_real_escape_string($con, $_POST['ville']) : '';
$pays = isset($_POST['pays']) ? mysqli_real_escape_string($con, $_POST['pays']) : '';
$typedeproduit = isset($_POST['typedeproduit']) ? mysqli_real_escape_string($con, $_POST['typedeproduit']) : '';
$conditiondepaiement = isset($_POST['conditiondepaiement']) ? mysqli_real_escape_string($con, $_POST['conditiondepaiement']) : '';
$conditiondelivraison = isset($_POST['conditiondelivraison']) ? mysqli_real_escape_string($con, $_POST['conditiondelivraison']) : '';
$notes = isset($_POST['notes']) ? mysqli_real_escape_string($con, $_POST['notes']) : '';

$parties = array();
$parties[] = "`nom` = '" . $nom . "'";
$parties[] = "`contact` = '" . $contact . "'";
$parties[] = "`tel` = '" . $tel . "'";
$parties[] = "`email` = '" . $email . "'";
$parties[] = "`adresse` = '" . $adresse . "'";
$parties[] = "`ville` = '" . $ville . "'";
$parties[] = "`pays` = '" . $pays . "'";
$parties[] = "`typedeproduit` = '" . $typedeproduit . "'";
$parties[] = "`conditiondepaiement` = '" . $conditiondepaiement . "'";
$parties[] = "`conditiondelivraison` = '" . $conditiondelivraison . "'";
$parties[] = "`notes` = '" . $notes . "'";

$r = "update `fournisseur` set " . implode(", ", $parties) . " where `idf` = '" . $id . "'";
mysqli_query($con, $r);
redirection("fournisseur-list.php");
?>
