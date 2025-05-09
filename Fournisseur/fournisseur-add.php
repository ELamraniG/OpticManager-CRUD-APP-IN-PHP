<?php
require("../connexion.php");
require("../fonctions.php");

$idf = isset($_POST['idf']) ? mysqli_real_escape_string($con, $_POST['idf']) : '';
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

$r = "insert into `fournisseur` (`idf`, `nom`, `contact`, `tel`, `email`, `adresse`, `ville`, `pays`, `typedeproduit`, `conditiondepaiement`, `conditiondelivraison`, `notes`) values ('" . $idf . "', '" . $nom . "', '" . $contact . "', '" . $tel . "', '" . $email . "', '" . $adresse . "', '" . $ville . "', '" . $pays . "', '" . $typedeproduit . "', '" . $conditiondepaiement . "', '" . $conditiondelivraison . "', '" . $notes . "')";
mysqli_query($con, $r);
redirection("fournisseur-list.php");
?>
