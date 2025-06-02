<?php
require("../head.php");
require("../connexion.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';
$id_sql = mysqli_real_escape_string($con, $id);
$r = "select * from `vente_details` where `iddetail` = '$id_sql'";
$res = mysqli_query($con, $r);
$data = mysqli_fetch_assoc($res);

$r_list_idvente = "select `id_vente` as value, CONCAT('#', id_vente, ' - ', datevente) as label from `ventes` order by label";
$list_idvente = mysqli_query($con, $r_list_idvente);
$r_list_idproduit = "select `idproduit` as value, `nomproduit` as label from `produit` order by label";
$list_idproduit = mysqli_query($con, $r_list_idproduit);
?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Modifier - Détails ventes</h2>
            <?php if (!$data) { ?>
                <div class="alert alert-danger">Ligne introuvable</div>
            <?php } else { ?>
            <form method="post" action="vente_details-update.php">
                <input type="hidden" name="id" value="<?php echo e($data['iddetail']); ?>">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Vente</label>
            <select name="idvente" class="form-select" required>
                <?php while ($x = mysqli_fetch_assoc($list_idvente)) { ?>
                    <option value="<?php echo e($x['value']); ?>" <?php if ((string)$data['idvente'] == (string)$x['value']) echo "selected"; ?>>
                        <?php echo e($x['label']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Produit</label>
            <select name="idproduit" class="form-select" required>
                <?php while ($x = mysqli_fetch_assoc($list_idproduit)) { ?>
                    <option value="<?php echo e($x['value']); ?>" <?php if ((string)$data['idproduit'] == (string)$x['value']) echo "selected"; ?>>
                        <?php echo e($x['label']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Quantité</label>
            <input type="number" name="quantite" class="form-control" value="<?php echo e($data['quantite']); ?>" step="0.01" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Prix unitaire</label>
            <input type="number" name="prixunitaire" class="form-control" value="<?php echo e($data['prixunitaire']); ?>" step="0.01" required>
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Modifier</button>
                <a href="vente_details-list.php" class="btn btn-secondary">Retour</a>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
