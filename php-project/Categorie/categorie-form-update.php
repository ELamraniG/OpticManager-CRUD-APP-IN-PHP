<?php
	$id=$_GET['id'];
	$r = "select * from categorie where idc = '".$id."'";
	require("../connexion.php");
	$res = mysqli_query($con, $r);
	$data = mysqli_fetch_assoc($res);
	mysqli_close($con);
	require("../head.php");
	require("../fonctions.php");
?>
<section class="home-section">
    <div class="home-content">
    
<div class="container" style="margin-top:100px">
<form method="POST" action="categorie-update.php">
	<fieldset>
		<legend>Formulaire Categorie</legend>
		<label>Id Categorie</label>
		<input type="text" name="idc" value="<?php echo $data['idc']; ?>" class="form-control" disabled>
		<input type="text" name="id" value="<?php echo $data['idc']; ?>" hidden>
		<label>Titre Categorie</label>
		<input type="text" name="titrec" value="<?php echo $data['titrec']; ?>" class="form-control">
		<button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Enregistrer
            </button>	</fieldset>
</form>
</div>
</div>
  </section>
  