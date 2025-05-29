<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `ventes` order by `id_vente` desc";
$res = mysqli_query($con, $r);
$nbr = mysqli_num_rows($res);
?>
<div class="container-fluid">
    <div class="entete-list">
        <h1 class="h2">Ventes</h1>
        <span class="nbr"><?php echo $nbr; ?></span>
    </div>

    <div class="mb-3 no-print">
        <a href="ventes-form-add.php" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter</a>
        <a href="ventes-print.php" class="btn btn-secondary"><i class="fa fa-print"></i> Imprimer</a>
    </div>

    <?php show_flash(); ?>

    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>id_vente</th>
                        <th>Patient</th>
                        <th>Date vente</th>
                        <th>Montant total</th>
                        <th>Mode paiement</th>
                        <th>Statut paiement</th>
                        <th class="no-print">Actions</th>
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
                        <td class="no-print">
                            <a href="ventes-form-update.php?id=<?php echo urlencode($data['id_vente']); ?>" class="btn btn-sm btn-primary">Modifier</a>
                            <a href="ventes-form-delete.php?id=<?php echo urlencode($data['id_vente']); ?>" class="btn btn-sm btn-danger">Supprimer</a>
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
