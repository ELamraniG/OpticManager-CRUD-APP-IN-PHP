<?php
	require("../head.php");
	require("../fonctions.php");
	require("../connexion.php");
	$nbr = mysqli_query($con ,"select idrendezvous from rendezvous order by idrendezvous desc limit 1;");
	$nbr_cat = mysqli_fetch_assoc($nbr);
?>
<div class="container" style="margin-top: 100px;">
<form method="POST" action="rendezvous-add.php">
	<fieldset class="row">
		<legend>Formulaire Rendez Vous</legend>
		<div class="col-md-6">
		<label>Id Rendez Vous</label>
		<input type="text" class="form-control" value =<?php echo ++$nbr_cat['idrendezvous'] ;?> disabled>
		<input type="text" name="idr" class="form-control" value =<?php echo $nbr_cat['idrendezvous']; ?> hidden>
		<label>Client<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idclient">
			<option selected disabled>Select un Client</option>
			<?php
				$res = mysqli_query($con, "select * from client");
				while ($data_client = mysqli_fetch_assoc($res))
					echo "<option value='". $data_client['idl']."'>". $data_client['idl'] . " | " . $data_client['nom'] ."</option>";
			?>
		</select>
		<label>Cabinet<span class="obg">*</span></label>
		<select class="form-select" aria-label="Disabled select example" name="idcabinet">
			<option selected disabled>Select un Cabinet</option>
			<?php
				$res = mysqli_query($con, "select * from cabinet");
				while ($data_produit = mysqli_fetch_assoc($res))
					echo "<option value='". $data_produit['idcabinet']."'>". $data_produit['idcabinet'] . " | " . $data_produit['nomcabinet'] ."</option>";
			?>
		</select>
		<label>Notes</label>
		<input type="text" name="notes" class="form-control">
		</div>
		<div class="col-md-6">
		<label>Date Rendez Vous<span class="obg">*</span></label>
		<input type="date" name="dater" class="form-control" require>
		<label>Time Rendez Vous<span class="obg">*</span></label>
		<input type="time" name="timer" class="form-control" require>
		<label>Niveau de Credibilite</label>
		<input type="number" name="ncr" class="form-control" min="0">
		</div>
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Enregistrer
			</button>
			<button  class="btn btn-secondary" link="./rendezvous-list.php">Return</button>
		</div>
	</fieldset>
</form>
</div>
<style>
	.obg{
		color:red;
	}
</style>