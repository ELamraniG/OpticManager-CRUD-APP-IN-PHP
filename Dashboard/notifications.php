<?php
session_start();
if(!isset($_SESSION['v_session']) || $_SESSION['v_session'] != 1) {
    header('Location: ../index-main.php');
    exit();
}

require("../connexion.php");

// Récupérer les notifications
$notifications = array();

// 1. Stock critique
$query = "SELECT nomproduit, qteenstock, seuildalerte FROM produit WHERE qteenstock <= seuildalerte ORDER BY qteenstock ASC LIMIT 10";
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_assoc($result)) {
    $notifications[] = array(
        'type' => 'stock',
        'priority' => 'high',
        'icon' => 'fas fa-exclamation-triangle',
        'title' => 'Stock critique',
        'message' => $row['nomproduit'] . ' (Stock: ' . $row['qteenstock'] . ')',
        'action' => '../Stock/inventory-manager.php',
        'action_text' => 'Gérer le stock',
        'date' => date('Y-m-d H:i:s')
    );
}

// 2. Rendez-vous du jour
$query = "SELECT COUNT(*) as nb_rdv FROM rendezvous WHERE DATE(daterendezvous) = CURDATE()";
$result = mysqli_query($con, $query);
$nb_rdv_row = mysqli_fetch_assoc($result);
$nb_rdv = $nb_rdv_row['nb_rdv'];
if($nb_rdv > 0) {
    $notifications[] = array(
        'type' => 'rdv',
        'priority' => 'medium',
        'icon' => 'fas fa-calendar-check',
        'title' => 'Rendez-vous aujourd\'hui',
        'message' => $nb_rdv . ' rendez-vous programmé(s) pour aujourd\'hui',
        'action' => '../Rendezvous/rendezvous-list.php',
        'action_text' => 'Voir les RDV',
        'date' => date('Y-m-d H:i:s')
    );
}

// 3. Consultations récentes sans ordonnance
$query = "SELECT COUNT(*) as nb FROM consultations WHERE prescriptionpdf IS NULL AND dateconsultation >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
$result = mysqli_query($con, $query);
$nb_sans_ord_row = mysqli_fetch_assoc($result);
$nb_sans_ord = $nb_sans_ord_row['nb'];
if($nb_sans_ord > 0) {
    $notifications[] = array(
        'type' => 'ordonnance',
        'priority' => 'medium',
        'icon' => 'fas fa-prescription',
        'title' => 'Ordonnances manquantes',
        'message' => $nb_sans_ord . ' consultation(s) récente(s) sans ordonnance',
        'action' => '../Ordonnances/ordonnances-form-add.php',
        'action_text' => 'Créer ordonnance',
        'date' => date('Y-m-d H:i:s')
    );
}

// 4. Nouveaux patients cette semaine
$query = "SELECT COUNT(*) as nb FROM patients WHERE datecreation >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
$result = mysqli_query($con, $query);
$nouveaux_patients_row = mysqli_fetch_assoc($result);
$nouveaux_patients = $nouveaux_patients_row['nb'];
if($nouveaux_patients > 0) {
    $notifications[] = array(
        'type' => 'patient',
        'priority' => 'low',
        'icon' => 'fas fa-user-plus',
        'title' => 'Nouveaux patients',
        'message' => $nouveaux_patients . ' nouveau(x) patient(s) cette semaine',
        'action' => '../Patients/patients-list.php',
        'action_text' => 'Voir les patients',
        'date' => date('Y-m-d H:i:s')
    );
}

// 5. Ventes importantes du jour (si la table existe)
$query = "SELECT SUM(montanttotal) as total_jour FROM ventes WHERE DATE(datevente) = CURDATE()";
$result = mysqli_query($con, $query);
if($result) {
    $ventes_jour_row = mysqli_fetch_assoc($result);
    $ventes_jour = $ventes_jour_row['total_jour'];
    if($ventes_jour > 500) {
        $notifications[] = array(
            'type' => 'vente',
            'priority' => 'low',
            'icon' => 'fas fa-euro-sign',
            'title' => 'Excellentes ventes',
            'message' => 'Chiffre d\'affaires du jour: ' . number_format($ventes_jour, 2) . '€',
            'action' => '../Ventes/ventes-list.php',
            'action_text' => 'Voir les ventes',
            'date' => date('Y-m-d H:i:s')
        );
    }
}

// Fonction pour trier par priorité (compatible avec PHP ancien)
function sortByPriority($a, $b) {
    $priority_order = array('high' => 1, 'medium' => 2, 'low' => 3);
    return $priority_order[$a['priority']] - $priority_order[$b['priority']];
}
usort($notifications, 'sortByPriority');

// Fonctions pour compter les notifications par priorité
function countNotificationsByPriority($notifications, $priority) {
    $count = 0;
    foreach($notifications as $notification) {
        if($notification['priority'] == $priority) {
            $count++;
        }
    }
    return $count;
}

