<?php
	extract($_POST);
	$r = "insert into rendezvous 
	values (".$idr.",
	'".$dater."',
	'".$timer."',
	'".$idclient."', 
	'".$idcabinet."', 
	'".$notes."', 
	'".$ncr."')";
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("rendezvous-list.php");
?>