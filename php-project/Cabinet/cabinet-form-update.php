<?php
	$id=$_GET['id'];
	$r = "select * from cabinet where idcabinet = '".$id."'";
	require("../connexion.php");
	$res = mysqli_query($con, $r);
	$data = mysqli_fetch_assoc($res);
	mysqli_close($con);
	require("../head.php");
	require("../fonctions.php");
?>
<div class="container" style="margin-top:100px">
<form method="POST" action="cabinet-update.php">
	<fieldset>
		<legend>Formulaire Cabinet</legend>
		<div class="row">
		<div class="col-6">
		<label>Id Cabinet</label>
		<input type="text" name="idcabinet" class="form-control" value="<?php echo $data['idcabinet']; ?>" disabled>
		<input type="text" name="id" class="form-control" value="<?php echo $data['idcabinet']; ?>"hidden>
		<label>Nom<span class="obg">*</span></label>
		<input type="text" name="nomc" value="<?php echo $data['nomcabinet']; ?>" class="form-control" required>
		<label>Adresse<span class="obg">*</span></label>
		<input type="text" name="adressec" value="<?php echo $data['adresse']; ?>" class="form-control" required>
		<label>Telephone <span class="obg">*</span></label>
		<input type="tel" name="telc" value="<?php echo $data['telephone']; ?>" class="form-control" required>
		<label>Email<span class="obg">*</span></label>
		<input type="email" name="emailc"  value="<?php echo $data['email']; ?>" class="form-control" required>
        <label>SiteWeb<span class="obg">*</span></label>
		<input type="text" name="sitewebc" value="<?php echo $data['siteweb']; ?>" class="form-control" required>
		</div>

		<div class="col-6">
        <label>Responsable</label>
		<input type="text" name="respoc" value="<?php echo $data['responsable']; ?>" class="form-control">
		<label>Specialaite</label>
		<input type="text" name="spc" value="<?php echo $data['specialite']; ?>" class="form-control" required>
        <label>Ville<span class="obg">*</span></label>
		<input type="text" name="villec" value="<?php echo $data['ville']; ?>" class="form-control" required>
        <label>Pays</label>
		<input type="text" name="paysc" value="<?php echo $data['pays']; ?>" class="form-control">
        <label>Code Postal</label>
		<input type="text" name="codepc" value="<?php echo $data['codepostal']; ?>" class="form-control">
        <label>Logo </label>
		<input type="text" name="logoc" value="<?php echo $data['logo']; ?>" class="form-control">
		</div>
			<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Update
			</button>
			<button  class="btn btn-secondary" link="./cabinet-list.php">Return</button>
		</div>
		</fieldset>
</form>
</div>
