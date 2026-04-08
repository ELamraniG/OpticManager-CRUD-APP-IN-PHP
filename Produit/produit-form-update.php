<?php
	$id=$_GET['id'];
	$r = "SELECT idproduit, produit.idc, categorie.titrec, produit.idf, fournisseur.nom, nomproduit, marque, produit.notes, prixdachat, tvaappliquee, prixdevente, qteenstock, seuildalerte
	FROM produit, categorie, fournisseur
	WHERE produit.idc = categorie.idc
	AND produit.idf = fournisseur.idf
	AND idproduit = " . $id;
	require("../connexion.php");
	$res = mysqli_query($con, $r);
	$data = mysqli_fetch_assoc($res);
	require("../head.php");
	require("../fonctions.php");
?>
<div class="container" style="margin-top:100px">
<form method="POST" action="produit-update.php">
	<fieldset>
		<legend>Formulaire Produit</legend>
		<div class="row">
		<div class="col-6">
		<label>Id Produit</label>
		<input type="text" name="idp" class="form-control" value="<?php echo $data['idproduit']; ?>" disabled>
		<input type="text" name="id" class="form-control" value="<?php echo $data['idproduit']; ?>"hidden>
		<label>Nom Produit<span class="obg">*</span></label>
		<input type="text" name="nomp" value="<?php echo $data['nomproduit']; ?>" class="form-control" required>
		<label>Categorie<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idc">
			<?php
				$res_categorie = mysqli_query($con, "select * from categorie");
				while ($data_categorie = mysqli_fetch_assoc($res_categorie))
				{
					if ($data_categorie['idc'] == $data['idc'])
						echo "<option selected value='". $data_categorie['idc']."'>". $data_categorie['idc'] . " | " . $data_categorie['titrec'] ."</option>";
					else
					echo "<option value='". $data_categorie['idc']."'>". $data_categorie['idc'] . " | " . $data_categorie['titrec'] ."</option>";

				}
			?>
		</select>
		<label>Marque <span class="obg">*</span></label>
		<input type="tel" name="marque" value="<?php echo $data['marque']; ?>" class="form-control" required>
		<label>Fournisseur<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idf">
			<?php
				$res_fournisseur = mysqli_query($con, "select * from fournisseur");
				while ($data_fournisseur = mysqli_fetch_assoc($res_fournisseur))
				{
					if ($data_fournisseur['idf'] == $data['idf'])
						echo "<option selected value='". $data_fournisseur['idf']."'>". $data_fournisseur['idf'] . " | " . $data_fournisseur['nom'] ."</option>";
					else
					echo "<option value='". $data_fournisseur['idf']."'>". $data_fournisseur['idf'] . " | " . $data_fournisseur['nom'] ."</option>";

				}
				mysqli_close($con);
			?>
		</select>
	</div>
	
	<div class="col-6">
		<label>Prix d'Achat<span class="obg">*</span></label>
		<input type="text" name="prixa" value="<?php echo $data['prixdachat']; ?>" class="form-control" required>
        <label>TVA</label>
		<input type="text" name="tva" value="<?php echo $data['tvaappliquee']; ?>" class="form-control">
		<label>Prix de Vente</label>
		<input type="text" name="prixv" value="<?php echo $data['prixdevente']; ?>" class="form-control" required>
        <label>Quantite du Stock<span class="obg">*</span></label>
		<input type="text" name="qte" value="<?php echo $data['qteenstock']; ?>" class="form-control" required>
        <label>Seuil d'Alerte</label>
		<input type="text" name="seuil" value="<?php echo $data['seuildalerte']; ?>" class="form-control">
        </div>
			<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Update
			</button>
			<button  class="btn btn-secondary" link="./produit-list.php">Return</button>
		</div>
		</fieldset>
</form>
</div>