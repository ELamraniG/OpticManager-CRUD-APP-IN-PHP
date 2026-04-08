<?php
	require("../head.php");
	require("../fonctions.php");
	require("../connexion.php");
	$nbr = mysqli_query($con ,"select idpatient from patients order by idpatient desc limit 1;");
	$nbr_cat = mysqli_fetch_assoc($nbr);
?>
<div class="container" style="margin-top: 100px;">
<form method="POST" action="patients-add.php">
	<fieldset class="row">
		<legend>Formulaire Patient</legend>
		<div class="col-md-6">
		<label>Id Patient</label>
		<input type="text" class="form-control" value =<?php echo ++$nbr_cat['idpatient'] ;?> disabled>
		<input type="text" name="idpatient" class="form-control" value =<?php echo $nbr_cat['idpatient']; ?> hidden>
		<label>Nom <span class="obg">*</span></label>
		<input type="text" name="nom" class="form-control" required>
		<label>Prenom<span class="obg">*</span></label>
		<input type="text" name="prenom" class="form-control" required>
		<label>Date de Naissance <span class="obg">*</span></label>
		<input type="date" name="datenaissance" class="form-control" required>
		<label>Sexe<span class="obg">*</span></label>
		<select class="form-select" name="sexe" required>
			<option selected disabled>Sélectionner le sexe</option>
			<option value="Homme">Homme</option>
			<option value="Femme">Femme</option>
		</select>
		</div>
		<div class="col-md-6">
		<label>Telephone <span class="obg">*</span></label>
		<input type="tel" name="telephone" class="form-control" required>
		<label>Email<span class="obg">*</span></label>
		<input type="email" name="email" class="form-control" required>
		<label>Adresse</label>
		<textarea name="adresse" class="form-control" rows="3"></textarea>
		<label>Date Creation</label>
		<input type="date" name="datecreation" class="form-control" value="<?php echo date('Y-m-d'); ?>">
		</div>
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Enregistrer
			</button>
			<button type="button" class="btn btn-secondary" onclick="window.location.href='./patients-list.php'">Return</button>
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
