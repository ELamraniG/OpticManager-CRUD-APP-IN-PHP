<?php
	extract($_POST);
	$r = "update ventes set 
	idpatient = ".$idpatient.", 
	datevente = '".$datevente."', 
	montanttotal = ".$montanttotal.", 
	modepaiement = '".$modepaiement."', 
	statutpaiement = '".$statutpaiement."'
	where id_vente = ".$id;
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("ventes-list.php");
?>
