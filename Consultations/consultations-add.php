<?php
	extract($_POST);
	$r = "insert into consultations 
	values (".$idconsultation.",
	".$idpatient.", 
	'".$dateconsultation."', 
	'".$motif."', 
	'".$observations."', 
	'".$prescriptionpdf."')";
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("consultations-list.php");
?>
