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