<?php
require("../connexion.php");
require("../fonctions.php");
$id = isset($_GET['id']) ? mysqli_real_escape_string($con, $_GET['id']) : '';
mysqli_query($con, "delete from `vente_details` where `iddetail` = '$id'");
redirection("vente_details-list.php");
?>
