<?php
	require("../connexion.php");
	extract($_POST);
	
	$gerer = isset($_POST['gerer']) ? 1 : 0;
	$service = isset($_POST['service']) ? 1 : 0;
	$employe = isset($_POST['employe']) ? 1 : 0;
	$lesaffectationsauxservices = isset($_POST['lesaffectationsauxservices']) ? 1 : 0;
	$pointage = isset($_POST['pointage']) ? 1 : 0;
	$pointageindividuel = isset($_POST['pointageindividuel']) ? 1 : 0;
	$pointageautomatique = isset($_POST['pointageautomatique']) ? 1 : 0;
	$rapportetstatistiques = isset($_POST['rapportetstatistiques']) ? 1 : 0;
	$tableaudebord = isset($_POST['tableaudebord']) ? 1 : 0;
	$etatdesemployesparservice = isset($_POST['etatdesemployesparservice']) ? 1 : 0;
	$etatdesaffectationsdunemploye = isset($_POST['etatdesaffectationsdunemploye']) ? 1 : 0;
	$etatdespointagesentredatesdunemploye = isset($_POST['etatdespointagesentredatesdunemploye']) ? 1 : 0;
	$parametre = isset($_POST['parametre']) ? 1 : 0;
	$gestiondesutilisateurs = isset($_POST['gestiondesutilisateurs']) ? 1 : 0;
	$configurationdelapplication = isset($_POST['configurationdelapplication']) ? 1 : 0;

	$r = "update utilisateur
		set idemploye = ".$idemploye.
		", login = '".$login.
		"', motdepasse = '".$motdepasse.
		"', typeutilisateur = '".$typeutilisateur.
		"', gerer = ".$gerer.
		", service = ".$service.
		", employe = ".$employe.
		", lesaffectationsauxservices = ".$lesaffectationsauxservices.
		", pointage = ".$pointage.
		", pointageindividuel = ".$pointageindividuel.
		", pointageautomatique = ".$pointageautomatique.
		", rapportetstatistiques = ".$rapportetstatistiques.
		", tableaudebord = ".$tableaudebord.
		", etatdesemployesparservice = ".$etatdesemployesparservice.
		", etatdesaffectationsdunemploye = ".$etatdesaffectationsdunemploye.
		", etatdespointagesentredatesdunemploye = ".$etatdespointagesentredatesdunemploye.
		", parametre = ".$parametre.
		", gestiondesutilisateurs = ".$gestiondesutilisateurs.
		", configurationdelapplication = ".$configurationdelapplication.
		" where idutilisateur = ".$ancien_idutilisateur;

	//Exécution de la requête d'action
	mysqli_query($con, $r);
	mysqli_close($con);
	
	require("../fonctions.php");
	redirection("utilisateur-list.php");
?>