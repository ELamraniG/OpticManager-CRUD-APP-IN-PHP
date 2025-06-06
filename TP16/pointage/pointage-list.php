<?php
require("../head.php");
$active = 4;
require("../menu.php");
require("../connexion.php");

//La requête de jointure pour chercher les données de la table pointage
$r = "select employe.*, service.*, pointage.*, affecter.*
from pointage, employe, service, affecter
where affecter.idemploye = employe.idemploye
and affecter.idservice = service.idservice
and pointage.idemploye = employe.idemploye";
$res = mysqli_query($con, $r);
$nbr_pointage = mysqli_num_rows($res);
$aujourdhui = date("Y-m-d");
?>

<!-- Fenêtre modal pour sélectionner les 2 dates (Imprimer Etat = 1) ----------------------------->
<div class="modal fade" id="myModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Imprimer les pointages entre 2 dates</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form id="printForm" action="pointage-print.php?etat=1" method="POST">
        <div class="modal-body">
            <div class="col">
                <div class="form-group">
                    <label>Date début</label>
                    <input type="date" class="form-control" name="dp1" value="<?php echo $aujourdhui; ?>">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Date Fin</label>
                    <input type="date" class="form-control" name="dp2" value="<?php echo $aujourdhui; ?>">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary" name="printButton">Imprimer</button>
        </div>
    </form>
    </div>
  </div>
</div>
<!------------------------------------------FIN MODAL 1--------------------------------------------->

<!-- Fenêtre modal pour sélectionner un employé et les 2 dates (Imprimer Etat = 2) ---------------->
<div class="modal fade" id="myModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Imprimer les employés d'un service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form id="printForm" action="pointage-print.php?etat=2" method="POST">
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

            <div class="col">
                <div class="form-group">
                    <label>Date début</label>
                    <input type="date" class="form-control" name="dp1" value="<?php echo $aujourdhui; ?>">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Date Fin</label>
                    <input type="date" class="form-control" name="dp2" value="<?php echo $aujourdhui; ?>">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary" name="printButton">Imprimer</button>
        </div>
    </form>
    </div>
  </div>
</div>
<!------------------------------------------FIN MODAL 2--------------------------------------------->
<!-- Fenêtre modal pour sélectionner un service et les 2 dates (Imprimer Etat = 3) ----------------->
<div class="modal fade" id="myModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Imprimer les employés d'un service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form id="printForm" action="pointage-print.php?etat=3" method="POST">
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

            <div class="col">
                <div class="form-group">
                    <label>Date début</label>
                    <input type="date" class="form-control" name="dp1" value="<?php echo $aujourdhui; ?>">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Date Fin</label>
                    <input type="date" class="form-control" name="dp2" value="<?php echo $aujourdhui; ?>">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary" name="printButton">Imprimer</button>
        </div>
    </form>
    </div>
  </div>
</div>
<!------------------------------------------FIN MODAL 3--------------------------------------------->
<!-- Fenêtre modal pour le pointage automatique ---------------------------------- ----------------->
<div class="modal fade" id="myModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pointage automatique</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form id="printForm" action="pointage-auto.php" method="POST">
        <div class="modal-body">
            <div class="col">
                <div class="form-group">
                    <label>Date de pointage</label>
                    <input type="date" class="form-control" name="ddp" value="<?php echo $aujourdhui; ?>">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary" name="printButton">Générer</button>
        </div>
    </form>
    </div>
  </div>
</div>
<!------------------------------------------FIN MODAL 4--------------------------------------------->

<div class="container" style="margin-top: 100px;">
    <div class=entete-list>
        <h1 class="display-4">Gestion des pointages</h1>
        <span class="nbr"><?php echo $nbr_pointage; ?></span>
    </div>
<!--Bouton Ajouter avec choix -->

    <a href=pointage-form-add.php class='btn btn-success ttip' data-bs-toggle='tooltip' title='Ajouter un pointage'><i class='fa-solid fa-plus'></i></a>

<!--Bouton imprimer avec choix -->
    <a href=# class='btn btn-secondary' data-bs-toggle='tooltip' title='Imprimer' onclick='afficherListe()'><i class="fa-solid fa-print"></i></a>
    <div id="liste" style="display: none;">
      <ul>
        <li><a href="pointage-print.php?etat=1" data-bs-toggle="modal" data-bs-target="#myModal1" >Liste des pointages entre 2 dates</a></li>
        <li><a href="#" class="employee-link" data-bs-toggle="modal" data-bs-target="#myModal2">Historique des pointages d'un employé entre 2 dates</a></li>
        <li><a href="#" class="service-link" data-bs-toggle="modal" data-bs-target="#myModal3">Historique des pointage d'un service entre 2 dates</a></li>
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

<!--Bouton pointage automatique -->
    <a href=# class='btn btn-warning'  title='Pointage automatique' data-bs-toggle="modal" data-bs-target="#myModal4"><i class="fa-solid fa-wand-magic-sparkles"></i></a>


    <br>
    <br>
    <div class="card shadow">
        <div class="card-body">
            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                        <th>Num</th>
                        <th>Id employé </th>
                        <th>Nom </th>
                        <th>Prénom </th>
                        <th>Titre </th>
                        <th>Date </th>
                        <th>Heure d'entrée </th>
                        <th>Heure de sortie </th>
                        <th>Statut </th>
                        <th>Notes </th>
                        <th class="colm"></th>
                    </tr>
                </thead>
                <tbody>
<?php

    while ($data = mysqli_fetch_assoc($res))
    {
$id= $data['idp'];

echo "<tr>";
echo "<td>" . $data['idp'];
echo "<td>" . $data['idemploye'];
echo "<td>" . $data['nom'];
echo "<td>" . $data['prenom'];
echo "<td>" . $data['nomservice'];
echo "<td>" . $data['datepointage'];
echo "<td>" . date('H:i', strtotime($data['heuredentree']));
echo "<td>" . date('H:i', strtotime($data['heuresortie']));
echo "<td>" . $data['status'];
echo "<td>" . $data['notes'];
echo "<td> <a href=pointage-form-update.php?id=".$id." data-bs-toggle='tooltip' title='Modifier cette ligne'><i class='fa-solid fa-pencil'></i></a>";
echo " <a href=pointage-form-delete.php?id=".$id." data-bs-toggle='tooltip' title='Supprimer cette ligne'><i class='fa-solid fa-trash-can iconrouge'></i></a>";
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
