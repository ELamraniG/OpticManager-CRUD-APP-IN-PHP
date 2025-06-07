<?php
	$id=$_GET['id'];
	$r = "select * from client where idl = '".$id."'";
	require("../connexion.php");
	$res = mysqli_query($con, $r);
	$data = mysqli_fetch_assoc($res);
	mysqli_close($con);
	require("../head.php");
	require("../fonctions.php");
?>
<div class="container" style="margin-top:100px">
<form method="POST" action="client-update.php">
	<fieldset>
		<legend>Formulaire client</legend>
		<div class="row">
		<div class="col-6">
		<label>Id Client</label>
		<input type="text" name="idl" class="form-control" value="<?php echo $data['idl']; ?>" disabled>
		<input type="text" name="id" class="form-control" value="<?php echo $data['idl']; ?>"hidden>
		<label>Nom<span class="obg">*</span></label>
		<input type="text" name="nomc" value="<?php echo $data['nom']; ?>" class="form-control" required>
		<label>Prenom<span class="obg">*</span></label>
		<input type="text" name="prenomc" value="<?php echo $data['prenom']; ?>" class="form-control" required>
		<label>Telephone <span class="obg">*</span></label>
		<input type="tel" name="telc" value="<?php echo $data['telephone']; ?>" class="form-control" required>
		<label>Email<span class="obg">*</span></label>
		<input type="email" name="emailc"  value="<?php echo $data['email']; ?>" class="form-control" required>
	</div>
	
	<div class="col-6">
			<label>Adresse<span class="obg">*</span></label>
			<input type="text" name="adressec" value="<?php echo $data['adresse']; ?>" class="form-control" required>
        <label>Date de Naissance</label>
		<input type="date" name="datec" value="<?php echo $data['dateNaissance']; ?>" class="form-control">
		<label>Ordonnances</label>
		<input type="text" name="ordc" value="<?php echo $data['ordonnances']; ?>" class="form-control" required>
        <label>historique Achats<span class="obg">*</span></label>
		<input type="text" name="historyc" value="<?php echo $data['historiqueAchats']; ?>" class="form-control" required>
        </div>
			<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Update
			</button>
			<button  class="btn btn-secondary" link="./client-list.php">Return</button>
		</div>
		</fieldset>
</form>
</div>
