<?php
	require("../head.php");
	require("../fonctions.php");
	require("../connexion.php");
	$nbr = mysqli_query($con ,"select idconsultation from consultations order by idconsultation desc limit 1;");
	$nbr_cat = mysqli_fetch_assoc($nbr);
?>
<div class="container" style="margin-top: 100px;">
<form method="POST" action="consultations-add.php">
	<fieldset class="row">
		<legend>Formulaire Consultation</legend>
		<div class="col-md-6">
		<label>Id Consultation</label>
		<input type="text" class="form-control" value =<?php echo ++$nbr_cat['idconsultation'] ;?> disabled>
		<input type="text" name="idconsultation" class="form-control" value =<?php echo $nbr_cat['idconsultation']; ?> hidden>
		<label>Patient<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idpatient" required>
			<option selected disabled>Sélectionner un Patient</option>
			<?php
				$res = mysqli_query($con, "select * from patients");
				while ($data_patient = mysqli_fetch_assoc($res))
					echo "<option value='". $data_patient['idpatient']."'>". $data_patient['idpatient'] . " | " . $data_patient['nom'] . " " . $data_patient['prenom'] ."</option>";
			?>
		</select>
		<label>Date de Consultation<span class="obg">*</span></label>
		<input type="date" name="dateconsultation" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
		<label>Motif<span class="obg">*</span></label>
		<textarea name="motif" class="form-control" rows="3" required></textarea>
		</div>
		<div class="col-md-6">
		<label>Observations</label>
		<textarea name="observations" class="form-control" rows="4"></textarea>
		<label>Prescription PDF</label>
		<input type="text" name="prescriptionpdf" class="form-control" placeholder="Nom du fichier PDF">
		</div>
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Enregistrer
			</button>
			<button type="button" class="btn btn-secondary" onclick="window.location.href='./consultations-list.php'">Return</button>
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

