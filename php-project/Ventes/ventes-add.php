<?php
	extract($_POST);
	$r = "insert into ventes 
	values (".$id_vente.",
	".$idpatient.", 
	'".$datevente."', 
	".$montanttotal.", 
	'".$modepaiement."', 
	'".$statutpaiement."')";
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("ventes-list.php");
?>
