<?php
require("../head.php");
require("../connexion.php");
$r = "SELECT idproduit, produit.idc, categorie.titrec, produit.idf, fournisseur.nom, nomproduit, marque, produit.notes, prixdachat, tvaappliquee, prixdevente, qteenstock, seuildalerte
FROM produit, categorie, fournisseur
WHERE produit.idc = categorie.idc
AND produit.idf = fournisseur.idf";
$res = mysqli_query($con, $r);
$nbr_service = mysqli_num_rows($res);
require("../fonctions.php");
?>
<div class="container" style="margin-top: 100px;">
    <div class=entete-list>
        <h1 class="display-4">Liste des Produit</h1>
        <span class="nbr"><?php echo $nbr_service; ?></span>
    </div>

    <a href=produit-form-add.php class='btn btn-success ttip' data-bs-toggle='tooltip' title='Ajouter un produit'><i class='fa-solid fa-plus'></i></a>

    <a href=produit-print.php class='btn btn-secondary' data-bs-toggle='tooltip' title='Imprimer tous les produit'><i class="fa-solid fa-print"></i></a>

    <br>
    <br>
    <div class="card shadow">
        <div class="card-body">
            <table id="example" class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Id Produit</th>
                        <th>Nom du Produit</th>
                        <th>Categorie</th>
                        <th>Marque</th>
                        <th>Fournisseur</th>
                        <th>Notes</th>
                        <th>Prix Achat</th>
                        <th>TVA</th>
                        <th>Prix Vente</th>
                        <th>Quantite du stock</th>
                        <th>Seuil d'alert</th>
                        <th class="colm"></th>
                        <th class="colm"></th>
                    </tr>
                </thead>
                <tbody>
<?php

while ($data = mysqli_fetch_assoc($res))
{
    $id= $data['idproduit'];
    echo "<tr>";
    echo "<td>" . $data['idproduit'];
    echo "<td>" . $data['nomproduit'];
    echo "<td>" . $data['titrec'];
    echo "<td>" . $data['marque'];
    echo "<td>" . $data['nom'];
    echo "<td>" . $data['notes'];
    echo "<td>" . $data['prixdachat'];
    echo "<td>" . $data['tvaappliquee'];
    echo "<td>" . $data['prixdevente'];
    echo "<td>" . $data['qteenstock'];
    echo "<td>" . $data['seuildalerte'];
    echo "<td> <a href=produit-form-update.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Modifier cette ligne'><i class='fa-solid fa-pencil'></i></a>";
    echo "<td> <a href=produit-form-delete.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Supprimer cette ligne'><i class='fa-solid fa-trash-can iconrouge'></i></a>";
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
