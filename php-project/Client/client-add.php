<?php
	extract($_POST);
	$r = "insert into client (nom, prenom, adresse, telephone, email, dateNaissance, ordonnances, historiqueAchats)
	values ('".$nomc."', '".$prenomc."', '".$adressec."', '".$telc."', '".$emailc."', '".$datec."', '".$ordc."', '".$historyc."')";
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("client-list.php");
?>
