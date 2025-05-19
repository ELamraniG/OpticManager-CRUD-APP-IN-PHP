<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `commande` order by `idcommande`";
$res = mysqli_query($con, $r);
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h2>Commandes clients</h2>
        <button onclick="window.print()" class="btn btn-secondary no-print">Imprimer</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>idcommande</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Produit</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($data = mysqli_fetch_assoc($res)) { ?>
                <tr>
                    <td><?php echo e($data['idcommande']); ?></td>
                    <td><?php echo e($data['datecommande']); ?></td>
                    <td><?php echo e($data['idclient']); ?></td>
                    <td><?php echo e($data['idproduit']); ?></td>
                    <td><?php echo e($data['statut']); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require("../footer.php"); ?>
