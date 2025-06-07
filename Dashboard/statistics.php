<?php
session_start();
if(!isset($_SESSION['v_session']) || $_SESSION['v_session'] != 1) {
    header('Location: ../index-main.php');
    exit();
}

require("../connexion.php");

// Statistiques pour les graphiques
$stats = array();

// Consultations par mois (6 derniers mois)
$query = "SELECT MONTH(dateconsultation) as mois, COUNT(*) as total 
          FROM consultations 
          WHERE dateconsultation >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
          GROUP BY MONTH(dateconsultation)
          ORDER BY mois";
$result = mysqli_query($con, $query);
$consultations_mensuelle = array();
while($row = mysqli_fetch_assoc($result)) {
    $mois_nom = array('', 'Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc');
    $consultations_mensuelle[] = array(
        'mois' => $mois_nom[$row['mois']],
        'total' => $row['total']
    );
}

// Produits les plus vendus
$query = "SELECT p.nomproduit, SUM(vd.quantite) as total_vendu 
          FROM produit p 
          JOIN vente_details vd ON p.idproduit = vd.idproduit 
          GROUP BY p.idproduit 
          ORDER BY total_vendu DESC 
          LIMIT 5";
$result = mysqli_query($con, $query);
$produits_vendus = array();
while($row = mysqli_fetch_assoc($result)) {
    $produits_vendus[] = $row;
}

// Répartition des patients par âge
$query = "SELECT 
            CASE 
                WHEN TIMESTAMPDIFF(YEAR, datenaissance, CURDATE()) < 18 THEN 'Moins de 18'
                WHEN TIMESTAMPDIFF(YEAR, datenaissance, CURDATE()) BETWEEN 18 AND 35 THEN '18-35 ans'
                WHEN TIMESTAMPDIFF(YEAR, datenaissance, CURDATE()) BETWEEN 36 AND 55 THEN '36-55 ans'
                ELSE 'Plus de 55'
            END as tranche_age,
            COUNT(*) as nombre
          FROM patients 
          WHERE datenaissance IS NOT NULL
          GROUP BY tranche_age";
$result = mysqli_query($con, $query);
$repartition_age = array();
while($row = mysqli_fetch_assoc($result)) {
    $repartition_age[] = $row;
}

// Stock critique
$query = "SELECT COUNT(*) as nb_critique FROM produit WHERE qteenstock <= seuildalerte";
$result = mysqli_query($con, $query);
$stock_critique_data = mysqli_fetch_assoc($result);
$stock_critique = $stock_critique_data['nb_critique'];

// Chiffre d'affaires mensuel
$query = "SELECT MONTH(datevente) as mois, SUM(montanttotal) as ca 
          FROM ventes 
          WHERE datevente >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
          GROUP BY MONTH(datevente)
          ORDER BY mois";
$result = mysqli_query($con, $query);
$ca_mensuel = array();
while($row = mysqli_fetch_assoc($result)) {
    $mois_nom = array('', 'Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc');
    $ca_mensuel[] = array(
        'mois' => $mois_nom[$row['mois']],
        'ca' => $row['ca']
    );
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - OptiRent</title>
    <!-- Remove Bootstrap/jQuery - use only from head.php -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .analytics-card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            transition: transform 0.2s;
        }
        .analytics-card:hover {
            transform: translateY(-2px);
        }
        .chart-container {
            position: relative;
            height: 300px;
            margin: 20px 0;
        }
        .stat-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
        }
    </style>
