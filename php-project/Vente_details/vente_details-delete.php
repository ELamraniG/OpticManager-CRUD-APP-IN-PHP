<?php
	extract($_POST);
	$r = "delete from vente_details where iddetail = " . $id;
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("vente_details-list.php");
?>
