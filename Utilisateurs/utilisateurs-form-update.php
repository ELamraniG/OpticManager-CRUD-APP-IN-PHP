<?php
	require("../head.php");
	require("../fonctions.php");
	require("../connexion.php");
	$id = $_GET['id'];
	$r = "SELECT * FROM utilisateurs WHERE idutilisateur = $id";
	$res = mysqli_query($con, $r);
	$data = mysqli_fetch_assoc($res);
?>
<div class="container" style="margin-top: 100px;">
<form method="POST" action="utilisateurs-update.php">
	<fieldset class="row">
		<legend>Formulaire Utilisateur</legend>
		<div class="col-md-6">
		<label>Id Utilisateur</label>
		<input type="text" class="form-control" value="<?php echo $data['idutilisateur']; ?>" disabled>
		<input type="text" name="idutilisateur" class="form-control" value="<?php echo $data['idutilisateur']; ?>" hidden>
		<label>Nom d'utilisateur<span class="obg">*</span></label>
		<input type="text" name="nomutilisateur" class="form-control" value="<?php echo $data['nomutilisateur']; ?>" required>
		<label>Mot de passe<span class="obg">*</span></label>
		<input type="password" name="motdepasse" class="form-control" placeholder="Laissez vide pour conserver l'ancien">
		<label>Rôle<span class="obg">*</span></label>
		<select class="form-select" name="role" required>
			<option value="admin" <?php echo ($data['role'] == 'admin') ? 'selected' : ''; ?>>Administrateur</option>
			<option value="opticien" <?php echo ($data['role'] == 'opticien') ? 'selected' : ''; ?>>Opticien</option>
			<option value="assistant" <?php echo ($data['role'] == 'assistant') ? 'selected' : ''; ?>>Assistant</option>
		</select>
		</div>
		<div class="col-md-6">
		<label>Nom complet<span class="obg">*</span></label>
		<input type="text" name="nomcomplet" class="form-control" value="<?php echo $data['nomcomplet']; ?>" required>
		<label>Actif<span class="obg">*</span></label>
		<select class="form-select" name="actif" required>
			<option value="1" <?php echo ($data['actif'] == 1) ? 'selected' : ''; ?>>Actif</option>
			<option value="0" <?php echo ($data['actif'] == 0) ? 'selected' : ''; ?>>Inactif</option>
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
                    <label for="motdepasse" class="col-sm-3 col-form-label">Nouveau mot de passe</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="motdepasse" name="motdepasse" placeholder="Laisser vide pour ne pas changer">
                        <small class="form-text text-muted">Laisser vide pour conserver le mot de passe actuel</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="role" class="col-sm-3 col-form-label">Rôle <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-control obg" id="role" name="role" required>
                            <option value="">Sélectionner un rôle</option>
                            <option value="admin" <?php echo ($utilisateur['role'] == 'admin') ? 'selected' : ''; ?>>Administrateur</option>
                            <option value="user" <?php echo ($utilisateur['role'] == 'user') ? 'selected' : ''; ?>>Utilisateur</option>
                            <option value="manager" <?php echo ($utilisateur['role'] == 'manager') ? 'selected' : ''; ?>>Manager</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nomcomplet" class="col-sm-3 col-form-label">Nom complet <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control obg" id="nomcomplet" name="nomcomplet" value="<?php echo $utilisateur['nomcomplet']; ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="actif" class="col-sm-3 col-form-label">Statut <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-control obg" id="actif" name="actif" required>
                            <option value="">Sélectionner le statut</option>
                            <option value="1" <?php echo ($utilisateur['actif'] == '1') ? 'selected' : ''; ?>>Actif</option>
                            <option value="0" <?php echo ($utilisateur['actif'] == '0') ? 'selected' : ''; ?>>Inactif</option>
                        </select>
                    </div>
                </div>
            </fieldset>

            <div class="form-group row mt-4">
                <div class="col-sm-12">
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Modifier
                    </button>
                    <a href="utilisateurs-list.php" class="btn btn-secondary ml-2">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
