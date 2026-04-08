<?php
require("../head.php");
require("../connexion.php");
require("../fonctions.php");
?>
<div class="container" style="margin-top:100px">
<form method="POST" action="commandes-fournisseur-add.php">
	<fieldset>
		<legend>Formulaire Commande Fournisseur</legend>
		<div class="row">
		<div class="col-6">
		<label>Fournisseur<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idfournisseur" required>
			<option selected disabled>Sélectionner un Fournisseur</option>
			<?php
				$res = mysqli_query($con, "select * from fournisseur");
				while ($data_fournisseur = mysqli_fetch_assoc($res))
					echo "<option value='". $data_fournisseur['idf']."'>". $data_fournisseur['idf'] . " | " . $data_fournisseur['nom'] ."</option>";
			?>
		</select>
		<label>Date de Commande<span class="obg">*</span></label>
		<input type="date" name="datecommande" class="form-control" required>
		</div>
		<div class="col-6">
		<label>Statut<span class="obg">*</span></label>
		<select class="form-select" name="statut" required>
			<option selected disabled>Sélectionner un Statut</option>
			<option value="en_attente">En Attente</option>
			<option value="livree">Livrée</option>
			<option value="annulee">Annulée</option>
		</select>
		</div>
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Ajouter
			</button>
			<a href="./commandes-fournisseur-list.php"><input type="button" class="btn btn-secondary" value="Return"></a>
		</div>
		</div>
	</fieldset>
</form>
</div>

