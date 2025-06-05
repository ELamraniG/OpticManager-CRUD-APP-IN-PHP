<?php
require("../head.php");
require("../connexion.php");
$r = "SELECT idutilisateur, nomutilisateur, role, nomcomplet, actif
      FROM utilisateurs";
$res = mysqli_query($con, $r);
$nbr_service = mysqli_num_rows($res);
require("../fonctions.php");
?>
<div class="container" style="margin-top: 100px;">
    <div class=entete-list>
        <h1 class="display-4">Liste des Utilisateurs</h1>
        <span class="nbr"><?php echo $nbr_service; ?></span>
    </div>

    <a href=utilisateurs-form-add.php class='btn btn-success ttip' data-bs-toggle='tooltip' title='Ajouter un utilisateur'><i class='fa-solid fa-plus'></i></a>

    <a href=utilisateurs-print.php class='btn btn-secondary' data-bs-toggle='tooltip' title='Imprimer tous les utilisateurs'><i class="fa-solid fa-print"></i></a>

    <br>
    <br>
    <table id="example" class="table table-striped table-responsive">
        <thead>
            <tr>
                <th>Id Utilisateur</th>
                <th>Nom d'utilisateur</th>
                <th>Rôle</th>
                <th>Nom complet</th>
                <th>Statut</th>
                <th class="colm"></th>
                <th class="colm"></th>
            </tr>
        </thead>
        <tbody>
<?php

while ($data = mysqli_fetch_assoc($res))
{
    $id= $data['idutilisateur'];
    echo "<tr>";
    echo "<td>" . $data['idutilisateur'];
    echo "<td>" . $data['nomutilisateur'];
    echo "<td>" . $data['role'];
    echo "<td>" . $data['nomcomplet'];
    echo "<td>" . ($data['actif'] == 1 ? 'Actif' : 'Inactif');
    echo "<td> <a href=utilisateurs-form-update.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Modifier cette ligne'><i class='fa-solid fa-pencil'></i></a>";
    echo "<td> <a href=utilisateurs-form-delete.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Supprimer cette ligne'><i class='fa-solid fa-trash-can iconrouge'></i></a>";
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
