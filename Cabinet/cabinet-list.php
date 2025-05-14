<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `cabinet` order by `idcabinet` desc";
$res = mysqli_query($con, $r);
$nbr = mysqli_num_rows($res);
?>
<div class="container-fluid">
    <div class="entete-list">
        <h1 class="h2">Cabinets</h1>
        <span class="nbr"><?php echo $nbr; ?></span>
    </div>

    <div class="mb-3 no-print">
        <a href="cabinet-form-add.php" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter</a>
        <a href="cabinet-print.php" class="btn btn-secondary"><i class="fa fa-print"></i> Imprimer</a>
    </div>

    <?php show_flash(); ?>

    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>idcabinet</th>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Site web</th>
                        <th>Responsable</th>
                        <th>Spécialité</th>
                        <th>Ville</th>
                        <th>Pays</th>
                        <th>Code postal</th>
                        <th>Logo</th>
                        <th class="no-print">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($data = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <td><?php echo e($data['idcabinet']); ?></td>
                        <td><?php echo e($data['nomcabinet']); ?></td>
                        <td><?php echo e($data['adresse']); ?></td>
                        <td><?php echo e($data['telephone']); ?></td>
                        <td><?php echo e($data['email']); ?></td>
                        <td><?php echo e($data['siteweb']); ?></td>
                        <td><?php echo e($data['responsable']); ?></td>
                        <td><?php echo e($data['specialite']); ?></td>
                        <td><?php echo e($data['ville']); ?></td>
                        <td><?php echo e($data['pays']); ?></td>
                        <td><?php echo e($data['codepostal']); ?></td>
                        <td><?php echo e($data['logo']); ?></td>
                        <td class="no-print">
                            <a href="cabinet-form-update.php?id=<?php echo urlencode($data['idcabinet']); ?>" class="btn btn-sm btn-primary">Modifier</a>
                            <a href="cabinet-form-delete.php?id=<?php echo urlencode($data['idcabinet']); ?>" class="btn btn-sm btn-danger">Supprimer</a>
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
