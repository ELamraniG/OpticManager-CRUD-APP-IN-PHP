<?php
require("../head.php");
require("../connexion.php");

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$category_filter = isset($_GET['category']) ? mysqli_real_escape_string($con, $_GET['category']) : '';


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


$categories_query = "SELECT idc, titrec FROM categorie ORDER BY titrec";
$categories_result = mysqli_query($con, $categories_query);


$total_products = mysqli_num_rows(mysqli_query($con, "SELECT * FROM produit"));
$low_stock_count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM produit WHERE qteenstock <= seuildalerte"));
$out_of_stock_count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM produit WHERE qteenstock = 0"));
?>

<div class="container" style="margin-top: 100px;">

    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-4"><i class="fas fa-warehouse"></i> Inventaire</h1>
            <p class="lead">Consultation des stocks en temps réel</p>
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


    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-filter"></i> Filtres</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="" class="row align-items-end">
                <div class="col-md-4">
                    <label class="form-label">État du stock :</label>
                    <select name="filter" class="form-control">
                        <option value="all" <?php echo $filter == 'all' ? 'selected' : ''; ?>>Tous les produits</option>
                        <option value="low_stock" <?php echo $filter == 'low_stock' ? 'selected' : ''; ?>>Stock faible</option>
                        <option value="out_of_stock" <?php echo $filter == 'out_of_stock' ? 'selected' : ''; ?>>Rupture de stock</option>
                        <option value="in_stock" <?php echo $filter == 'in_stock' ? 'selected' : ''; ?>>En stock</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Catégorie :</label>
                    <select name="category" class="form-control">
                        <option value="">Toutes les catégories</option>
                        <?php while ($category = mysqli_fetch_assoc($categories_result)): ?>
                            <option value="<?php echo $category['idc']; ?>" 
                                    <?php echo $category_filter == $category['idc'] ? 'selected' : ''; ?>>
                                <?php echo $category['titrec']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Filtrer
                    </button>
                </div>
            </form>
        </div>
    </div>


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
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Produit</th>
                                <th>Catégorie</th>
                                <th>Fournisseur</th>
                                <th>Prix Vente</th>
                                <th>Stock Actuel</th>
                                <th>Seuil d'Alerte</th>
                                <th>Statut</th>
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
                                        <span class="badge bg-<?php echo $status_class; ?>">
                                            <?php echo $data['qteenstock']; ?>
                                        </span>
                                    </td>
                                    <td class="text-center"><?php echo $data['seuildalerte']; ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-<?php echo $status_class; ?>">
                                            <i class="fas <?php echo $status_icon; ?>"></i> <?php echo $stock_status; ?>
                                        </span>
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

<?php
mysqli_close($con);
require("../footer.php");
?>
