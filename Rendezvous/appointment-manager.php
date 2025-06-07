<?php
session_start();
if(!isset($_SESSION['v_session']) || $_SESSION['v_session'] != 1) {
    header('Location: ../index-main.php');
    exit();
}

include('../connexion.php');

// Get today's appointments for display
$today = date('Y-m-d');

// Get detailed appointments for today
$query_today_details = "SELECT r.idrendezvous, r.daterendezvous, r.heurerendezvous, r.notes, r.niveaudecredibilite,
                               c.nom as client_nom, c.prenom as client_prenom, c.telephone as client_tel,
                               cab.nomcabinet
                        FROM rendezvous r, client c, cabinet cab
                        WHERE r.idclient = c.idl 
                        AND r.idcabinet = cab.idcabinet
                        AND DATE(r.daterendezvous) = '$today'
                        ORDER BY r.heurerendezvous";

$result_today_details = mysqli_query($con, $query_today_details);
$nbr_rdv_today = mysqli_num_rows($result_today_details);

// Statistics queries
$query_week = "SELECT COUNT(*) as nb FROM rendezvous WHERE WEEK(daterendezvous) = WEEK(NOW())";
$result_week = mysqli_query($con, $query_week);
$rdv_week_data = mysqli_fetch_assoc($result_week);
$rdv_week = $rdv_week_data['nb'];

$query_month = "SELECT COUNT(*) as nb FROM rendezvous WHERE MONTH(daterendezvous) = MONTH(NOW())";
$result_month = mysqli_query($con, $query_month);
$rdv_month_data = mysqli_fetch_assoc($result_month);
$rdv_month = $rdv_month_data['nb'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Rendez-vous - OptiRent</title>
    <style>
        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        .stats-card:hover {
            transform: translateY(-2px);
        }
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
        }
        .table th {
            border-top: none;
        }
        .badge {
            font-size: 0.75em;
        }
    </style>
</head>
<body class="bg-light">
    <?php include('../head.php'); ?>

    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-calendar-alt me-3"></i>Gestionnaire de Rendez-vous</h1>
            <p class="mb-0">Planifiez et gérez efficacement vos rendez-vous</p>
        </div>
    </div>

    <div class="container">
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-calendar-day fa-2x text-primary mb-2"></i>
                    <h4 class="text-primary"><?php echo $nbr_rdv_today; ?></h4>
                    <small class="text-muted">Aujourd'hui</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-calendar-week fa-2x text-success mb-2"></i>
                    <h4 class="text-success"><?php echo $rdv_week; ?></h4>
                    <small class="text-muted">Cette semaine</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-calendar fa-2x text-info mb-2"></i>
                    <h4 class="text-info"><?php echo $rdv_month; ?></h4>
                    <small class="text-muted">Ce mois</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                    <h4 class="text-warning" id="current-time"></h4>
                    <small class="text-muted">Heure actuelle</small>
                </div>
            </div>
        </div>

        <!-- Today's Appointments Table -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-calendar-day me-2"></i>
                            Rendez-vous d'Aujourd'hui - <?php echo date('d/m/Y'); ?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php if ($nbr_rdv_today > 0): ?>
                            <div class="mb-3">
                                <a href="../Rendezvous/rendezvous-form-add.php" class='btn btn-success' data-bs-toggle='tooltip' title='Ajouter un rendez-vous'>
                                    <i class='fa-solid fa-plus'></i> Nouveau Rendez-vous
                                </a>
                                <a href="../Rendezvous/rendezvous-list.php" class='btn btn-outline-primary ms-2' data-bs-toggle='tooltip' title='Voir tous les rendez-vous'>
                                    <i class="fa-solid fa-list"></i> Tous les Rendez-vous
                                </a>
                            </div>
                            
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Heure</th>
                                        <th>Client</th>
                                        <th>Cabinet</th>
                                        <th>Téléphone</th>
                                        <th>Notes</th>
                                        <th>Niveau</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($data = mysqli_fetch_assoc($result_today_details)) {
                                    $id = $data['idrendezvous'];
                                    echo "<tr>";
                                    echo "<td><strong><i class='fas fa-clock text-primary me-1'></i>" . date('H:i', strtotime($data['heurerendezvous'])) . "</strong></td>";
                                    echo "<td><i class='fas fa-user text-info me-1'></i>" . $data['client_nom'] . " " . $data['client_prenom'] . "</td>";
                                    echo "<td><i class='fas fa-building text-success me-1'></i>" . $data['nomcabinet'] . "</td>";
                                    echo "<td><i class='fas fa-phone text-warning me-1'></i>" . ($data['client_tel'] ? $data['client_tel'] : 'Non renseigné') . "</td>";
                                    echo "<td>" . ($data['notes'] ? $data['notes'] : '<em class="text-muted">Aucune note</em>') . "</td>";
                                    echo "<td>";
                                    if ($data['niveaudecredibilite']) {
                                        $niveau = $data['niveaudecredibilite'];
                                        if ($niveau >= 8) {
                                            echo "<span class='badge bg-success'>$niveau/10</span>";
                                        } elseif ($niveau >= 5) {
                                            echo "<span class='badge bg-warning'>$niveau/10</span>";
                                        } else {
                                            echo "<span class='badge bg-danger'>$niveau/10</span>";
                                        }
                                    } else {
                                        echo "<span class='badge bg-secondary'>N/A</span>";
                                    }
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<a href='../Rendezvous/rendezvous-form-update.php?id=" . urlencode($id) . "' class='btn btn-sm btn-outline-primary me-1' data-bs-toggle='tooltip' title='Modifier'>";
                                    echo "<i class='fa-solid fa-pencil'></i>";
                                    echo "</a>";
                                    echo "<a href='../Rendezvous/rendezvous-form-delete.php?id=" . urlencode($id) . "' class='btn btn-sm btn-outline-danger' data-bs-toggle='tooltip' title='Supprimer'>";
                                    echo "<i class='fa-solid fa-trash-can'></i>";
                                    echo "</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                                <h4 class="text-muted">Aucun rendez-vous aujourd'hui</h4>
                                <p class="text-muted">Vous n'avez aucun rendez-vous prévu pour aujourd'hui.</p>
                                <a href="../Rendezvous/rendezvous-form-add.php" class='btn btn-success btn-lg'>
                                    <i class='fa-solid fa-plus me-2'></i> Planifier un Rendez-vous
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Update current time in stats
        function updateCurrentTime() {
            const now = new Date();
            document.getElementById('current-time').textContent = now.toLocaleTimeString('fr-FR');
        }
        setInterval(updateCurrentTime, 1000);
        updateCurrentTime();
        
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>
