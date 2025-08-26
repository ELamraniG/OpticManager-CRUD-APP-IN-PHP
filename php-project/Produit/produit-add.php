<?php
	extract($_POST);
	$r = "insert into produit 
	values (".$idp.",
	'".$idc."', 
	'".$idf."', 
	'".$nomp."', 
	'".$marquep."', 
	'".$notep."', 
	'".$prixa."', 
	'".$tva."', 
	'".$prixv."', 
	'".$qte."', 
	'".$seuil."')";
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("produit-list.php");
?>