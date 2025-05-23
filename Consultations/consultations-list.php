<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `consultations` order by `idconsultation` desc";
$res = mysqli_query($con, $r);
$nbr = mysqli_num_rows($res);
?>
<div class="container-fluid">
    <div class="entete-list">
        <h1 class="h2">Consultations</h1>
        <span class="nbr"><?php echo $nbr; ?></span>
    </div>

    <div class="mb-3 no-print">
        <a href="consultations-form-add.php" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter</a>
        <a href="consultations-print.php" class="btn btn-secondary"><i class="fa fa-print"></i> Imprimer</a>
    </div>

    <?php show_flash(); ?>

    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>idconsultation</th>
                        <th>Patient</th>
                        <th>Date</th>
                        <th>Motif</th>
                        <th>Observations</th>
                        <th>Prescription</th>
                        <th class="no-print">Actions</th>
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
                        <td class="no-print">
                            <a href="consultations-form-update.php?id=<?php echo urlencode($data['idconsultation']); ?>" class="btn btn-sm btn-primary">Modifier</a>
                            <a href="consultations-form-delete.php?id=<?php echo urlencode($data['idconsultation']); ?>" class="btn btn-sm btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
mysqli_close($con);
require("../footer.php");
?>
