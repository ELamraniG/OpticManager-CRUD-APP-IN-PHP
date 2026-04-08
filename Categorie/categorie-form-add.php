<?php
	require("../head.php");
	require("../fonctions.php");
	require("../connexion.php");
	$r = "select * from categorie";
	$res = mysqli_query($con, $r);
?>
<div class="container" style="margin-top: 100px;">
<form method="POST" action="categorie-add.php">
	<fieldset>
		<legend>Formulaire Categorie</legend>
		<label>Id Categorie</label>
		<input type="text" class="form-control" name="idc">
		<label>Titre Categorie</label>
		<input type="text" name="titrec" class="form-control">
        <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Enregistrer
            </button>
	</fieldset>
</form>
</div>

