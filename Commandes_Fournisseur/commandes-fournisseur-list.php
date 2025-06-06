<?php
require("../head.php");
require("../connexion.php");
$r = "SELECT cf.idcommande, cf.datecommande, cf.statut, f.nom as fournisseur_nom, f.idf
FROM commandes_fournisseur cf, fournisseur f
WHERE cf.idfournisseur = f.idf";
$res = mysqli_query($con, $r);
$nbr_service = mysqli_num_rows($res);
require("../fonctions.php");
?>
<div class="container" style="margin-top: 100px;">
    <div class=entete-list>
        <h1 class="display-4">Liste des Commandes Fournisseur</h1>
        <span class="nbr"><?php echo $nbr_service; ?></span>
    </div>

    <a href=commandes-fournisseur-form-add.php class='btn btn-success ttip' data-bs-toggle='tooltip' title='Ajouter une commande fournisseur'><i class='fa-solid fa-plus'></i></a>

    <a href=commandes-fournisseur-print.php class='btn btn-secondary' data-bs-toggle='tooltip' title='Imprimer toutes les commandes fournisseur'><i class="fa-solid fa-print"></i></a>

    <br>
    <br>
    <div class="card shadow">
        <div class="card-body">
            <table id="example" class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Id Commande</th>
                        <th>Date Commande</th>
                        <th>Fournisseur</th>
                        <th>Statut</th>
                        <th class="colm"></th>
                        <th class="colm"></th>
                    </tr>
                </thead>
                <tbody>
<?php

while ($data = mysqli_fetch_assoc($res))
{
    $id= $data['idcommande'];
    echo "<tr>";
    echo "<td>" . $data['idcommande'];
    echo "<td>" . $data['datecommande'];
    echo "<td>" . $data['fournisseur_nom'];
    echo "<td>" . $data['statut'];
    echo "<td> <a href=commandes-fournisseur-form-update.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Modifier cette ligne'><i class='fa-solid fa-pencil'></i></a>";
    echo "<td> <a href=commandes-fournisseur-form-delete.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Supprimer cette ligne'><i class='fa-solid fa-trash-can iconrouge'></i></a>";
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
