<?php
	extract($_POST);
	$r = "insert into fournisseur 
	values ('".$idf."', '".$nomf."', '".$contactf."', '".$telf."', '".$emailc."', '".$adressef."', '".$villef."', '".$paysf."', '".$typef."', '".$conditionpf."', '".$conditionlf."', '".$notef."')";
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("fournisseur-list.php");
?>