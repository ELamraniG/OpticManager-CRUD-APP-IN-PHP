<?php
	require("../head.php");
	require("../fonctions.php");
	require("../connexion.php");
	$nbr = mysqli_query($con ,"select iddetail from vente_details order by iddetail desc limit 1;");
	$nbr_cat = mysqli_fetch_assoc($nbr);
?>
<div class="container" style="margin-top: 100px;">
<form method="POST" action="vente_details-add.php">
	<fieldset class="row">
		<legend>Formulaire Détail Vente</legend>
		<div class="col-md-6">
		<label>Id Détail</label>
		<input type="text" class="form-control" value =<?php echo ++$nbr_cat['iddetail'] ;?> disabled>
		<input type="text" name="iddetail" class="form-control" value =<?php echo $nbr_cat['iddetail']; ?> hidden>
		<label>Vente<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idvente" required>
			<option selected disabled>Sélectionner une Vente</option>
			<?php
				$res = mysqli_query($con, "SELECT v.id_vente, v.datevente, CONCAT(p.nom, ' ', p.prenom) as patient_nom, v.montanttotal
				FROM ventes v, patients p 
				WHERE v.idpatient = p.idpatient 
				ORDER BY v.datevente DESC");
				while ($data_vente = mysqli_fetch_assoc($res))
					echo "<option value='". $data_vente['id_vente']."'>". $data_vente['id_vente'] . " | " . $data_vente['patient_nom'] . " (" . $data_vente['datevente'] . ") - " . $data_vente['montanttotal'] . "€</option>";
			?>
		</select>
		<label>Produit<span class="obg">*</span></label>
		<select class="form-select" name="idproduit" required>
			<option selected disabled>Sélectionner le produit</option>
			<?php
				$res_produit = mysqli_query($con, "SELECT p.idproduit, p.nomproduit, p.marque, p.prixdevente
				FROM produit p 
				ORDER BY p.nomproduit");
				while ($data_produit = mysqli_fetch_assoc($res_produit))
					echo "<option value='". $data_produit['idproduit']."'>". $data_produit['idproduit'] . " | " . $data_produit['nomproduit'] . " (" . $data_produit['marque'] . ") - " . $data_produit['prixdevente'] . "€</option>";
			?>
		</select>
		<label>Quantité<span class="obg">*</span></label>
		<input type="number" min="1" name="quantite" class="form-control" required>
		</div>
		<div class="col-md-6">
		<label>Prix Unitaire<span class="obg">*</span></label>
		<input type="number" step="0.01" min="0" name="prixunitaire" class="form-control" required>
		</div>
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Enregistrer
			</button>
			<button type="button" class="btn btn-secondary" onclick="window.location.href='./vente_details-list.php'">Return</button>
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
