<?php
	extract($_POST);
	$r = "update fournisseur
	set nom = '".$nomf."'
	, contact = '".$contactf."'
	, tel = '".$telf."'
	, email = '".$emailf."'
	, adresse =  '".$adressef."'
	, ville = '".$villef."'
	, pays =  '".$paysf."'
	, typedeproduit =  '".$typef."'
	, conditiondepaiement = '".$conditionpf."'
	, conditiondelivraison =  '".$conditionlf."'
	, notes = '".$notef."'
	where idf = ".$id;
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("fournisseur-list.php");
?>