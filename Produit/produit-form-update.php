<?php
require("../head.php");
require("../connexion.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';
$id_sql = mysqli_real_escape_string($con, $id);
$r = "select * from `produit` where `idproduit` = '$id_sql'";
$res = mysqli_query($con, $r);
$data = mysqli_fetch_assoc($res);

$r_list_idc = "select `idc` as value, `titrec` as label from `categorie` order by label";
$list_idc = mysqli_query($con, $r_list_idc);
$r_list_idf = "select `idf` as value, `nom` as label from `fournisseur` order by label";
$list_idf = mysqli_query($con, $r_list_idf);
?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Modifier - Produits</h2>
            <?php if (!$data) { ?>
                <div class="alert alert-danger">Ligne introuvable</div>
            <?php } else { ?>
            <form method="post" action="produit-update.php">
                <input type="hidden" name="id" value="<?php echo e($data['idproduit']); ?>">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Catégorie</label>
            <select name="idc" class="form-select" required>
                <?php while ($x = mysqli_fetch_assoc($list_idc)) { ?>
                    <option value="<?php echo e($x['value']); ?>" <?php if ((string)$data['idc'] == (string)$x['value']) echo "selected"; ?>>
                        <?php echo e($x['label']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Fournisseur</label>
            <select name="idf" class="form-select" required>
                <?php while ($x = mysqli_fetch_assoc($list_idf)) { ?>
                    <option value="<?php echo e($x['value']); ?>" <?php if ((string)$data['idf'] == (string)$x['value']) echo "selected"; ?>>
                        <?php echo e($x['label']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Produit</label>
            <input type="text" name="nomproduit" class="form-control" value="<?php echo e($data['nomproduit']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Marque</label>
            <input type="text" name="marque" class="form-control" value="<?php echo e($data['marque']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control"><?php echo e($data['notes']); ?></textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Prix achat</label>
            <input type="number" name="prixdachat" class="form-control" value="<?php echo e($data['prixdachat']); ?>" step="0.01" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">TVA %</label>
            <input type="number" name="tvaappliquee" class="form-control" value="<?php echo e($data['tvaappliquee']); ?>" step="0.01">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Prix vente</label>
            <input type="number" name="prixdevente" class="form-control" value="<?php echo e($data['prixdevente']); ?>" step="0.01" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="qteenstock" class="form-control" value="<?php echo e($data['qteenstock']); ?>" step="0.01">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Seuil alerte</label>
            <input type="number" name="seuildalerte" class="form-control" value="<?php echo e($data['seuildalerte']); ?>" step="0.01">
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Modifier</button>
                <a href="produit-list.php" class="btn btn-secondary">Retour</a>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
