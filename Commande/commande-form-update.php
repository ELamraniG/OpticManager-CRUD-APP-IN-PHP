<?php
	$id=$_GET['id'];
	$r = "SELECT * from commande
	where idcommande = " . $id;
	require("../connexion.php");
	$res = mysqli_query($con, $r);
	$data = mysqli_fetch_assoc($res);
	require("../head.php");
	require("../fonctions.php");
?>
<div class="container" style="margin-top:100px">
<form method="POST" action="commande-update.php">
	<fieldset>
		<legend>Formulaire Commande</legend>
		<div class="row">
		<div class="col-6">
		<label>Id Commande</label>
		<input type="text" name="idp" class="form-control" value="<?php echo $data['idcommande']; ?>" disabled>
		<input type="text" name="id" class="form-control" value="<?php echo $data['idcommande']; ?>"hidden>
		<label>Client<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idl">
			<?php
				$res_categorie = mysqli_query($con, "select * from client");
				while ($data_categorie = mysqli_fetch_assoc($res_categorie))
				{
					if ($data_categorie['idl'] == $data['idclient'])
						echo "<option selected value='". $data_categorie['idl']."'>". $data_categorie['idl'] . " | " . $data_categorie['nom'] ."</option>";
					else
					echo "<option value='". $data_categorie['idl']."'>". $data_categorie['idl'] . " | " . $data_categorie['nom'] ."</option>";

				}
			?>
		</select>
		<label>Produit<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idproduit">
			<?php
				$res_fournisseur = mysqli_query($con, "select * from produit");
				while ($data_fournisseur = mysqli_fetch_assoc($res_fournisseur))
				{
					if ($data_fournisseur['idproduit'] == $data['idproduit'])
						echo "<option selected value='". $data_fournisseur['idproduit']."'>". $data_fournisseur['idproduit'] . " | " . $data_fournisseur['nomproduit'] ."</option>";
					else
					echo "<option value='". $data_fournisseur['idproduit']."'>". $data_fournisseur['idproduit'] . " | " . $data_fournisseur['nomproduit'] ."</option>";

				}
				mysqli_close($con);
			?>
		</select>
	</div>
	
	<div class="col-6">
		<label>Date de Commande<span class="obg">*</span></label>
		<input type="date" name="datec" value="<?php echo $data['datecommande']; ?>" class="form-control" required>
        <label>Statut</label>
		<input type="text" name="statut" value="<?php echo $data['statut']; ?>" class="form-control">
		</div>
			<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Update
			</button>
			<button  class="btn btn-secondary" link="./commande-list.php">Return</button>
		</div>
		</fieldset>
</form>
</div>

