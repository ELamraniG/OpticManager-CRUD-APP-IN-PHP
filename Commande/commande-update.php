<?php
	extract($_POST);
	$r = "update commande
	set idclient = '".$idl."'
	, idproduit = '".$idproduit."'
	, datecommande = '".$datec."'
	, statut = '".$statut."'
	where idcommande = ".$id;
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("commande-list.php");
?>
