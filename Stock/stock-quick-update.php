<?php
require("../head.php");
require("../connexion.php");

// Handle AJAX stock update
if (isset($_POST['action']) && $_POST['action'] == 'update_stock') {
    $idproduit = mysqli_real_escape_string($con, $_POST['idproduit']);
    $nouvelle_qte = mysqli_real_escape_string($con, $_POST['nouvelle_qte']);
    $operation = mysqli_real_escape_string($con, $_POST['operation']);
    
    // Get current stock
    $current_query = mysqli_query($con, "SELECT qteenstock, nomproduit FROM produit WHERE idproduit = '$idproduit'");
    $current_data = mysqli_fetch_assoc($current_query);
    $current_stock = $current_data['qteenstock'];
    
    // Calculate new stock based on operation
    if ($operation == 'add') {
        $new_stock = $current_stock + $nouvelle_qte;
    } elseif ($operation == 'subtract') {
        $new_stock = max(0, $current_stock - $nouvelle_qte); // Don't go below 0
    } else {
        $new_stock = $nouvelle_qte; // Direct update
    }
    
    // Update stock
    $update_query = "UPDATE produit SET qteenstock = '$new_stock' WHERE idproduit = '$idproduit'";
    $result = mysqli_query($con, $update_query);
    
    if ($result) {
        echo json_encode(array(
            'success' => true, 
            'new_stock' => $new_stock,
            'product_name' => $current_data['nomproduit']
        ));
    } else {
        echo json_encode(array('success' => false, 'error' => 'Erreur lors de la mise à jour'));
    }
    exit();
}

// Get products with low stock
$low_stock_query = "SELECT idproduit, nomproduit, marque, qteenstock, seuildalerte, prixdevente 
                    FROM produit 
                    WHERE qteenstock <= seuildalerte 
                    ORDER BY qteenstock ASC";
$low_stock_result = mysqli_query($con, $low_stock_query);

// Get all products for quick update
$all_products_query = "SELECT idproduit, nomproduit, marque, qteenstock, seuildalerte 
                       FROM produit 
                       ORDER BY nomproduit ASC";
$all_products_result = mysqli_query($con, $all_products_query);
?>

