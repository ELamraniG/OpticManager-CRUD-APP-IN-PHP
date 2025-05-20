<?php
require("../head.php");
require("../connexion.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';

if (isset($_POST['delete'])) {
    $id = isset($_POST['id']) ? mysqli_real_escape_string($con, $_POST['id']) : '';
    $r = "delete from `commande` where `idcommande` = '$id'";
    mysqli_query($con, $r);
    flash("success", "Ligne supprimée");
    redirection("commande-list.php");
}

$id_sql = mysqli_real_escape_string($con, $id);
$r = "select * from `commande` where `idcommande` = '$id_sql'";
$res = mysqli_query($con, $r);
$data = mysqli_fetch_assoc($res);
?>
<div class="container" style="max-width:700px">
    <div class="card shadow">
        <div class="card-body">
            <h2>Supprimer</h2>
            <?php if (!$data) { ?>
                <div class="alert alert-danger">Ligne introuvable</div>
            <?php } else { ?>
                <p>Voulez-vous vraiment supprimer la ligne <b><?php echo e($data['idcommande']); ?></b> ?</p>
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo e($data['idcommande']); ?>">
                    <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>
                    <a href="commande-list.php" class="btn btn-secondary">Annuler</a>
                </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
