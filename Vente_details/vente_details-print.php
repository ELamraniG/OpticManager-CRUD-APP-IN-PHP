<?php
require("../connexion.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $result = mysqli_query($con, "SELECT vd.*, v.datevente, v.montanttotal, CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet, p.telephone, p.email,
                                   pr.nomproduit, pr.marque, pr.prixdevente
                                   FROM vente_details vd, ventes v, patients p, produit pr
                                   WHERE vd.iddetail = $id
                                   AND vd.idvente = v.id_vente
                                   AND v.idpatient = p.idpatient
                                   AND vd.idproduit = pr.idproduit");
    
    if($result && mysqli_num_rows($result) > 0) {
        $detail_vente = mysqli_fetch_assoc($result);
    } else {
        echo "Détail vente not found.";
        exit;
    }
} else {
    // Afficher tous les détails ventes
    $result = mysqli_query($con, "SELECT vd.iddetail, vd.quantite, vd.prixunitaire,
                                   v.id_vente, v.datevente, CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet,
                                   pr.nomproduit, pr.marque
                                   FROM vente_details vd, ventes v, patients p, produit pr
                                   WHERE vd.idvente = v.id_vente
                                   AND v.idpatient = p.idpatient
                                   AND vd.idproduit = pr.idproduit
                                   ORDER BY vd.iddetail DESC");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimer Détails Ventes<?php if(isset($detail_vente)) echo " - " . $detail_vente['iddetail']; ?></title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
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
            margin: 20px 10px 20px 0;
            text-decoration: none;
            display: inline-block;
        }
        .back-btn:hover {
            background-color: #5a6268;
            text-decoration: none;
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
            <h2><?php echo isset($detail_vente) ? 'Détail de Vente' : 'Liste des Détails Ventes'; ?></h2>
        </div>

        <?php if(isset($detail_vente)): ?>
        <div class="info-section">
            <h3>Informations du Détail de Vente</h3>
            <div class="info-grid">
                <div class="info-item">
                    <strong>ID Détail:</strong>
                    <?php echo $detail_vente['iddetail']; ?>
                </div>
                <div class="info-item">
                    <strong>ID Vente:</strong>
                    <?php echo $detail_vente['idvente']; ?>
                </div>
                <div class="info-item">
                    <strong>Patient:</strong>
                    <?php echo $detail_vente['patient_nom_complet']; ?>
                </div>
                <div class="info-item">
                    <strong>Date de Vente:</strong>
                    <?php echo date('d/m/Y H:i', strtotime($detail_vente['datevente'])); ?>
                </div>
                <div class="info-item">
                    <strong>Produit:</strong>
                    <?php echo $detail_vente['nomproduit']; ?>
                </div>
                <div class="info-item">
                    <strong>Marque:</strong>
                    <?php echo $detail_vente['marque']; ?>
                </div>
                <div class="info-item">
                    <strong>Quantité:</strong>
                    <?php echo $detail_vente['quantite']; ?>
                </div>
                <div class="info-item">
                    <strong>Prix Unitaire:</strong>
                    <?php echo number_format($detail_vente['prixunitaire'], 2); ?> €
                </div>
                <div class="info-item">
                    <strong>Total:</strong>
                    <?php echo number_format($detail_vente['quantite'] * $detail_vente['prixunitaire'], 2); ?> €
                </div>
                <div class="info-item">
                    <strong>Téléphone Patient:</strong>
                    <?php echo $detail_vente['telephone']; ?>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="info-section">
            <h3>Liste de tous les Détails Ventes</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID Détail</th>
                        <th>Patient</th>
                        <th>Vente</th>
                        <th>Produit</th>
                        <th>Marque</th>
                        <th>Quantité</th>
                        <th>Prix Unitaire</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['iddetail']; ?></td>
                        <td><?php echo $row['patient_nom_complet']; ?></td>
                        <td><?php echo $row['id_vente'] . " (" . date('d/m/Y', strtotime($row['datevente'])) . ")"; ?></td>
                        <td><?php echo $row['nomproduit']; ?></td>
                        <td><?php echo $row['marque']; ?></td>
                        <td><?php echo $row['quantite']; ?></td>
                        <td><?php echo number_format($row['prixunitaire'], 2); ?> €</td>
                        <td><?php echo number_format($row['quantite'] * $row['prixunitaire'], 2); ?> €</td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>

        <div style="text-align: center; margin-top: 30px;">
            <a href="vente_details-list.php" class="back-btn">Retour à la Liste</a>
            <button onclick="window.print()" class="print-btn">Imprimer</button>
        </div>
    </div>

    <script>
        // Auto-print if requested
        if(window.location.search.includes('auto_print=1')) {
            window.onload = function() {
                window.print();
            }
        }
    </script>
</body>
</html>
