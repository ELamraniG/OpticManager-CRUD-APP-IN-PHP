<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `client` order by `idl` desc";
$res = mysqli_query($con, $r);
$nbr = mysqli_num_rows($res);
?>
<div class="container-fluid">
    <div class="entete-list">
        <h1 class="h2">Clients</h1>
        <span class="nbr"><?php echo $nbr; ?></span>
    </div>

    <div class="mb-3 no-print">
        <a href="client-form-add.php" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter</a>
        <a href="client-print.php" class="btn btn-secondary"><i class="fa fa-print"></i> Imprimer</a>
    </div>

    <?php show_flash(); ?>

    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>idl</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Adresse</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Date de naissance</th>
                        <th>Ordonnances</th>
                        <th>Historique achats</th>
                        <th class="no-print">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($data = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <td><?php echo e($data['idl']); ?></td>
                        <td><?php echo e($data['nom']); ?></td>
                        <td><?php echo e($data['prenom']); ?></td>
                        <td><?php echo e($data['adresse']); ?></td>
                        <td><?php echo e($data['telephone']); ?></td>
                        <td><?php echo e($data['email']); ?></td>
                        <td><?php echo e($data['dateNaissance']); ?></td>
                        <td><?php echo e($data['ordonnances']); ?></td>
                        <td><?php echo e($data['historiqueAchats']); ?></td>
                        <td class="no-print">
                            <a href="client-form-update.php?id=<?php echo urlencode($data['idl']); ?>" class="btn btn-sm btn-primary">Modifier</a>
                            <a href="client-form-delete.php?id=<?php echo urlencode($data['idl']); ?>" class="btn btn-sm btn-danger">Supprimer</a>
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
