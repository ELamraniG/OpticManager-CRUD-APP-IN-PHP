<?php
require("../connexion.php");
require("../fonctions.php");

$idcabinet = isset($_POST['idcabinet']) ? mysqli_real_escape_string($con, $_POST['idcabinet']) : '';
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

$r = "insert into `cabinet` (`idcabinet`, `nomcabinet`, `adresse`, `telephone`, `email`, `siteweb`, `responsable`, `specialite`, `ville`, `pays`, `codepostal`, `logo`) values ('" . $idcabinet . "', '" . $nomcabinet . "', '" . $adresse . "', '" . $telephone . "', '" . $email . "', '" . $siteweb . "', '" . $responsable . "', '" . $specialite . "', '" . $ville . "', '" . $pays . "', '" . $codepostal . "', '" . $logo . "')";
mysqli_query($con, $r);
redirection("cabinet-list.php");
?>
