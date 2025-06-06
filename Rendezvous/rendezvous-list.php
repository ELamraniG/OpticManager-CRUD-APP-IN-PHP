<?php
require("../head.php");
require("../connexion.php");
$r = "SELECT idrendezvous, client.nom, cabinet.nomcabinet, daterendezvous, notes, heurerendezvous, niveaudecredibilite 
FROM rendezvous, client, cabinet
WHERE rendezvous.idclient = client.idl
AND rendezvous.idcabinet = cabinet.idcabinet";
$res = mysqli_query($con, $r);
$nbr_service = mysqli_num_rows($res);
require("../fonctions.php");
?>
<div class="container" style="margin-top: 100px;">
    <div class=entete-list>
        <h1 class="display-4">Liste des Rendez Vous</h1>
        <span class="nbr"><?php echo $nbr_service; ?></span>
    </div>

    <a href=rendezvous-form-add.php class='btn btn-success ttip' data-bs-toggle='tooltip' title='Ajouter un rendezvous'><i class='fa-solid fa-plus'></i></a>

    <a href=rendezvous-print.php class='btn btn-secondary' data-bs-toggle='tooltip' title='Imprimer tous les rendezvous'><i class="fa-solid fa-print"></i></a>

    <br>
    <br>
    <div class="card shadow">
        <div class="card-body">
            <table id="example" class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Id Rendezvous</th>
                        <th>Client Nom</th>
                        <th>Nom Cabinet</th>
                        <th>Date rendezvous</th>
                        <th>Heure rendezvous</th>
                        <th>Niveau de Credibilite</th>
                        <th>Notes</th>
                        <th class="colm"></th>
                        <th class="colm"></th>
                    </tr>
                </thead>
                <tbody>
<?php

while ($data = mysqli_fetch_assoc($res))
{
    $id= $data['idrendezvous'];
    echo "<tr>";
    echo "<td>" . $data['idrendezvous'];
    echo "<td>" . $data['nom'];
    echo "<td>" . $data['nomcabinet'];
    echo "<td>" . $data['daterendezvous'];
    echo "<td>" . $data['heurerendezvous'];
    echo "<td>" . $data['niveaudecredibilite'];
    echo "<td>" . $data['notes'];
    echo "<td> <a href=rendezvous-form-update.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Modifier cette ligne'><i class='fa-solid fa-pencil'></i></a>";
    echo "<td> <a href=rendezvous-form-delete.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Supprimer cette ligne'><i class='fa-solid fa-trash-can iconrouge'></i></a>";
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
