<?php
	require("../head.php");
	require("../fonctions.php");
	require("../connexion.php");
	$nbr = mysqli_query($con ,"select id_vente from ventes order by id_vente desc limit 1;");
	$nbr_cat = mysqli_fetch_assoc($nbr);
?>
<div class="container" style="margin-top: 100px;">
<form method="POST" action="ventes-add.php">
	<fieldset class="row">
		<legend>Formulaire Vente</legend>
		<div class="col-md-6">
		<label>Id Vente</label>
		<input type="text" class="form-control" value =<?php echo ++$nbr_cat['id_vente'] ;?> disabled>
		<input type="text" name="id_vente" class="form-control" value =<?php echo $nbr_cat['id_vente']; ?> hidden>
		<label>Patient<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idpatient" required>
			<option selected disabled>Sélectionner un Patient</option>
			<?php
				$res = mysqli_query($con, "SELECT idpatient, nom, prenom FROM patients ORDER BY nom, prenom");
				while ($data_patient = mysqli_fetch_assoc($res))
					echo "<option value='". $data_patient['idpatient']."'>". $data_patient['idpatient'] . " | " . $data_patient['nom'] . " " . $data_patient['prenom'] . "</option>";
			?>
		</select>
		<label>Date Vente<span class="obg">*</span></label>
		<input type="datetime-local" name="datevente" class="form-control" required>
		<label>Montant Total<span class="obg">*</span></label>
		<input type="number" step="0.01" name="montanttotal" class="form-control" required>
		</div>
		<div class="col-md-6">
		<label>Mode de Paiement<span class="obg">*</span></label>
		<select class="form-select" name="modepaiement" required>
			<option selected disabled>Sélectionner le mode</option>
			<option value="especes">Espèces</option>
			<option value="carte">Carte</option>
			<option value="mutuelle">Mutuelle</option>
			<option value="tiers_payant">Tiers Payant</option>
		</select>
		<label>Statut Paiement<span class="obg">*</span></label>
		<select class="form-select" name="statutpaiement" required>
			<option selected disabled>Sélectionner le statut</option>
			<option value="paye">Payé</option>
			<option value="en_attente">En Attente</option>
		</select>
		</div>
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Enregistrer
			</button>
			<button type="button" class="btn btn-secondary" onclick="window.location.href='./ventes-list.php'">Return</button>
		</div>
	</fieldset>
</form>
</div>
<style>
	.obg{
		color:red;
	}
</style>
<?php
    require("../footer.php");
?>
