<?php
require("../head.php");
require("../connexion.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';
$id_sql = mysqli_real_escape_string($con, $id);
$r = "select * from `fournisseur` where `idf` = '$id_sql'";
$res = mysqli_query($con, $r);
$data = mysqli_fetch_assoc($res);


?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Modifier - Fournisseurs</h2>
            <?php if (!$data) { ?>
                <div class="alert alert-danger">Ligne introuvable</div>
            <?php } else { ?>
            <form method="post" action="fournisseur-update.php">
                <input type="hidden" name="id" value="<?php echo e($data['idf']); ?>">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="<?php echo e($data['nom']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Contact</label>
            <input type="text" name="contact" class="form-control" value="<?php echo e($data['contact']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="tel" class="form-control" value="<?php echo e($data['tel']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo e($data['email']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Adresse</label>
            <input type="text" name="adresse" class="form-control" value="<?php echo e($data['adresse']); ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Ville</label>
            <input type="text" name="ville" class="form-control" value="<?php echo e($data['ville']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Pays</label>
            <input type="text" name="pays" class="form-control" value="<?php echo e($data['pays']); ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Type de produit</label>
            <input type="text" name="typedeproduit" class="form-control" value="<?php echo e($data['typedeproduit']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Condition de paiement</label>
            <input type="text" name="conditiondepaiement" class="form-control" value="<?php echo e($data['conditiondepaiement']); ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Condition de livraison</label>
            <input type="text" name="conditiondelivraison" class="form-control" value="<?php echo e($data['conditiondelivraison']); ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control"><?php echo e($data['notes']); ?></textarea>
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Modifier</button>
                <a href="fournisseur-list.php" class="btn btn-secondary">Retour</a>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
