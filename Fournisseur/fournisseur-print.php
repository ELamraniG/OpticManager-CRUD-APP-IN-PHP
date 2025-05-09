<?php
require("../head.php");
require("../connexion.php");

$r = "select * from `fournisseur` order by `idf`";
$res = mysqli_query($con, $r);
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h2>Fournisseurs</h2>
        <button onclick="window.print()" class="btn btn-secondary no-print">Imprimer</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
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
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require("../footer.php"); ?>
