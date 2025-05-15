<?php
require("../head.php");
require("../connexion.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';
$id_sql = mysqli_real_escape_string($con, $id);
$r = "select * from `cabinet` where `idcabinet` = '$id_sql'";
$res = mysqli_query($con, $r);
$data = mysqli_fetch_assoc($res);


?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Modifier - Cabinets</h2>
            <?php if (!$data) { ?>
                <div class="alert alert-danger">Ligne introuvable</div>
            <?php } else { ?>
            <form method="post" action="cabinet-update.php">
                <input type="hidden" name="id" value="<?php echo e($data['idcabinet']); ?>">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nomcabinet" class="form-control" value="<?php echo e($data['nomcabinet']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Adresse</label>
            <input type="text" name="adresse" class="form-control" value="<?php echo e($data['adresse']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-control" value="<?php echo e($data['telephone']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo e($data['email']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Site web</label>
            <input type="text" name="siteweb" class="form-control" value="<?php echo e($data['siteweb']); ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Responsable</label>
            <input type="text" name="responsable" class="form-control" value="<?php echo e($data['responsable']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Spécialité</label>
            <input type="text" name="specialite" class="form-control" value="<?php echo e($data['specialite']); ?>" required>
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
            <label class="form-label">Code postal</label>
            <input type="text" name="codepostal" class="form-control" value="<?php echo e($data['codepostal']); ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Logo</label>
            <input type="text" name="logo" class="form-control" value="<?php echo e($data['logo']); ?>">
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Modifier</button>
                <a href="cabinet-list.php" class="btn btn-secondary">Retour</a>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
