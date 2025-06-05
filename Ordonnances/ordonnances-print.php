<?php
include_once '../conn.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $result = mysqli_query($conn, "SELECT o.*, p.nom as patient_nom, p.prenom as patient_prenom 
                                   FROM ordonnances o 
                                   LEFT JOIN patients p ON o.patient_id = p.id 
                                   WHERE o.id = $id");
    
    if($result && mysqli_num_rows($result) > 0) {
        $ordonnance = mysqli_fetch_assoc($result);
    } else {
        echo "Ordonnance not found.";
        exit;
    }
} else {
    echo "No ordonnance ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimer Ordonnance - <?php echo $ordonnance['id']; ?></title>
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
            margin: 20px 10px 20px 0;
            text-decoration: none;
            display: inline-block;
        }
        .back-btn:hover {
            background-color: #5a6268;
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
            <h1>Ordonnance</h1>
            <p>Gestion Optique - Impression des Données</p>
        </div>

        <div class="info-section">
            <h3>Informations de l'Ordonnance</h3>
            <div class="info-grid">
                <div class="info-item">
                    <strong>ID Ordonnance:</strong>
                    <?php echo htmlspecialchars($ordonnance['id']); ?>
                </div>
                <div class="info-item">
                    <strong>Patient:</strong>
                    <?php echo htmlspecialchars($ordonnance['patient_nom'] . ' ' . $ordonnance['patient_prenom']); ?>
                </div>
                <div class="info-item">
                    <strong>Date Ordonnance:</strong>
                    <?php echo htmlspecialchars($ordonnance['date_ordonnance']); ?>
                </div>
                <div class="info-item">
                    <strong>Médecin:</strong>
                    <?php echo htmlspecialchars($ordonnance['medecin']); ?>
                </div>
                <div class="info-item">
                    <strong>Sphère OD:</strong>
                    <?php echo htmlspecialchars($ordonnance['sphere_od']); ?>
                </div>
                <div class="info-item">
                    <strong>Cylindre OD:</strong>
                    <?php echo htmlspecialchars($ordonnance['cylindre_od']); ?>
                </div>
                <div class="info-item">
                    <strong>Axe OD:</strong>
                    <?php echo htmlspecialchars($ordonnance['axe_od']); ?>
                </div>
                <div class="info-item">
                    <strong>Sphère OG:</strong>
                    <?php echo htmlspecialchars($ordonnance['sphere_og']); ?>
                </div>
                <div class="info-item">
                    <strong>Cylindre OG:</strong>
                    <?php echo htmlspecialchars($ordonnance['cylindre_og']); ?>
                </div>
                <div class="info-item">
                    <strong>Axe OG:</strong>
                    <?php echo htmlspecialchars($ordonnance['axe_og']); ?>
                </div>
                <div class="info-item">
                    <strong>Addition:</strong>
                    <?php echo htmlspecialchars($ordonnance['addition']); ?>
                </div>
                <div class="info-item">
                    <strong>Écart Pupillaire:</strong>
                    <?php echo htmlspecialchars($ordonnance['ecart_pupillaire']); ?>
                </div>
            </div>
            
            <?php if (!empty($ordonnance['notes'])): ?>
            <div class="info-item" style="margin-top: 20px;">
                <strong>Notes:</strong>
                <?php echo nl2br(htmlspecialchars($ordonnance['notes'])); ?>
            </div>
            <?php endif; ?>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <a href="ordonnances-list.php" class="back-btn">Retour à la Liste</a>
            <button onclick="window.print()" class="print-btn">Imprimer</button>
        </div>
    </div>
</body>
</html>
