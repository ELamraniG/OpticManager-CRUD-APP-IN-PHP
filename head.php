<?php
session_start();
?>
<!-- Bootstrap version 5.3.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

<!--Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta charset="utf-8">
<!-- Favicon -->    
    <link rel="icon" type="image/png" sizes="16x16"  href="../images/logo_bg.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

<?php
/* Vérifier si cette page est authentifié */
    $v_session = $_SESSION['v_session'];
    if ($v_session != 1) {
    echo "<div class='alert alert-danger'><i class='fa-solid fa-triangle-exclamation'></i> <b>LaPduP</b> : Echec de connexion... | Vous n'avez pas le droit d'accéder à cette page sans authentification...</div>";
    exit();
}
else
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
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16"  href="images/logo_bg.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    
    <title>OPTIRENT</title>
    <!--Mon style -->
    <link rel="stylesheet" type="text/css" href="../style.css"><body>
<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #004080;">
    <div class="container-fluid">
        <img src="../images/logo_bg.png" width="90px">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#" style="border-radius: 5px; padding: 10px 15px;">
                        <i class='bx bx-grid-alt'></i> Dashboard
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 5px; padding: 10px 15px;">
                        <i class='bx bx-collection'></i> Tables
                    </a>                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../categorie/categorie-list.php">Categories</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../fournisseur/fournisseur-list.php">Fournisseur</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../client/client-list.php">Client</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../cabinet/cabinet-list.php">Cabinet</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../produit/produit-list.php">Produit</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../commande/commande-list.php">Commande</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Commandes_Fournisseur/commandes-fournisseur-list.php">Commandes Fournisseur</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../rendezvous/rendezvous-list.php">Rendez Vous</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Patients/patients-list.php">Patients</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Consultations/consultations-list.php">Consultations</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Ordonnances/ordonnances-list.php">Ordonnances</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Ventes/ventes-list.php">Ventes</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Vente_details/vente_details-list.php">Détails Ventes</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Utilisateurs/utilisateurs-list.php">Utilisateurs</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#" style="border-radius: 5px; padding: 10px 15px;">
                        <i class='bx bx-pie-chart-alt-2'></i> Analytics
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#" style="border-radius: 5px; padding: 10px 15px;">
                        <i class='bx bx-line-chart'></i> Chart
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#" style="border-radius: 5px; padding: 10px 15px;">
                        <i class='bx bx-compass'></i> Explore
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#" style="border-radius: 5px; padding: 10px 15px;">
                        <i class='bx bx-history'></i> History
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#" style="border-radius: 5px; padding: 10px 15px;">
                        <i class='bx bx-cog'></i> Setting
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="../deconnexion.php" style="padding: 10px 15px;">
                        <i class="fa-solid fa-lock"></i> Déconnexion
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary" href="#" style="padding: 10px 15px;">
                        <i class="fa-solid fa-user"></i> Admin (Administration)
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main content area with top padding to account for fixed navbar -->
<div class="container-fluid" style="margin-top: 80px; padding: 20px;"></body>
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

.navbar {
    background-color: #004080; /* Couleur de fond */
    padding: 10px; /* Espacement interne */
}

.navbar-nav .nav-link {
    color: white ; /* Couleur du texte */
    border-radius: 5px; /* Arrondissement des coins */
    padding: 10px 15px; /* Espacement du texte */
    font-size: 16px; /* Taille de la police */
}

.navbar-nav .nav-link.active {
    color: #007bff; /* Couleur du texte pour l'élément actif */
    background-color: #fff; /* Couleur de fond pour l'élément actif */
}

.navbar-nav .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: white;
}
</style>
</html>
</head>