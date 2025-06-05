<?php
	extract($_POST);
	if (isset($idfournisseur)) {
		$r = "UPDATE commandes_fournisseur SET 
		      idfournisseur = '$idfournisseur', 
		      datecommande = '$datecommande', 
		      statut = '$statut' 
		      WHERE idcommande = '$id'";
		require("../connexion.php");
		mysqli_query($con, $r);
		mysqli_close($con);
		require("../fonctions.php");
		redirection("commandes-fournisseur-list.php");
	}
?>
