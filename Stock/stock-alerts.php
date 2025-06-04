<?php
require("../head.php");
require("../connexion.php");

$res = mysqli_query($con, 'SELECT idproduit, nomproduit, marque, qteenstock, seuildalerte
                           FROM produit
                           WHERE qteenstock <= seuildalerte
                           ORDER BY qteenstock ASC, nomproduit');
$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>
<div class="container">
    <h1 class="h2 mb-3">Alertes stock</h1>

    <?php if (!$rows) { ?>
        <div class="alert alert-success">Aucune alerte de stock.</div>
    <?php } else { ?>
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead><tr><th>Produit</th><th>Marque</th><th>Stock</th><th>Seuil</th></tr></thead>
                    <tbody>
                    <?php foreach ($rows as $row) { ?>
                    <tr>
                        <td><?php echo e($row['nomproduit']); ?></td>
                        <td><?php echo e($row['marque']); ?></td>
                        <td><span class="badge bg-danger"><?php echo e($row['qteenstock']); ?></span></td>
                        <td><?php echo e($row['seuildalerte']); ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>
</div>
<?php require("../footer.php"); ?>
