<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `client` order by `idl`";
$res = mysqli_query($con, $r);
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h2>Clients</h2>
        <button onclick="window.print()" class="btn btn-secondary no-print">Imprimer</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
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
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require("../footer.php"); ?>
