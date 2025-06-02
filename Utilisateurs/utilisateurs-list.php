<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `utilisateurs` order by `idutilisateur` desc";
$res = mysqli_query($con, $r);
$nbr = mysqli_num_rows($res);
?>
<div class="container-fluid">
    <div class="entete-list">
        <h1 class="h2">Utilisateurs</h1>
        <span class="nbr"><?php echo $nbr; ?></span>
    </div>

    <div class="mb-3 no-print">
        <a href="utilisateurs-form-add.php" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter</a>
        <a href="utilisateurs-print.php" class="btn btn-secondary"><i class="fa fa-print"></i> Imprimer</a>
    </div>

    <?php show_flash(); ?>

    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>idutilisateur</th>
                        <th>Nom utilisateur</th>
                        <th>Rôle</th>
                        <th>Nom complet</th>
                        <th>Actif</th>
                        <th class="no-print">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($data = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <td><?php echo e($data['idutilisateur']); ?></td>
                        <td><?php echo e($data['nomutilisateur']); ?></td>
                        <td><?php echo e($data['role']); ?></td>
                        <td><?php echo e($data['nomcomplet']); ?></td>
                        <td><?php echo e($data['actif']); ?></td>
                        <td class="no-print">
                            <a href="utilisateurs-form-update.php?id=<?php echo urlencode($data['idutilisateur']); ?>" class="btn btn-sm btn-primary">Modifier</a>
                            <a href="utilisateurs-form-delete.php?id=<?php echo urlencode($data['idutilisateur']); ?>" class="btn btn-sm btn-danger">Supprimer</a>
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
