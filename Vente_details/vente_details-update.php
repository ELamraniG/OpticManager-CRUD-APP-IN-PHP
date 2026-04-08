<?php
	extract($_POST);
	$r = "update vente_details set
	idvente = ".$idvente.",
	idproduit = ".$idproduit.",
	quantite = ".$quantite.",
	prixunitaire = ".$prixunitaire."
	where iddetail = " . $id;
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("vente_details-list.php");
?>
