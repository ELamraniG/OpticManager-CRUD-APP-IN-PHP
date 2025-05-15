<?php
require("../connexion.php");
require("../fonctions.php");
$id = isset($_POST['id']) ? mysqli_real_escape_string($con, $_POST['id']) : '';

$nomcabinet = isset($_POST['nomcabinet']) ? mysqli_real_escape_string($con, $_POST['nomcabinet']) : '';
$adresse = isset($_POST['adresse']) ? mysqli_real_escape_string($con, $_POST['adresse']) : '';
$telephone = isset($_POST['telephone']) ? mysqli_real_escape_string($con, $_POST['telephone']) : '';
$email = isset($_POST['email']) ? mysqli_real_escape_string($con, $_POST['email']) : '';
$siteweb = isset($_POST['siteweb']) ? mysqli_real_escape_string($con, $_POST['siteweb']) : '';
$responsable = isset($_POST['responsable']) ? mysqli_real_escape_string($con, $_POST['responsable']) : '';
$specialite = isset($_POST['specialite']) ? mysqli_real_escape_string($con, $_POST['specialite']) : '';
$ville = isset($_POST['ville']) ? mysqli_real_escape_string($con, $_POST['ville']) : '';
$pays = isset($_POST['pays']) ? mysqli_real_escape_string($con, $_POST['pays']) : '';
$codepostal = isset($_POST['codepostal']) ? mysqli_real_escape_string($con, $_POST['codepostal']) : '';
$logo = isset($_POST['logo']) ? mysqli_real_escape_string($con, $_POST['logo']) : '';

$parties = array();
$parties[] = "`nomcabinet` = '" . $nomcabinet . "'";
$parties[] = "`adresse` = '" . $adresse . "'";
$parties[] = "`telephone` = '" . $telephone . "'";
$parties[] = "`email` = '" . $email . "'";
$parties[] = "`siteweb` = '" . $siteweb . "'";
$parties[] = "`responsable` = '" . $responsable . "'";
$parties[] = "`specialite` = '" . $specialite . "'";
$parties[] = "`ville` = '" . $ville . "'";
$parties[] = "`pays` = '" . $pays . "'";
$parties[] = "`codepostal` = '" . $codepostal . "'";
$parties[] = "`logo` = '" . $logo . "'";

$r = "update `cabinet` set " . implode(", ", $parties) . " where `idcabinet` = '" . $id . "'";
mysqli_query($con, $r);
redirection("cabinet-list.php");
?>
