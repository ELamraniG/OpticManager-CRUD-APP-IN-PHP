<?php
	extract($_POST);
	$r = "insert into cabinet 
	values ('".$idc."',
	'".$nomc."', 
	'".$adressec."', 
	'".$telc."', 
	'".$emailc."', 
	'".$sitewebc."', 
	'".$respoc."', 
	'".$spc."', 
	'".$villec."', 
	'".$paysc."', 
	'".$codepc."', 
	'".$logoc."')";
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("cabinet-list.php");
?>
