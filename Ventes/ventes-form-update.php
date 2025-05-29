<?php
require("../head.php");
require("../connexion.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';
$id_sql = mysqli_real_escape_string($con, $id);
$r = "select * from `ventes` where `id_vente` = '$id_sql'";
$res = mysqli_query($con, $r);
$data = mysqli_fetch_assoc($res);

$r_list_idpatient = "select `idpatient` as value, CONCAT(nom, ' ', prenom) as label from `patients` order by label";
$list_idpatient = mysqli_query($con, $r_list_idpatient);
?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Modifier - Ventes</h2>
            <?php if (!$data) { ?>
                <div class="alert alert-danger">Ligne introuvable</div>
            <?php } else { ?>
            <form method="post" action="ventes-update.php">
                <input type="hidden" name="id" value="<?php echo e($data['id_vente']); ?>">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Patient</label>
            <select name="idpatient" class="form-select" required>
                <?php while ($x = mysqli_fetch_assoc($list_idpatient)) { ?>
                    <option value="<?php echo e($x['value']); ?>" <?php if ((string)$data['idpatient'] == (string)$x['value']) echo "selected"; ?>>
                        <?php echo e($x['label']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Date vente</label>
            <input type="datetime-local" name="datevente" class="form-control" value="<?php echo e($data['datevente']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Montant total</label>
            <input type="number" name="montanttotal" class="form-control" value="<?php echo e($data['montanttotal']); ?>" step="0.01" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Mode paiement</label>
            <select name="modepaiement" class="form-select" required>
                <option value="Carte bancaire" <?php if ((string)$data['modepaiement'] == 'Carte bancaire') echo "selected"; ?>>Carte bancaire</option>
                <option value="Espèces" <?php if ((string)$data['modepaiement'] == 'Espèces') echo "selected"; ?>>Espèces</option>
                <option value="Chèque" <?php if ((string)$data['modepaiement'] == 'Chèque') echo "selected"; ?>>Chèque</option>
                <option value="Virement" <?php if ((string)$data['modepaiement'] == 'Virement') echo "selected"; ?>>Virement</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Statut paiement</label>
            <select name="statutpaiement" class="form-select">
                <option value="en_attente" <?php if ((string)$data['statutpaiement'] == 'en_attente') echo "selected"; ?>>en_attente</option>
                <option value="payé" <?php if ((string)$data['statutpaiement'] == 'payé') echo "selected"; ?>>payé</option>
                <option value="annulé" <?php if ((string)$data['statutpaiement'] == 'annulé') echo "selected"; ?>>annulé</option>
            </select>
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Modifier</button>
                <a href="ventes-list.php" class="btn btn-secondary">Retour</a>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
