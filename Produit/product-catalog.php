<?php
require_once '../head.php';
require_once '../connexion.php';

$q = trim($_GET['q'] ?? '');
$category = trim($_GET['category'] ?? '');

$sql = "SELECT p.*, c.titrec
        FROM produit p
        LEFT JOIN categorie c ON c.idc = p.idc
        WHERE 1 = 1";
$params = array();
$types = '';

if ($q !== '') {
    $sql .= " AND (p.nomproduit LIKE ? OR p.marque LIKE ?)";
    $like = '%' . $q . '%';
    $params[] = $like;
    $params[] = $like;
    $types .= 'ss';
}

if ($category !== '') {
    $sql .= " AND p.idc = ?";
    $params[] = $category;
    $types .= 's';
}

$sql .= " ORDER BY p.nomproduit";

$stmt = mysqli_prepare($con, $sql);
if ($params) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);

$cats = mysqli_fetch_all(mysqli_query($con, 'SELECT idc, titrec FROM categorie ORDER BY titrec'), MYSQLI_ASSOC);
?>
<div class="container-fluid">
    <h1 class="h2 mb-3">Catalogue produits</h1>

    <form class="row g-2 mb-4">
        <div class="col-md-6"><input name="q" value="<?php echo e($q); ?>" class="form-control" placeholder="Produit ou marque"></div>
        <div class="col-md-4">
            <select name="category" class="form-select">
                <option value="">Toutes les catégories</option>
                <?php foreach ($cats as $cat): ?>
                <option value="<?php echo e($cat['idc']); ?>" <?php echo $category === $cat['idc'] ? 'selected' : ''; ?>><?php echo e($cat['titrec']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2"><button class="btn btn-primary w-100">Filtrer</button></div>
    </form>

    <div class="row g-3">
        <?php foreach ($rows as $row): ?>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="small text-muted"><?php echo e($row['titrec']); ?></div>
                    <h2 class="h5"><?php echo e($row['nomproduit']); ?></h2>
                    <div><?php echo e($row['marque']); ?></div>
                    <div class="fs-4 fw-bold mt-3"><?php echo e($row['prixdevente']); ?> DH</div>
                    <div class="mt-2">
                        <?php if ($row['qteenstock'] <= $row['seuildalerte']): ?>
                            <span class="badge bg-warning text-dark">Stock: <?php echo e($row['qteenstock']); ?></span>
                        <?php else: ?>
                            <span class="badge bg-success">Stock: <?php echo e($row['qteenstock']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <a href="produit-form-update.php?id=<?php echo urlencode($row['idproduit']); ?>" class="btn btn-sm btn-outline-primary">Modifier</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php require_once '../footer.php'; ?>
