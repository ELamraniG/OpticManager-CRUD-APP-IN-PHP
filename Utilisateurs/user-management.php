<?php
require_once '../head.php';
require_once '../connexion.php';

if (current_user_role() !== 'admin') {
    echo '<div class="alert alert-danger">Accès réservé à l’administrateur.</div>';
    require_once '../footer.php';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_user'])) {
    $id = (int) ($_POST['user_id'] ?? 0);
    $stmt = mysqli_prepare($con, 'UPDATE utilisateurs SET actif = IF(actif = 1, 0, 1) WHERE idutilisateur = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    flash('success', 'Statut utilisateur mis à jour.');
    redirect_to('user-management.php');
}

$rows = mysqli_fetch_all(
    mysqli_query($con, 'SELECT idutilisateur, nomutilisateur, role, nomcomplet, actif FROM utilisateurs ORDER BY role, nomutilisateur'),
    MYSQLI_ASSOC
);

$active = 0;
foreach ($rows as $row) {
    if ($row['actif']) {
        $active++;
    }
}
?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h2 mb-0">Gestion utilisateurs</h1>
            <span class="text-muted"><?php echo count($rows); ?> comptes, <?php echo $active; ?> actifs</span>
        </div>
        <a class="btn btn-primary" href="utilisateurs-form-add.php">Nouvel utilisateur</a>
    </div>

    <?php show_flash(); ?>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead><tr><th>Login</th><th>Nom</th><th>Rôle</th><th>Statut</th><th></th></tr></thead>
                <tbody>
                <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?php echo e($row['nomutilisateur']); ?></td>
                    <td><?php echo e($row['nomcomplet']); ?></td>
                    <td><span class="badge bg-secondary"><?php echo e($row['role']); ?></span></td>
                    <td><?php echo $row['actif'] ? '<span class="badge bg-success">Actif</span>' : '<span class="badge bg-danger">Inactif</span>'; ?></td>
                    <td class="table-actions">
                        <form method="post" class="d-inline">
                            <input type="hidden" name="user_id" value="<?php echo e($row['idutilisateur']); ?>">
                            <button name="toggle_user" class="btn btn-sm btn-outline-secondary">Changer statut</button>
                        </form>
                        <a class="btn btn-sm btn-primary" href="utilisateurs-form-update.php?id=<?php echo urlencode($row['idutilisateur']); ?>">Modifier</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once '../footer.php'; ?>
