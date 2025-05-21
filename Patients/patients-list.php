<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `patients` order by `idpatient` desc";
$res = mysqli_query($con, $r);
$nbr = mysqli_num_rows($res);
?>
<div class="container-fluid">
    <div class="entete-list">
        <h1 class="h2">Patients</h1>
        <span class="nbr"><?php echo $nbr; ?></span>
    </div>

    <div class="mb-3 no-print">
        <a href="patients-form-add.php" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter</a>
        <a href="patients-print.php" class="btn btn-secondary"><i class="fa fa-print"></i> Imprimer</a>
    </div>

    <?php show_flash(); ?>

    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>idpatient</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de naissance</th>
                        <th>Sexe</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Adresse</th>
                        <th>Date création</th>
                        <th class="no-print">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($data = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <td><?php echo e($data['idpatient']); ?></td>
                        <td><?php echo e($data['nom']); ?></td>
                        <td><?php echo e($data['prenom']); ?></td>
                        <td><?php echo e($data['datenaissance']); ?></td>
                        <td><?php echo e($data['sexe']); ?></td>
                        <td><?php echo e($data['telephone']); ?></td>
                        <td><?php echo e($data['email']); ?></td>
                        <td><?php echo e($data['adresse']); ?></td>
                        <td><?php echo e($data['datecreation']); ?></td>
                        <td class="no-print">
                            <a href="patients-form-update.php?id=<?php echo urlencode($data['idpatient']); ?>" class="btn btn-sm btn-primary">Modifier</a>
                            <a href="patients-form-delete.php?id=<?php echo urlencode($data['idpatient']); ?>" class="btn btn-sm btn-danger">Supprimer</a>
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
