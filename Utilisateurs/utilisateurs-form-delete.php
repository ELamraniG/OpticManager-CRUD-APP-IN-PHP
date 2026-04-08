<?php
	$id=$_GET['id'];
	$r = "SELECT * FROM utilisateurs WHERE idutilisateur = " . $id;
	require("../connexion.php");
	$res = mysqli_query($con, $r);
	$data = mysqli_fetch_assoc($res);
	require("../head.php");
	require("../fonctions.php");
?>
<div class="container" style="margin-top: 100px;">
<form method="POST">
	<div class="row">
		<div class="datadelete col-6">
			<fieldset>
				<legend>Utilisateur à supprimer</legend>
				<label>Id Utilisateur</label>
				<input type="text" name="idutilisateur" value="<?php echo $data['idutilisateur']; ?>" class="form-control" disabled>
				<input type="text" name="id" value="<?php echo $data['idutilisateur']; ?>" hidden>
				<label>Nom d'utilisateur</label>
				<input type="text" name="nomutilisateur" value="<?php echo $data['nomutilisateur']; ?>" class="form-control" disabled>
				<label>Rôle</label>
				<input type="text" name="role" value="<?php echo $data['role']; ?>" class="form-control" disabled>
				<label>Nom complet</label>
				<input type="text" name="nomcomplet" value="<?php echo $data['nomcomplet']; ?>" class="form-control" disabled>
				<a href="./utilisateurs-list.php"><input type="button"  class="btn btn-secondary" value="Return"></a>
			</fieldset>
		</div>
		<div class="cledelete col-6">
			<i class="fa-solid fa-key"></i>
			<h2>Suppression</h2>
			<label>Entrez la clé de la suppression</label>
			<input type="password" name="cledelete" class="form-control" style="width: 300px;text-align: center; margin: auto;" autofocus>
			
			<div class="container mt-3">
    <div class="alert alert-warning" role="alert">
        <i class="fa-solid fa-triangle-exclamation"></i><br>Les données supprimées ne seront plus récupérables. Êtes-vous sûr de vouloir continuer ?
    </div>
    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-can"></i> Supprimer </button>
	</div>

		</div>
	</div>

</form>
</div>
<?php
	extract($_POST);
	if(!empty($cledelete)){
		if($cledelete == '123'){
			$req = "delete from utilisateurs where idutilisateur = ".$id;
			$res = mysqli_query($con, $req);
			redirection("utilisateurs-list.php");
		}
		else{
			echo "<script>alert('Clé de suppression incorrecte')</script>";
		}
	}
?>

<?php
    require("../footer.php");
?>
                </div>

                <div class="form-group row">
                    <label for="nomcomplet" class="col-sm-3 col-form-label">Nom complet</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nomcomplet" value="<?php echo $utilisateur['nomcomplet']; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="actif" class="col-sm-3 col-form-label">Statut</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="actif" value="<?php echo ($utilisateur['actif'] == '1') ? 'Actif' : 'Inactif'; ?>">
                    </div>
                </div>
            </fieldset>

            <div class="form-group row mt-4">
                <div class="col-sm-12">
                    <button type="submit" name="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                        <i class="fas fa-trash"></i> Supprimer définitivement
                    </button>
                    <a href="utilisateurs-list.php" class="btn btn-secondary ml-2">
                        <i class="fas fa-arrow-left"></i> Annuler
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
