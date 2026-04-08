<?php
require("../head.php");
require("../connexion.php");
$r = "SELECT vd.iddetail, vd.quantite, vd.prixunitaire,
      v.id_vente, v.datevente, CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet,
      pr.idproduit, pr.nomproduit, pr.marque
      FROM vente_details vd, ventes v, patients p, produit pr
      WHERE vd.idvente = v.id_vente
      AND v.idpatient = p.idpatient
      AND vd.idproduit = pr.idproduit";
$res = mysqli_query($con, $r);
$nbr_service = mysqli_num_rows($res);
require("../fonctions.php");
?>
<div class="container" style="margin-top: 100px;">
    <div class=entete-list>
        <h1 class="display-4">Liste des Détails Ventes</h1>
        <span class="nbr"><?php echo $nbr_service; ?></span>
    </div>

    <a href=vente_details-form-add.php class='btn btn-success ttip' data-bs-toggle='tooltip' title='Ajouter un détail vente'><i class='fa-solid fa-plus'></i></a>

    <a href=vente_details-print.php class='btn btn-secondary' data-bs-toggle='tooltip' title='Imprimer tous les détails ventes'><i class="fa-solid fa-print"></i></a>

    <br>
    <br>
    <div class="card shadow">
        <div class="card-body">
            <table id="example" class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Id Détail</th>
                        <th>Patient</th>
                        <th>Vente</th>
                        <th>Produit</th>
                        <th>Marque</th>
                        <th>Quantité</th>
                        <th>Prix Unitaire</th>
                        <th>Total</th>
                        <th class="colm"></th>
                        <th class="colm"></th>
                    </tr>
                </thead>
                <tbody>
<?php

while ($data = mysqli_fetch_assoc($res))
{
    $id= $data['iddetail'];
    echo "<tr>";
    echo "<td>" . $data['iddetail'];
    echo "<td>" . $data['patient_nom_complet'];
    echo "<td>" . $data['id_vente'] . " (" . $data['datevente'] . ")";
    echo "<td>" . $data['nomproduit'];
    echo "<td>" . $data['marque'];
    echo "<td>" . $data['quantite'];
    echo "<td>" . number_format($data['prixunitaire'], 2) . "€";
    echo "<td>" . number_format($data['quantite'] * $data['prixunitaire'], 2) . "€";
    echo "<td> <a href=vente_details-form-update.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Modifier cette ligne'><i class='fa-solid fa-pencil'></i></a>";
    echo "<td> <a href=vente_details-form-delete.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Supprimer cette ligne'><i class='fa-solid fa-trash-can iconrouge'></i></a>";
}
mysqli_close($con);
?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    
<?php
    require("../footer.php");
?>

</body>
