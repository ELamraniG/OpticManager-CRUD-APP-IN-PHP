<?php
require("../head.php");
require("../connexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) (isset($_POST['idproduit']) ? $_POST['idproduit'] : 0);
    $stock = max(0, (int) (isset($_POST['qteenstock']) ? $_POST['qteenstock'] : 0));
    $threshold = max(0, (int) (isset($_POST['seuildalerte']) ? $_POST['seuildalerte'] : 0));

    $r = "UPDATE produit SET qteenstock = $stock, seuildalerte = $threshold WHERE idproduit = $id";
    mysqli_query($con, $r);
    flash('success', 'Stock mis à jour.');
    redirect_to('inventory-manager.php');
}

$res = mysqli_query($con, 'SELECT idproduit, nomproduit, marque, qteenstock, seuildalerte, prixdevente
                           FROM produit ORDER BY nomproduit');
$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div><h1 class="h2 mb-0">Inventaire</h1><span class="text-muted"><?php echo count($rows); ?> produits</span></div>
        <a class="btn btn-outline-danger" href="stock-alerts.php">Voir les alertes</a>
    </div>

    <?php show_flash(); ?>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead><tr><th>Produit</th><th>Marque</th><th>Prix</th><th style="width:280px">Stock / seuil</th><th>État</th></tr></thead>
                <tbody>
                <?php foreach ($rows as $row) { ?>
                <tr>
                    <td><?php echo e($row['nomproduit']); ?></td>
                    <td><?php echo e($row['marque']); ?></td>
                    <td><?php echo e($row['prixdevente']); ?> DH</td>
                    <td>
                        <form method="post" class="d-flex gap-2">
                            <input type="hidden" name="idproduit" value="<?php echo e($row['idproduit']); ?>">
                            <input type="number" min="0" name="qteenstock" value="<?php echo e($row['qteenstock']); ?>" class="form-control form-control-sm">
                            <input type="number" min="0" name="seuildalerte" value="<?php echo e($row['seuildalerte']); ?>" class="form-control form-control-sm">
                            <button class="btn btn-sm btn-primary">OK</button>
                        </form>
                    </td>
                    <td>
                        <?php if ($row['qteenstock'] <= 0) { ?>
                            <span class="badge bg-danger">Rupture</span>
                        <?php } elseif ($row['qteenstock'] <= $row['seuildalerte']) { ?>
                            <span class="badge bg-warning text-dark">Faible</span>
                        <?php } else { ?>
                            <span class="badge bg-success">OK</span>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
