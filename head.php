<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['v_session']) || $_SESSION['v_session'] != 1) {
    header("Location: ../index-main.php");
    exit();
}

require_once(__DIR__ . "/fonctions.php");
$role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'admin';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OPTIRENT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="../home/home.php">
            <i class="fa-solid fa-glasses"></i> OpticManager
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="../Dashboard/dashboard.php">Dashboard</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Tables</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../Categorie/categorie-list.php">Categories</a></li>
                        <li><a class="dropdown-item" href="../Fournisseur/fournisseur-list.php">Fournisseurs</a></li>
                        <li><a class="dropdown-item" href="../Client/client-list.php">Clients</a></li>
                        <li><a class="dropdown-item" href="../Cabinet/cabinet-list.php">Cabinets</a></li>
                        <li><a class="dropdown-item" href="../Produit/produit-list.php">Produits</a></li>
                        <li><a class="dropdown-item" href="../Commande/commande-list.php">Commandes</a></li>
                        <li><a class="dropdown-item" href="../Commandes_Fournisseur/commandes-fournisseur-list.php">Commandes fournisseur</a></li>
                        <li><a class="dropdown-item" href="../Patients/patients-list.php">Patients</a></li>
                        <li><a class="dropdown-item" href="../Consultations/consultations-list.php">Consultations</a></li>
                        <li><a class="dropdown-item" href="../Ordonnances/ordonnances-list.php">Ordonnances</a></li>
                        <li><a class="dropdown-item" href="../Rendezvous/rendezvous-list.php">Rendez-vous</a></li>
                        <li><a class="dropdown-item" href="../Ventes/ventes-list.php">Ventes</a></li>
                        <li><a class="dropdown-item" href="../Vente_details/vente_details-list.php">Details ventes</a></li>
                        <?php if ($role == 'admin') { ?>
                        <li><a class="dropdown-item" href="../Utilisateurs/utilisateurs-list.php">Utilisateurs</a></li>
                        <?php } ?>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Outils</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../Search/global-search.php">Recherche</a></li>
                        <li><a class="dropdown-item" href="../Stock/inventory-manager.php">Stock</a></li>
                        <li><a class="dropdown-item" href="../Patients/patient-finder.php">Trouver patient</a></li>
                        <li><a class="dropdown-item" href="../Rendezvous/appointment-manager.php">Gestion RDV</a></li>
                        <li><a class="dropdown-item" href="../Produit/product-catalog.php">Catalogue</a></li>
                        <li><a class="dropdown-item" href="../Dashboard/statistics.php">Statistiques</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Aide</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../Aide/a-propos.php">A propos</a></li>
                        <li><a class="dropdown-item" href="../Aide/contacter-support.php">Support</a></li>
                    </ul>
                </li>
            </ul>

            <span class="navbar-text me-3"><?php echo e($role); ?></span>
            <a href="../deconnexion.php" class="btn btn-outline-light btn-sm">Deconnexion</a>
        </div>
    </div>
</nav>

<div class="container-fluid main-content">
