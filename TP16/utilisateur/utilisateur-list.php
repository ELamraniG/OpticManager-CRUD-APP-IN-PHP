<?php
require("../head.php");
$active = 4;
require("../menu.php");
require("../connexion.php");

//La requête de jointure pour chercher les données de la table utilisateur
$r = "select employe.*, utilisateur.*
from utilisateur, employe
where employe.idemploye = utilisateur.idemploye";
$res = mysqli_query($con, $r);
$nbr_utilisateur = mysqli_num_rows($res);
$aujourdhui = date("Y-m-d");
?>

<!-- Fenêtre modal pour sélectionner les 2 dates (Imprimer Etat = 1) ----------------------------->
<div class="modal fade" id="myModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Imprimer les utilisateurs entre 2 dates</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form id="printForm" action="utilisateur-print.php?etat=1" method="POST">
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
    <form id="printForm" action="utilisateur-print.php?etat=2" method="POST">
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
    <form id="printForm" action="utilisateur-print.php?etat=3" method="POST">
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
<!-- Fenêtre modal pour le utilisateur automatique ---------------------------------- ----------------->
<div class="modal fade" id="myModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">utilisateur automatique</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form id="printForm" action="utilisateur-auto.php" method="POST">
        <div class="modal-body">
            <div class="col">
                <div class="form-group">
                    <label>Date de utilisateur</label>
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
        <h1 class="display-4">Gestion des utilisateurs</h1>
        <span class="nbr"><?php echo $nbr_utilisateur; ?></span>
    </div>
<!--Bouton Ajouter avec choix -->

    <a href=utilisateur-form-add.php class='btn btn-success ttip' data-bs-toggle='tooltip' title='Ajouter un utilisateur'><i class='fa-solid fa-plus'></i></a>

<!--Bouton imprimer avec choix -->
    <a href=utilisateur-print.php class='btn btn-secondary' data-bs-toggle='tooltip' title='Imprimer les utilisateurs'><i class="fa-solid fa-print"></i></a>
<!-- Fin bouton Imprimer --->

    <br>
    <br>
    <div class="card shadow">
        <div class="card-body">
            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                        <th class="colm"></th>
                        <th class="colm"></th>
                        <th>Num</th>
                        <th>Id employé </th>
                        <th>Nom </th>
                        <th>Prénom </th>
                        <th>Type </th>
                        <th>login </th>
                        <th>Gérer </th>
                        <th>Service </th>
                        <th>Employé </th>
                        <th>lesaffectationsauxservices </th>
                        <th>pointage </th>
                        <th>pointageindividuel </th>
                        <th>pointageautomatique </th>
                        <th>tableaudebord </th>
                        <th>etatdesemployesparservice </th>
                        <th>etatdesaffectationsdunemploye </th>
                        <th>etatdespointagesentredatesdunemploye </th>
                        <th>parametre </th>
                        <th>gestiondesutilisateurs </th>
                        <th>configurationdelapplication </th>
                    </tr>
                </thead>
                <tbody>
<?php

    while ($data = mysqli_fetch_assoc($res))
    {
$id= $data['idutilisateur'];

echo "<tr>";

echo "<td> <a href=utilisateur-form-update.php?id=".$id." data-bs-toggle='tooltip' title='Modifier cette ligne'><i class='fa-solid fa-pencil'></i></a>";
echo "<td><a href=utilisateur-form-delete.php?id=".$id." data-bs-toggle='tooltip' title='Supprimer cette ligne'><i class='fa-solid fa-trash-can iconrouge'></i></a>";
echo "<td>" . $data['idutilisateur'];
echo "<td>" . $data['idemploye'];
echo "<td>" . $data['nom'];
echo "<td>" . $data['prenom'];
echo "<td>" . $data['typeutilisateur'];
echo "<td>" . $data['login'];
if ($data['gerer'] == 1) echo "<td><center><i class='fa-solid fa-check'></i>";
else echo "<td> ";
if ($data['service'] == 1) echo "<td><center><i class='fa-solid fa-check'></i>";
else echo "<td> ";
if ($data['employe'] == 1) echo "<td><center><i class='fa-solid fa-check'></i>";
else echo "<td> ";
if ($data['lesaffectationsauxservices'] == 1) echo "<td><center><i class='fa-solid fa-check'></i>";
else echo "<td> ";
if ($data['pointage'] == 1) echo "<td><center><i class='fa-solid fa-check'></i>";
else echo "<td> ";
if ($data['pointageindividuel'] == 1) echo "<td><center><i class='fa-solid fa-check'></i>";
else echo "<td> ";
if ($data['pointageautomatique'] == 1) echo "<td><center><i class='fa-solid fa-check'></i>";
else echo "<td> ";
if ($data['tableaudebord'] == 1) echo "<td><center><i class='fa-solid fa-check'></i>";
else echo "<td> ";
if ($data['etatdesemployesparservice'] == 1) echo "<td><center><i class='fa-solid fa-check'></i>";
else echo "<td> ";
if ($data['etatdesaffectationsdunemploy'] == 1) echo "<td><center><i class='fa-solid fa-check'></i>";
else echo "<td> ";
if ($data['etatdespointagesentredatesdunemploye'] == 1) echo "<td><center><i class='fa-solid fa-check'></i>";
else echo "<td> ";
if ($data['parametre'] == 1) echo "<td><center><i class='fa-solid fa-check'></i>";
else echo "<td> ";
if ($data['gestiondesutilisateurs'] == 1) echo "<td><center><i class='fa-solid fa-check'></i>";
else echo "<td> ";
if ($data['configurationdelapplication'] == 1) echo "<td><center><i class='fa-solid fa-check'></i>";
else echo "<td> ";


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