</head>
<body class="bg-light">
    <?php include('../head.php'); ?>

    <!-- Add proper spacing after navbar -->
    <div style="margin-top: 70px;">
        <div class="page-header">
            <div class="container">
                <h1><i class="fas fa-chart-line me-3"></i>Analytics & Statistiques</h1>
                <p class="mb-0">Analyse détaillée des performances de votre cabinet</p>
            </div>
        </div>

        <div class="container">
            <!-- Indicateurs clés -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card analytics-card text-center p-3">
                        <i class="fas fa-users stat-icon text-primary"></i>
                        <h4><?php 
                            $query = "SELECT COUNT(*) as total FROM patients";
                            $result = mysqli_query($con, $query);
                            $total_data = mysqli_fetch_assoc($result);
                            echo $total_data['total'];
                        ?></h4>
                        <p class="text-muted mb-0">Patients Total</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card analytics-card text-center p-3">
                        <i class="fas fa-calendar stat-icon text-success"></i>
                        <h4><?php 
                            $query = "SELECT COUNT(*) as total FROM consultations WHERE MONTH(dateconsultation) = MONTH(NOW())";
                            $result = mysqli_query($con, $query);
                            $total_data = mysqli_fetch_assoc($result);
                            echo $total_data['total'];
                        ?></h4>
                        <p class="text-muted mb-0">Consultations ce mois</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card analytics-card text-center p-3">
                        <i class="fas fa-exclamation-triangle stat-icon text-warning"></i>
                        <h4><?php echo $stock_critique; ?></h4>
                        <p class="text-muted mb-0">Produits en rupture</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card analytics-card text-center p-3">
                        <i class="fas fa-euro-sign stat-icon text-info"></i>
                        <h4><?php 
                            $query = "SELECT SUM(montanttotal) as total FROM ventes WHERE MONTH(datevente) = MONTH(NOW())";
                            $result = mysqli_query($con, $query);
                            $ca_data = mysqli_fetch_assoc($result);
                            $ca = $ca_data['total'];
                            echo number_format($ca ? $ca : 0, 0, ',', ' ');
                        ?>€</h4>
                        <p class="text-muted mb-0">CA ce mois</p>
                    </div>
                </div>
            </div>

            <!-- Graphiques -->
            <div class="row">
                <!-- Consultations mensuelles -->
                <div class="col-md-6">
                    <div class="card analytics-card p-4">
                        <h5><i class="fas fa-chart-line me-2"></i>Consultations par mois</h5>
                        <div class="chart-container">
                            <canvas id="consultationsChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Chiffre d'affaires -->
                <div class="col-md-6">
                    <div class="card analytics-card p-4">
                        <h5><i class="fas fa-chart-bar me-2"></i>Chiffre d'affaires mensuel</h5>
                        <div class="chart-container">
                            <canvas id="caChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Répartition par âge -->
                <div class="col-md-6">
                    <div class="card analytics-card p-4">
                        <h5><i class="fas fa-chart-pie me-2"></i>Répartition des patients par âge</h5>
                        <div class="chart-container">
                            <canvas id="ageChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Produits les plus vendus -->
                <div class="col-md-6">
                    <div class="card analytics-card p-4">
                        <h5><i class="fas fa-trophy me-2"></i>Top 5 des produits</h5>
                        <div class="chart-container">
                            <canvas id="produitsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="row mt-4 mb-5">
                <div class="col-12">
                    <div class="card analytics-card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-tools me-2"></i>Actions rapides</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="../Dashboard/dashboard.php" class="btn btn-outline-primary w-100 mb-2">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="../Stock/inventory-manager.php" class="btn btn-outline-warning w-100 mb-2">
                                        <i class="fas fa-boxes me-2"></i>Gérer le stock
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="../Patients/patient-finder.php" class="btn btn-outline-info w-100 mb-2">
                                        <i class="fas fa-search me-2"></i>Rechercher patient
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="../Consultations/consultation-history.php" class="btn btn-outline-success w-100 mb-2">
                                        <i class="fas fa-history me-2"></i>Historique
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Configuration des graphiques
        Chart.defaults.color = '#666';
        Chart.defaults.font.family = 'Arial, sans-serif';

        // Graphique des consultations
        var consultationsData = <?php echo json_encode($consultations_mensuelle); ?>;
        var consultationsCtx = document.getElementById('consultationsChart').getContext('2d');
        new Chart(consultationsCtx, {
            type: 'line',
            data: {
                labels: consultationsData.map(function(item) { return item.mois; }),
                datasets: [{
                    label: 'Consultations',
                    data: consultationsData.map(function(item) { return item.total; }),
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Graphique du CA
        var caData = <?php echo json_encode($ca_mensuel); ?>;
        var caCtx = document.getElementById('caChart').getContext('2d');
        new Chart(caCtx, {
            type: 'bar',
            data: {
                labels: caData.map(function(item) { return item.mois; }),
                datasets: [{
                    label: 'Chiffre d\'affaires (€)',
                    data: caData.map(function(item) { return item.ca; }),
                    backgroundColor: '#1cc88a',
                    borderColor: '#1cc88a',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Graphique répartition par âge
        var ageData = <?php echo json_encode($repartition_age); ?>;
        var ageCtx = document.getElementById('ageChart').getContext('2d');
        new Chart(ageCtx, {
            type: 'doughnut',
            data: {
                labels: ageData.map(function(item) { return item.tranche_age; }),
                datasets: [{
                    data: ageData.map(function(item) { return item.nombre; }),
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Graphique produits les plus vendus
        var produitsData = <?php echo json_encode($produits_vendus); ?>;
        var produitsCtx = document.getElementById('produitsChart').getContext('2d');
        new Chart(produitsCtx, {
            type: 'horizontalBar',
            data: {
                labels: produitsData.map(function(item) { 
                    return item.nomproduit.length > 20 ? item.nomproduit.substring(0, 20) + '...' : item.nomproduit;
                }),
                datasets: [{
                    label: 'Quantité vendue',
                    data: produitsData.map(function(item) { return item.total_vendu; }),
                    backgroundColor: '#e74a3b',
                    borderColor: '#e74a3b',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    <!-- Remove this line - Bootstrap is already loaded in head.php -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>
