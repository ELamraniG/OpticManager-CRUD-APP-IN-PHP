<?php
require("../head.php");
require("../connexion.php");

// Get products with low stock
$low_stock_query = "SELECT idproduit, nomproduit, marque, qteenstock, seuildalerte, prixdevente 
                    FROM produit 
                    WHERE qteenstock <= seuildalerte 
                    ORDER BY qteenstock ASC";
$low_stock_result = mysqli_query($con, $low_stock_query);

// Calculate stock statistics
$total_products = mysqli_num_rows(mysqli_query($con, "SELECT * FROM produit"));
$out_of_stock = mysqli_num_rows(mysqli_query($con, "SELECT * FROM produit WHERE qteenstock = 0"));
$low_stock_count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM produit WHERE qteenstock <= seuildalerte AND qteenstock > 0"));
$total_value_query = mysqli_query($con, "SELECT SUM(prixdevente * qteenstock) as total FROM produit");
$total_value_data = mysqli_fetch_assoc($total_value_query);
$total_value = $total_value_data['total'];
?>

<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h1 class="display-4 mb-4">
                <i class="fas fa-warehouse"></i> Statistiques du Stock
            </h1>
        </div>
    </div>

    <!-- Stock Statistics -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <i class="fas fa-boxes fa-2x mb-2"></i>
                    <h3><?php echo $total_products; ?></h3>
                    <p>Total Produits</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body text-center">
                    <i class="fas fa-times-circle fa-2x mb-2"></i>
                    <h3><?php echo $out_of_stock; ?></h3>
                    <p>Rupture de Stock</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body text-center">
                    <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                    <h3><?php echo $low_stock_count; ?></h3>
                    <p>Stock Faible</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <i class="fas fa-dollar-sign fa-2x mb-2"></i>
                    <h3><?php echo number_format($total_value, 2); ?> DH</h3>
                    <p>Valeur Totale</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Alerts Stock -->
    <div class="row">
        <div class="col-12">
            <div class="card border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-exclamation-triangle"></i> Alertes Stock</h5>
                </div>
                <div class="card-body">
                    <?php if (mysqli_num_rows($low_stock_result) > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Marque</th>
                                        <th>Stock Actuel</th>
                                        <th>Seuil d'Alerte</th>
                                        <th>Prix Unitaire</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($product = mysqli_fetch_assoc($low_stock_result)): ?>
                                    <tr class="<?php echo $product['qteenstock'] == 0 ? 'table-danger' : 'table-warning'; ?>">
                                        <td><strong><?php echo $product['nomproduit']; ?></strong></td>
                                        <td><?php echo $product['marque']; ?></td>
                                        <td>
                                            <span class="badge <?php echo $product['qteenstock'] == 0 ? 'bg-danger' : 'bg-warning'; ?>">
                                                <?php echo $product['qteenstock']; ?>
                                            </span>
                                        </td>
                                        <td><?php echo $product['seuildalerte']; ?></td>
                                        <td><?php echo number_format($product['prixdevente'], 2); ?> DH</td>
                                        <td>
                                            <?php if ($product['qteenstock'] == 0): ?>
                                                <span class="badge bg-danger">RUPTURE</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning">STOCK FAIBLE</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center text-success">
                            <i class="fas fa-check-circle fa-3x mb-3"></i>
                            <h4>Excellent!</h4>
                            <p>Aucune alerte de stock. Tous les produits sont bien approvisionnés.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
mysqli_close($con);
require("../footer.php");
?>
