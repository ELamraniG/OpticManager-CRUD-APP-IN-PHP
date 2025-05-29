<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `ventes` order by `id_vente`";
$res = mysqli_query($con, $r);
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h2>Ventes</h2>
        <button onclick="window.print()" class="btn btn-secondary no-print">Imprimer</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>id_vente</th>
                    <th>Patient</th>
                    <th>Date vente</th>
                    <th>Montant total</th>
                    <th>Mode paiement</th>
                    <th>Statut paiement</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($data = mysqli_fetch_assoc($res)) { ?>
                <tr>
                    <td><?php echo e($data['id_vente']); ?></td>
                    <td><?php echo e($data['idpatient']); ?></td>
                    <td><?php echo e($data['datevente']); ?></td>
                    <td><?php echo e($data['montanttotal']); ?></td>
                    <td><?php echo e($data['modepaiement']); ?></td>
                    <td><?php echo e($data['statutpaiement']); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require("../footer.php"); ?>
