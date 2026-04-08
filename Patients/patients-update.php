<?php
	extract($_POST);
	$r = "update patients set 
	nom = '".$nom."', 
	prenom = '".$prenom."', 
	datenaissance = '".$datenaissance."', 
	sexe = '".$sexe."', 
	telephone = '".$telephone."', 
	email = '".$email."', 
	adresse = '".$adresse."', 
	datecreation = '".$datecreation."'
	where idpatient = ".$id;
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("patients-list.php");
?>
