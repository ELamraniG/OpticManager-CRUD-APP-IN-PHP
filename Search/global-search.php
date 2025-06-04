<?php
require_once '../head.php';
require_once '../connexion.php';

$q = trim($_GET['q'] ?? '');
$results = array();

if ($q !== '') {
    $like = '%' . $q . '%';

    $queries = array(
        'Clients' => "SELECT idl AS id, CONCAT(nom, ' ', prenom) AS title, email AS detail FROM client WHERE nom LIKE ? OR prenom LIKE ? OR email LIKE ? LIMIT 20",
        'Patients' => "SELECT idpatient AS id, CONCAT(nom, ' ', prenom) AS title, telephone AS detail FROM patients WHERE nom LIKE ? OR prenom LIKE ? OR telephone LIKE ? LIMIT 20",
        'Produits' => "SELECT idproduit AS id, nomproduit AS title, marque AS detail FROM produit WHERE nomproduit LIKE ? OR marque LIKE ? OR notes LIKE ? LIMIT 20",
        'Fournisseurs' => "SELECT idf AS id, nom AS title, email AS detail FROM fournisseur WHERE nom LIKE ? OR contact LIKE ? OR email LIKE ? LIMIT 20"
    );

    foreach ($queries as $group => $sql) {
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $like, $like, $like);
        mysqli_stmt_execute($stmt);
        $results[$group] = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    }
}
?>
<div class="container" style="max-width: 1000px">
    <h1 class="h2 mb-4">Recherche globale</h1>

    <form class="input-group mb-4">
        <input name="q" class="form-control form-control-lg" value="<?php echo e($q); ?>" placeholder="Nom, email, produit, téléphone...">
        <button class="btn btn-primary">Rechercher</button>
    </form>

    <?php if ($q !== ''): ?>
        <?php foreach ($results as $group => $rows): ?>
        <div class="card shadow-sm mb-3">
            <div class="card-header"><strong><?php echo e($group); ?></strong> <span class="badge bg-secondary"><?php echo count($rows); ?></span></div>
            <div class="list-group list-group-flush">
                <?php if (!$rows): ?><div class="list-group-item text-muted">Aucun résultat.</div><?php endif; ?>
                <?php foreach ($rows as $row): ?>
                <div class="list-group-item d-flex justify-content-between">
                    <span><?php echo e($row['title']); ?></span>
                    <small class="text-muted"><?php echo e($row['detail']); ?></small>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php require_once '../footer.php'; ?>
