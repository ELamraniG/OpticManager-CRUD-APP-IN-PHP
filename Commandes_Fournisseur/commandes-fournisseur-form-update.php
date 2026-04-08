<?php
	$id=$_GET['id'];
	$r = "SELECT cf.idcommande, cf.idfournisseur, cf.datecommande, cf.statut, f.nom
	FROM commandes_fournisseur cf, fournisseur f
	WHERE cf.idfournisseur = f.idf
	AND cf.idcommande = " . $id;
	require("../connexion.php");
	$res = mysqli_query($con, $r);
	$data = mysqli_fetch_assoc($res);
	require("../head.php");
	require("../fonctions.php");
?>
<div class="container" style="margin-top:100px">
<form method="POST" action="commandes-fournisseur-update.php">
	<fieldset>
		<legend>Formulaire Commande Fournisseur</legend>
		<div class="row">
		<div class="col-6">
		<label>Id Commande</label>
		<input type="text" name="idcf" class="form-control" value="<?php echo $data['idcommande']; ?>" disabled>
		<input type="text" name="id" class="form-control" value="<?php echo $data['idcommande']; ?>" hidden>
		<label>Fournisseur<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idfournisseur">
			<?php
				$res_fournisseur = mysqli_query($con, "select * from fournisseur");
				while ($data_fournisseur = mysqli_fetch_assoc($res_fournisseur))
				{
					if ($data_fournisseur['idf'] == $data['idfournisseur'])
						echo "<option selected value='". $data_fournisseur['idf']."'>". $data_fournisseur['idf'] . " | " . $data_fournisseur['nom'] ."</option>";
					else
					echo "<option value='". $data_fournisseur['idf']."'>". $data_fournisseur['idf'] . " | " . $data_fournisseur['nom'] ."</option>";

				}
			?>
		</select>
		<label>Date de Commande<span class="obg">*</span></label>
		<input type="date" name="datecommande" value="<?php echo $data['datecommande']; ?>" class="form-control" required>
		</div>
		<div class="col-6">
		<label>Statut<span class="obg">*</span></label>
		<select class="form-select" name="statut" required>
			<option value="en_attente" <?php if($data['statut'] == 'en_attente') echo 'selected'; ?>>En Attente</option>
			<option value="livree" <?php if($data['statut'] == 'livree') echo 'selected'; ?>>Livrée</option>
			<option value="annulee" <?php if($data['statut'] == 'annulee') echo 'selected'; ?>>Annulée</option>
		</select>
		</div>
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Update
			</button>
			<button  class="btn btn-secondary" link="./commandes-fournisseur-list.php">Return</button>
		</div>
		</div>
		<?php mysqli_close($con); ?>
	</fieldset>
</form>
</div>

