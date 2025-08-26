<?php
	require("../head.php");
	require("../fonctions.php");
	require("../connexion.php");
	$nbr = mysqli_query($con ,"select idcommande from commande order by idcommande desc limit 1;");
	$nbr_cat = mysqli_fetch_assoc($nbr);
?>
<div class="container" style="margin-top: 100px;">
<form method="POST" action="commande-add.php">
	<fieldset class="row">
		<legend>Formulaire Commande</legend>
		<div class="col-md-6">
		<label>Id Commande</label>
		<input type="text" class="form-control" value =<?php echo ++$nbr_cat['idcommande'] ;?> disabled>
		<input type="text" name="idc" class="form-control" value =<?php echo $nbr_cat['idcommande']; ?> hidden>
		<label>Client<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idclient">
			<option selected disabled>Select un Client</option>
			<?php
				$res = mysqli_query($con, "select * from client");
				while ($data_client = mysqli_fetch_assoc($res))
					echo "<option value='". $data_client['idl']."'>". $data_client['idl'] . " | " . $data_client['nom'] ."</option>";
			?>
		</select>
		<label>Produit<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idproduit">
			<option selected disabled>Select un Produit</option>
			<?php
				$res = mysqli_query($con, "select * from produit");
				while ($data_produit = mysqli_fetch_assoc($res))
					echo "<option value='". $data_produit['idproduit']."'>". $data_produit['idproduit'] . " | " . $data_produit['nomproduit'] ."</option>";
			?>
		</select>
		</div>
		<div class="col-md-6">
		<label>Date Commande<span class="obg">*</span></label>
		<input type="date" name="datec" class="form-control" require>
		<label>Statut<span class="obg">*</span></label>
		<input type="text" name="statut" class="form-control" require>
		</div>
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Enregistrer
			</button>
			<button  class="btn btn-secondary" link="./commande-list.php">Return</button>
		</div>
	</fieldset>
</form>
</div>
<style>
	.obg{
		color:red;
	}
</style>
