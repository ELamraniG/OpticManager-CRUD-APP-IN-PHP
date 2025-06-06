<?php
require("../head.php");
require("../connexion.php");
require("../fonctions.php");

// Get basic statistics
$total_patients = mysqli_num_rows(mysqli_query($con, "SELECT * FROM patients"));
$total_clients = mysqli_num_rows(mysqli_query($con, "SELECT * FROM client"));
$total_produits = mysqli_num_rows(mysqli_query($con, "SELECT * FROM produit"));
$total_fournisseurs = mysqli_num_rows(mysqli_query($con, "SELECT * FROM fournisseur"));

// Stock alerts - products below threshold
$stock_alerts = mysqli_query($con, "SELECT nomproduit, qteenstock, seuildalerte FROM produit WHERE qteenstock <= seuildalerte");
$nbr_alerts = mysqli_num_rows($stock_alerts);

// Additional statistics
$total_consultations = mysqli_num_rows(mysqli_query($con, "SELECT * FROM consultations"));
$total_ordonnances = mysqli_num_rows(mysqli_query($con, "SELECT * FROM ordonnances"));
$consultations_today = mysqli_num_rows(mysqli_query($con, "SELECT * FROM consultations WHERE DATE(dateconsultation) = CURDATE()"));
$consultations_this_month = mysqli_num_rows(mysqli_query($con, "SELECT * FROM consultations WHERE MONTH(dateconsultation) = MONTH(CURDATE()) AND YEAR(dateconsultation) = YEAR(CURDATE())"));

// Stock statistics
$total_stock_value_query = mysqli_query($con, "SELECT SUM(prixdevente * qteenstock) as total_value FROM produit");
$total_stock_value = mysqli_fetch_assoc($total_stock_value_query);
$stock_value = $total_stock_value['total_value'] ? $total_stock_value['total_value'] : 0;

// Recent consultations (last 10)
$recent_consultations = mysqli_query($con, "SELECT p.nom, p.prenom, c.dateconsultation, c.motif 
                                           FROM consultations c 
                                           JOIN patients p ON c.idpatient = p.idpatient 
                                           ORDER BY c.dateconsultation DESC LIMIT 10");

// Low stock products
$low_stock = mysqli_query($con, "SELECT nomproduit, qteenstock, seuildalerte, marque 
                                FROM produit 
                                WHERE qteenstock <= seuildalerte 
                                ORDER BY qteenstock ASC LIMIT 5");
?>

<div class="container-fluid" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h1 class="display-4 mb-4">
                <i class="fas fa-tachometer-alt"></i> Tableau de Bord
            </h1>
        </div>
    </div>    <!-- Statistics Cards Row 1 -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Patients
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_patients; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Clients
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_clients; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Produits
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_produits; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Alertes Stock
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $nbr_alerts; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards Row 2 -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Consultations Totales
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_consultations; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-stethoscope fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Consultations Aujourd'hui
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $consultations_today; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Ordonnances
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_ordonnances; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-prescription fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-purple shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-purple text-uppercase mb-1">
                                Valeur Stock (DH)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($stock_value, 2); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-coins fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Stock Alerts -->
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-exclamation-triangle"></i> Alertes de Stock
                    </h6>
                    <a href="../Produit/produit-list.php" class="btn btn-sm btn-primary">
                        Voir tous les produits
                    </a>
                </div>
                <div class="card-body">
                    <?php if ($nbr_alerts > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Stock Actuel</th>
                                        <th>Seuil d'Alerte</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($alert = mysqli_fetch_assoc($stock_alerts)): ?>
                                    <tr>
                                        <td><?php echo $alert['nomproduit']; ?></td>
                                        <td><span class="badge badge-warning"><?php echo $alert['qteenstock']; ?></span></td>
                                        <td><?php echo $alert['seuildalerte']; ?></td>
                                        <td>
                                            <?php if ($alert['qteenstock'] == 0): ?>
                                                <span class="badge badge-danger">Rupture</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Stock Faible</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center text-muted">
                            <i class="fas fa-check-circle fa-3x mb-3"></i>
                            <p>Aucune alerte de stock pour le moment</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Recent Consultations -->
        <div class="col-xl-6 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-calendar-check"></i> Consultations Récentes
                    </h6>
                    <a href="../Consultations/consultations-list.php" class="btn btn-sm btn-primary">
                        Voir toutes
                    </a>
                </div>
                <div class="card-body">
                    <?php if (mysqli_num_rows($recent_consultations) > 0): ?>
                        <div class="list-group">
                            <?php while ($consult = mysqli_fetch_assoc($recent_consultations)): ?>
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1"><?php echo $consult['nom'] . ' ' . $consult['prenom']; ?></h6>
                                    <small><?php echo date('d/m/Y', strtotime($consult['dateconsultation'])); ?></small>
                                </div>
                                <p class="mb-1"><?php echo $consult['motif']; ?></p>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center text-muted">
                            <i class="fas fa-calendar-times fa-3x mb-3"></i>
                            <p>Aucune consultation récente</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}
.border-left-secondary {
    border-left: 0.25rem solid #858796 !important;
}
.border-left-dark {
    border-left: 0.25rem solid #5a5c69 !important;
}
.border-left-danger {
    border-left: 0.25rem solid #e74a3b !important;
}
.border-left-purple {
    border-left: 0.25rem solid #6f42c1 !important;
}

.badge-danger {
    background-color: #e74a3b;
    color: white;
    padding: 0.5em 0.75em;
    border-radius: 0.375rem;
}
.badge-warning {
    background-color: #f6c23e;
    color: #212529;
    padding: 0.5em 0.75em;
    border-radius: 0.375rem;
}

.text-purple {
    color: #6f42c1 !important;
}
</style>

<?php
mysqli_close($con);
require("../footer.php");
?>
