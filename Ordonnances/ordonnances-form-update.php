<?php
	$id=$_GET['id'];
	$r = "SELECT o.*, c.idconsultation, c.dateconsultation, CONCAT(p.nom, ' ', p.prenom) as patient_nom
	FROM ordonnances o, consultations c, patients p
	WHERE o.idconsultation = c.idconsultation
	AND c.idpatient = p.idpatient
	AND o.idordonnance = " . $id;
	require("../connexion.php");
	$res = mysqli_query($con, $r);
	$data = mysqli_fetch_assoc($res);
	require("../head.php");
	require("../fonctions.php");
?>
<div class="container" style="margin-top:100px">
<form method="POST" action="ordonnances-update.php">
	<fieldset>
		<legend>Formulaire Ordonnance</legend>
		<div class="row">
		<div class="col-6">
		<label>Id Ordonnance</label>
		<input type="text" name="idordonnance" class="form-control" value="<?php echo $data['idordonnance']; ?>" disabled>
		<input type="text" name="id" class="form-control" value="<?php echo $data['idordonnance']; ?>"hidden>
		<label>Consultation<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idconsultation" required>
			<?php
				$res_consultation = mysqli_query($con, "SELECT c.idconsultation, c.dateconsultation, CONCAT(p.nom, ' ', p.prenom) as patient_nom 
				FROM consultations c, patients p 
				WHERE c.idpatient = p.idpatient 
				ORDER BY c.dateconsultation DESC");
				while ($data_consultation = mysqli_fetch_assoc($res_consultation))
				{
					if ($data_consultation['idconsultation'] == $data['idconsultation'])
						echo "<option selected value='". $data_consultation['idconsultation']."'>". $data_consultation['idconsultation'] . " | " . $data_consultation['patient_nom'] . " (" . $data_consultation['dateconsultation'] . ")</option>";
					else
					echo "<option value='". $data_consultation['idconsultation']."'>". $data_consultation['idconsultation'] . " | " . $data_consultation['patient_nom'] . " (" . $data_consultation['dateconsultation'] . ")</option>";

				}
			?>
		</select>
		<label>Oeil<span class="obg">*</span></label>
		<select class="form-select" name="oeil" required>
			<option value="Droit" <?php if($data['oeil'] == 'Droit') echo 'selected'; ?>>Droit</option>
			<option value="Gauche" <?php if($data['oeil'] == 'Gauche') echo 'selected'; ?>>Gauche</option>
		</select>
		<label>Sphère</label>
		<input type="number" step="0.25" name="sphere" value="<?php echo $data['sphere']; ?>" class="form-control">
		<label>Cylindre</label>
		<input type="number" step="0.25" name="cylindre" value="<?php echo $data['cylindre']; ?>" class="form-control">
		</div>
		<div class="col-6">
		<label>Axe</label>
		<input type="number" min="0" max="180" name="axe" value="<?php echo $data['axe']; ?>" class="form-control">
		<label>Addition</label>
		<input type="number" step="0.25" name="addition" value="<?php echo $data['addition']; ?>" class="form-control">
		<label>Type de Correction<span class="obg">*</span></label>
		<select class="form-select" name="typecorrection" required>
			<option value="verre" <?php if($data['typecorrection'] == 'verre') echo 'selected'; ?>>Verre</option>
			<option value="lentille" <?php if($data['typecorrection'] == 'lentille') echo 'selected'; ?>>Lentille</option>
		</select>
		</div>
			<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Update
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
