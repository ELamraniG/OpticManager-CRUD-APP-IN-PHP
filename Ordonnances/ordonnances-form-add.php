<?php
	require("../head.php");
	require("../fonctions.php");
	require("../connexion.php");
	$nbr = mysqli_query($con ,"select idordonnance from ordonnances order by idordonnance desc limit 1;");
	$nbr_cat = mysqli_fetch_assoc($nbr);
?>
<div class="container" style="margin-top: 100px;">
<form method="POST" action="ordonnances-add.php">
	<fieldset class="row">
		<legend>Formulaire Ordonnance</legend>
		<div class="col-md-6">
		<label>Id Ordonnance</label>
		<input type="text" class="form-control" value =<?php echo ++$nbr_cat['idordonnance'] ;?> disabled>
		<input type="text" name="idordonnance" class="form-control" value =<?php echo $nbr_cat['idordonnance']; ?> hidden>
		<label>Consultation<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idconsultation" required>
			<option selected disabled>Sélectionner une Consultation</option>
			<?php
				$res = mysqli_query($con, "SELECT c.idconsultation, c.dateconsultation, CONCAT(p.nom, ' ', p.prenom) as patient_nom 
				FROM consultations c, patients p 
				WHERE c.idpatient = p.idpatient 
				ORDER BY c.dateconsultation DESC");
				while ($data_consultation = mysqli_fetch_assoc($res))
					echo "<option value='". $data_consultation['idconsultation']."'>". $data_consultation['idconsultation'] . " | " . $data_consultation['patient_nom'] . " (" . $data_consultation['dateconsultation'] . ")</option>";
			?>
		</select>
		<label>Oeil<span class="obg">*</span></label>
		<select class="form-select" name="oeil" required>
			<option selected disabled>Sélectionner l'oeil</option>
			<option value="Droit">Droit</option>
			<option value="Gauche">Gauche</option>
		</select>
		<label>Sphère</label>
		<input type="number" step="0.25" name="sphere" class="form-control">
		<label>Cylindre</label>
		<input type="number" step="0.25" name="cylindre" class="form-control">
		</div>
		<div class="col-md-6">
		<label>Axe</label>
		<input type="number" min="0" max="180" name="axe" class="form-control">
		<label>Addition</label>
		<input type="number" step="0.25" name="addition" class="form-control">
		<label>Type de Correction<span class="obg">*</span></label>
		<select class="form-select" name="typecorrection" required>
			<option selected disabled>Sélectionner le type</option>
			<option value="verre">Verre</option>
			<option value="lentille">Lentille</option>
		</select>
		</div>
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Enregistrer
			</button>
			<button type="button" class="btn btn-secondary" onclick="window.location.href='./ordonnances-list.php'">Return</button>
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