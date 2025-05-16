<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `produit` order by `idproduit` desc";
$res = mysqli_query($con, $r);
$nbr = mysqli_num_rows($res);
?>
<div class="container-fluid">
    <div class="entete-list">
        <h1 class="h2">Produits</h1>
        <span class="nbr"><?php echo $nbr; ?></span>
    </div>

    <div class="mb-3 no-print">
        <a href="produit-form-add.php" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter</a>
        <a href="produit-print.php" class="btn btn-secondary"><i class="fa fa-print"></i> Imprimer</a>
    </div>

    <?php show_flash(); ?>

    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>idproduit</th>
                        <th>Catégorie</th>
                        <th>Fournisseur</th>
                        <th>Produit</th>
                        <th>Marque</th>
                        <th>Notes</th>
                        <th>Prix achat</th>
                        <th>TVA %</th>
                        <th>Prix vente</th>
                        <th>Stock</th>
                        <th>Seuil alerte</th>
                        <th class="no-print">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($data = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <td><?php echo e($data['idproduit']); ?></td>
                        <td><?php echo e($data['idc']); ?></td>
                        <td><?php echo e($data['idf']); ?></td>
                        <td><?php echo e($data['nomproduit']); ?></td>
                        <td><?php echo e($data['marque']); ?></td>
                        <td><?php echo e($data['notes']); ?></td>
                        <td><?php echo e($data['prixdachat']); ?></td>
                        <td><?php echo e($data['tvaappliquee']); ?></td>
                        <td><?php echo e($data['prixdevente']); ?></td>
                        <td><?php echo e($data['qteenstock']); ?></td>
                        <td><?php echo e($data['seuildalerte']); ?></td>
                        <td class="no-print">
                            <a href="produit-form-update.php?id=<?php echo urlencode($data['idproduit']); ?>" class="btn btn-sm btn-primary">Modifier</a>
                            <a href="produit-form-delete.php?id=<?php echo urlencode($data['idproduit']); ?>" class="btn btn-sm btn-danger">Supprimer</a>
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
