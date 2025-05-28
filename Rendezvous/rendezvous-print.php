<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `rendezvous` order by `idrendezvous`";
$res = mysqli_query($con, $r);
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h2>Rendez-vous</h2>
        <button onclick="window.print()" class="btn btn-secondary no-print">Imprimer</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>idrendezvous</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Client</th>
                    <th>Cabinet</th>
                    <th>Notes</th>
                    <th>Crédibilité</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($data = mysqli_fetch_assoc($res)) { ?>
                <tr>
                    <td><?php echo e($data['idrendezvous']); ?></td>
                    <td><?php echo e($data['daterendezvous']); ?></td>
                    <td><?php echo e($data['heurerendezvous']); ?></td>
                    <td><?php echo e($data['idclient']); ?></td>
                    <td><?php echo e($data['idcabinet']); ?></td>
                    <td><?php echo e($data['notes']); ?></td>
                    <td><?php echo e($data['niveaudecredibilite']); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require("../footer.php"); ?>
