<?php
	extract($_POST);
	$r = "insert into utilisateurs 
	values (".$idutilisateur.",
	'".$nomutilisateur."', 
	MD5('".$motdepasse."'), 
	'".$role."', 
	'".$nomcomplet."', 
	".(empty($actif) ? "1" : $actif).")";
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("utilisateurs-list.php");
?>
