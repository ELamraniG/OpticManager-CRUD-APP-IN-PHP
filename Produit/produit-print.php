<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `produit` order by `idproduit`";
$res = mysqli_query($con, $r);
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h2>Produits</h2>
        <button onclick="window.print()" class="btn btn-secondary no-print">Imprimer</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>idproduit</th>
                    <th>Catégorie</th>
                    <th>Fournisseur</th>
                    <th>Produit</th>
                    <th>Marque</th>
                    <th>Notes</th>
                    <th>Prix achat</th>
                    <th>TVA %</th>
                    <th>Prix vente</th>
                    <th>Stock</th>
                    <th>Seuil alerte</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($data = mysqli_fetch_assoc($res)) { ?>
                <tr>
                    <td><?php echo e($data['idproduit']); ?></td>
                    <td><?php echo e($data['idc']); ?></td>
                    <td><?php echo e($data['idf']); ?></td>
                    <td><?php echo e($data['nomproduit']); ?></td>
                    <td><?php echo e($data['marque']); ?></td>
                    <td><?php echo e($data['notes']); ?></td>
                    <td><?php echo e($data['prixdachat']); ?></td>
                    <td><?php echo e($data['tvaappliquee']); ?></td>
                    <td><?php echo e($data['prixdevente']); ?></td>
                    <td><?php echo e($data['qteenstock']); ?></td>
                    <td><?php echo e($data['seuildalerte']); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require("../footer.php"); ?>
