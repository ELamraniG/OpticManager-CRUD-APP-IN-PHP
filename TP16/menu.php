
<?php
session_start();
echo $vs_login = $_SESSION['vs_login'];
$vs_motdepasse = $_SESSION['vs_motdepasse'];
require("connexion.php");
$ru = "select utilisateur.*, employe.* from utilisateur, employe where utilisateur.idemploye = employe.idemploye and login = '" . $vs_login . "' and utilisateur.motdepasse = '" . $vs_motdepasse . "'";
$resu = mysqli_query($con, $ru);
$datau = mysqli_fetch_assoc($resu);
?>
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <img src="../images/lap2.png" width="90px">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php if ($datau['gerer'] == 0) echo "disabled"; ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 5px">
                        Gérer
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item <?php if ($datau['service'] == 0) echo "disabled"; ?>" href="../service/service-list.php">Services</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item <?php if ($datau['employe'] == 0) echo "disabled"; ?>" href="../employe/employe-list.php">Employés</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item <?php if ($datau['lesaffectationsauxservices'] == 0) echo "disabled"; ?>" href="../affecter/affecter-list.php">Les affectations aux services</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php if ($datau['pointage'] == 0) echo "disabled"; ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 5px">
                        Pointage
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item <?php if ($datau['pointageindividuel'] == 0) echo "disabled"; ?>" href="../pointage/pointage-list.php">Pointage individuel</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item <?php if ($datau['pointageautomatique'] == 0) echo "disabled"; ?>" href="../pointage/pointage-list.php">Pointage automatique</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php if ($datau['rapportetstatistiques'] == 0) echo "disabled"; ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 5px">
                        Rapports et statistiques
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item <?php if ($datau['tableaudebord'] == 0) echo "disabled"; ?>" href="../pointage/pointage-list.php">Tableau de bord (Dashbord)</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item <?php if ($datau['etatdesemployesparservice'] == 0) echo "disabled"; ?>" href="#">Etat des employés par service</a></li>
                        <li><a class="dropdown-item <?php if ($datau['etatdesaffectationsdunemploye'] == 0) echo "disabled"; ?>" href="#">Etat des affectations d'un employé</a></li>
                        <li><a class="dropdown-item <?php if ($datau['etatdespointagesentredatesdunemploye'] == 0) echo "disabled"; ?>" href="#">Etat des pointages entre 2 dates d'un employé</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php if ($datau['parametre'] == 0) echo "disabled"; ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 5px">
                        Paramètre
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item <?php if ($datau['gestiondesutilisateurs'] == 0) echo "disabled"; ?>" href="../utilisateur/utilisateur-list.php">Gestion des utilisateurs</a></li>
                        <hr class="dropdown-divider">                    
                        <li><a class="dropdown-item <?php if ($datau['configurationdelapplication'] == 0) echo "disabled"; ?>" href="#">Configuration de l'application</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 5px">
                        Aide
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Aide</a></li>
                        <li><a class="dropdown-item" href="../aide/contact.php">Contacter le support</a></li>
                        <hr class="dropdown-divider">                    
                        <li><a class="dropdown-item" href="../aide/apropos.php">A propos</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="../deconnexion.php" ><i class="fa-solid fa-lock"></i> Déconnexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary" href="#" ><i class="fa-solid fa-user"></i> <?php echo $datau['nom'] . " " . $datau['prenom']. " (". $datau['typeutilisateur']. ")"; ?></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
