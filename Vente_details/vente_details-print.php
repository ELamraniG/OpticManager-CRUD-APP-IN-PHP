<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `vente_details` order by `iddetail`";
$res = mysqli_query($con, $r);
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h2>Détails ventes</h2>
        <button onclick="window.print()" class="btn btn-secondary no-print">Imprimer</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>iddetail</th>
                    <th>Vente</th>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($data = mysqli_fetch_assoc($res)) { ?>
                <tr>
                    <td><?php echo e($data['iddetail']); ?></td>
                    <td><?php echo e($data['idvente']); ?></td>
                    <td><?php echo e($data['idproduit']); ?></td>
                    <td><?php echo e($data['quantite']); ?></td>
                    <td><?php echo e($data['prixunitaire']); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require("../footer.php"); ?>
