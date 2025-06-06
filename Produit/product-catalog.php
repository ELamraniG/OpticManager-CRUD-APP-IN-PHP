<?php
session_start();
if(!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] != 1) {
    header('Location: ../');
    exit();
}

include('../cnx.php');

// Traitement des actions AJAX
if(isset($_POST['action'])) {
    header('Content-Type: application/json');
    
    if($_POST['action'] == 'search_products') {
        $search = mysqli_real_escape_string($con, $_POST['search']);
        $category = mysqli_real_escape_string($con, $_POST['category']);
        $price_min = $_POST['price_min'] ? mysqli_real_escape_string($con, $_POST['price_min']) : 0;
        $price_max = $_POST['price_max'] ? mysqli_real_escape_string($con, $_POST['price_max']) : 999999;
        $stock_filter = mysqli_real_escape_string($con, $_POST['stock_filter']);
        
        $where_conditions = array();
        
        if(!empty($search)) {
            $where_conditions[] = "(p.nomproduit LIKE '%$search%' OR p.marque LIKE '%$search%')";
        }
        
        if(!empty($category)) {
            $where_conditions[] = "p.idc = '$category'";
        }
        
        $where_conditions[] = "p.prixdevente BETWEEN $price_min AND $price_max";
        
        if($stock_filter == 'low') {
            $where_conditions[] = "p.qteenstock <= p.seuildalerte";
        } elseif($stock_filter == 'available') {
            $where_conditions[] = "p.qteenstock > p.seuildalerte";
        } elseif($stock_filter == 'out') {
            $where_conditions[] = "p.qteenstock = 0";
        }
        
        $where_clause = !empty($where_conditions) ? 'WHERE ' . implode(' AND ', $where_conditions) : '';
        
        $query = "SELECT p.*, c.nom as categorie_nom 
                  FROM produit p 
                  LEFT JOIN categorie c ON p.idc = c.idc
                  $where_clause
                  ORDER BY p.nomproduit";
        
        $result = mysqli_query($con, $query);
        $products = array();
        
        while($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        
        echo json_encode($products);
        exit();
    }
    
    if($_POST['action'] == 'get_product_details') {
        $id = mysqli_real_escape_string($con, $_POST['id']);
        
        $query = "SELECT p.*, c.nom as categorie_nom, f.nom as fournisseur_nom
                  FROM produit p 
                  LEFT JOIN categorie c ON p.idc = c.idc
                  LEFT JOIN fournisseur f ON p.idf = f.idf
                  WHERE p.idproduit = '$id'";
        
        $result = mysqli_query($con, $query);
        $product = mysqli_fetch_assoc($result);
        
        // Récupérer l'historique des ventes
        $query_sales = "SELECT vd.quantite, vd.prix_unitaire, v.date_vente
                        FROM vente_details vd
                        JOIN ventes v ON vd.idvente = v.idvente
                        WHERE vd.idproduit = '$id'
                        ORDER BY v.date_vente DESC
                        LIMIT 10";
        
        $result_sales = mysqli_query($con, $query_sales);
        $sales = array();
        while($row = mysqli_fetch_assoc($result_sales)) {
            $sales[] = $row;
        }
        
        $product['sales_history'] = $sales;
        
        echo json_encode($product);
        exit();
    }
}

// Récupérer les catégories pour le filtre
$query_categories = "SELECT * FROM categorie ORDER BY nom";
$result_categories = mysqli_query($con, $query_categories);
$categories = array();
while($row = mysqli_fetch_assoc($result_categories)) {
    $categories[] = $row;
}

// Statistiques
$query_stats = "SELECT 
    COUNT(*) as total_produits,
    SUM(qteenstock * prixdachat) as valeur_stock,
    COUNT(CASE WHEN qteenstock <= seuildalerte THEN 1 END) as produits_critiques,
    AVG(prixdevente) as prix_moyen
    FROM produit";
$result_stats = mysqli_query($con, $query_stats);
$stats = mysqli_fetch_assoc($result_stats);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue Produits - OptiRent</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .product-card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            transition: all 0.3s ease;
            height: 100%;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .product-image {
            height: 200px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 10px 10px 0 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #6c757d;
        }
        .product-price {
            font-size: 1.25rem;
            font-weight: bold;
            color: #28a745;
        }
        .stock-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }
        .filter-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
            position: sticky;
            top: 20px;
        }
        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            margin-bottom: 20px;
        }
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
        }
        .search-bar {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .loading {
            text-align: center;
            padding: 50px;
            color: #6c757d;
        }
        .product-actions {
            position: absolute;
            top: 10px;
            left: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .product-card:hover .product-actions {
            opacity: 1;
        }
        .price-range {
            margin: 15px 0;
        }
    </style>
</head>
<body class="bg-light">
    <?php include('../head.php'); ?>

    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-boxes me-3"></i>Catalogue Produits</h1>
            <p class="mb-0">Explorez et gérez votre inventaire de produits optiques</p>
        </div>
    </div>

    <div class="container">
        <!-- Statistiques -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-cube fa-2x text-primary mb-2"></i>
                    <h4 class="text-primary"><?php echo number_format($stats['total_produits']); ?></h4>
                    <small class="text-muted">Produits total</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-euro-sign fa-2x text-success mb-2"></i>
                    <h4 class="text-success"><?php echo number_format($stats['valeur_stock'], 0, ',', ' '); ?>€</h4>
                    <small class="text-muted">Valeur du stock</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning mb-2"></i>
                    <h4 class="text-warning"><?php echo $stats['produits_critiques']; ?></h4>
                    <small class="text-muted">Stock critique</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-tag fa-2x text-info mb-2"></i>
                    <h4 class="text-info"><?php echo number_format($stats['prix_moyen'], 2); ?>€</h4>
                    <small class="text-muted">Prix moyen</small>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Filtres -->
            <div class="col-md-3">
                <div class="filter-card">
                    <h5><i class="fas fa-filter me-2"></i>Filtres</h5>
                    
                    <div class="mb-3">
                        <label class="form-label">Recherche</label>
                        <input type="text" class="form-control" id="search-input" 
                               placeholder="Nom ou marque...">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Catégorie</label>
                        <select class="form-select" id="category-filter">
                            <option value="">Toutes les catégories</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category['idc']; ?>">
                                    <?php echo htmlspecialchars($category['nom']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Prix</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="number" class="form-control" id="price-min" 
                                       placeholder="Min" min="0" step="0.01">
                            </div>
                            <div class="col-6">
                                <input type="number" class="form-control" id="price-max" 
                                       placeholder="Max" min="0" step="0.01">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <select class="form-select" id="stock-filter">
                            <option value="">Tous les stocks</option>
                            <option value="available">Stock disponible</option>
                            <option value="low">Stock faible</option>
                            <option value="out">Rupture de stock</option>
                        </select>
                    </div>
                    
                    <button class="btn btn-primary w-100 mb-2" onclick="applyFilters()">
                        <i class="fas fa-search me-2"></i>Rechercher
                    </button>
                    
                    <button class="btn btn-outline-secondary w-100" onclick="clearFilters()">
                        <i class="fas fa-times me-2"></i>Effacer
                    </button>
                </div>

                <!-- Actions rapides -->
                <div class="filter-card">
                    <h5><i class="fas fa-tools me-2"></i>Actions</h5>
                    <a href="../Produit/produit-add.php" class="btn btn-success w-100 mb-2">
                        <i class="fas fa-plus me-2"></i>Nouveau produit
                    </a>
                    <a href="../Stock/inventory-manager.php" class="btn btn-warning w-100 mb-2">
                        <i class="fas fa-boxes me-2"></i>Gérer le stock
                    </a>
                    <a href="../Categorie/categorie-list.php" class="btn btn-info w-100">
                        <i class="fas fa-tags me-2"></i>Catégories
                    </a>
                </div>
            </div>

            <!-- Catalogue -->
            <div class="col-md-9">
                <div class="search-bar">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0">
                                <span id="results-count">Chargement...</span> produits trouvés
                            </h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="btn-group" role="group">
                                <button class="btn btn-outline-primary active" onclick="setView('grid')" id="btn-grid">
                                    <i class="fas fa-th"></i> Grille
                                </button>
                                <button class="btn btn-outline-primary" onclick="setView('list')" id="btn-list">
                                    <i class="fas fa-list"></i> Liste
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="products-container">
                    <div class="loading">
                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                        <p class="mt-3">Chargement des produits...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal détails produit -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-info-circle me-2"></i>Détails du produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="product-details">
                    <!-- Contenu chargé dynamiquement -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" id="edit-product-btn">
                        <i class="fas fa-edit me-2"></i>Modifier
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    
    <script>
        let currentView = 'grid';
        let searchTimeout;

        // Chargement initial
        document.addEventListener('DOMContentLoaded', function() {
            loadProducts();
            
            // Auto-recherche en temps réel
            document.getElementById('search-input').addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(applyFilters, 300);
            });
        });

        function loadProducts() {
            applyFilters();
        }

        function applyFilters() {
            const search = document.getElementById('search-input').value;
            const category = document.getElementById('category-filter').value;
            const priceMin = document.getElementById('price-min').value;
            const priceMax = document.getElementById('price-max').value;
            const stockFilter = document.getElementById('stock-filter').value;

            fetch('', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `action=search_products&search=${encodeURIComponent(search)}&category=${category}&price_min=${priceMin}&price_max=${priceMax}&stock_filter=${stockFilter}`
            })
            .then(response => response.json())
            .then(products => {
                displayProducts(products);
                document.getElementById('results-count').textContent = products.length;
            })
            .catch(error => {
                console.error('Erreur:', error);
                document.getElementById('products-container').innerHTML = 
                    '<div class="alert alert-danger"><i class="fas fa-exclamation-triangle me-2"></i>Erreur lors du chargement des produits</div>';
            });
        }

        function clearFilters() {
            document.getElementById('search-input').value = '';
            document.getElementById('category-filter').value = '';
            document.getElementById('price-min').value = '';
            document.getElementById('price-max').value = '';
            document.getElementById('stock-filter').value = '';
            applyFilters();
        }

        function displayProducts(products) {
            const container = document.getElementById('products-container');
            
            if (products.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-5">
                        <i class="fas fa-search fa-4x text-muted mb-3"></i>
                        <h4>Aucun produit trouvé</h4>
                        <p class="text-muted">Essayez de modifier vos critères de recherche</p>
                    </div>
                `;
                return;
            }

            if (currentView === 'grid') {
                displayGridView(products, container);
            } else {
                displayListView(products, container);
            }
        }

        function displayGridView(products, container) {
            let html = '<div class="row">';
            
            products.forEach(product => {
                const stockClass = getStockClass(product.qteenstock, product.seuildalerte);
                const stockText = getStockText(product.qteenstock, product.seuildalerte);
                
                html += `
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card product-card position-relative">
                            <div class="product-actions">
                                <button class="btn btn-sm btn-primary" onclick="showProductDetails(${product.idproduit})">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <span class="badge ${stockClass} stock-badge">${stockText}</span>
                            <div class="product-image">
                                <i class="fas fa-glasses"></i>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title">${product.nomproduit}</h6>
                                <p class="card-text">
                                    <small class="text-muted">${product.marque}</small><br>
                                    <small class="text-muted">Stock: ${product.qteenstock}</small>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="product-price">${parseFloat(product.prixdevente).toFixed(2)}€</span>
                                    <button class="btn btn-sm btn-outline-primary" onclick="showProductDetails(${product.idproduit})">
                                        <i class="fas fa-info"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            html += '</div>';
            container.innerHTML = html;
        }

        function displayListView(products, container) {
            let html = '<div class="list-group">';
            
            products.forEach(product => {
                const stockClass = getStockClass(product.qteenstock, product.seuildalerte);
                const stockText = getStockText(product.qteenstock, product.seuildalerte);
                
                html += `
                    <div class="list-group-item list-group-item-action">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h6 class="mb-1">${product.nomproduit}</h6>
                                <p class="mb-1 text-muted">${product.marque}</p>
                                <small>${product.categorie_nom || 'Sans catégorie'}</small>
                            </div>
                            <div class="col-md-2 text-center">
                                <span class="badge ${stockClass}">${stockText}</span>
                                <small class="d-block text-muted">${product.qteenstock} unités</small>
                            </div>
                            <div class="col-md-2 text-center">
                                <span class="product-price">${parseFloat(product.prixdevente).toFixed(2)}€</span>
                            </div>
                            <div class="col-md-2 text-end">
                                <button class="btn btn-sm btn-outline-primary" onclick="showProductDetails(${product.idproduit})">
                                    <i class="fas fa-eye me-1"></i>Détails
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            html += '</div>';
            container.innerHTML = html;
        }

        function getStockClass(stock, seuil) {
            if (stock == 0) return 'bg-danger';
            if (stock <= seuil) return 'bg-warning';
            return 'bg-success';
        }

        function getStockText(stock, seuil) {
            if (stock == 0) return 'Rupture';
            if (stock <= seuil) return 'Faible';
            return 'Disponible';
        }

        function setView(view) {
            currentView = view;
            
            document.getElementById('btn-grid').classList.toggle('active', view === 'grid');
            document.getElementById('btn-list').classList.toggle('active', view === 'list');
            
            applyFilters();
        }

        function showProductDetails(productId) {
            fetch('', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `action=get_product_details&id=${productId}`
            })
            .then(response => response.json())
            .then(product => {
                displayProductDetails(product);
                new bootstrap.Modal(document.getElementById('productModal')).show();
                
                document.getElementById('edit-product-btn').onclick = function() {
                    window.location.href = `../Produit/produit-update.php?idproduit=${productId}`;
                };
            });
        }

        function displayProductDetails(product) {
            const stockClass = getStockClass(product.qteenstock, product.seuildalerte);
            const stockText = getStockText(product.qteenstock, product.seuildalerte);
            
            let salesHtml = '';
            if (product.sales_history && product.sales_history.length > 0) {
                salesHtml = '<h6 class="mt-4">Historique des ventes récentes</h6><div class="table-responsive"><table class="table table-sm"><thead><tr><th>Date</th><th>Quantité</th><th>Prix</th></tr></thead><tbody>';
                product.sales_history.forEach(sale => {
                    salesHtml += `<tr><td>${sale.date_vente}</td><td>${sale.quantite}</td><td>${parseFloat(sale.prix_unitaire).toFixed(2)}€</td></tr>`;
                });
                salesHtml += '</tbody></table></div>';
            } else {
                salesHtml = '<p class="mt-4 text-muted">Aucune vente récente</p>';
            }

            const html = `
                <div class="row">
                    <div class="col-md-8">
                        <h4>${product.nomproduit}</h4>
                        <p class="text-muted">${product.marque}</p>
                        
                        <div class="row mb-3">
                            <div class="col-6">
                                <strong>Catégorie:</strong><br>
                                ${product.categorie_nom || 'Non définie'}
                            </div>
                            <div class="col-6">
                                <strong>Fournisseur:</strong><br>
                                ${product.fournisseur_nom || 'Non défini'}
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-4">
                                <strong>Prix d'achat:</strong><br>
                                ${parseFloat(product.prixdachat).toFixed(2)}€
                            </div>
                            <div class="col-4">
                                <strong>Prix de vente:</strong><br>
                                <span class="text-success fs-5">${parseFloat(product.prixdevente).toFixed(2)}€</span>
                            </div>
                            <div class="col-4">
                                <strong>TVA:</strong><br>
                                ${product.tvaappliquee}%
                            </div>
                        </div>
                        
                        ${product.notes ? `<div class="mb-3"><strong>Notes:</strong><br>${product.notes}</div>` : ''}
                        
                        ${salesHtml}
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5>Stock</h5>
                                <h2 class="text-primary">${product.qteenstock}</h2>
                                <span class="badge ${stockClass} mb-2">${stockText}</span>
                                <p class="small text-muted">Seuil d'alerte: ${product.seuildalerte}</p>
                                
                                <div class="mt-3">
                                    <button class="btn btn-outline-primary btn-sm w-100 mb-2" onclick="window.location.href='../Stock/stock-quick-update.php?id=${product.idproduit}'">
                                        <i class="fas fa-edit me-1"></i>Modifier stock
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            document.getElementById('product-details').innerHTML = html;
        }
    </script>
</body>
</html>
