<?php
	require("../head.php");
	require("../fonctions.php");
	require("../connexion.php");
	$nbr = mysqli_query($con ,"select idutilisateur from utilisateurs order by idutilisateur desc limit 1;");
	$nbr_cat = mysqli_fetch_assoc($nbr);
?>
<div class="container" style="margin-top: 100px;">
<form method="POST" action="utilisateurs-add.php">
	<fieldset class="row">
		<legend>Formulaire Utilisateur</legend>
		<div class="col-md-6">
		<label>Id Utilisateur</label>
		<input type="text" class="form-control" value =<?php echo ++$nbr_cat['idutilisateur'] ;?> disabled>
		<input type="text" name="idutilisateur" class="form-control" value =<?php echo $nbr_cat['idutilisateur']; ?> hidden>
		<label>Nom d'utilisateur<span class="obg">*</span></label>
		<input type="text" name="nomutilisateur" class="form-control" required>
		<label>Mot de passe<span class="obg">*</span></label>
		<input type="password" name="motdepasse" class="form-control" required>
		<label>Rôle<span class="obg">*</span></label>
		<select class="form-select" name="role" required>
			<option selected disabled>Sélectionner le rôle</option>
			<option value="admin">Administrateur</option>
			<option value="opticien">Opticien</option>
			<option value="assistant">Assistant</option>
		</select>
		</div>
		<div class="col-md-6">
		<label>Nom complet<span class="obg">*</span></label>
		<input type="text" name="nomcomplet" class="form-control" required>
		<label>Actif<span class="obg">*</span></label>
		<select class="form-select" name="actif" required>
			<option selected disabled>Sélectionner le statut</option>
			<option value="1">Actif</option>
			<option value="0">Inactif</option>
		</select>
		</div>
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Enregistrer
			</button>
			<button type="button" class="btn btn-secondary" onclick="window.location.href='./utilisateurs-list.php'">Return</button>
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
