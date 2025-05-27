<?php
require("../head.php");
require("../connexion.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';
$id_sql = mysqli_real_escape_string($con, $id);
$r = "select * from `ordonnances` where `idordonnance` = '$id_sql'";
$res = mysqli_query($con, $r);
$data = mysqli_fetch_assoc($res);

$r_list_idconsultation = "select `idconsultation` as value, CONCAT('#', idconsultation, ' - ', dateconsultation) as label from `consultations` order by label";
$list_idconsultation = mysqli_query($con, $r_list_idconsultation);
?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Modifier - Ordonnances</h2>
            <?php if (!$data) { ?>
                <div class="alert alert-danger">Ligne introuvable</div>
            <?php } else { ?>
            <form method="post" action="ordonnances-update.php">
                <input type="hidden" name="id" value="<?php echo e($data['idordonnance']); ?>">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Consultation</label>
            <select name="idconsultation" class="form-select" required>
                <?php while ($x = mysqli_fetch_assoc($list_idconsultation)) { ?>
                    <option value="<?php echo e($x['value']); ?>" <?php if ((string)$data['idconsultation'] == (string)$x['value']) echo "selected"; ?>>
                        <?php echo e($x['label']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Œil</label>
            <select name="oeil" class="form-select" required>
                <option value="OD" <?php if ((string)$data['oeil'] == 'OD') echo "selected"; ?>>OD</option>
                <option value="OG" <?php if ((string)$data['oeil'] == 'OG') echo "selected"; ?>>OG</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Sphère</label>
            <input type="number" name="sphere" class="form-control" value="<?php echo e($data['sphere']); ?>" step="0.01">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Cylindre</label>
            <input type="number" name="cylindre" class="form-control" value="<?php echo e($data['cylindre']); ?>" step="0.01">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Axe</label>
            <input type="number" name="axe" class="form-control" value="<?php echo e($data['axe']); ?>" step="0.01">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Addition</label>
            <input type="number" name="addition" class="form-control" value="<?php echo e($data['addition']); ?>" step="0.01">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Type correction</label>
            <select name="typecorrection" class="form-select" required>
                <option value="Distance" <?php if ((string)$data['typecorrection'] == 'Distance') echo "selected"; ?>>Distance</option>
                <option value="Près" <?php if ((string)$data['typecorrection'] == 'Près') echo "selected"; ?>>Près</option>
                <option value="Progressif" <?php if ((string)$data['typecorrection'] == 'Progressif') echo "selected"; ?>>Progressif</option>
            </select>
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Modifier</button>
                <a href="ordonnances-list.php" class="btn btn-secondary">Retour</a>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
