<?php
require("../head.php");
require("../connexion.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';
$id_sql = mysqli_real_escape_string($con, $id);
$r = "select * from `consultations` where `idconsultation` = '$id_sql'";
$res = mysqli_query($con, $r);
$data = mysqli_fetch_assoc($res);

$r_list_idpatient = "select `idpatient` as value, CONCAT(nom, ' ', prenom) as label from `patients` order by label";
$list_idpatient = mysqli_query($con, $r_list_idpatient);
?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Modifier - Consultations</h2>
            <?php if (!$data) { ?>
                <div class="alert alert-danger">Ligne introuvable</div>
            <?php } else { ?>
            <form method="post" action="consultations-update.php">
                <input type="hidden" name="id" value="<?php echo e($data['idconsultation']); ?>">
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
            <label class="form-label">Date</label>
            <input type="date" name="dateconsultation" class="form-control" value="<?php echo e($data['dateconsultation']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Motif</label>
            <textarea name="motif" class="form-control" required><?php echo e($data['motif']); ?></textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Observations</label>
            <textarea name="observations" class="form-control"><?php echo e($data['observations']); ?></textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Prescription</label>
            <input type="text" name="prescriptionpdf" class="form-control" value="<?php echo e($data['prescriptionpdf']); ?>">
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Modifier</button>
                <a href="consultations-list.php" class="btn btn-secondary">Retour</a>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
