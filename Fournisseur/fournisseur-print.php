<?php
session_start();
/* Vérifier si cette page est authentifié */
    $v_session = $_SESSION['v_session'];
    if ($v_session != 1) 
    {
    echo "<!-- Bootstrap version 5.3.0 -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css'>";
    echo "<meta charset=utf-8>";

    echo "<div class='alert alert-danger'><i class='fa-solid fa-triangle-exclamation'></i> <b>optique manager</b> : Echec de connexion... | Vous n'avez pas le droit d'accéder à cette page sans authentification...</div>";
    exit();
}
else
{
// Inclure la bibliothèque FPDF
require('../fpdf/fpdf.php');

require("../connexion.php");

// Récupérer les données de la table "fournisseur"
$r = "SELECT * FROM fournisseur";
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
$pdf->Cell(0, 10, 'Liste des Fournisseurs', 0, 1, 'C');
$pdf->Ln(6);

// Entête du tableau
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 220, 255); // Couleur de fond de l'en-tête

$pdf->Cell(25, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Nom', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Contact', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Telephone', 1, 0, 'C', true);
$pdf->Cell(45, 10, 'Email', 1, 0, 'C', true);
$pdf->Ln();

// Afficher les données de la table
$pdf->SetFont('Arial', '', 9);
while ($data = mysqli_fetch_assoc($res)) {
    $pdf->Cell(25, 10, $data['idf'], 1);
    $pdf->Cell(50, 10, substr($data['nom'], 0, 22), 1);
    $pdf->Cell(40, 10, substr($data['contact'], 0, 18), 1);
    $pdf->Cell(30, 10, $data['tel'], 1);
    $pdf->Cell(45, 10, substr($data['email'], 0, 20), 1);
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
