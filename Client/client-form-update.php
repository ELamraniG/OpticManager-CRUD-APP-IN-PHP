<?php
require("../head.php");
require("../connexion.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';
$id_sql = mysqli_real_escape_string($con, $id);
$r = "select * from `client` where `idl` = '$id_sql'";
$res = mysqli_query($con, $r);
$data = mysqli_fetch_assoc($res);


?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Modifier - Clients</h2>
            <?php if (!$data) { ?>
                <div class="alert alert-danger">Ligne introuvable</div>
            <?php } else { ?>
            <form method="post" action="client-update.php">
                <input type="hidden" name="id" value="<?php echo e($data['idl']); ?>">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="<?php echo e($data['nom']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" value="<?php echo e($data['prenom']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Adresse</label>
            <input type="text" name="adresse" class="form-control" value="<?php echo e($data['adresse']); ?>">
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
            <label class="form-label">Date de naissance</label>
            <input type="date" name="dateNaissance" class="form-control" value="<?php echo e($data['dateNaissance']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Ordonnances</label>
            <textarea name="ordonnances" class="form-control"><?php echo e($data['ordonnances']); ?></textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Historique achats</label>
            <textarea name="historiqueAchats" class="form-control"><?php echo e($data['historiqueAchats']); ?></textarea>
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Modifier</button>
                <a href="client-list.php" class="btn btn-secondary">Retour</a>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
