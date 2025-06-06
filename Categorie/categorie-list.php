<?php
require("../head.php");
require("../connexion.php");
$r = "select * from categorie";
$res = mysqli_query($con, $r);
$nbr_service = mysqli_num_rows($res);
require("../fonctions.php");
?>
<div class="container" style="margin-top: 100px;">
    <div class=entete-list>
        <h1 class="display-4">Liste des categorie</h1>
        <span class="nbr"><?php echo $nbr_service; ?></span>
    </div>

    <a href=categorie-form-add.php class='btn btn-success ttip' data-bs-toggle='tooltip' title='Ajouter un categorie'><i class='fa-solid fa-plus'></i></a>

    <a href=categorie-print.php class='btn btn-secondary' data-bs-toggle='tooltip' title='Imprimer tous les categorie'><i class="fa-solid fa-print"></i></a>

    <br>
    <br>
    <div class="card shadow">
        <div class="card-body">
            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                        <th>Id Categorie</th>
                        <th>Titre Categorie </th>
                        <th class="colm"></th>
                    </tr>
                </thead>
                <tbody>
<?php

while ($data = mysqli_fetch_assoc($res))
{
    $id= $data['idc'];
    echo "<tr>";
    echo "<td>" . $data['idc'];
    echo "<td>" . $data['titrec'];
    echo "<td> <a href=categorie-form-update.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Modifier cette ligne'><i class='fa-solid fa-pencil'></i></a>";
    echo " <a href=categorie-form-delete.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Supprimer cette ligne'><i class='fa-solid fa-trash-can iconrouge'></i></a>";
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
