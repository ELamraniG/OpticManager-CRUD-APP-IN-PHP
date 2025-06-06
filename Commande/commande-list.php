<?php
require("../head.php");
require("../connexion.php");
$r = "SELECT idcommande, client.nom, produit.nomproduit, datecommande, statut 
FROM commande, client, produit
WHERE commande.idclient = client.idl
AND commande.idproduit = produit.idproduit";
$res = mysqli_query($con, $r);
$nbr_service = mysqli_num_rows($res);
require("../fonctions.php");
?>
<div class="container" style="margin-top: 100px;">
    <div class=entete-list>
        <h1 class="display-4">Liste des Commandes</h1>
        <span class="nbr"><?php echo $nbr_service; ?></span>
    </div>

    <a href=commande-form-add.php class='btn btn-success ttip' data-bs-toggle='tooltip' title='Ajouter un commande'><i class='fa-solid fa-plus'></i></a>

    <a href=commande-print.php class='btn btn-secondary' data-bs-toggle='tooltip' title='Imprimer tous les commande'><i class="fa-solid fa-print"></i></a>

    <br>
    <br>
    <div class="card shadow">
        <div class="card-body">
            <table id="example" class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Id commande</th>
                        <th>client nom</th>
                        <th>Nom produit</th>
                        <th>Date commande</th>
                        <th>Status</th>
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
    echo "<td>" . $data['nom'];
    echo "<td>" . $data['nomproduit'];
    echo "<td>" . $data['datecommande'];
    echo "<td>" . $data['statut'];
    echo "<td> <a href=commande-form-update.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Modifier cette ligne'><i class='fa-solid fa-pencil'></i></a>";
    echo "<td> <a href=commande-form-delete.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Supprimer cette ligne'><i class='fa-solid fa-trash-can iconrouge'></i></a>";
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
