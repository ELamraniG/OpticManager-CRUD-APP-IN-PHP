<?php
require("../head.php");
require("../connexion.php");
$r_list_idc = "select `idc` as value, `titrec` as label from `categorie` order by label";
$list_idc = mysqli_query($con, $r_list_idc);
$r_list_idf = "select `idf` as value, `nom` as label from `fournisseur` order by label";
$list_idf = mysqli_query($con, $r_list_idf);
?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Ajouter - Produits</h2>
            <form method="post" action="produit-add.php">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Catégorie</label>
            <select name="idc" class="form-select" required>
                <?php while ($x = mysqli_fetch_assoc($list_idc)) { ?>
                    <option value="<?php echo e($x['value']); ?>" <?php if ((string)'' == (string)$x['value']) echo "selected"; ?>>
                        <?php echo e($x['label']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Fournisseur</label>
            <select name="idf" class="form-select" required>
                <?php while ($x = mysqli_fetch_assoc($list_idf)) { ?>
                    <option value="<?php echo e($x['value']); ?>" <?php if ((string)'' == (string)$x['value']) echo "selected"; ?>>
                        <?php echo e($x['label']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Produit</label>
            <input type="text" name="nomproduit" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Marque</label>
            <input type="text" name="marque" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control"><?php echo e(''); ?></textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Prix achat</label>
            <input type="number" name="prixdachat" class="form-control" value="<?php echo e(''); ?>" step="0.01" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">TVA %</label>
            <input type="number" name="tvaappliquee" class="form-control" value="<?php echo e(''); ?>" step="0.01">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Prix vente</label>
            <input type="number" name="prixdevente" class="form-control" value="<?php echo e(''); ?>" step="0.01" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="qteenstock" class="form-control" value="<?php echo e(''); ?>" step="0.01">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Seuil alerte</label>
            <input type="number" name="seuildalerte" class="form-control" value="<?php echo e(''); ?>" step="0.01">
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Enregistrer</button>
                <a href="produit-list.php" class="btn btn-secondary">Retour</a>
            </form>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
