<?php
require("../head.php");
require("../connexion.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';
$id_sql = mysqli_real_escape_string($con, $id);
$r = "select * from `categorie` where `idc` = '$id_sql'";
$res = mysqli_query($con, $r);
$data = mysqli_fetch_assoc($res);


?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Modifier - Categories</h2>
            <?php if (!$data) { ?>
                <div class="alert alert-danger">Ligne introuvable</div>
            <?php } else { ?>
            <form method="post" action="categorie-update.php">
                <input type="hidden" name="id" value="<?php echo e($data['idc']); ?>">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="titrec" class="form-control" value="<?php echo e($data['titrec']); ?>" required>
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Modifier</button>
                <a href="categorie-list.php" class="btn btn-secondary">Retour</a>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
