<?php
require_once '../head.php';
require_once '../connexion.php';

$patient = (int) ($_GET['patient'] ?? 0);
$sql = "SELECT c.*, p.nom, p.prenom
        FROM consultations c
        JOIN patients p ON p.idpatient = c.idpatient";
$params = array();

if ($patient > 0) {
    $sql .= " WHERE c.idpatient = ?";
    $stmt = mysqli_prepare($con, $sql . " ORDER BY c.dateconsultation DESC");
    mysqli_stmt_bind_param($stmt, 'i', $patient);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
} else {
    $res = mysqli_query($con, $sql . " ORDER BY c.dateconsultation DESC");
}

$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h2">Historique consultations</h1>
        <a class="btn btn-primary" href="consultations-form-add.php">Nouvelle consultation</a>
    </div>

    <div class="list-group shadow-sm">
        <?php if (!$rows): ?><div class="list-group-item text-muted">Aucune consultation.</div><?php endif; ?>
        <?php foreach ($rows as $row): ?>
        <div class="list-group-item">
            <div class="d-flex justify-content-between">
                <strong><?php echo e($row['nom'] . ' ' . $row['prenom']); ?></strong>
                <span><?php echo e($row['dateconsultation']); ?></span>
            </div>
            <div><?php echo e($row['motif']); ?></div>
            <?php if ($row['observations']): ?><small class="text-muted"><?php echo e($row['observations']); ?></small><?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php require_once '../footer.php'; ?>
