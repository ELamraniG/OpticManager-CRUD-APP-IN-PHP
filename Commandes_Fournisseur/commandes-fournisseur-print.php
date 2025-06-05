<?php
require("../head.php");
require("../connexion.php");
$r = "SELECT cf.idcommande, cf.datecommande, cf.statut, f.nom as fournisseur_nom
FROM commandes_fournisseur cf, fournisseur f
WHERE cf.idfournisseur = f.idf";
$res = mysqli_query($con, $r);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Impression - Commandes Fournisseur</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 30px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Liste des Commandes Fournisseur</h1>
        <p>Date d'impression: <?php echo date('d/m/Y H:i:s'); ?></p>
    </div>

    <button onclick="window.print()" class="no-print">Imprimer</button>
    <a href="commandes-fournisseur-list.php" class="no-print">Retour</a>

    <table>
        <thead>
            <tr>
                <th>Id Commande</th>
                <th>Date Commande</th>
                <th>Fournisseur</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
<?php
while ($data = mysqli_fetch_assoc($res)) {
    echo "<tr>";
    echo "<td>" . $data['idcommande'] . "</td>";
    echo "<td>" . $data['datecommande'] . "</td>";
    echo "<td>" . $data['fournisseur_nom'] . "</td>";
    echo "<td>" . $data['statut'] . "</td>";
    echo "</tr>";
}
mysqli_close($con);
?>
        </tbody>
    </table>
</body>
</html>
