<?php
require("../head.php");
require("../connexion.php");

$patient = (int) (isset($_GET['patient']) ? $_GET['patient'] : 0);
$sql = "SELECT c.*, p.nom, p.prenom
        FROM consultations c
        JOIN patients p ON p.idpatient = c.idpatient";
if ($patient > 0) {
    $sql .= " WHERE c.idpatient = $patient";
}
$sql .= " ORDER BY c.dateconsultation DESC";
$res = mysqli_query($con, $sql);
$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h2">Historique consultations</h1>
        <a class="btn btn-primary" href="consultations-form-add.php">Nouvelle consultation</a>
    </div>

    <div class="list-group shadow-sm">
        <?php if (!$rows) { ?><div class="list-group-item text-muted">Aucune consultation.</div><?php } ?>
        <?php foreach ($rows as $row) { ?>
        <div class="list-group-item">
            <div class="d-flex justify-content-between">
                <strong><?php echo e($row['nom'] . ' ' . $row['prenom']); ?></strong>
                <span><?php echo e($row['dateconsultation']); ?></span>
            </div>
            <div><?php echo e($row['motif']); ?></div>
            <?php if ($row['observations']) { ?><small class="text-muted"><?php echo e($row['observations']); ?></small><?php } ?>
        </div>
        <?php } ?>
    </div>
</div>
<?php require("../footer.php"); ?>
