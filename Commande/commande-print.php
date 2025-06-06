<?php
session_start();
/* Vérifier si cette page est authentifié */
    $v_session = $_SESSION['v_session'];
    if ($v_session != 1) 
    {
    echo "<!-- Bootstrap version 5.3.0 -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css'>";
    echo "<meta charset=utf-8>";

    echo "<div class='alert alert-danger'><i class='fa-solid fa-triangle-exclamation'></i> <b>LaPduP</b> : Echec de connexion... | Vous n'avez pas le droit d'accéder à cette page sans authentification...</div>";
    exit();
}
else
{
// Inclure la bibliothèque FPDF
require('../fpdf/fpdf.php');

require("../connexion.php");

// Récupérer les données de la table "commande" avec jointures
$r = "SELECT c.idcommande, c.datecommande, CONCAT(cl.nom, ' ', cl.prenom) as client_nom, p.nomproduit, c.statut
FROM commande c, client cl, produit p
WHERE c.idclient = cl.idl AND c.idproduit = p.idproduit";
$res = mysqli_query($con, $r);

// Vérifier si la requête a réussi
if (!$res) {
    mysqli_close($con);
    exit('Erreur de requête: ' . mysqli_error($con));
}

// Créer un objet FPDF
$pdf = new FPDF();
$pdf->AliasNbPages(); // Ajouter cette ligne pour définir l'alias
$pdf->AddPage();

// Définir la police
$pdf->SetFont('Arial', 'B', 16);

// Ajouter une image en haut de la page
$pdf->Image('../images/lap2.png', 10, 10, 0, 5);
$pdf->Ln(10);

// Titre
$pdf->Cell(0, 10, 'Liste des Commandes', 0, 1, 'C');
$pdf->Ln(6);

// Entête du tableau
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 220, 255); // Couleur de fond de l'en-tête

$pdf->Cell(20, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Date', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Client', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Produit', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Statut', 1, 0, 'C', true);
$pdf->Ln();

// Afficher les données de la table
$pdf->SetFont('Arial', '', 9);
while ($data = mysqli_fetch_assoc($res)) {
    $pdf->Cell(20, 10, $data['idcommande'], 1);
    $pdf->Cell(30, 10, $data['datecommande'], 1);
    $pdf->Cell(50, 10, substr($data['client_nom'], 0, 22), 1);
    $pdf->Cell(60, 10, substr($data['nomproduit'], 0, 28), 1);
    $pdf->Cell(30, 10, substr($data['statut'], 0, 12), 1);
    $pdf->Ln();
}

// Numéro de page
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0,10, 'Page ' . $pdf->PageNo() . ' sur {nb}', 0, 0, 'L');


// Fermer la connexion à la base de données
mysqli_close($con);

// Afficher le PDF dans le navigateur
$pdf->Output();
}
?>
