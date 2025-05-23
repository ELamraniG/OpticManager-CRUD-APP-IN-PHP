<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `consultations` order by `idconsultation`";
$res = mysqli_query($con, $r);
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h2>Consultations</h2>
        <button onclick="window.print()" class="btn btn-secondary no-print">Imprimer</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>idconsultation</th>
                    <th>Patient</th>
                    <th>Date</th>
                    <th>Motif</th>
                    <th>Observations</th>
                    <th>Prescription</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($data = mysqli_fetch_assoc($res)) { ?>
                <tr>
                    <td><?php echo e($data['idconsultation']); ?></td>
                    <td><?php echo e($data['idpatient']); ?></td>
                    <td><?php echo e($data['dateconsultation']); ?></td>
                    <td><?php echo e($data['motif']); ?></td>
                    <td><?php echo e($data['observations']); ?></td>
                    <td><?php echo e($data['prescriptionpdf']); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require("../footer.php"); ?>
