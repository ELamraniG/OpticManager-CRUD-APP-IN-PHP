<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `cabinet` order by `idcabinet`";
$res = mysqli_query($con, $r);
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h2>Cabinets</h2>
        <button onclick="window.print()" class="btn btn-secondary no-print">Imprimer</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
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
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require("../footer.php"); ?>
