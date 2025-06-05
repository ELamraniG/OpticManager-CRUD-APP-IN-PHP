<?php
require("../head.php");
require("../connexion.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impression - Utilisateurs</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/all.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                font-size: 12px;
            }
            .table {
                font-size: 11px;
            }
        }
        .print-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }
        .print-footer {
            text-align: center;
            margin-top: 30px;
            border-top: 1px solid #ccc;
            padding-top: 15px;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="no-print mb-3">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print"></i> Imprimer
            </button>
            <button onclick="window.close()" class="btn btn-secondary ml-2">
                <i class="fas fa-times"></i> Fermer
            </button>
        </div>

        <div class="print-header">
            <h2>Liste des Utilisateurs</h2>
            <p>Date d'impression: <?php echo date('d/m/Y H:i:s'); ?></p>
        </div>

        <?php        if (isset($_GET['id'])) {
            // Print individual user
            $id = $_GET['id'];
            $sql = "SELECT * FROM utilisateurs WHERE idutilisateur = $id";
            $resultat = mysqli_query($con, $sql);
            
            if (mysqli_num_rows($resultat) > 0) {
                $utilisateur = mysqli_fetch_assoc($resultat);
                ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Détails de l'utilisateur</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <td><strong>ID:</strong></td>
                                        <td><?php echo $utilisateur['idutilisateur']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nom d'utilisateur:</strong></td>
                                        <td><?php echo $utilisateur['nomutilisateur']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nom complet:</strong></td>
                                        <td><?php echo $utilisateur['nomcomplet']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Rôle:</strong></td>
                                        <td><?php echo ucfirst($utilisateur['role']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Statut:</strong></td>
                                        <td><?php echo ($utilisateur['actif'] == '1') ? 'Actif' : 'Inactif'; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                echo '<div class="alert alert-warning">Utilisateur non trouvé.</div>';
            }        } else {
            // Print all users
            $sql = "SELECT * FROM utilisateurs ORDER BY nomcomplet";
            $resultat = mysqli_query($con, $sql);
            
            if (mysqli_num_rows($resultat) > 0) {
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nom d'utilisateur</th>
                                <th>Nom complet</th>
                                <th>Rôle</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($ligne = mysqli_fetch_assoc($resultat)) {
                                $statusText = $ligne['actif'] == '1' ? 'Actif' : 'Inactif';
                                echo '<tr>';
                                echo '<td>' . $ligne['idutilisateur'] . '</td>';
                                echo '<td>' . $ligne['nomutilisateur'] . '</td>';
                                echo '<td>' . $ligne['nomcomplet'] . '</td>';
                                echo '<td>' . ucfirst($ligne['role']) . '</td>';
                                echo '<td>' . $statusText . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    <p><strong>Total des utilisateurs:</strong> <?php echo mysqli_num_rows($resultat); ?></p>
                </div>
                <?php
            } else {
                echo '<div class="alert alert-info">Aucun utilisateur trouvé.</div>';
            }
        }
        ?>

        <div class="print-footer">
            <p>Document généré automatiquement - Système de gestion</p>
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto print on load if requested
        if (window.location.search.includes('auto=1')) {
            window.onload = function() {
                window.print();
            }
        }
    </script>
</body>
</html>
