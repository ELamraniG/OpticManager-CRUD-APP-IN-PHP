<?php
require("../head.php");
require("../connexion.php");
$r = "select * from fournisseur";
$res = mysqli_query($con, $r);
$nbr_service = mysqli_num_rows($res);
require("../fonctions.php");
?>
<div class="container" style="margin-top: 100px;">
    <div class=entete-list>
        <h1 class="display-4">Liste des fournisseur</h1>
        <span class="nbr"><?php echo $nbr_service; ?></span>
    </div>

    <a href=fournisseur-form-add.php class='btn btn-success ttip' data-bs-toggle='tooltip' title='Ajouter un categorie'><i class='fa-solid fa-plus'></i></a>

    <a href=fournisseur-print.php class='btn btn-secondary' data-bs-toggle='tooltip' title='Imprimer tous les categorie'><i class="fa-solid fa-print"></i></a>

    <br>
    <br>
    <div class="card shadow">
        <div class="card-body">
            <table id="example" class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Id Fournisseur</th>
                        <th>Nom</th>
                        <th>Contact</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Adresse</th>
                        <th>Ville</th>
                        <th>Pays</th>
                        <th>Type</th>
                        <th>Paiement</th>
                        <th>Livraison</th>
                        <th>Notes</th>
                        <th class="colm"></th>
                        <th class="colm"></th>
                    </tr>
                </thead>
                <tbody>
<?php

while ($data = mysqli_fetch_assoc($res))
{
    $id= $data['idf'];
    echo "<tr>";
    echo "<td>" . $data['idf'];
    echo "<td>" . $data['nom'];
    echo "<td>" . $data['contact'];
    echo "<td>" . $data['tel'];
    echo "<td>" . $data['email'];
    echo "<td>" . $data['adresse'];
    echo "<td>" . $data['ville'];
    echo "<td>" . $data['pays'];
    echo "<td>" . $data['typedeproduit'];
    echo "<td>" . $data['conditiondepaiement'];
    echo "<td>" . $data['conditiondelivraison'];
    echo "<td>" . $data['notes'];
    echo "<td> <a href=fournisseur-form-update.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Modifier cette ligne'><i class='fa-solid fa-pencil'></i></a>";
    echo "<td> <a href=fournisseur-form-delete.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Supprimer cette ligne'><i class='fa-solid fa-trash-can iconrouge'></i></a>";
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
