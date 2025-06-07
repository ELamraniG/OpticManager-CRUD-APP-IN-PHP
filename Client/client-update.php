<?php
	extract($_POST);
	$r = "update client
	set nom = '".$nomc."'
	, contact = '".$prenomc."'
	, tel = '".$telc."'
	, email = '".$emailc."'
	, adresse =  '".$adressec."'
	, dateNaissance = '".$datec."'
	, ordonnances =  '".$ordc."'
	, historiqueAchats =  '".$historyc."'
	where idf = ".$id;
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("client-list.php");
?>
