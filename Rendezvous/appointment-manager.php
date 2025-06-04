<?php
require_once '../head.php';
require_once '../connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = (int) $_POST['delete_id'];
    $stmt = mysqli_prepare($con, 'DELETE FROM rendezvous WHERE idrendezvous = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    flash('success', 'Rendez-vous supprimé.');
    redirect_to('appointment-manager.php');
}

$res = mysqli_query($con, "SELECT r.*, CONCAT(c.nom, ' ', c.prenom) AS client, b.nomcabinet
                           FROM rendezvous r
                           JOIN client c ON c.idl = r.idclient
                           JOIN cabinet b ON b.idcabinet = r.idcabinet
                           WHERE r.daterendezvous >= CURDATE()
                           ORDER BY r.daterendezvous, r.heurerendezvous");
$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h2 mb-0">Gestion rendez-vous</h1>
        <div>
            <a class="btn btn-outline-secondary" href="calendar-view.php">Calendrier</a>
            <a class="btn btn-primary" href="rendezvous-form-add.php">Nouveau RDV</a>
        </div>
    </div>
    <?php show_flash(); ?>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead><tr><th>Date</th><th>Heure</th><th>Client</th><th>Cabinet</th><th>Notes</th><th></th></tr></thead>
                <tbody>
                <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?php echo e($row['daterendezvous']); ?></td>
                    <td><?php echo e(substr($row['heurerendezvous'], 0, 5)); ?></td>
                    <td><?php echo e($row['client']); ?></td>
                    <td><?php echo e($row['nomcabinet']); ?></td>
                    <td><?php echo e($row['notes']); ?></td>
                    <td class="table-actions">
                        <a class="btn btn-sm btn-primary" href="rendezvous-form-update.php?id=<?php echo urlencode($row['idrendezvous']); ?>">Modifier</a>
                        <form method="post" class="d-inline">
                            <input type="hidden" name="delete_id" value="<?php echo e($row['idrendezvous']); ?>">
                            <button class="btn btn-sm btn-outline-danger" data-confirm="Supprimer ce rendez-vous ?">Supprimer</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once '../footer.php'; ?>
