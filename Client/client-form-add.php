<?php
	require("../head.php");
	require("../fonctions.php");
	require("../connexion.php");
	$r = "select * from client";
	$res = mysqli_query($con, $r);
	$nbr = mysqli_query($con ,"select idl from client order by idl desc limit 1;");
	$nbr_cat = mysqli_fetch_assoc($nbr);
?>
<div class="container" style="margin-top: 100px;">
<form method="POST" action="client-add.php">
	<fieldset class="row">
		<legend>Formulaire Client</legend>
		<div class="col-md-6">
		<label>Id client</label>
		<input type="text" class="form-control" value =<?php echo ++$nbr_cat['idl'] ;?> disabled>
		<input type="text" name="idl" class="form-control" value =<?php echo $nbr_cat; ?> hidden>
		<label>Nom <span class="obg">*</span></label>
		<input type="text" name="nomc" class="form-control" require>
		<label>Prenom<span class="obg">*</span></label>
		<input type="text" name="prenomc" class="form-control" require>
		<label>Telephone<span class="obg">*</span></label>
		<input type="tel" name="telc" class="form-control" require>
		<label>Email<span class="obg">*</span></label>
		<input type="email" name="emailc" class="form-control" require>
	</div>
	<div class="col-md-6">
		<label>Adresse</label>
		<input type="text" name="adressec" class="form-control">
		<label>Date de Naissance<span class="obg">*</span></label>
		<input type="date" name="datec" class="form-control" require>
		<label>Ordonnances</label>
		<input type="text" name="ordc" class="form-control">
		<label>Historique Achats</label>
		<input type="text" name="historyc" class="form-control">
		</div>
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Enregistrer
			</button>
			<button  class="btn btn-secondary" link="./client-list.php">Return</button>
	</div>
	</fieldset>
</form>
</div>
<style>
	.obg{
		color:red;
	}
</style>
