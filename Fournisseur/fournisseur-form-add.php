<?php
require("../head.php");
require("../connexion.php");

?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Ajouter - Fournisseurs</h2>
            <form method="post" action="fournisseur-add.php">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">ID</label>
            <input type="text" name="idf" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Contact</label>
            <input type="text" name="contact" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="tel" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Adresse</label>
            <input type="text" name="adresse" class="form-control" value="<?php echo e(''); ?>">
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
            <label class="form-label">Type de produit</label>
            <input type="text" name="typedeproduit" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Condition de paiement</label>
            <input type="text" name="conditiondepaiement" class="form-control" value="<?php echo e(''); ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Condition de livraison</label>
            <input type="text" name="conditiondelivraison" class="form-control" value="<?php echo e(''); ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control"><?php echo e(''); ?></textarea>
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Enregistrer</button>
                <a href="fournisseur-list.php" class="btn btn-secondary">Retour</a>
            </form>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
