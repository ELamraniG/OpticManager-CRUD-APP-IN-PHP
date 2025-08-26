<?php
	extract($_POST);
	$r = "update consultations set 
	idpatient = ".$idpatient.", 
	dateconsultation = '".$dateconsultation."', 
	motif = '".$motif."', 
	observations = '".$observations."', 
	prescriptionpdf = '".$prescriptionpdf."'
	where idconsultation = ".$id;
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("consultations-list.php");
?>

