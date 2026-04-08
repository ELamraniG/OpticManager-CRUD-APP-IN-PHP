<?php
	require("../head.php");
	require("../fonctions.php");
	require("../connexion.php");
	$r = "select * from cabinet";
	$res = mysqli_query($con, $r);
	$nbr = mysqli_query($con ,"select idcabinet from cabinet order by idcabinet desc limit 1;");
	$nbr_cat = mysqli_fetch_assoc($nbr);
?>
<div class="container" style="margin-top: 100px;">
<form method="POST" action="cabinet-add.php">
	<fieldset class="row">
		<legend>Formulaire Cabinet</legend>
		<div class="col-md-6">
		<label>Id Cabinet</label>
		<input type="text" class="form-control" value =<?php echo ++$nbr_cat['idcabinet'] ;?> disabled>
		<input type="text" name="idc" class="form-control" value =<?php echo $nbr_cat['idcabinet']; ?> hidden>
		<label>Nom Cabinet<span class="obg">*</span></label>
		<input type="text" name="nomc" class="form-control" require>
		<label>Adresse<span class="obg">*</span></label>
		<input type="text" name="adressec" class="form-control" require>
		<label>Telephone<span class="obg">*</span></label>
		<input type="text" name="telc" class="form-control" require>
		<label>Email<span class="obg">*</span></label>
		<input type="text" name="emailc" class="form-control" require>
		<label>SiteWeb</label>
		<input type="text" name="sitewebc" class="form-control">
		</div>
		<div class="col-md-6">
		<label>Responsable<span class="obg">*</span></label>
		<input type="text" name="respoc" class="form-control" require>
		<label>Specialaite<span class="obg">*</span></label>
		<input type="text" name="spc" class="form-control" require>
		<label>Ville<span class="obg">*</span></label>
		<input type="text" name="villec" class="form-control" require>
		<label>Pays</label>
		<input type="text" name="paysc" class="form-control">
		<label>Code Postal</label>
		<input type="text" name="codepc" class="form-control">
		<label>Logo</label>
		<input type="text" name="logoc" class="form-control">
		</div>
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Enregistrer
			</button>
			<button  class="btn btn-secondary" link="./cabinet-list.php">Return</button>
		</div>
	</fieldset>
</form>
</div>
<style>
	.obg{
		color:red;
	}
</style>
