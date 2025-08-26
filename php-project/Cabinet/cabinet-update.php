<?php
	extract($_POST);
	$r = "update cabinet
	set nomcabinet = '".$nomc."'
	, siteweb = '".$sitewebc."'
	, telephone = '".$telc."'
	, email = '".$emailc."'
	, adresse =  '".$adressec."'
	, ville = '".$villec."'
	, pays =  '".$paysc."'
	, codepostal =  '".$codepc."'
	, responsable = '".$respoc."'
	, specialite =  '".$spc."'
	, logo = '".$logoc."'
	where idcabinet = ".$id;
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("cabinet-list.php");
?>