<?php
require("../connexion.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $result = mysqli_query($con, "SELECT v.*, CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet, p.telephone, p.email 
                                   FROM ventes v, patients p 
                                   WHERE v.idpatient = p.idpatient 
                                   AND v.id_vente = $id");
    
    if($result && mysqli_num_rows($result) > 0) {
        $vente = mysqli_fetch_assoc($result);
    } else {
        echo "Vente not found.";
        exit;
    }
} else {
    // Afficher toutes les ventes
    $result = mysqli_query($con, "SELECT v.*, CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet 
                                   FROM ventes v, patients p 
                                   WHERE v.idpatient = p.idpatient 
                                   ORDER BY v.datevente DESC");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimer Ventes<?php if(isset($vente)) echo " - " . $vente['id_vente']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .print-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #007bff;
            margin: 0;
            font-size: 2.5em;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-section h3 {
            color: #007bff;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .info-item {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #007bff;
        }
        .info-item strong {
            color: #495057;
            display: block;
            margin-bottom: 5px;
        }
        .print-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 20px 0;
        }
        .print-btn:hover {
            background-color: #0056b3;
        }
        .back-btn {
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }
        .back-btn:hover {
            background-color: #5a6268;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        @media print {
            .print-btn, .back-btn {
                display: none;
            }
            body {
                background-color: white;
            }
            .print-container {
                box-shadow: none;
                max-width: none;
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="print-container">
        <div class="header">
            <h1>OPTI-RENT</h1>
            <h2><?php echo isset($vente) ? 'Facture Vente' : 'Liste des Ventes'; ?></h2>
        </div>

        <?php if(isset($vente)): ?>
        <div class="info-section">
            <h3>Informations de la Vente</h3>
            <div class="info-grid">
                <div class="info-item">
                    <strong>ID Vente:</strong>
                    <?php echo $vente['id_vente']; ?>
                </div>
                <div class="info-item">
                    <strong>Patient:</strong>
                    <?php echo $vente['patient_nom_complet']; ?>
                </div>
                <div class="info-item">
                    <strong>Date de Vente:</strong>
                    <?php echo date('d/m/Y H:i', strtotime($vente['datevente'])); ?>
                </div>
                <div class="info-item">
                    <strong>Montant Total:</strong>
                    <?php echo $vente['montanttotal']; ?> €
                </div>
                <div class="info-item">
                    <strong>Mode de Paiement:</strong>
                    <?php echo ucfirst($vente['modepaiement']); ?>
                </div>
                <div class="info-item">
                    <strong>Statut du Paiement:</strong>
                    <?php echo ucfirst(str_replace('_', ' ', $vente['statutpaiement'])); ?>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="info-section">
            <h3>Liste de toutes les Ventes</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient</th>
                        <th>Date</th>
                        <th>Montant</th>
                        <th>Mode Paiement</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id_vente']; ?></td>
                        <td><?php echo $row['patient_nom_complet']; ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($row['datevente'])); ?></td>
                        <td><?php echo $row['montanttotal']; ?> €</td>
                        <td><?php echo ucfirst($row['modepaiement']); ?></td>
                        <td><?php echo ucfirst(str_replace('_', ' ', $row['statutpaiement'])); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>

        <div style="text-align: center; margin-top: 30px;">
            <button onclick="window.print()" class="print-btn">
                <i class="fa-solid fa-print"></i> Imprimer
            </button>
            <a href="ventes-list.php" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i> Retour à la liste
            </a>
        </div>
    </div>

    <script>
        // Auto print when URL has print=true parameter
        if(window.location.search.includes('print=true')) {
            window.onload = function() {
                window.print();
            }
        }
    </script>
</body>
</html>
