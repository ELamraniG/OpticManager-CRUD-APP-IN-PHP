<?php
session_start();
if(!isset($_SESSION['v_session']) || $_SESSION['v_session'] != 1) {
    header('Location: ../index-main.php');
    exit();
}

include("../connexion.php");

$stats = array();

$query = "SELECT DATE(dateconsultation) as jour, COUNT(*) as total 
          FROM consultations 
          WHERE dateconsultation >= DATE_SUB(NOW(), INTERVAL 30 DAY)
          GROUP BY DATE(dateconsultation)
          ORDER BY jour";
$result = mysqli_query($con, $query);
$consultations_journaliere = array();
while($row = mysqli_fetch_assoc($result)) {
    $consultations_journaliere[] = array(
        'jour' => date('d/m', strtotime($row['jour'])),
        'total' => $row['total']
    );
}



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

$query = "SELECT COUNT(*) as nb_critique FROM produit WHERE qteenstock <= seuildalerte";
$result = mysqli_query($con, $query);
$stock_critique_data = mysqli_fetch_assoc($result);
$stock_critique = $stock_critique_data['nb_critique'];

$query = "SELECT DATE(datevente) as jour, SUM(montanttotal) as ca 
          FROM ventes 
          WHERE datevente >= DATE_SUB(NOW(), INTERVAL 30 DAY)
          GROUP BY DATE(datevente)
          ORDER BY jour";
$result = mysqli_query($con, $query);
$ca_journalier = array();
while($row = mysqli_fetch_assoc($result)) {
    $ca_journalier[] = array(
        'jour' => date('d/m', strtotime($row['jour'])),
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

    <div style="margin-top: 70px;">
        <div class="page-header">
            <div class="container">
                <h1><i class="fas fa-chart-line me-3"></i>Analytics & Statistiques</h1>
                <p class="mb-0">Analyse détaillée des performances de votre cabinet</p>
            </div>
        </div>

        <div class="container">

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
                </div>                <div class="col-md-3">
                    <div class="card analytics-card text-center p-3">
                        <i class="fas fa-calendar stat-icon text-success"></i>
                        <h4><?php 
                            $query = "SELECT COUNT(*) as total FROM consultations WHERE DATE(dateconsultation) = CURDATE()";
                            $result = mysqli_query($con, $query);
                            $total_data = mysqli_fetch_assoc($result);
                            echo $total_data['total'];
                        ?></h4>
                        <p class="text-muted mb-0">Consultations aujourd'hui</p>
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
                        <i class="fas fa-euro-sign stat-icon text-info"></i>                        <h4><?php 
                            $query = "SELECT SUM(montanttotal) as total FROM ventes WHERE DATE(datevente) = CURDATE()";
                            $result = mysqli_query($con, $query);
                            $ca_data = mysqli_fetch_assoc($result);
                            $ca = $ca_data['total'];
                            echo number_format($ca ? $ca : 0, 0, ',', ' ');
                        ?>€</h4>
                        <p class="text-muted mb-0">CA aujourd'hui</p>
                    </div>
                </div>
            </div>

    
            <div class="row">                <div class="col-md-6">
                    <div class="card analytics-card p-4">
                        <h5><i class="fas fa-chart-line me-2"></i>Consultations par jour (30 derniers jours)</h5>
                        <div class="chart-container">
                            <canvas id="consultationsChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card analytics-card p-4">
                        <h5><i class="fas fa-chart-bar me-2"></i>Chiffre d'affaires journalier (30 derniers jours)</h5>
                        <div class="chart-container">
                            <canvas id="caChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card analytics-card p-4">
                        <h5><i class="fas fa-chart-pie me-2"></i>Répartition des patients par âge</h5>
                        <div class="chart-container">
                            <canvas id="ageChart"></canvas>
                        </div>
                    </div>
                </div>            </div>
        </div>
    </div>

    <script>
       
        Chart.defaults.color = '#666';
        Chart.defaults.font.family = 'Arial, sans-serif';       
        var consultationsData = <?php echo json_encode($consultations_journaliere); ?>;
        var consultationsCtx = document.getElementById('consultationsChart').getContext('2d');
        new Chart(consultationsCtx, {
            type: 'line',
            data: {
                labels: consultationsData.map(function(item) { return item.jour; }),
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

       
        var caData = <?php echo json_encode($ca_journalier); ?>;
        var caCtx = document.getElementById('caChart').getContext('2d');
        new Chart(caCtx, {
            type: 'bar',
            data: {
                labels: caData.map(function(item) { return item.jour; }),
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
            }        });
    </script>


</body>
</html>
