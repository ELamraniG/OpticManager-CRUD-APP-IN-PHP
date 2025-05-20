<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `commandes_fournisseur` order by `idcommande` desc";
$res = mysqli_query($con, $r);
$nbr = mysqli_num_rows($res);
?>
<div class="container-fluid">
    <div class="entete-list">
        <h1 class="h2">Commandes fournisseurs</h1>
        <span class="nbr"><?php echo $nbr; ?></span>
    </div>

    <div class="mb-3 no-print">
        <a href="commandes-fournisseur-form-add.php" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter</a>
        <a href="commandes-fournisseur-print.php" class="btn btn-secondary"><i class="fa fa-print"></i> Imprimer</a>
    </div>

    <?php show_flash(); ?>

    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>idcommande</th>
                        <th>Fournisseur</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th class="no-print">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($data = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <td><?php echo e($data['idcommande']); ?></td>
                        <td><?php echo e($data['idfournisseur']); ?></td>
                        <td><?php echo e($data['datecommande']); ?></td>
                        <td><?php echo e($data['statut']); ?></td>
                        <td class="no-print">
                            <a href="commandes-fournisseur-form-update.php?id=<?php echo urlencode($data['idcommande']); ?>" class="btn btn-sm btn-primary">Modifier</a>
                            <a href="commandes-fournisseur-form-delete.php?id=<?php echo urlencode($data['idcommande']); ?>" class="btn btn-sm btn-danger">Supprimer</a>
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
