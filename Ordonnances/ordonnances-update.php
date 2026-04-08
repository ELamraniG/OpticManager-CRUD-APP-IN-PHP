<?php
	extract($_POST);
	$r = "update ordonnances set 
	idconsultation = ".$idconsultation.", 
	oeil = '".$oeil."', 
	sphere = ".(empty($sphere) ? "NULL" : $sphere).", 
	cylindre = ".(empty($cylindre) ? "NULL" : $cylindre).", 
	axe = ".(empty($axe) ? "NULL" : $axe).", 
	addition = ".(empty($addition) ? "NULL" : $addition).", 
	typecorrection = '".$typecorrection."'
	where idordonnance = ".$id;
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("ordonnances-list.php");
?>
