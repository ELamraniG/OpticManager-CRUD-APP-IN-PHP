<?php
	extract($_POST);
	$r = "update rendezvous
	set idclient = '".$idl."'
	, idcabinet = '".$idcabinet."'
	, daterendezvous = '".$dater."'
	, heurerendezvous = '".$timer."'
	, notes = '".$notes."'
	, niveaudecredibilite = '".$niveaudecredibilite."'
	where idrendezvous = ".$id;
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("rendezvous-list.php");
?>