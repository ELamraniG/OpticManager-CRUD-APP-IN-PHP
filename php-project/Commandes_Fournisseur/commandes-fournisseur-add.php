<?php
	extract($_POST);
	if (isset($idfournisseur)) {
		$r = "INSERT INTO commandes_fournisseur (idfournisseur, datecommande, statut) 
		      VALUES ('$idfournisseur', '$datecommande', '$statut')";
		require("../connexion.php");
		mysqli_query($con, $r);
		mysqli_close($con);
		require("../fonctions.php");
		redirection("commandes-fournisseur-list.php");
	}
?>

