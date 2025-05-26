<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `ordonnances` order by `idordonnance` desc";
$res = mysqli_query($con, $r);
$nbr = mysqli_num_rows($res);
?>
<div class="container-fluid">
    <div class="entete-list">
        <h1 class="h2">Ordonnances</h1>
        <span class="nbr"><?php echo $nbr; ?></span>
    </div>

    <div class="mb-3 no-print">
        <a href="ordonnances-form-add.php" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter</a>
        <a href="ordonnances-print.php" class="btn btn-secondary"><i class="fa fa-print"></i> Imprimer</a>
    </div>

    <?php show_flash(); ?>

    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>idordonnance</th>
                        <th>Consultation</th>
                        <th>Œil</th>
                        <th>Sphère</th>
                        <th>Cylindre</th>
                        <th>Axe</th>
                        <th>Addition</th>
                        <th>Type correction</th>
                        <th class="no-print">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($data = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <td><?php echo e($data['idordonnance']); ?></td>
                        <td><?php echo e($data['idconsultation']); ?></td>
                        <td><?php echo e($data['oeil']); ?></td>
                        <td><?php echo e($data['sphere']); ?></td>
                        <td><?php echo e($data['cylindre']); ?></td>
                        <td><?php echo e($data['axe']); ?></td>
                        <td><?php echo e($data['addition']); ?></td>
                        <td><?php echo e($data['typecorrection']); ?></td>
                        <td class="no-print">
                            <a href="ordonnances-form-update.php?id=<?php echo urlencode($data['idordonnance']); ?>" class="btn btn-sm btn-primary">Modifier</a>
                            <a href="ordonnances-form-delete.php?id=<?php echo urlencode($data['idordonnance']); ?>" class="btn btn-sm btn-danger">Supprimer</a>
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
