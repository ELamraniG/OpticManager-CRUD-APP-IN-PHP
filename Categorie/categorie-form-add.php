<?php
require("../head.php");
require("../connexion.php");

?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Ajouter - Categories</h2>
            <form method="post" action="categorie-add.php">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">ID</label>
            <input type="text" name="idc" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="titrec" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Enregistrer</button>
                <a href="categorie-list.php" class="btn btn-secondary">Retour</a>
            </form>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