<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h1 class="display-4 mb-4">
                <i class="fas fa-warehouse"></i> Gestion Rapide du Stock
            </h1>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-exclamation-triangle"></i> Alertes Stock</h5>
                </div>
                <div class="card-body">
                    <?php if (mysqli_num_rows($low_stock_result) > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Stock</th>
                                        <th>Seuil</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($low_product = mysqli_fetch_assoc($low_stock_result)): ?>
                                    <tr class="<?php echo $low_product['qteenstock'] == 0 ? 'table-danger' : 'table-warning'; ?>">
                                        <td>
                                            <strong><?php echo $low_product['nomproduit']; ?></strong><br>
                                            <small class="text-muted"><?php echo $low_product['marque']; ?></small>
                                        </td>
                                        <td>
                                            <span class="badge <?php echo $low_product['qteenstock'] == 0 ? 'bg-danger' : 'bg-warning text-dark'; ?>">
                                                <?php echo $low_product['qteenstock']; ?>
                                            </span>
                                        </td>
                                        <td><?php echo $low_product['seuildalerte']; ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" 
                                                    onclick="openStockModal(<?php echo $low_product['idproduit']; ?>, '<?php echo addslashes($low_product['nomproduit']); ?>', <?php echo $low_product['qteenstock']; ?>)">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center text-success">
                            <i class="fas fa-check-circle fa-3x mb-3"></i>
                            <p>Aucune alerte de stock !</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-search"></i> Mise à Jour Rapide</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Rechercher un produit :</label>
                        <select class="form-control" id="productSearch" onchange="loadProductForUpdate()">
                            <option value="">Sélectionner un produit...</option>
                            <?php 
                            mysqli_data_seek($all_products_result, 0); // Reset pointer
                            while ($product = mysqli_fetch_assoc($all_products_result)): 
                            ?>
                                <option value="<?php echo $product['idproduit']; ?>" 
                                        data-name="<?php echo addslashes($product['nomproduit']); ?>"
                                        data-stock="<?php echo $product['qteenstock']; ?>">
                                    <?php echo $product['nomproduit']; ?> (Stock: <?php echo $product['qteenstock']; ?>)
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    
                    <div id="quickUpdateForm" style="display: none;">
                        <div class="alert alert-info">
                            <strong id="selectedProductName"></strong><br>
                            Stock actuel: <span id="currentStock" class="badge bg-primary"></span>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-success w-100" onclick="openStockModal(null, null, null, 'add')">
                                    <i class="fas fa-plus"></i> Ajouter
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-warning w-100" onclick="openStockModal(null, null, null, 'subtract')">
                                    <i class="fas fa-minus"></i> Retirer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Statistics -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-chart-bar"></i> Statistiques Stock</h5>
                </div>
                <div class="card-body">
                    <?php
                    // Calculate stock statistics
                    $total_products = mysqli_num_rows(mysqli_query($con, "SELECT * FROM produit"));
                    $out_of_stock = mysqli_num_rows(mysqli_query($con, "SELECT * FROM produit WHERE qteenstock = 0"));
                    $low_stock_count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM produit WHERE qteenstock <= seuildalerte AND qteenstock > 0"));
                    $total_value_query = mysqli_query($con, "SELECT SUM(prixdevente * qteenstock) as total FROM produit");
                    $total_value_data = mysqli_fetch_assoc($total_value_query);
                    $total_value = $total_value_data['total'];
                    ?>
                    
                    <div class="row text-center">
                        <div class="col-md-3">
                            <h3 class="text-primary"><?php echo $total_products; ?></h3>
                            <p>Total Produits</p>
                        </div>
                        <div class="col-md-3">
                            <h3 class="text-danger"><?php echo $out_of_stock; ?></h3>
                            <p>Rupture de Stock</p>
                        </div>
                        <div class="col-md-3">
                            <h3 class="text-warning"><?php echo $low_stock_count; ?></h3>
                            <p>Stock Faible</p>
                        </div>
                        <div class="col-md-3">
                            <h3 class="text-success"><?php echo number_format($total_value, 2); ?> DH</h3>
                            <p>Valeur Totale</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stock Update Modal -->
<div class="modal fade" id="stockUpdateModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-edit"></i> Mise à Jour Stock</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="stockUpdateForm">
                    <input type="hidden" id="modalProductId">
                    <input type="hidden" id="modalOperation">
                    
                    <div class="alert alert-info">
                        <strong id="modalProductName"></strong><br>
                        Stock actuel: <span id="modalCurrentStock" class="badge badge-primary"></span>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label>Quantité :</label>
                        <input type="number" class="form-control" id="modalQuantity" min="0" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label>Opération :</label>
                        <select class="form-control" id="modalOperationType">
                            <option value="add">Ajouter au stock</option>
                            <option value="subtract">Retirer du stock</option>
                            <option value="set">Définir le stock à</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="updateStock()">
                    <i class="fas fa-save"></i> Mettre à Jour
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let selectedProductId = null;
let selectedProductStock = null;

function loadProductForUpdate() {
    const select = document.getElementById('productSearch');
    const option = select.options[select.selectedIndex];
    
    if (option.value) {
        selectedProductId = option.value;
        selectedProductStock = parseInt(option.dataset.stock);
        
        document.getElementById('selectedProductName').textContent = option.dataset.name;
        document.getElementById('currentStock').textContent = option.dataset.stock;
        document.getElementById('quickUpdateForm').style.display = 'block';
    } else {
        document.getElementById('quickUpdateForm').style.display = 'none';
    }
}

function openStockModal(productId, productName, currentStock, operation) {
    operation = operation || 'add';
    
    // Use selected product if not provided
    if (!productId && selectedProductId) {
        productId = selectedProductId;
        var select = document.getElementById('productSearch');
        var option = select.options[select.selectedIndex];
        productName = option.getAttribute('data-name');
        currentStock = parseInt(option.getAttribute('data-stock'));
    }
    
    if (!productId) {
        alert('Veuillez sélectionner un produit');
        return;
    }
    
    document.getElementById('modalProductId').value = productId;
    document.getElementById('modalProductName').innerHTML = productName;
    document.getElementById('modalCurrentStock').innerHTML = currentStock;
    document.getElementById('modalOperationType').value = operation;
    document.getElementById('modalQuantity').value = '';
    
    $('#stockUpdateModal').modal('show');
}

function updateStock() {
    var productId = document.getElementById('modalProductId').value;
    var quantity = document.getElementById('modalQuantity').value;
    var operation = document.getElementById('modalOperationType').value;
    
    if (!quantity || quantity < 0) {
        alert('Veuillez saisir une quantité valide');
        return;
    }
    
    // Send AJAX request using jQuery
    $.ajax({
        url: 'stock-quick-update.php',
        type: 'POST',
        data: {
            action: 'update_stock',
            idproduit: productId,
            nouvelle_qte: quantity,
            operation: operation
        },
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                alert('Stock mis à jour avec succès!\n' + data.product_name + ': ' + data.new_stock + ' unités');
                // Refresh the page to show updated data
                window.location.reload();
            } else {
                alert('Erreur: ' + (data.error || 'Erreur inconnue'));
            }
        },
        error: function(xhr, status, error) {
            alert('Erreur de connexion: ' + error);
        }
    });
}
</script>

<?php
mysqli_close($con);
require("../footer.php");
?>
