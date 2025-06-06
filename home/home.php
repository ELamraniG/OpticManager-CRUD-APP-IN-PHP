<?php
    require("../head.php");
    require("../connexion.php");

    // Get some basic stats for display
    $total_patients = mysqli_num_rows(mysqli_query($con, "SELECT * FROM patients"));
    $total_produits = mysqli_num_rows(mysqli_query($con, "SELECT * FROM produit"));
    $alerts_stock = mysqli_num_rows(mysqli_query($con, "SELECT * FROM produit WHERE qteenstock <= seuildalerte"));
    $consultations_today = mysqli_num_rows(mysqli_query($con, "SELECT * FROM consultations WHERE DATE(dateconsultation) = CURDATE()"));
?>

<div class="container-fluid" style="margin-top: 50px;">
    <!-- Welcome Section -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center">
                        <div class="mb-4">
                            <img src="../images/logo_bg.png" alt="OpticManager Logo" class="img-fluid rounded-circle shadow-sm" style="max-height: 150px; width: auto;">
                        </div>
                        <h1 class="display-4 font-weight-bold text-primary mb-3">
                            Bienvenue à OpticManager
                        </h1>
                        <p class="lead text-muted mb-4">
                            Votre solution complète de gestion optique
                        </p>
                        
                        <!-- Quick Stats -->
                        <div class="row text-center mb-4">
                            <div class="col-3">
                                <div class="p-3">
                                    <i class="fas fa-users fa-2x text-primary mb-2"></i>
                                    <h4 class="font-weight-bold"><?php echo $total_patients; ?></h4>
                                    <small class="text-muted">Patients</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="p-3">
                                    <i class="fas fa-boxes fa-2x text-success mb-2"></i>
                                    <h4 class="font-weight-bold"><?php echo $total_produits; ?></h4>
                                    <small class="text-muted">Produits</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="p-3">
                                    <i class="fas fa-calendar-day fa-2x text-info mb-2"></i>
                                    <h4 class="font-weight-bold"><?php echo $consultations_today; ?></h4>
                                    <small class="text-muted">Consultations Aujourd'hui</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="p-3">
                                    <i class="fas fa-exclamation-triangle fa-2x text-warning mb-2"></i>
                                    <h4 class="font-weight-bold"><?php echo $alerts_stock; ?></h4>
                                    <small class="text-muted">Alertes Stock</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h2 class="text-center mb-4">Actions Rapides</h2>
            <div class="row">
                <!-- Patient Management -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow border-0 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-user-plus fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Gestion Patients</h5>
                            <p class="card-text">Ajouter ou gérer les patients</p>
                            <div class="btn-group-vertical w-100">
                                <a href="../Patients/patients-form-add.php" class="btn btn-primary btn-sm mb-2">
                                    <i class="fas fa-plus"></i> Nouveau Patient
                                </a>
                                <a href="../Patients/patients-list.php" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-list"></i> Liste Patients
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Consultations -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow border-0 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-stethoscope fa-3x text-success mb-3"></i>
                            <h5 class="card-title">Consultations</h5>
                            <p class="card-text">Gérer les consultations</p>
                            <div class="btn-group-vertical w-100">
                                <a href="../Consultations/consultations-form-add.php" class="btn btn-success btn-sm mb-2">
                                    <i class="fas fa-plus"></i> Nouvelle Consultation
                                </a>
                                <a href="../Consultations/consultations-list.php" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-list"></i> Liste Consultations
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products/Stock -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow border-0 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-boxes fa-3x text-info mb-3"></i>
                            <h5 class="card-title">Stock & Produits</h5>
                            <p class="card-text">Gérer l'inventaire</p>
                            <div class="btn-group-vertical w-100">
                                <a href="../Produit/produit-form-add.php" class="btn btn-info btn-sm mb-2">
                                    <i class="fas fa-plus"></i> Nouveau Produit
                                </a>
                                <a href="../Produit/produit-list.php" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-list"></i> Gestion Stock
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search & Reports -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow border-0 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-search fa-3x text-warning mb-3"></i>
                            <h5 class="card-title">Recherche & Rapports</h5>
                            <p class="card-text">Trouver des informations</p>
                            <div class="btn-group-vertical w-100">
                                <a href="../Search/global-search.php" class="btn btn-warning btn-sm mb-2">
                                    <i class="fas fa-search"></i> Recherche Globale
                                </a>
                                <a href="../Dashboard/dashboard.php" class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-chart-bar"></i> Tableau de Bord
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Actions Row -->
            <div class="row mt-4">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow border-0 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-prescription fa-3x text-danger mb-3"></i>
                            <h5 class="card-title">Ordonnances</h5>
                            <div class="btn-group-vertical w-100">
                                <a href="../Ordonnances/ordonnances-form-add.php" class="btn btn-danger btn-sm mb-2">
                                    <i class="fas fa-plus"></i> Nouvelle Ordonnance
                                </a>
                                <a href="../Ordonnances/ordonnances-list.php" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-list"></i> Liste Ordonnances
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow border-0 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-truck fa-3x text-secondary mb-3"></i>
                            <h5 class="card-title">Fournisseurs</h5>
                            <div class="btn-group-vertical w-100">
                                <a href="../Fournisseur/fournisseur-form-add.php" class="btn btn-secondary btn-sm mb-2">
                                    <i class="fas fa-plus"></i> Nouveau Fournisseur
                                </a>
                                <a href="../Fournisseur/fournisseur-list.php" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-list"></i> Liste Fournisseurs
                                </a>
                            </div>
                        </div>
                    </div>
                </div>                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow border-0 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-alt fa-3x text-dark mb-3"></i>
                            <h5 class="card-title">Rendez-vous</h5>
                            <div class="btn-group-vertical w-100">
                                <a href="../Rendezvous/rendezvous-form-add.php" class="btn btn-dark btn-sm mb-2">
                                    <i class="fas fa-plus"></i> Nouveau RDV
                                </a>
                                <a href="../Rendezvous/appointment-manager.php" class="btn btn-primary btn-sm mb-2">
                                    <i class="fas fa-calendar-check"></i> Gestionnaire RDV
                                </a>
                                <a href="../Rendezvous/rendezvous-list.php" class="btn btn-outline-dark btn-sm">
                                    <i class="fas fa-list"></i> Planning
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Nouveaux outils -->
            <div class="row mt-4">
                <div class="col-12">
                    <h3 class="text-center mb-4 text-primary">Outils Avancés</h3>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow border-0 h-100 border-primary">
                        <div class="card-body text-center">
                            <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Analytics Avancé</h5>
                            <p class="card-text">Graphiques et analyses détaillées</p>
                            <a href="../Dashboard/analytics.php" class="btn btn-primary">
                                <i class="fas fa-chart-bar me-2"></i>Voir Analytics
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow border-0 h-100 border-warning">
                        <div class="card-body text-center">
                            <i class="fas fa-bell fa-3x text-warning mb-3"></i>
                            <h5 class="card-title">Centre de Notifications</h5>
                            <p class="card-text">Alertes et notifications importantes</p>
                            <a href="../Dashboard/notifications.php" class="btn btn-warning">
                                <i class="fas fa-bell me-2"></i>Voir Notifications
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow border-0 h-100 border-success">
                        <div class="card-body text-center">
                            <i class="fas fa-search fa-3x text-success mb-3"></i>
                            <h5 class="card-title">Recherche Patients</h5>
                            <p class="card-text">Recherche avancée avec filtres</p>
                            <a href="../Patients/patient-finder.php" class="btn btn-success">
                                <i class="fas fa-search me-2"></i>Rechercher
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow border-0 h-100 border-info">
                        <div class="card-body text-center">
                            <i class="fas fa-eye fa-3x text-info mb-3"></i>
                            <h5 class="card-title">Catalogue Produits</h5>
                            <p class="card-text">Explorer les produits avec filtres</p>
                            <a href="../Produit/product-catalog.php" class="btn btn-info">
                                <i class="fas fa-boxes me-2"></i>Catalogue
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Info -->
    <div class="row justify-content-center mt-5">
        <div class="col-lg-8">
            <div class="text-center border-top pt-4">
                <small class="text-muted font-italic">
                    Développé par ELAMRANI MOHAMMED | OpticManager v1.0
                </small>
            </div>
        </div>
    </div>
</div>