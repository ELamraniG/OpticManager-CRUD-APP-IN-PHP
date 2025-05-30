<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `vente_details` order by `iddetail` desc";
$res = mysqli_query($con, $r);
$nbr = mysqli_num_rows($res);
?>
<div class="container-fluid">
    <div class="entete-list">
        <h1 class="h2">Détails ventes</h1>
        <span class="nbr"><?php echo $nbr; ?></span>
    </div>

    <div class="mb-3 no-print">
        <a href="vente_details-form-add.php" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter</a>
        <a href="vente_details-print.php" class="btn btn-secondary"><i class="fa fa-print"></i> Imprimer</a>
    </div>

    <?php show_flash(); ?>

    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>iddetail</th>
                        <th>Vente</th>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th class="no-print">Actions</th>
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
                        <td class="no-print">
                            <a href="vente_details-form-update.php?id=<?php echo urlencode($data['iddetail']); ?>" class="btn btn-sm btn-primary">Modifier</a>
                            <a href="vente_details-form-delete.php?id=<?php echo urlencode($data['iddetail']); ?>" class="btn btn-sm btn-danger">Supprimer</a>
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
