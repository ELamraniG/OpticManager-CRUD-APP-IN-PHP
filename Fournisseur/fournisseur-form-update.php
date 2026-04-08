<?php
	$id=$_GET['id'];
	$r = "select * from fournisseur where idf = '".$id."'";
	require("../connexion.php");
	$res = mysqli_query($con, $r);
	$data = mysqli_fetch_assoc($res);
	mysqli_close($con);
	require("../head.php");
	require("../fonctions.php");
?>
<div class="container" style="margin-top:100px">
<form method="POST" action="fournisseur-update.php">
	<fieldset>
		<legend>Formulaire Fournisseur</legend>
		<div class="row">
		<div class="col-6">
		<label>Id Fournisseur</label>
		<input type="text" name="idf" class="form-control" value="<?php echo $data['idf']; ?>" disabled>
		<input type="text" name="id" class="form-control" value="<?php echo $data['idf']; ?>"hidden>
		<label>Nom<span class="obg">*</span></label>
		<input type="text" name="nomf" value="<?php echo $data['nom']; ?>" class="form-control" required>
		<label>Contact<span class="obg">*</span></label>
		<input type="text" name="contactf" value="<?php echo $data['contact']; ?>" class="form-control" required>
		<label>Telephone <span class="obg">*</span></label>
		<input type="tel" name="telf" value="<?php echo $data['tel']; ?>" class="form-control" required>
		<label>Email<span class="obg">*</span></label>
		<input type="email" name="emailf"  value="<?php echo $data['email']; ?>" class="form-control" required>
        <label>Adresse<span class="obg">*</span></label>
		<input type="text" name="adressef" value="<?php echo $data['adresse']; ?>" class="form-control" required>
		</div>

		<div class="col-6">
        <label>Ville</label>
		<input type="text" name="villef" value="<?php echo $data['ville']; ?>" class="form-control">
		<label>Pays</label>
		<input type="text" name="paysf" value="<?php echo $data['pays']; ?>" class="form-control" required>
        <label>Type de Produit<span class="obg">*</span></label>
		<input type="text" name="typef" value="<?php echo $data['typedeproduit']; ?>" class="form-control" required>
        <label>Condition de Paiement</label>
		<input type="text" name="conditionpf" value="<?php echo $data['conditiondepaiement']; ?>" class="form-control">
        <label>Condition de Livraison</label>
		<input type="text" name="conditionlf" value="<?php echo $data['conditiondelivraison']; ?>" class="form-control">
        <label>Notes </label>
		<input type="text" name="notef" value="<?php echo $data['notes']; ?>" class="form-control">
		</div>
			<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Update
			</button>
			<button  class="btn btn-secondary" link="./fournisseur-list.php">Return</button>
		</div>
		</fieldset>
</form>
</div>