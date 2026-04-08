<?php
	$id=$_GET['id'];
	$r = "SELECT * from rendezvous
	where idrendezvous = " . $id;
	require("../connexion.php");
	$res = mysqli_query($con, $r);
	$data = mysqli_fetch_assoc($res);
	require("../head.php");
	require("../fonctions.php");
?>
<div class="container" style="margin-top:100px">
<form method="POST" action="rendezvous-update.php">
	<fieldset>
		<legend>Formulaire Rendez-Vous</legend>
		<div class="row">
		<div class="col-6">
		<label>Id Rendez-Vous</label>
		<input type="text" name="idr" class="form-control" value="<?php echo $data['idrendezvous']; ?>" disabled>
		<input type="text" name="id" class="form-control" value="<?php echo $data['idrendezvous']; ?>"hidden>
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
		<label>Cabinet<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idcabinet">
			<?php
				$res_fournisseur = mysqli_query($con, "select * from cabinet");
				while ($data_fournisseur = mysqli_fetch_assoc($res_fournisseur))
				{
					if ($data_fournisseur['idcabinet'] == $data['idcabinet'])
						echo "<option selected value='". $data_fournisseur['idcabinet']."'>". $data_fournisseur['idcabinet'] . " | " . $data_fournisseur['nomcabinet'] ."</option>";
					else
					echo "<option value='". $data_fournisseur['idcabinet']."'>". $data_fournisseur['idcabinet'] . " | " . $data_fournisseur['nomcabinet'] ."</option>";

				}
				mysqli_close($con);
			?>
		</select>
		<label>Notes</label>
		<input type="text" name="notes" value="<?php echo $data['notes']; ?>" class="form-control">
	</div>
	
	<div class="col-6">
		<label>Date de Rendez-Vous<span class="obg">*</span></label>
		<input type="date" name="dater" value="<?php echo $data['daterendezvous']; ?>" class="form-control" required>
		<label>Time de Rendez-Vous<span class="obg">*</span></label>
		<input type="time" name="timer" value="<?php echo $data['heurerendezvous']; ?>" class="form-control" required>
		<label>Niveau de Credibilite</label>
		<input type="text" name="niveaudecredibilite" value="<?php echo $data['niveaudecredibilite']; ?>" class="form-control">
		</div>
			<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Update
			</button>
			<button  class="btn btn-secondary" link="./rendezvous-list.php">Return</button>
		</div>
		</fieldset>
</form>
</div>