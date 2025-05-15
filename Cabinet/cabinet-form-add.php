<?php
require("../head.php");
require("../connexion.php");

?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Ajouter - Cabinets</h2>
            <form method="post" action="cabinet-add.php">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">ID</label>
            <input type="text" name="idcabinet" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nomcabinet" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Adresse</label>
            <input type="text" name="adresse" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Site web</label>
            <input type="text" name="siteweb" class="form-control" value="<?php echo e(''); ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Responsable</label>
            <input type="text" name="responsable" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Spécialité</label>
            <input type="text" name="specialite" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Ville</label>
            <input type="text" name="ville" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Pays</label>
            <input type="text" name="pays" class="form-control" value="<?php echo e(''); ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Code postal</label>
            <input type="text" name="codepostal" class="form-control" value="<?php echo e(''); ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Logo</label>
            <input type="text" name="logo" class="form-control" value="<?php echo e(''); ?>">
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Enregistrer</button>
                <a href="cabinet-list.php" class="btn btn-secondary">Retour</a>
            </form>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
