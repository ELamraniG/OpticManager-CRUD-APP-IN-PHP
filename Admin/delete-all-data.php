<?php
require_once '../head.php';
require_once '../connexion.php';

if (current_user_role() !== 'admin') {
    echo '<div class="alert alert-danger">Accès refusé.</div>';
    require_once '../footer.php';
    exit();
}

$done = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['confirm'] ?? '') === 'DELETE') {
    $tables = array(
        'vente_details', 'ventes', 'ordonnances', 'consultations',
        'commande', 'commandes_fournisseur', 'rendezvous',
        'produit', 'patients', 'client', 'cabinet', 'categorie', 'fournisseur'
    );

    mysqli_query($con, 'SET FOREIGN_KEY_CHECKS = 0');
    foreach ($tables as $table) {
        mysqli_query($con, 'TRUNCATE TABLE `' . $table . '`');
    }
    mysqli_query($con, 'SET FOREIGN_KEY_CHECKS = 1');
    $done = true;
}
?>
<div class="container" style="max-width: 700px">
    <div class="card border-danger">
        <div class="card-body p-4">
            <h1 class="h3 text-danger">Supprimer les données métier</h1>
            <?php if ($done): ?>
                <div class="alert alert-success">Les données ont été supprimées. Les utilisateurs sont conservés.</div>
            <?php else: ?>
                <p>Cette opération vide les tables métier. Les comptes utilisateurs sont conservés.</p>
                <form method="post">
                    <label class="form-label">Tapez DELETE pour confirmer</label>
                    <input name="confirm" class="form-control mb-3" required>
                    <button class="btn btn-danger" data-confirm="Confirmer la suppression de toutes les données ?">Supprimer</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php require_once '../footer.php'; ?>
