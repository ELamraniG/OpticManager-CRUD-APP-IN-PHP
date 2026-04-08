<?php
	require("../head.php");
	require("../fonctions.php");
	require("../connexion.php");
	$r = "select * from fournisseur";
	$res = mysqli_query($con, $r);
	$nbr = mysqli_query($con ,"select idf from fournisseur order by idf desc limit 1;");
	$nbr_cat = mysqli_fetch_assoc($nbr);
?>
<div class="container" style="margin-top: 100px;">
<form method="POST" action="fournisseur-add.php">
	<fieldset class="row">
		<legend>Formulaire Fournisseur</legend>
		<div class="col-md-6">
		<label>Id Fournisseur</label>
		<input type="text" class="form-control" value =<?php echo ++$nbr_cat['idf'] ;?> disabled>
		<input type="text" name="idf" class="form-control" value =<?php echo $nbr_cat['idf']; ?> hidden>
		<label>Nom <span class="obg">*</span></label>
		<input type="text" name="nomf" class="form-control" require>
		<label>Contact<span class="obg">*</span></label>
		<input type="text" name="contactf" class="form-control" require>
		<label>Telephone<span class="obg">*</span></label>
		<input type="text" name="telf" class="form-control" require>
		<label>Email<span class="obg">*</span></label>
		<input type="text" name="emailf" class="form-control" require>
		<label>Adresse</label>
		<input type="text" name="adressef" class="form-control">
		</div>
		<div class="col-md-6">
		<label>Ville<span class="obg">*</span></label>
		<input type="text" name="villef" class="form-control" require>
		<label>Pays</label>
		<input type="text" name="paysf" class="form-control">
		<label>Type de Produit<span class="obg">*</span></label>
		<input type="text" name="typef" class="form-control" require>
		<label>Conditions de Paiement<span class="obg">*</span></label>
		<input type="text" name="conditionpf" class="form-control" require>
		<label>conditions de Livraison<span class="obg">*</span></label>
		<input type="text" name="conditionlf" class="form-control" require>
		<label>Notes</label>
		<input type="text" name="notef" class="form-control">
		</div>
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Enregistrer
			</button>
			<button  class="btn btn-secondary" link="./fournisseur-list.php">Return</button>
		</div>
	</fieldset>
</form>
</div>
<style>
	.obg{
		color:red;
	}
</style>