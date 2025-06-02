<?php
require("../head.php");
require("../connexion.php");

?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Ajouter - Utilisateurs</h2>
            <form method="post" action="utilisateurs-add.php">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Nom utilisateur</label>
            <input type="text" name="nomutilisateur" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="motdepasse" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Rôle</label>
            <select name="role" class="form-select" required>
                <option value="admin" <?php if ((string)'' == 'admin') echo "selected"; ?>>admin</option>
                <option value="opticien" <?php if ((string)'' == 'opticien') echo "selected"; ?>>opticien</option>
                <option value="assistant" <?php if ((string)'' == 'assistant') echo "selected"; ?>>assistant</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Nom complet</label>
            <input type="text" name="nomcomplet" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Actif</label>
            <select name="actif" class="form-select">
                <option value="1" <?php if ((string)'' == '1') echo "selected"; ?>>Actif</option>
                <option value="0" <?php if ((string)'' == '0') echo "selected"; ?>>Inactif</option>
            </select>
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Enregistrer</button>
                <a href="utilisateurs-list.php" class="btn btn-secondary">Retour</a>
            </form>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
