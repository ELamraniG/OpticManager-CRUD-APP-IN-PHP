<?php
require("../head.php");
$active = 3;
require("../menu.php");
require("../connexion.php");

//La requête de jointure pour chercher les données de la table affecter
$r = "select employe.*, service.*, affecter.* 
from affecter, employe, service
where affecter.idemploye = employe.idemploye
and affecter.idservice = service.idservice";
$res = mysqli_query($con, $r);
$nbr_affecter = mysqli_num_rows($res);
?>

<!-- Fenêtre modal pour sélectionner en employé (Imprimer Etat = 2) -->
<div class="modal fade" id="myModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Imprimer l'historique des affectations d'un employé</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form id="printForm" action="affecter-print.php?etat=2" method="POST">
        <div class="modal-body">
            Sélectionnez un employé
            <select name="idemploye" class="form-select">
                <option selected disabled>Sélectionner un employé</option>
                <?php
                $r_employe = "select * from employe";
                $res_employe = mysqli_query($con, $r_employe);
                while ($data_employe = mysqli_fetch_assoc($res_employe))
                {
                    echo "<option value=".$data_employe['idemploye'].">";
                    echo $data_employe['nom'] . " " . $data_employe['prenom'];
                }
                ?>
            </select>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary" name="printButton">Imprimer</button>
        </div>
    </form>
    </div>
  </div>
</div>

<!-- Fenêtre modal pour sélectionner en service (Imprimer Etat = 3) -->
<div class="modal fade" id="myModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Imprimer les employés d'un service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form id="printForm" action="affecter-print.php?etat=3" method="POST">
        <div class="modal-body">
            Sélectionnez un service
            <select name="idservice" class="form-select">
                <option selected disabled>Sélectionner un service</option>
                <?php
                $r_service = "select * from service";
                $res_service = mysqli_query($con, $r_service);
                while ($data_service = mysqli_fetch_assoc($res_service))
                {
                    echo "<option value=".$data_service['idservice'].">";
                    echo $data_service['nomservice'];
                }
                ?>
            </select>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary" name="printButton">Imprimer</button>
        </div>
    </form>
    </div>
  </div>
</div>

<!--------------------------------------------------------------------------------------------->

<div class="container" style="margin-top: 100px;">
    <div class=entete-list>
        <h1 class="display-4">Liste des affectations</h1>
        <span class="nbr"><?php echo $nbr_affecter; ?></span>
    </div>
    <a href=affecter-form-add.php class='btn btn-success ttip' data-bs-toggle='tooltip' title='Ajouter un service'><i class='fa-solid fa-plus'></i></a>

<!--Bouton imprimer avec choix -->
    <a href=# class='btn btn-secondary' data-bs-toggle='tooltip' title='Imprimer' onclick='afficherListe()'><i class="fa-solid fa-print"></i></a>
    <div id="liste" style="display: none;">
      <ul>
        <li><a href="affecter-print.php?etat=1">Liste des affectations</a></li>
        <li><a href="#" class="employee-link" data-bs-toggle="modal" data-bs-target="#myModal1">Historique des affectations d'un employé</a></li>
        <li><a href="#" class="service-link" data-bs-toggle="modal" data-bs-target="#myModal2">Liste des affectations d'un service</a></li>
      </ul>
    </div>
    <script>
    function afficherListe() {
      var liste = document.getElementById('liste');
      if (liste.style.display === 'none') {
        liste.style.display = 'block';
      } else {
        liste.style.display = 'none';
      }
    }
    </script>
<!-- Fin bouton Imprimer --->



    <br>
    <br>
    <table id="example" class="table table-striped">
        <thead>
            <tr>
                <th>Id Employé</th>
                <th>Photo </th>
                <th>Nom </th>
                <th>Prénom </th>
                <th>Id Service </th>
                <th>Titre </th>
                <th>Date début </th>
                <th>Date fin </th>
                <th class="colm"></th>
            </tr>
        </thead>
        <tbody>
<?php

    while ($data = mysqli_fetch_assoc($res))
    {
$id= $data['idservice']."|".$data['idemploye']."|".$data['datedebut'];

echo "<tr>";
echo "<td>" . $data['idemploye'];
echo "<td><img src=../employe/images/" . $data['photo']. " width=40>";
echo "<td>" . $data['nom'];
echo "<td>" . $data['prenom'];
echo "<td>" . $data['idservice'];
echo "<td>" . $data['nomservice'];
echo "<td>" . $data['datedebut'];
echo "<td>" . $data['datefin'];
echo "<td> <a href=affecter-form-update.php?id=".$id." data-bs-toggle='tooltip' title='Modifier cette ligne'><i class='fa-solid fa-pencil'></i></a>";
echo " <a href=affecter-form-delete.php?id=".$id." data-bs-toggle='tooltip' title='Supprimer cette ligne'><i class='fa-solid fa-trash-can iconrouge'></i></a>";
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
