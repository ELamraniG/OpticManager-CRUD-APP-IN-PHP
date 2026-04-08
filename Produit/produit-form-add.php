<?php
	require("../head.php");
	require("../fonctions.php");
	require("../connexion.php");
	$nbr = mysqli_query($con ,"select idproduit from produit order by idproduit desc limit 1;");
	$nbr_cat = mysqli_fetch_assoc($nbr);
?>
<div class="container" style="margin-top: 100px;">
<form method="POST" action="produit-add.php">
	<fieldset class="row">
		<legend>Formulaire Produit</legend>
		<div class="col-md-6">
		<label>Id Produit</label>
		<input type="text" class="form-control" value =<?php echo ++$nbr_cat['idproduit'] ;?> disabled>
		<input type="text" name="idp" class="form-control" value =<?php echo $nbr_cat['idproduit']; ?> hidden>
		<label>Nom Produit<span class="obg">*</span></label>
		<input type="text" name="nomp" class="form-control" require>
		<label>Categorie<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idc">
			<option selected disabled>Select a Categorie</option>
			<?php
				$res = mysqli_query($con, "select * from categorie");
				while ($data_categorie = mysqli_fetch_assoc($res))
				{
					echo "<option value='". $data_categorie['idc']."'>". $data_categorie['idc'] . " | " . $data_categorie['titrec'] ."</option>";
				}
			?>
		</select>
		<label>Marque<span class="obg">*</span></label>
		<input type="text" name="marquep" class="form-control" require>
		<label>Fournisseur<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idf">
			<option selected disabled>Select un Fournisseur</option>
			<?php
				$res = mysqli_query($con, "select * from fournisseur");
				while ($data_fournisseur = mysqli_fetch_assoc($res))
				{
					echo "<option value='". $data_fournisseur['idf']."'>". $data_fournisseur['idf'] . " | " . $data_fournisseur['nom'] ."</option>";
				}
			?>
		</select>
		</div>
		<div class="col-md-6">
		<label>Prix d'Achat<span class="obg">*</span></label>
		<input type="number" name="prixa" class="form-control" require>
		<label>TVA<span class="obg">*</span></label>
		<input type="number" name="tva" class="form-control" require>
		<label>Prix de Vente<span class="obg">*</span></label>
		<input type="number" name="prixv" class="form-control" require>
		<label>Quantite du Stock</label>
		<input type="number" name="qte" class="form-control">
		<label>Seuil d'alerte</label>
		<input type="number" name="seuil" class="form-control">
		<label>Notes</label>
		<input type="text" name="notep" class="form-control">
		</div>
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Enregistrer
			</button>
			<button  class="btn btn-secondary" link="./produit-list.php">Return</button>
		</div>
	</fieldset>
</form>
</div>
<style>
	.obg{
		color:red;
	}
</style>