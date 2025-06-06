<?php
require("../head.php");
require("../connexion.php");
require("../fonctions.php");

$search_term = "";
$search_results = array();
$search_performed = false;

if (isset($_GET['q']) && !empty($_GET['q'])) {
    $search_term = mysqli_real_escape_string($con, $_GET['q']);
    $search_performed = true;
    
    // Search in Patients
    $patients_query = "SELECT 'Patient' as type, idpatient as id, CONCAT(nom, ' ', prenom) as title, 
                       telephone as info, 'Patients/patients-form-update.php' as edit_link
                       FROM patients 
                       WHERE nom LIKE '%$search_term%' 
                       OR prenom LIKE '%$search_term%' 
                       OR telephone LIKE '%$search_term%'
                       OR email LIKE '%$search_term%'
                       LIMIT 10";
    
    // Search in Clients
    $clients_query = "SELECT 'Client' as type, idl as id, CONCAT(nom, ' ', prenom) as title, 
                      telephone as info, 'Client/client-form-update.php' as edit_link
                      FROM client 
                      WHERE nom LIKE '%$search_term%' 
                      OR prenom LIKE '%$search_term%' 
                      OR telephone LIKE '%$search_term%'
                      OR email LIKE '%$search_term%'
                      LIMIT 10";
    
    // Search in Products
    $products_query = "SELECT 'Produit' as type, idproduit as id, nomproduit as title, 
                       CONCAT(marque, ' - Stock: ', qteenstock) as info, 'Produit/produit-form-update.php' as edit_link
                       FROM produit 
                       WHERE nomproduit LIKE '%$search_term%' 
                       OR marque LIKE '%$search_term%'
                       OR notes LIKE '%$search_term%'
                       LIMIT 10";
    
    // Search in Fournisseurs
    $fournisseurs_query = "SELECT 'Fournisseur' as type, idf as id, nom as title, 
                           CONCAT(contact, ' - ', tel) as info, 'Fournisseur/fournisseur-form-update.php' as edit_link
                           FROM fournisseur 
                           WHERE nom LIKE '%$search_term%' 
                           OR contact LIKE '%$search_term%'
                           OR tel LIKE '%$search_term%'
                           OR email LIKE '%$search_term%'
                           LIMIT 10";
    
    // Execute searches and combine results
    $queries = array($patients_query, $clients_query, $products_query, $fournisseurs_query);
    
    foreach ($queries as $query) {
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $search_results[] = $row;
        }
    }
}
?>

<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h1 class="display-4 mb-4">
                <i class="fas fa-search"></i> Recherche Globale
            </h1>
        </div>
    </div>

    <!-- Search Form -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="">
                <div class="row">
                    <div class="col-md-10">
                        <input type="text" 
                               name="q" 
                               class="form-control form-control-lg" 
                               placeholder="Rechercher dans patients, clients, produits, fournisseurs..." 
                               value="<?php echo htmlspecialchars($search_term); ?>"
                               required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-search"></i> Rechercher
                        </button>
                    </div>
                </div>
            </form>
            
            <div class="mt-3">
                <small class="text-muted">
                    <i class="fas fa-info-circle"></i> 
                    Recherche dans: noms, prénoms, téléphones, emails, marques, produits...
                </small>
            </div>
        </div>
    </div>

    <?php if ($search_performed): ?>
        <?php if (!empty($search_results)): ?>
            <!-- Search Results -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-search-plus"></i> 
                        Résultats de recherche pour: "<?php echo htmlspecialchars($search_term); ?>"
                        <span class="badge bg-primary"><?php echo count($search_results); ?> résultat(s)</span>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>ID</th>
                                    <th>Titre/Nom</th>
                                    <th>Informations</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($search_results as $result): ?>
                                <tr>
                                    <td>
                                        <?php 
                                        $type_colors = array(
                                            'Patient' => 'primary',
                                            'Client' => 'success',
                                            'Produit' => 'warning',
                                            'Fournisseur' => 'info'
                                        );
                                        $color = isset($type_colors[$result['type']]) ? $type_colors[$result['type']] : 'secondary';
                                        ?>
                                        <span class="badge bg-<?php echo $color; ?>">
                                            <?php echo $result['type']; ?>
                                        </span>
                                    </td>
                                    <td><?php echo $result['id']; ?></td>
                                    <td>
                                        <strong><?php echo htmlspecialchars($result['title']); ?></strong>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <?php echo htmlspecialchars($result['info']); ?>
                                        </small>
                                    </td>
                                    <td>
                                        <a href="../<?php echo $result['edit_link']; ?>?id=<?php echo urlencode($result['id']); ?>" 
                                           class="btn btn-sm btn-outline-primary"
                                           data-bs-toggle="tooltip" 
                                           title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="../<?php echo str_replace('-form-update.php', '-list.php', $result['edit_link']); ?>" 
                                           class="btn btn-sm btn-outline-secondary"
                                           data-bs-toggle="tooltip" 
                                           title="Voir la liste">
                                            <i class="fas fa-list"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        <?php else: ?>
            <!-- No Results -->
            <div class="card shadow">
                <div class="card-body text-center py-5">
                    <i class="fas fa-search-minus text-muted" style="font-size: 4rem;"></i>
                    <h3 class="mt-3 text-muted">Aucun résultat trouvé</h3>
                    <p class="lead text-muted">
                        Aucun résultat pour "<?php echo htmlspecialchars($search_term); ?>"
                    </p>
                    <div class="mt-4">
                        <h5>Suggestions:</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success"></i> Vérifiez l'orthographe</li>
                            <li><i class="fas fa-check text-success"></i> Utilisez des termes plus généraux</li>
                            <li><i class="fas fa-check text-success"></i> Essayez avec moins de mots</li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
    <?php else: ?>
        <!-- Search Tips -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="fas fa-lightbulb"></i> Conseils de Recherche</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><i class="fas fa-arrow-right text-primary"></i> Tapez le nom ou prénom d'un patient/client</li>
                            <li><i class="fas fa-arrow-right text-primary"></i> Recherchez par numéro de téléphone</li>
                            <li><i class="fas fa-arrow-right text-primary"></i> Cherchez un produit par nom ou marque</li>
                            <li><i class="fas fa-arrow-right text-primary"></i> Trouvez un fournisseur par nom</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="fas fa-list"></i> Accès Rapide</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="../Patients/patients-list.php" class="btn btn-outline-primary">
                                <i class="fas fa-users"></i> Voir tous les Patients
                            </a>
                            <a href="../Client/client-list.php" class="btn btn-outline-success">
                                <i class="fas fa-user-friends"></i> Voir tous les Clients
                            </a>
                            <a href="../Produit/produit-list.php" class="btn btn-outline-warning">
                                <i class="fas fa-boxes"></i> Voir tous les Produits
                            </a>
                            <a href="../Fournisseur/fournisseur-list.php" class="btn btn-outline-info">
                                <i class="fas fa-truck"></i> Voir tous les Fournisseurs
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
// Auto-focus on search input
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('input[name="q"]').focus();
});

// Handle Enter key for search
document.querySelector('input[name="q"]').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        this.form.submit();
    }
});
</script>

<?php
mysqli_close($con);
require("../footer.php");
?>
