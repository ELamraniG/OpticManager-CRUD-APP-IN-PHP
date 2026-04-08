<?php
	extract($_POST);
	$r = "insert into commande 
	values (".$idc.",
	'".$datec."', 
	'".$idclient."', 
	'".$idproduit."', 
	'".$statut."')";
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("commande-list.php");
?>
