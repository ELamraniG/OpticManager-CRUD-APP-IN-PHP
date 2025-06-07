<?php
	$id=$_GET['id'];
	$r = "SELECT c.*, CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet
	FROM consultations c, patients p
	WHERE c.idpatient = p.idpatient
	AND c.idconsultation = " . $id;
	require("../connexion.php");
	$res = mysqli_query($con, $r);
	$data = mysqli_fetch_assoc($res);
	require("../head.php");
	require("../fonctions.php");
?>
<div class="container" style="margin-top:100px">
<form method="POST" action="consultations-update.php">
	<fieldset>
		<legend>Formulaire Consultation</legend>
		<div class="row">
		<div class="col-6">
		<label>Id Consultation</label>
		<input type="text" name="idconsultation" class="form-control" value="<?php echo $data['idconsultation']; ?>" disabled>
		<input type="text" name="id" class="form-control" value="<?php echo $data['idconsultation']; ?>"hidden>
		<label>Patient<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idpatient" required>
			<?php
				$res_patient = mysqli_query($con, "select * from patients");
				while ($data_patient = mysqli_fetch_assoc($res_patient))
				{
					if ($data_patient['idpatient'] == $data['idpatient'])
						echo "<option selected value='". $data_patient['idpatient']."'>". $data_patient['idpatient'] . " | " . $data_patient['nom'] . " " . $data_patient['prenom'] ."</option>";
					else
					echo "<option value='". $data_patient['idpatient']."'>". $data_patient['idpatient'] . " | " . $data_patient['nom'] . " " . $data_patient['prenom'] ."</option>";

				}
			?>
		</select>
		<label>Date de Consultation<span class="obg">*</span></label>
		<input type="date" name="dateconsultation" value="<?php echo $data['dateconsultation']; ?>" class="form-control" required>
		<label>Motif<span class="obg">*</span></label>
		<textarea name="motif" class="form-control" rows="3" required><?php echo $data['motif']; ?></textarea>
		</div>
		<div class="col-6">
		<label>Observations</label>
		<textarea name="observations" class="form-control" rows="4"><?php echo $data['observations']; ?></textarea>
		<label>Prescription PDF</label>
		<input type="text" name="prescriptionpdf" value="<?php echo $data['prescriptionpdf']; ?>" class="form-control">
		</div>
			<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Update
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

