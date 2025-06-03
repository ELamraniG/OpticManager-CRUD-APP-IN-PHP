<?php
require("../head.php");
require("../connexion.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';
$id_sql = mysqli_real_escape_string($con, $id);
$r = "select * from `utilisateurs` where `idutilisateur` = '$id_sql'";
$res = mysqli_query($con, $r);
$data = mysqli_fetch_assoc($res);


?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Modifier - Utilisateurs</h2>
            <?php if (!$data) { ?>
                <div class="alert alert-danger">Ligne introuvable</div>
            <?php } else { ?>
            <form method="post" action="utilisateurs-update.php">
                <input type="hidden" name="id" value="<?php echo e($data['idutilisateur']); ?>">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Nom utilisateur</label>
            <input type="text" name="nomutilisateur" class="form-control" value="<?php echo e($data['nomutilisateur']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="motdepasse" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Rôle</label>
            <select name="role" class="form-select" required>
                <option value="admin" <?php if ((string)$data['role'] == 'admin') echo "selected"; ?>>admin</option>
                <option value="opticien" <?php if ((string)$data['role'] == 'opticien') echo "selected"; ?>>opticien</option>
                <option value="assistant" <?php if ((string)$data['role'] == 'assistant') echo "selected"; ?>>assistant</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Nom complet</label>
            <input type="text" name="nomcomplet" class="form-control" value="<?php echo e($data['nomcomplet']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Actif</label>
            <select name="actif" class="form-select">
                <option value="1" <?php if ((string)$data['actif'] == '1') echo "selected"; ?>>Actif</option>
                <option value="0" <?php if ((string)$data['actif'] == '0') echo "selected"; ?>>Inactif</option>
            </select>
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Modifier</button>
                <a href="utilisateurs-list.php" class="btn btn-secondary">Retour</a>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
