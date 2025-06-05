<?php
require("../head.php");
require("../connexion.php");
$r = "SELECT v.id_vente, v.datevente, v.montanttotal, v.modepaiement, v.statutpaiement,
      CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet, p.idpatient
      FROM ventes v, patients p
      WHERE v.idpatient = p.idpatient
      ORDER BY v.datevente DESC";
$res = mysqli_query($con, $r);
$nbr_service = mysqli_num_rows($res);
require("../fonctions.php");
?>
<div class="container" style="margin-top: 100px;">
    <div class=entete-list>
        <h1 class="display-4">Liste des Ventes</h1>
        <span class="nbr"><?php echo $nbr_service; ?></span>
    </div>

    <a href=ventes-form-add.php class='btn btn-success ttip' data-bs-toggle='tooltip' title='Ajouter une vente'><i class='fa-solid fa-plus'></i></a>

    <a href=ventes-print.php class='btn btn-secondary' data-bs-toggle='tooltip' title='Imprimer toutes les ventes'><i class="fa-solid fa-print"></i></a>

    <br>
    <br>
    <table id="example" class="table table-striped table-responsive">
        <thead>
            <tr>
                <th>Id Vente</th>
                <th>Patient</th>
                <th>Date Vente</th>
                <th>Montant Total</th>
                <th>Mode Paiement</th>
                <th>Statut Paiement</th>
                <th class="colm"></th>
                <th class="colm"></th>
            </tr>
        </thead>
        <tbody>
<?php

while ($data = mysqli_fetch_assoc($res))
{
    $id= $data['id_vente'];
    echo "<tr>";
    echo "<td>" . $data['id_vente'];
    echo "<td>" . $data['patient_nom_complet'];
    echo "<td>" . $data['datevente'];
    echo "<td>" . $data['montanttotal'] . " €";
    echo "<td>" . $data['modepaiement'];
    echo "<td>" . $data['statutpaiement'];
    echo "<td> <a href=ventes-form-update.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Modifier cette ligne'><i class='fa-solid fa-pencil'></i></a>";
    echo "<td> <a href=ventes-form-delete.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Supprimer cette ligne'><i class='fa-solid fa-trash-can iconrouge'></i></a>";
}
mysqli_close($con);
?>
        </tbody>
    </table>
</div>

    
<?php
    require("../footer.php");
?>

</body>
