<?php
	$id=$_GET['id'];
	$r = "SELECT vd.*, v.datevente, CONCAT(p.nom, ' ', p.prenom) as patient_nom, pr.nomproduit, pr.marque
	FROM vente_details vd, ventes v, patients p, produit pr
	WHERE vd.iddetail = " . $id . "
	AND vd.idvente = v.id_vente
	AND v.idpatient = p.idpatient
	AND vd.idproduit = pr.idproduit";
	require("../connexion.php");
	$res = mysqli_query($con, $r);
	$data = mysqli_fetch_assoc($res);
	require("../head.php");
	require("../fonctions.php");
?>
<div class="container" style="margin-top:100px">
<form method="POST" action="vente_details-update.php">
	<fieldset>
		<legend>Formulaire Détail Vente</legend>
		<div class="row">
		<div class="col-6">
		<label>Id Détail</label>
		<input type="text" name="iddetailr" class="form-control" value="<?php echo $data['iddetail']; ?>" disabled>
		<input type="text" name="id" class="form-control" value="<?php echo $data['iddetail']; ?>"hidden>
		<label>Vente<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idvente">
			<?php
				$res_vente = mysqli_query($con, "SELECT v.id_vente, v.datevente, CONCAT(p.nom, ' ', p.prenom) as patient_nom, v.montanttotal
				FROM ventes v, patients p 
				WHERE v.idpatient = p.idpatient 
				ORDER BY v.datevente DESC");
				while ($data_vente = mysqli_fetch_assoc($res_vente))
				{
					if ($data_vente['id_vente'] == $data['idvente'])
						echo "<option selected value='". $data_vente['id_vente']."'>". $data_vente['id_vente'] . " | " . $data_vente['patient_nom'] . " (" . $data_vente['datevente'] . ")</option>";
					else
					echo "<option value='". $data_vente['id_vente']."'>". $data_vente['id_vente'] . " | " . $data_vente['patient_nom'] . " (" . $data_vente['datevente'] . ")</option>";

				}
			?>
		</select>
		<label>Produit<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idproduit">
			<?php
				$res_produit = mysqli_query($con, "SELECT p.idproduit, p.nomproduit, p.marque, p.prixdevente
				FROM produit p 
				ORDER BY p.nomproduit");
				while ($data_produit = mysqli_fetch_assoc($res_produit))
				{
					if ($data_produit['idproduit'] == $data['idproduit'])
						echo "<option selected value='". $data_produit['idproduit']."'>". $data_produit['idproduit'] . " | " . $data_produit['nomproduit'] . " (" . $data_produit['marque'] . ")</option>";
					else
					echo "<option value='". $data_produit['idproduit']."'>". $data_produit['idproduit'] . " | " . $data_produit['nomproduit'] . " (" . $data_produit['marque'] . ")</option>";

				}
				mysqli_close($con);
			?>
		</select>
	</div>
	
	<div class="col-6">
		<label>Quantité<span class="obg">*</span></label>
		<input type="number" min="1" name="quantite" value="<?php echo $data['quantite']; ?>" class="form-control" required>
		<label>Prix Unitaire<span class="obg">*</span></label>
		<input type="number" step="0.01" min="0" name="prixunitaire" value="<?php echo $data['prixunitaire']; ?>" class="form-control" required>
		</div>
			<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Update
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
