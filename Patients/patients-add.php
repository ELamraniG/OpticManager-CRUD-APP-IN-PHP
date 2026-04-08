<?php
	extract($_POST);
	$r = "insert into patients 
	values (".$idpatient.",
	'".$nom."', 
	'".$prenom."', 
	'".$datenaissance."', 
	'".$sexe."', 
	'".$telephone."', 
	'".$email."', 
	'".$adresse."', 
	'".$datecreation."')";
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("patients-list.php");
?>
