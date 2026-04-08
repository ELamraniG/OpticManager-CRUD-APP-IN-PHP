<?php
	$id=$_GET['id'];
	$r = "select * from patients where idpatient = ".$id;
	require("../connexion.php");
	$res = mysqli_query($con, $r);
	$data = mysqli_fetch_assoc($res);
	require("../head.php");
	require("../fonctions.php");
?>
<div class="container" style="margin-top:100px">
<form method="POST" action="patients-update.php">
	<fieldset>
		<legend>Formulaire Patient</legend>
		<div class="row">
		<div class="col-6">
		<label>Id Patient</label>
		<input type="text" name="idpatient" class="form-control" value="<?php echo $data['idpatient']; ?>" disabled>
		<input type="text" name="id" class="form-control" value="<?php echo $data['idpatient']; ?>"hidden>
		<label>Nom<span class="obg">*</span></label>
		<input type="text" name="nom" value="<?php echo $data['nom']; ?>" class="form-control" required>
		<label>Prenom<span class="obg">*</span></label>
		<input type="text" name="prenom" value="<?php echo $data['prenom']; ?>" class="form-control" required>
		<label>Date de Naissance <span class="obg">*</span></label>
		<input type="date" name="datenaissance" value="<?php echo $data['datenaissance']; ?>" class="form-control" required>
		<label>Sexe<span class="obg">*</span></label>
		<select class="form-select" name="sexe" required>
			<option value="Homme" <?php if($data['sexe'] == 'Homme') echo 'selected'; ?>>Homme</option>
			<option value="Femme" <?php if($data['sexe'] == 'Femme') echo 'selected'; ?>>Femme</option>
		</select>
		</div>
		<div class="col-6">
		<label>Telephone <span class="obg">*</span></label>
		<input type="tel" name="telephone" value="<?php echo $data['telephone']; ?>" class="form-control" required>
		<label>Email<span class="obg">*</span></label>
		<input type="email" name="email" value="<?php echo $data['email']; ?>" class="form-control" required>
		<label>Adresse</label>
		<textarea name="adresse" class="form-control" rows="3"><?php echo $data['adresse']; ?></textarea>
		<label>Date Creation</label>
		<input type="date" name="datecreation" value="<?php echo $data['datecreation']; ?>" class="form-control">
		</div>
			<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Update
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
