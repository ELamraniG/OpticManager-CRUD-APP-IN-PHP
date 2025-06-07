<?php
session_start();
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
require('../fpdf/fpdf.php');
require("../connexion.php");

if(isset($_GET['id'])) {

    $id = $_GET['id'];
    $r = "SELECT vd.*, v.datevente, v.montanttotal, CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet, p.telephone, p.email,
          pr.nomproduit, pr.marque, pr.prixdevente
          FROM vente_details vd, ventes v, patients p, produit pr
          WHERE vd.iddetail = $id
          AND vd.idvente = v.id_vente
          AND v.idpatient = p.idpatient
          AND vd.idproduit = pr.idproduit";
} else {

    $r = "SELECT vd.iddetail, vd.quantite, vd.prixunitaire,
          v.id_vente, v.datevente, CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet,
          pr.nomproduit, pr.marque
          FROM vente_details vd, ventes v, patients p, produit pr
          WHERE vd.idvente = v.id_vente
          AND v.idpatient = p.idpatient
          AND vd.idproduit = pr.idproduit
          ORDER BY vd.iddetail DESC";
}

$res = mysqli_query($con, $r);


if (!$res) {
    mysqli_close($con);
    exit('Erreur de requête: ' . mysqli_error($con));
}


$pdf = new FPDF();
$pdf->AliasNbPages();

if(isset($_GET['id'])) {
  
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    
 
    $pdf->Image('../images/lap2.png', 10, 10, 0, 5);
    $pdf->Ln(10);
    
    $pdf->Cell(0, 10, 'OPTI-RENT - DETAIL DE VENTE', 0, 1, 'C');
    $pdf->Ln(10);
    
    if($detail = mysqli_fetch_assoc($res)) {
        $pdf->SetFont('Arial', '', 12);
        
      
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'INFORMATIONS GENERALES', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 8, utf8_decode('ID Détail:'), 0, 0, 'L');
        $pdf->Cell(0, 8, $detail['iddetail'], 0, 1, 'L');
        $pdf->Cell(50, 8, 'ID Vente:', 0, 0, 'L');
        $pdf->Cell(0, 8, $detail['idvente'], 0, 1, 'L');
        $pdf->Cell(50, 8, 'Patient:', 0, 0, 'L');
        $pdf->Cell(0, 8, $detail['patient_nom_complet'], 0, 1, 'L');
        $pdf->Cell(50, 8, 'Date de vente:', 0, 0, 'L');
        $pdf->Cell(0, 8, date('d/m/Y H:i', strtotime($detail['datevente'])), 0, 1, 'L');
        $pdf->Ln(10);
        
        // Informations produit
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'INFORMATIONS PRODUIT', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 8, 'Produit:', 0, 0, 'L');
        $pdf->Cell(0, 8, $detail['nomproduit'], 0, 1, 'L');
        $pdf->Cell(50, 8, 'Marque:', 0, 0, 'L');
        $pdf->Cell(0, 8, $detail['marque'], 0, 1, 'L');
        $pdf->Cell(50, 8, utf8_decode('Quantité:'), 0, 0, 'L');
        $pdf->Cell(0, 8, $detail['quantite'], 0, 1, 'L');
        $pdf->Cell(50, 8, 'Prix unitaire:', 0, 0, 'L');
        $pdf->Cell(0, 8, number_format($detail['prixunitaire'], 2) . ' €', 0, 1, 'L');
        $pdf->Ln(5);
        
        // Total
        $total = $detail['quantite'] * $detail['prixunitaire'];
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'TOTAL: ' . number_format($total, 2) . ' €', 0, 1, 'R');
    }
} else {
    // Format liste pour tous les détails
    $pdf->AddPage('L');
    $pdf->SetFont('Arial', 'B', 16);
    
    // Ajouter une image en haut de la page
    $pdf->Image('../images/lap2.png', 10, 10, 0, 5);
    $pdf->Ln(10);
    
    $pdf->Cell(0, 10, utf8_decode('Liste des Détails de Vente'), 0, 1, 'C');
    $pdf->Ln(6);
    
    // Entête du tableau
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetFillColor(200, 220, 255);
    
    $pdf->Cell(20, 10, utf8_decode('ID Dét.'), 1, 0, 'C', true);
    $pdf->Cell(50, 10, 'Patient', 1, 0, 'C', true);
    $pdf->Cell(25, 10, 'Vente', 1, 0, 'C', true);
    $pdf->Cell(45, 10, 'Produit', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Marque', 1, 0, 'C', true);
    $pdf->Cell(20, 10, 'Qté', 1, 0, 'C', true);
    $pdf->Cell(25, 10, 'Prix Unit.', 1, 0, 'C', true);
    $pdf->Cell(25, 10, 'Total', 1, 0, 'C', true);
    $pdf->Ln();
    
    // Afficher les données
    $pdf->SetFont('Arial', '', 8);
    $fill = false;
    while ($data = mysqli_fetch_assoc($res)) {
        if ($fill) {
            $pdf->SetFillColor(240, 240, 240);
        } else {
            $pdf->SetFillColor(255, 255, 255);
        }
        
        $total = $data['quantite'] * $data['prixunitaire'];
        
        $pdf->Cell(20, 8, $data['iddetail'], 1, 0, 'C', $fill);
        $pdf->Cell(50, 8, substr($data['patient_nom_complet'], 0, 22), 1, 0, 'L', $fill);
        $pdf->Cell(25, 8, $data['id_vente'], 1, 0, 'C', $fill);
        $pdf->Cell(45, 8, substr($data['nomproduit'], 0, 20), 1, 0, 'L', $fill);
        $pdf->Cell(30, 8, substr($data['marque'], 0, 13), 1, 0, 'L', $fill);
        $pdf->Cell(20, 8, $data['quantite'], 1, 0, 'C', $fill);
        $pdf->Cell(25, 8, number_format($data['prixunitaire'], 2), 1, 0, 'R', $fill);
        $pdf->Cell(25, 8, number_format($total, 2), 1, 0, 'R', $fill);
        $pdf->Ln();
        $fill = !$fill;
    }
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
