<?php
require("../head.php");
require("../connexion.php");

// Handle alert threshold updates
if (isset($_POST['update_threshold'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
    $new_threshold = mysqli_real_escape_string($con, $_POST['new_threshold']);
    
    $update_query = "UPDATE produit SET seuildalerte = '$new_threshold' WHERE idproduit = '$product_id'";
    if (mysqli_query($con, $update_query)) {
        $success_message = "Seuil d'alerte mis à jour avec succès !";
    } else {
        $error_message = "Erreur lors de la mise à jour du seuil.";
    }
}

// Get filter parameters
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$category_filter = isset($_GET['category']) ? mysqli_real_escape_string($con, $_GET['category']) : '';

// Build query based on filters
$where_clause = "WHERE 1=1";
switch ($filter) {
    case 'low_stock':
        $where_clause .= " AND produit.qteenstock <= produit.seuildalerte";
        break;
    case 'out_of_stock':
        $where_clause .= " AND produit.qteenstock = 0";
        break;
    case 'in_stock':
        $where_clause .= " AND produit.qteenstock > produit.seuildalerte";
        break;
}

if ($category_filter) {
    $where_clause .= " AND produit.idc = '$category_filter'";
}

$r = "SELECT idproduit, produit.idc, categorie.titrec, produit.idf, fournisseur.nom, nomproduit, marque, produit.notes, prixdachat, tvaappliquee, prixdevente, qteenstock, seuildalerte
FROM produit, categorie, fournisseur
$where_clause
AND produit.idc = categorie.idc
AND produit.idf = fournisseur.idf
ORDER BY produit.qteenstock ASC, produit.nomproduit ASC";

$res = mysqli_query($con, $r);
$nbr_service = mysqli_num_rows($res);

// Get categories for filter
$categories_query = "SELECT idc, titrec FROM categorie ORDER BY titrec";
$categories_result = mysqli_query($con, $categories_query);

// Get statistics
$total_products = mysqli_num_rows(mysqli_query($con, "SELECT * FROM produit"));
$low_stock_count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM produit WHERE qteenstock <= seuildalerte"));
$out_of_stock_count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM produit WHERE qteenstock = 0"));
?>

<div class="container" style="margin-top: 100px;">
    <?php if (isset($success_message)): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php echo $success_message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?php echo $error_message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Header with Statistics -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-4"><i class="fas fa-warehouse"></i> Gestion Inventaire</h1>
            <p class="lead">Surveillance et gestion des stocks en temps réel</p>
        </div>
        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-4">
                            <h5 class="text-primary"><?php echo $total_products; ?></h5>
                            <small>Total</small>
                        </div>
                        <div class="col-4">
                            <h5 class="text-warning"><?php echo $low_stock_count; ?></h5>
                            <small>Stock Faible</small>
                        </div>
                        <div class="col-4">
                            <h5 class="text-danger"><?php echo $out_of_stock_count; ?></h5>
                            <small>Rupture</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-filter"></i> Filtres et Actions</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="" class="row align-items-end">
                <div class="col-md-3">
                    <label class="form-label">État du stock :</label>
                    <select name="filter" class="form-select">
                        <option value="all" <?php echo $filter == 'all' ? 'selected' : ''; ?>>Tous les produits</option>
                        <option value="low_stock" <?php echo $filter == 'low_stock' ? 'selected' : ''; ?>>Stock faible</option>
                        <option value="out_of_stock" <?php echo $filter == 'out_of_stock' ? 'selected' : ''; ?>>Rupture de stock</option>
                        <option value="in_stock" <?php echo $filter == 'in_stock' ? 'selected' : ''; ?>>En stock</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Catégorie :</label>
                    <select name="category" class="form-select">
                        <option value="">Toutes les catégories</option>
                        <?php while ($category = mysqli_fetch_assoc($categories_result)): ?>
                            <option value="<?php echo $category['idc']; ?>" 
                                    <?php echo $category_filter == $category['idc'] ? 'selected' : ''; ?>>
                                <?php echo $category['titrec']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Filtrer
                    </button>
                </div>
                <div class="col-md-4 text-end">
                    <a href="../Produit/produit-form-add.php" class="btn btn-success me-2">
                        <i class="fas fa-plus"></i> Nouveau Produit
                    </a>
                    <a href="../Stock/stock-quick-update.php" class="btn btn-info">
                        <i class="fas fa-edit"></i> Mise à Jour Rapide
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Results -->
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold">
                <i class="fas fa-list"></i> Résultats 
                <span class="badge bg-primary"><?php echo $nbr_service; ?> produit(s)</span>
            </h6>
        </div>
        <div class="card-body">
            <?php if ($nbr_service > 0): ?>
                <div class="table-responsive">
                    <table id="inventoryTable" class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Produit</th>
                                <th>Catégorie</th>
                                <th>Fournisseur</th>
                                <th>Prix Vente</th>
                                <th>Stock Actuel</th>
                                <th>Seuil d'Alerte</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($data = mysqli_fetch_assoc($res)): ?>
                                <?php
                                $stock_status = '';
                                $status_class = '';
                                $status_icon = '';
                                
                                if ($data['qteenstock'] == 0) {
                                    $stock_status = 'Rupture';
                                    $status_class = 'danger';
                                    $status_icon = 'fa-times-circle';
                                } elseif ($data['qteenstock'] <= $data['seuildalerte']) {
                                    $stock_status = 'Stock Faible';
                                    $status_class = 'warning';
                                    $status_icon = 'fa-exclamation-triangle';
                                } else {
                                    $stock_status = 'En Stock';
                                    $status_class = 'success';
                                    $status_icon = 'fa-check-circle';
                                }
                                ?>
                                <tr class="<?php echo $data['qteenstock'] == 0 ? 'table-danger' : ($data['qteenstock'] <= $data['seuildalerte'] ? 'table-warning' : ''); ?>">
                                    <td>
                                        <strong><?php echo $data['nomproduit']; ?></strong><br>
                                        <small class="text-muted"><?php echo $data['marque']; ?></small>
                                    </td>
                                    <td><?php echo $data['titrec']; ?></td>
                                    <td><?php echo $data['nom']; ?></td>
                                    <td class="text-end">
                                        <strong><?php echo number_format($data['prixdevente'], 2); ?> DH</strong>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-<?php echo $status_class; ?> fs-6">
                                            <?php echo $data['qteenstock']; ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <form method="POST" class="d-inline" onsubmit="return confirm('Modifier le seuil d\'alerte ?')">
                                            <input type="hidden" name="product_id" value="<?php echo $data['idproduit']; ?>">
                                            <div class="input-group input-group-sm" style="width: 100px;">
                                                <input type="number" name="new_threshold" value="<?php echo $data['seuildalerte']; ?>" 
                                                       class="form-control" min="0" required>
                                                <button type="submit" name="update_threshold" class="btn btn-outline-secondary">
                                                    <i class="fas fa-save"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-<?php echo $status_class; ?>">
                                            <i class="fas <?php echo $status_icon; ?>"></i> <?php echo $stock_status; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="../Produit/produit-form-update.php?id=<?php echo $data['idproduit']; ?>" 
                                               class="btn btn-outline-primary" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <?php if ($data['qteenstock'] <= $data['seuildalerte']): ?>
                                                <button class="btn btn-outline-success" 
                                                        onclick="quickStockUpdate(<?php echo $data['idproduit']; ?>, '<?php echo addslashes($data['nomproduit']); ?>', <?php echo $data['qteenstock']; ?>)"
                                                        title="Réapprovisionner">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-search fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Aucun produit trouvé</h4>
                    <p class="text-muted">Aucun produit ne correspond aux critères sélectionnés.</p>
                    <a href="inventory-manager.php" class="btn btn-primary">Voir tous les produits</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Quick Stock Update Modal -->
<div class="modal fade" id="quickStockModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus"></i> Réapprovisionnement Rapide</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <strong id="quickModalProductName"></strong><br>
                    Stock actuel: <span id="quickModalCurrentStock" class="badge bg-primary"></span>
                </div>
                <div class="form-group">
                    <label>Quantité à ajouter :</label>
                    <input type="number" id="quickStockQuantity" class="form-control" min="1" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success" onclick="performQuickUpdate()">
                    <i class="fas fa-plus"></i> Ajouter Stock
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let quickUpdateProductId = null;

function quickStockUpdate(productId, productName, currentStock) {
    quickUpdateProductId = productId;
    document.getElementById('quickModalProductName').textContent = productName;
    document.getElementById('quickModalCurrentStock').textContent = currentStock;
    document.getElementById('quickStockQuantity').value = '';
    
    new bootstrap.Modal(document.getElementById('quickStockModal')).show();
}

function performQuickUpdate() {
    const quantity = document.getElementById('quickStockQuantity').value;
    
    if (!quantity || quantity < 1) {
        alert('Veuillez saisir une quantité valide');
        return;
    }
    
    // Redirect to stock update page with parameters
    window.location.href = `../Stock/stock-quick-update.php?action=quick_add&product_id=${quickUpdateProductId}&quantity=${quantity}`;
}

// Initialize DataTable
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('inventoryTable')) {
        $('#inventoryTable').DataTable({
            "pageLength": 25,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json"
            },
            "order": [[4, "asc"]], // Sort by stock quantity ascending
            "columnDefs": [
                { "orderable": false, "targets": [7] } // Disable sorting for actions column
            ]
        });
    }
});
</script>

<?php
mysqli_close($con);
require("../footer.php");
?>
