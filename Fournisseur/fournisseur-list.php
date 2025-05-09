<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `fournisseur` order by `idf` desc";
$res = mysqli_query($con, $r);
$nbr = mysqli_num_rows($res);
?>
<div class="container-fluid">
    <div class="entete-list">
        <h1 class="h2">Fournisseurs</h1>
        <span class="nbr"><?php echo $nbr; ?></span>
    </div>

    <div class="mb-3 no-print">
        <a href="fournisseur-form-add.php" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter</a>
        <a href="fournisseur-print.php" class="btn btn-secondary"><i class="fa fa-print"></i> Imprimer</a>
    </div>

    <?php show_flash(); ?>

    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>idf</th>
                        <th>Nom</th>
                        <th>Contact</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Adresse</th>
                        <th>Ville</th>
                        <th>Pays</th>
                        <th>Type de produit</th>
                        <th>Condition de paiement</th>
                        <th>Condition de livraison</th>
                        <th>Notes</th>
                        <th class="no-print">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($data = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <td><?php echo e($data['idf']); ?></td>
                        <td><?php echo e($data['nom']); ?></td>
                        <td><?php echo e($data['contact']); ?></td>
                        <td><?php echo e($data['tel']); ?></td>
                        <td><?php echo e($data['email']); ?></td>
                        <td><?php echo e($data['adresse']); ?></td>
                        <td><?php echo e($data['ville']); ?></td>
                        <td><?php echo e($data['pays']); ?></td>
                        <td><?php echo e($data['typedeproduit']); ?></td>
                        <td><?php echo e($data['conditiondepaiement']); ?></td>
                        <td><?php echo e($data['conditiondelivraison']); ?></td>
                        <td><?php echo e($data['notes']); ?></td>
                        <td class="no-print">
                            <a href="fournisseur-form-update.php?id=<?php echo urlencode($data['idf']); ?>" class="btn btn-sm btn-primary">Modifier</a>
                            <a href="fournisseur-form-delete.php?id=<?php echo urlencode($data['idf']); ?>" class="btn btn-sm btn-danger">Supprimer</a>
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
