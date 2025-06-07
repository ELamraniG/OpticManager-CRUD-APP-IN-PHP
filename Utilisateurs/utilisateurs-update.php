<?php
	extract($_POST);
	
	if(!empty($motdepasse)){
		$r = "update utilisateurs set 
		nomutilisateur='".$nomutilisateur."',
		motdepasse=MD5('".$motdepasse."'),
		role='".$role."',
		nomcomplet='".$nomcomplet."',
		actif=".(empty($actif) ? "1" : $actif)."
		where idutilisateur=".$idutilisateur;
	} else {
		$r = "update utilisateurs set 
		nomutilisateur='".$nomutilisateur."',
		role='".$role."',
		nomcomplet='".$nomcomplet."',
		actif=".(empty($actif) ? "1" : $actif)."
		where idutilisateur=".$idutilisateur;
	}
	
	require("../connexion.php");
	mysqli_query($con, $r);
	require("../fonctions.php");
	redirection("utilisateurs-list.php");
?>
