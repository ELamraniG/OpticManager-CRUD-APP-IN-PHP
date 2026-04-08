<?php
	extract($_POST);
	$r = "update produit
	set nomproduit = '".$nomp."'
	, idc = '".$idc."'
	, idf = '".$idf."'
	, marque = '".$marque."'
	, prixdachat =  '".$prixa."'
	, tvaappliquee = '".$tva."'
	, prixdevente =  '".$prixv."'
	, qteenstock =  '".$qte."'
	, seuildalerte = '".$seuil."'
	where idproduit = ".$id;
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("produit-list.php");
?>