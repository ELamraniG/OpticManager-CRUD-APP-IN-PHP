<?php
	extract($_POST);
	$r = "insert into categorie 
	values ('".$idc."', '".$titrec."')";
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("categorie-list.php");
?>
