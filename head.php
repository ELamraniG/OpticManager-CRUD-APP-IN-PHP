<?php
session_start();

$v_session = $_SESSION['v_session'];
if ($v_session != 1) {
    echo "<!-- Bootstrap version 5.3.0 -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css'>";
    echo "<meta charset=utf-8>";
    echo "<div class='alert alert-danger'><i class='fa-solid fa-triangle-exclamation'></i> <b>optique manager</b> : Echec de connexion... | Vous n'avez pas le droit d'accéder à cette page sans authentification...</div>";
    exit();
}

// Include notifications
include_once('get_notifications.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

  
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    
  
    <link rel="icon" type="image/png" sizes="16x16"  href="../images/logo_bg.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
      <title>OPTIRENT</title>

    <link rel="stylesheet" type="text/css" href="../style.css">
      <style>
    /* Notification dropdown styles */
    .notification-dropdown {
        min-width: 350px;
        max-height: 400px;
        overflow-y: auto;
    }
    
    .notification-item {
        transition: background-color 0.2s ease;
        border-left: 3px solid transparent;
    }
    
    .notification-item:hover {
        background-color: #f8f9fa !important;
        border-left-color: #007bff;
    }
    
    .notification-badge {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    /* Responsive adjustments */
    @media (max-width: 576px) {
        .notification-dropdown {
            min-width: 280px;
            max-width: 90vw;
        }
    }
    
    /* Bell icon hover effect */
    #notificationDropdown:hover .fas.fa-bell {
        animation: swing 1s ease-in-out;
    }
    
    @keyframes swing {
        15% { transform: translateX(5px); }
        30% { transform: translateX(-5px); }
        45% { transform: translateX(3px); }
        60% { transform: translateX(-3px); }
        75% { transform: translateX(1px); }
        90% { transform: translateX(-1px); }
        100% { transform: translateX(0px); }
    }
    </style>
</head>

<body>
<?php

$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'admin';
$navbar_color = '#1e293b'; // Modern slate gray for admin

if ($user_role == 'opticien') {
    $navbar_color = '#059669'; // Modern emerald green for opticien
} elseif ($user_role == 'assistant') {
    $navbar_color = '#dc2626'; // Modern red for assistant
}
?>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm navbar-compact" style="background-color: <?php echo $navbar_color; ?>;">
    <div class="container-fluid px-3">        <a class="navbar-brand d-flex align-items-center" href="../home/home.php">
            <img src="../images/logo_bg.png" width="24" height="24" class="me-2 rounded-circle">
            <span class="fw-bold">OpticManager - <?php echo ucfirst($user_role); ?></span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link px-2" href="../home/home.php">
                        <i class='bx bx-grid-alt me-1'></i>Accueil
                    </a>
                </li>
                  <?php if ($user_role == 'admin'): ?>                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <i class='bx bx-collection me-1'></i>Tables
                    </a>
                    <ul class="dropdown-menu shadow border-0">
                        <li><a class="dropdown-item" href="../Categorie/categorie-list.php"><i class="fas fa-tags me-2"></i>Categories</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Fournisseur/fournisseur-list.php"><i class="fas fa-truck me-2"></i>Fournisseur</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Client/client-list.php"><i class="fas fa-user-friends me-2"></i>Client</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Cabinet/cabinet-list.php"><i class="fas fa-building me-2"></i>Cabinet</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Produit/produit-list.php"><i class="fas fa-boxes me-2"></i>Produit</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Commande/commande-list.php"><i class="fas fa-shopping-cart me-2"></i>Commande</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Commandes_Fournisseur/commandes-fournisseur-list.php"><i class="fas fa-clipboard-list me-2"></i>Commandes Fournisseur</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Rendezvous/rendezvous-list.php"><i class="fas fa-calendar-alt me-2"></i>Rendez Vous</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Patients/patients-list.php"><i class="fas fa-users me-2"></i>Patients</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Consultations/consultations-list.php"><i class="fas fa-stethoscope me-2"></i>Consultations</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Ordonnances/ordonnances-list.php"><i class="fas fa-prescription me-2"></i>Ordonnances</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Ventes/ventes-list.php"><i class="fas fa-cash-register me-2"></i>Ventes</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Vente_details/vente_details-list.php"><i class="fas fa-receipt me-2"></i>Détails Ventes</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Utilisateurs/utilisateurs-list.php"><i class="fas fa-user-cog me-2"></i>Utilisateurs</a></li>
                    </ul>
                </li>
                              <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-2" href="#" id="navbarToolsDropdown" role="button" data-bs-toggle="dropdown">
                        <i class='bx bx-wrench me-1'></i>Outils
                    </a>
                    <ul class="dropdown-menu shadow border-0">
                        <li><a class="dropdown-item" href="../Dashboard/dashboard.php"><i class="fas fa-tachometer-alt me-2"></i>Tableau de Bord</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Search/global-search.php"><i class="fas fa-search me-2"></i>Recherche Globale</a></li>
                        <li><hr class="dropdown-divider"></li>                        <li><a class="dropdown-item" href="../Stock/stock-quick-update.php"><i class="fas fa-warehouse me-2"></i>Gestion Stock Rapide</a></li>
                        <li><hr class="dropdown-divider"></li>                        <li><a class="dropdown-item" href="../Stock/inventory-manager.php"><i class="fas fa-clipboard-check me-2"></i>Gestionnaire Inventaire</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Consultations/consultation-history.php"><i class="fas fa-history me-2"></i>Historique Consultations</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Patients/patient-finder.php"><i class="fas fa-search me-2"></i>Recherche Patients</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Rendezvous/appointment-manager.php"><i class="fas fa-calendar-alt me-2"></i>Gestionnaire RDV</a></li>
                        <li><hr class="dropdown-divider"></li>                        <li><a class="dropdown-item" href="../Produit/product-catalog.php"><i class="fas fa-eye me-2"></i>Catalogue Produits</a></li>
                    </ul>
                </li>                  <li class="nav-item">
                    <a class="nav-link px-2" href="../Dashboard/statistics.php">
                        <i class='bx bx-pie-chart-alt-2 me-1'></i>Statistics
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-2" href="#" id="navbarParamsDropdown" role="button" data-bs-toggle="dropdown">
                        <i class='bx bx-cog me-1'></i>Paramètres
                    </a>
                    <ul class="dropdown-menu shadow border-0">
                        <li><a class="dropdown-item" href="../Utilisateurs/utilisateurs-list.php"><i class="fas fa-user-cog me-2"></i>Gestion des Utilisateurs</a></li>
                    </ul>
                </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-2" href="#" id="navbarAideDropdown" role="button" data-bs-toggle="dropdown">
                        <i class='bx bx-help-circle me-1'></i>Aide
                    </a>
                    <ul class="dropdown-menu shadow border-0">
                        <li><a class="dropdown-item" href="../Aide/a-propos.php"><i class="fas fa-info-circle me-2"></i>À propos</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Aide/contacter-support.php"><i class="fas fa-headset me-2"></i>Contacter le support</a></li>
                    </ul>
                </li>
                  <?php elseif ($user_role == 'opticien'): ?>                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <i class='bx bx-collection me-1'></i>Mes Tables
                    </a>
                    <ul class="dropdown-menu shadow border-0">
                        <li><a class="dropdown-item" href="../Client/client-list.php"><i class="fas fa-user-friends me-2"></i>Client</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Patients/patients-list.php"><i class="fas fa-users me-2"></i>Patients</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Consultations/consultations-list.php"><i class="fas fa-stethoscope me-2"></i>Consultations</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Ordonnances/ordonnances-list.php"><i class="fas fa-prescription me-2"></i>Ordonnances</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Ventes/ventes-list.php"><i class="fas fa-cash-register me-2"></i>Ventes</a></li>
                    </ul>
                </li>
                                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-2" href="#" id="navbarToolsDropdown" role="button" data-bs-toggle="dropdown">
                        <i class='bx bx-wrench me-1'></i>Outils
                    </a>
                    <ul class="dropdown-menu shadow border-0">
                        <li><a class="dropdown-item" href="../Search/global-search.php"><i class="fas fa-search me-2"></i>Recherche Globale</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Consultations/consultation-history.php"><i class="fas fa-history me-2"></i>Historique Consultations</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Dashboard/dashboard.php"><i class="fas fa-tachometer-alt me-2"></i>Tableau de Bord</a></li>
                    </ul>
                </li>
                  <?php elseif ($user_role == 'assistant'): ?>
                <li class="nav-item">
                    <a class="nav-link px-2" href="../Rendezvous/rendezvous-list.php">
                        <i class='bx bx-calendar me-1'></i>Rendez-vous
                    </a>
                </li>
                <?php endif; ?>
            </ul>
              <ul class="navbar-nav">               
                <li class="nav-item dropdown me-2">
                    <a class="nav-link px-2 position-relative" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <?php if(!empty($notifications) && $high_priority_count > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger notification-badge" style="font-size: 0.6rem;">
                            <?php echo count($notifications); ?>
                        </span>
                        <?php endif; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 notification-dropdown">
                        <li class="dropdown-header d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-bell me-2"></i>Notifications</span>
                            <span class="badge bg-primary"><?php echo count($notifications); ?></span>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        
                        <?php if(!empty($notifications)): ?>
                            <?php foreach($notifications as $notif): ?>
                            <li>
                                <a class="dropdown-item py-2 notification-item" href="<?php echo $notif['action']; ?>">
                                    <div class="d-flex">
                                        <div class="me-3 pt-1">
                                            <i class="<?php echo $notif['icon']; ?>"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-bold small"><?php echo $notif['title']; ?></div>
                                            <div class="text-muted small"><?php echo $notif['message']; ?></div>
                                            <div class="text-muted" style="font-size: 0.7rem;"><?php echo $notif['time']; ?></div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <?php endforeach; ?>
                            <li class="text-center">
                                <a class="dropdown-item small text-primary" href="../Stock/stock-alerts.php">
                                    <i class="fas fa-eye me-1"></i>Voir toutes les alertes
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="text-center py-3">
                                <i class="fas fa-check-circle text-success fa-2x"></i>
                                <div class="small text-muted mt-2">Aucune notification</div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link px-2" href="#">
                        <i class="fa-solid fa-user me-1"></i><?php echo ucfirst($user_role); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 text-warning" href="../deconnexion.php">
                        <i class="fa-solid fa-sign-out-alt me-1"></i>Déconnexion
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container-fluid">
</body>
</html>