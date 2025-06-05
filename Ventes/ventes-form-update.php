<?php
	$id=$_GET['id'];
	$r = "SELECT v.*, CONCAT(p.nom, ' ', p.prenom) as patient_nom
	FROM ventes v, patients p
	WHERE v.idpatient = p.idpatient
	AND v.id_vente = " . $id;
	require("../connexion.php");
	$res = mysqli_query($con, $r);
	$data = mysqli_fetch_assoc($res);
	require("../head.php");
	require("../fonctions.php");
?>
<div class="container" style="margin-top:100px">
<form method="POST" action="ventes-update.php">
	<fieldset>
		<legend>Formulaire Vente</legend>
		<div class="row">
		<div class="col-6">
		<label>Id Vente</label>
		<input type="text" name="id_vente" class="form-control" value="<?php echo $data['id_vente']; ?>" disabled>
		<input type="text" name="id" class="form-control" value="<?php echo $data['id_vente']; ?>"hidden>
		<label>Patient<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idpatient" required>
			<?php
				$res_patient = mysqli_query($con, "SELECT idpatient, nom, prenom FROM patients ORDER BY nom, prenom");
				while ($data_patient = mysqli_fetch_assoc($res_patient))
				{
					$selected = ($data_patient['idpatient'] == $data['idpatient']) ? 'selected' : '';
					echo "<option value='". $data_patient['idpatient']."' ".$selected.">". $data_patient['idpatient'] . " | " . $data_patient['nom'] . " " . $data_patient['prenom'] . "</option>";
				}
			?>
		</select>
		<label>Date Vente<span class="obg">*</span></label>
		<input type="datetime-local" name="datevente" value="<?php echo date('Y-m-d\TH:i', strtotime($data['datevente'])); ?>" class="form-control" required>
		<label>Montant Total<span class="obg">*</span></label>
		<input type="number" step="0.01" name="montanttotal" value="<?php echo $data['montanttotal']; ?>" class="form-control" required>
		</div>
		<div class="col-6">
		<label>Mode de Paiement<span class="obg">*</span></label>
		<select class="form-select" name="modepaiement" required>
			<option value="especes" <?php if($data['modepaiement'] == 'especes') echo 'selected'; ?>>Espèces</option>
			<option value="carte" <?php if($data['modepaiement'] == 'carte') echo 'selected'; ?>>Carte</option>
			<option value="mutuelle" <?php if($data['modepaiement'] == 'mutuelle') echo 'selected'; ?>>Mutuelle</option>
			<option value="tiers_payant" <?php if($data['modepaiement'] == 'tiers_payant') echo 'selected'; ?>>Tiers Payant</option>
		</select>
		<label>Statut Paiement<span class="obg">*</span></label>
		<select class="form-select" name="statutpaiement" required>
			<option value="paye" <?php if($data['statutpaiement'] == 'paye') echo 'selected'; ?>>Payé</option>
			<option value="en_attente" <?php if($data['statutpaiement'] == 'en_attente') echo 'selected'; ?>>En Attente</option>
		</select>
		</div>
			<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Update
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
