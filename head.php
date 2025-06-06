<?php
session_start();
/* Vérifier si cette page est authentifié */
$v_session = $_SESSION['v_session'];
if ($v_session != 1) {
    echo "<!-- Bootstrap version 5.3.0 -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css'>";
    echo "<meta charset=utf-8>";
    echo "<div class='alert alert-danger'><i class='fa-solid fa-triangle-exclamation'></i> <b>LaPduP</b> : Echec de connexion... | Vous n'avez pas le droit d'accéder à cette page sans authentification...</div>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <!-- Taille d'écran -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16"  href="../images/logo_bg.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    
    <title>OPTIRENT</title>
    <!--Mon style -->
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
<?php
// Get user role for navigation
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'admin';
$navbar_color = '#004080'; // Default admin color

if ($user_role == 'opticien') {
    $navbar_color = '#008000';
} elseif ($user_role == 'assistant') {
    $navbar_color = '#ff6600';
}
?>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm" style="background-color: <?php echo $navbar_color; ?>;">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center" href="../home/home.php">
            <img src="../images/logo_bg.png" width="50" height="50" class="me-2 rounded-circle">
            <span class="fw-bold">OpticManager - <?php echo ucfirst($user_role); ?></span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link px-3" href="../home/home.php">
                        <i class='bx bx-grid-alt me-1'></i>Accueil
                    </a>
                </li>
                
                <?php if ($user_role == 'admin'): ?>                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <i class='bx bx-collection me-1'></i>Toutes Les Tables
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
                
                <!-- New Quick Tools Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3" href="#" id="navbarToolsDropdown" role="button" data-bs-toggle="dropdown">
                        <i class='bx bx-wrench me-1'></i>Outils Rapides
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
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Produit/product-catalog.php"><i class="fas fa-eye me-2"></i>Catalogue Produits</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Dashboard/analytics.php"><i class="fas fa-chart-line me-2"></i>Analytics Avancé</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Dashboard/notifications.php"><i class="fas fa-bell me-2"></i>Centre de Notifications</a></li>
                    </ul>
                </li>
                  <li class="nav-item">
                    <a class="nav-link px-3" href="../Dashboard/analytics.php">
                        <i class='bx bx-pie-chart-alt-2 me-1'></i>Analytics
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="#">
                        <i class='bx bx-cog me-1'></i>Paramètres
                    </a>
                </li>
                
                <?php elseif ($user_role == 'opticien'): ?>                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
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
                
                <!-- Quick Tools for Opticien -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3" href="#" id="navbarToolsDropdown" role="button" data-bs-toggle="dropdown">
                        <i class='bx bx-wrench me-1'></i>Outils Rapides
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
                    <a class="nav-link px-3" href="../Rendezvous/rendezvous-list.php">
                        <i class='bx bx-calendar me-1'></i>Rendez-vous
                    </a>
                </li>
                <?php endif; ?>
            </ul>
            
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link px-3" href="#">
                        <i class="fa-solid fa-user me-1"></i><?php echo ucfirst($user_role); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 text-warning" href="../deconnexion.php">
                        <i class="fa-solid fa-sign-out-alt me-1"></i>Déconnexion
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main content area -->
<div class="container-fluid" style="margin-top: 70px; padding: 20px;">

<style>
*{
    margin: 0;
    padding: 0;
}

.table {
    width: 100%;
}

.colm {
    width: 30px;
}

input{
    margin-bottom: 10px;
}

.iconrouge{
    color:gray;
}

.entete-list{
    display: flex; 
    justify-content: space-between;
    align-items: center;
}

.nbr{
    border: 1px solid green;
    padding: 10px;
    background: green;
    color: white;
    font-size: 14pt;
    height: 40px;
    width: 40px;
    text-align: center;
    border-radius: 5px;
}

.cledelete{
    width: 400px;
    text-align: center;
    border: 1px solid blue;
    padding: 20px;
    border-radius: 5px;
    margin: auto;
}

.authentification{
    width: 50%;
    margin: auto;
}

.authentification img{
    width: 50%;
    float: center;
}

.navbar-nav .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: white;
}

.dropdown-menu {
    max-height: 400px;
    overflow-y: auto;
}
</style>
</body>
</html>