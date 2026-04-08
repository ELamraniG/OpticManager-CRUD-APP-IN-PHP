<?php
	extract($_POST);	$r = "update client
	set nom = '".$nomc."'
	, prenom = '".$prenomc."'
	, telephone = '".$telc."'
	, email = '".$emailc."'
	, adresse =  '".$adressec."'
	, dateNaissance = '".$datec."'
	, ordonnances =  '".$ordc."'
	, historiqueAchats =  '".$historyc."'
	where idl = ".$id;
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("client-list.php");
?>
