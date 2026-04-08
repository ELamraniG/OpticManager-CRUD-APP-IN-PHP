<?php
	extract($_POST);
	$r = "insert into vente_details 
	values (".$iddetail.",
	".$idvente.", 
	".$idproduit.", 
	".$quantite.", 
	".$prixunitaire.")";
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("vente_details-list.php");
?>
