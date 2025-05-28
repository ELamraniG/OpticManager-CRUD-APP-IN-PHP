<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `rendezvous` order by `idrendezvous` desc";
$res = mysqli_query($con, $r);
$nbr = mysqli_num_rows($res);
?>
<div class="container-fluid">
    <div class="entete-list">
        <h1 class="h2">Rendez-vous</h1>
        <span class="nbr"><?php echo $nbr; ?></span>
    </div>

    <div class="mb-3 no-print">
        <a href="rendezvous-form-add.php" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter</a>
        <a href="rendezvous-print.php" class="btn btn-secondary"><i class="fa fa-print"></i> Imprimer</a>
    </div>

    <?php show_flash(); ?>

    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>idrendezvous</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Client</th>
                        <th>Cabinet</th>
                        <th>Notes</th>
                        <th>Crédibilité</th>
                        <th class="no-print">Actions</th>
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
                        <td class="no-print">
                            <a href="rendezvous-form-update.php?id=<?php echo urlencode($data['idrendezvous']); ?>" class="btn btn-sm btn-primary">Modifier</a>
                            <a href="rendezvous-form-delete.php?id=<?php echo urlencode($data['idrendezvous']); ?>" class="btn btn-sm btn-danger">Supprimer</a>
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
