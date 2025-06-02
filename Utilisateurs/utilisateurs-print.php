<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `utilisateurs` order by `idutilisateur`";
$res = mysqli_query($con, $r);
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h2>Utilisateurs</h2>
        <button onclick="window.print()" class="btn btn-secondary no-print">Imprimer</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>idutilisateur</th>
                    <th>Nom utilisateur</th>
                    <th>Rôle</th>
                    <th>Nom complet</th>
                    <th>Actif</th>
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
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require("../footer.php"); ?>
