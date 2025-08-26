<?php
	extract($_POST);
	$r = "insert into ordonnances 
	values (".$idordonnance.",
	".$idconsultation.", 
	'".$oeil."', 
	".(empty($sphere) ? "NULL" : $sphere).", 
	".(empty($cylindre) ? "NULL" : $cylindre).", 
	".(empty($axe) ? "NULL" : $axe).", 
	".(empty($addition) ? "NULL" : $addition).", 
	'".$typecorrection."')";
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("ordonnances-list.php");
?>
