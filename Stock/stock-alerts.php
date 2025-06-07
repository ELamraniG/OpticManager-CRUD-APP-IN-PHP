<?php
require("../head.php");
require("../connexion.php");
require("../fonctions.php");

// Get products with stock alerts
$r = "SELECT p.idproduit, p.nomproduit, p.marque, p.qteenstock, p.seuildalerte, 
             c.titrec as categorie, f.nom as fournisseur
      FROM produit p
      LEFT JOIN categorie c ON p.idc = c.idc
      LEFT JOIN fournisseur f ON p.idf = f.idf
      WHERE p.qteenstock <= p.seuildalerte
      ORDER BY p.qteenstock ASC";

$res = mysqli_query($con, $r);
$nbr_alerts = mysqli_num_rows($res);

// Get all products for reference
$total_products = mysqli_num_rows(mysqli_query($con, "SELECT * FROM produit"));
?>

<div class="container" style="margin-top: 100px;">
    <div class="entete-list">
        <h1 class="display-4">
            <i class="fas fa-exclamation-triangle text-warning"></i> 
            Alertes de Stock
        </h1>
        <div>
            <span class="badge bg-danger fs-6"><?php echo $nbr_alerts; ?> alertes</span>
            <span class="badge bg-info fs-6"><?php echo $total_products; ?> produits total</span>
        </div>
    </div>

    <?php if ($nbr_alerts > 0): ?>
    <div class="card shadow">
        <div class="card-body">
            <div class="alert alert-warning">
                <i class="fas fa-info-circle"></i>
                <strong>Attention!</strong> <?php echo $nbr_alerts; ?> produit(s) nécessitent un réapprovisionnement.
            </div>
            
            <table id="example" class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom du Produit</th>
                        <th>Marque</th>
                        <th>Catégorie</th>
                        <th>Fournisseur</th>
                        <th>Stock Actuel</th>
                        <th>Seuil d'Alerte</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($data = mysqli_fetch_assoc($res)): ?>
                    <tr>
                        <td><?php echo $data['idproduit']; ?></td>
                        <td><strong><?php echo $data['nomproduit']; ?></strong></td>
                        <td><?php echo $data['marque']; ?></td>
                        <td><?php echo $data['categorie']; ?></td>
                        <td><?php echo $data['fournisseur']; ?></td>
                        <td>
                            <span class="badge <?php echo $data['qteenstock'] == 0 ? 'bg-danger' : 'bg-warning'; ?>">
                                <?php echo $data['qteenstock']; ?>
                            </span>
                        </td>
                        <td><?php echo $data['seuildalerte']; ?></td>
                        <td>
                            <?php if ($data['qteenstock'] == 0): ?>
                                <span class="badge bg-danger">RUPTURE</span>
                            <?php elseif ($data['qteenstock'] <= $data['seuildalerte']): ?>
                                <span class="badge bg-warning">STOCK FAIBLE</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <?php else: ?>
    <div class="card shadow">
        <div class="card-body text-center py-5">
            <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
            <h3 class="mt-3 text-success">Excellent!</h3>
            <p class="lead text-muted">Aucune alerte de stock pour le moment. Tous vos produits sont bien approvisionnés.</p>
        </div>
    </div>
    <?php endif; ?>

    <!-- Summary Statistics -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5>Ruptures de Stock</h5>
                            <h2><?php 
                                $ruptures = mysqli_query($con, "SELECT COUNT(*) as count FROM produit WHERE qteenstock = 0");
                                $ruptures_count = mysqli_fetch_assoc($ruptures);
                                echo $ruptures_count['count'];
                            ?></h2>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-times-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5>Stock Faible</h5>
                            <h2><?php 
                                $faible = mysqli_query($con, "SELECT COUNT(*) as count FROM produit WHERE qteenstock > 0 AND qteenstock <= seuildalerte");
                                $faible_count = mysqli_fetch_assoc($faible);
                                echo $faible_count['count'];
                            ?></h2>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5>Stock Normal</h5>
                            <h2><?php 
                                $normal = mysqli_query($con, "SELECT COUNT(*) as count FROM produit WHERE qteenstock > seuildalerte");
                                $normal_count = mysqli_fetch_assoc($normal);
                                echo $normal_count['count'];
                            ?></h2>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
mysqli_close($con);
require("../footer.php");
?>
