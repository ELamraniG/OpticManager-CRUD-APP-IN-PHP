<?php
require("../head.php");
require("../connexion.php");
$r = "select * from cabinet";
$res = mysqli_query($con, $r);
$nbr_service = mysqli_num_rows($res);
require("../fonctions.php");
?>
<div class="container" style="margin-top: 100px;">
    <div class=entete-list>
        <h1 class="display-4">Liste des Cabinet</h1>
        <span class="nbr"><?php echo $nbr_service; ?></span>
    </div>

    <a href=cabinet-form-add.php class='btn btn-success ttip' data-bs-toggle='tooltip' title='Ajouter un cabinet'><i class='fa-solid fa-plus'></i></a>

    <a href=cabinet-print.php class='btn btn-secondary' data-bs-toggle='tooltip' title='Imprimer tous les cabinet'><i class="fa-solid fa-print"></i></a>

    <br>
    <br>
    <div class="card shadow">
        <div class="card-body">
            <table id="example" class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Id Cabinet</th>
                        <th>Nom du Cabinet</th>
                        <th>Adresse</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>SiteWeb</th>
                        <th>responsable</th>
                        <th>Specilaite</th>
                        <th>Ville</th>
                        <th>Pays</th>
                        <th>Code Postal</th>
                        <th>Logo</th>
                        <th class="colm"></th>
                        <th class="colm"></th>
                    </tr>
                </thead>
                <tbody>
<?php

while ($data = mysqli_fetch_assoc($res))
{
    $id= $data['idcabinet'];
    echo "<tr>";
    echo "<td>" . $data['idcabinet'];
    echo "<td>" . $data['nomcabinet'];
    echo "<td>" . $data['adresse'];
    echo "<td>" . $data['telephone'];
    echo "<td>" . $data['email'];
    echo "<td>" . $data['siteweb'];
    echo "<td>" . $data['responsable'];
    echo "<td>" . $data['specialite'];
    echo "<td>" . $data['ville'];
    echo "<td>" . $data['pays'];
    echo "<td>" . $data['codepostal'];
    echo "<td>" . $data['logo'];
    echo "<td> <a href=cabinet-form-update.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Modifier cette ligne'><i class='fa-solid fa-pencil'></i></a>";
    echo "<td> <a href=cabinet-form-delete.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Supprimer cette ligne'><i class='fa-solid fa-trash-can iconrouge'></i></a>";
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