$high_count = countNotificationsByPriority($notifications, 'high');
$medium_count = countNotificationsByPriority($notifications, 'medium');
$low_count = countNotificationsByPriority($notifications, 'low');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centre de Notifications - OptiRent</title>
    
    <!-- Use same versions as head.php -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- jQuery for dropdown functionality -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    
    <style>
        .notification-card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            transition: all 0.3s ease;
            margin-bottom: 15px;
        }
        .notification-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }
        .priority-high {
            border-left: 4px solid #e74c3c;
        }
        .priority-medium {
            border-left: 4px solid #f39c12;
        }
        .priority-low {
            border-left: 4px solid #3498db;
        }
        .notification-icon {
            font-size: 2rem;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 20px;
        }
        .icon-high {
            background: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
        }
        .icon-medium {
            background: rgba(243, 156, 18, 0.1);
            color: #f39c12;
        }
        .icon-low {
            background: rgba(52, 152, 219, 0.1);
            color: #3498db;
        }
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
        }
        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .btn-action {
            border-radius: 20px;
            padding: 8px 20px;
            font-size: 0.9rem;
        }
        .no-notifications {
            text-align: center;
            padding: 50px;
            color: #6c757d;
        }
        .notification-time {
            font-size: 0.8rem;
            color: #6c757d;
        }
        /* Fix for navbar spacing */
        body {
            padding-top: 0;
        }
    </style>
</head>
<body class="bg-light">
    <?php include('../head.php'); ?>

    <!-- Add proper spacing after navbar -->
    <div style="margin-top: 70px;">
        <div class="page-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1><i class="fas fa-bell me-3"></i>Centre de Notifications</h1>
                        <p class="mb-0">Surveillez les alertes et événements importants de votre cabinet</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <button class="btn btn-light btn-lg" onclick="location.reload()">
                            <i class="fas fa-sync-alt me-2"></i>Actualiser
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- Statistiques rapides -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stats-card">
                        <i class="fas fa-exclamation-circle fa-2x text-danger mb-2"></i>
                        <h4 class="text-danger"><?php echo $high_count; ?></h4>
                        <small class="text-muted">Alertes Critiques</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <i class="fas fa-exclamation-triangle fa-2x text-warning mb-2"></i>
                        <h4 class="text-warning"><?php echo $medium_count; ?></h4>
                        <small class="text-muted">Alertes Moyennes</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <i class="fas fa-info-circle fa-2x text-info mb-2"></i>
                        <h4 class="text-info"><?php echo $low_count; ?></h4>
                        <small class="text-muted">Informations</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <i class="fas fa-bell fa-2x text-primary mb-2"></i>
                        <h4 class="text-primary"><?php echo count($notifications); ?></h4>
                        <small class="text-muted">Total Notifications</small>
                    </div>
                </div>
            </div>

            <!-- Liste des notifications -->
            <div class="row">
                <div class="col-12">
                    <?php if(empty($notifications)): ?>
                        <div class="card notification-card">
                            <div class="card-body no-notifications">
                                <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                                <h4>Aucune notification</h4>
                                <p class="text-muted">Tout semble fonctionner parfaitement !</p>
                                <a href="../home/home.php" class="btn btn-primary btn-action">
                                    <i class="fas fa-tachometer-alt me-2"></i>Retour au Dashboard
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php foreach($notifications as $notification): ?>
                            <div class="card notification-card priority-<?php echo $notification['priority']; ?>">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="notification-icon icon-<?php echo $notification['priority']; ?>">
                                                <i class="<?php echo $notification['icon']; ?>"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h5 class="mb-1"><?php echo htmlspecialchars($notification['title']); ?></h5>
                                                    <p class="mb-1"><?php echo htmlspecialchars($notification['message']); ?></p>
                                                    <small class="notification-time">
                                                        <i class="fas fa-clock me-1"></i>
                                                        Maintenant
                                                    </small>
                                                </div>
                                                <div class="text-end">
                                                    <a href="<?php echo $notification['action']; ?>" 
                                                       class="btn btn-outline-primary btn-action">
                                                        <i class="fas fa-arrow-right me-1"></i>
                                                        <?php echo $notification['action_text']; ?>
                                                    </a>
                                                    <?php if($notification['priority'] == 'high'): ?>
                                                        <div class="mt-2">
                                                            <span class="badge bg-danger">
                                                                <i class="fas fa-exclamation me-1"></i>Urgent
                                                            </span>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="row mt-4 mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-tools me-2"></i>Actions Rapides</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="../home/home.php" class="btn btn-outline-primary w-100 mb-2">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="../Stock/inventory-manager.php" class="btn btn-outline-warning w-100 mb-2">
                                        <i class="fas fa-boxes me-2"></i>Stock
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="../Patients/patient-finder.php" class="btn btn-outline-info w-100 mb-2">
                                        <i class="fas fa-search me-2"></i>Patients
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="../Consultations/consultation-history.php" class="btn btn-outline-success w-100 mb-2">
                                        <i class="fas fa-history me-2"></i>Historique
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="../Dashboard/statistics.php" class="btn btn-outline-secondary w-100 mb-2">
                                        <i class="fas fa-chart-line me-2"></i>Statistics
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="../Ordonnances/ordonnances-form-add.php" class="btn btn-outline-primary w-100 mb-2">
                                        <i class="fas fa-prescription me-2"></i>Ordonnance
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (required for dropdowns) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Auto-refresh toutes les 5 minutes
        setTimeout(function() {
            location.reload();
        }, 300000);

        // Animation d'entrée pour les cartes
        window.onload = function() {
            var cards = document.querySelectorAll('.notification-card');
            for(var i = 0; i < cards.length; i++) {
                cards[i].style.opacity = '0';
                cards[i].style.transform = 'translateY(20px)';
                (function(index) {
                    setTimeout(function() {
                        cards[index].style.transition = 'all 0.3s ease';
                        cards[index].style.opacity = '1';
                        cards[index].style.transform = 'translateY(0)';
                    }, index * 100);
                })(i);
            }
        };
    </script>
</body>
</html>
