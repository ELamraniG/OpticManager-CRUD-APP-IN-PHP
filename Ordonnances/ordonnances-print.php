<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `ordonnances` order by `idordonnance`";
$res = mysqli_query($con, $r);
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h2>Ordonnances</h2>
        <button onclick="window.print()" class="btn btn-secondary no-print">Imprimer</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
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
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require("../footer.php"); ?>
