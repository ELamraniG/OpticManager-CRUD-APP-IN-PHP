<?php
require("../head.php");
require("../connexion.php");
$r = "SELECT o.idordonnance, o.oeil, o.sphere, o.cylindre, o.axe, o.addition, o.typecorrection,
      c.idconsultation, c.dateconsultation, CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet
      FROM ordonnances o, consultations c, patients p
      WHERE o.idconsultation = c.idconsultation
      AND c.idpatient = p.idpatient";
$res = mysqli_query($con, $r);
$nbr_service = mysqli_num_rows($res);
require("../fonctions.php");
?>
<div class="container" style="margin-top: 100px;">
    <div class=entete-list>
        <h1 class="display-4">Liste des Ordonnances</h1>
        <span class="nbr"><?php echo $nbr_service; ?></span>
    </div>

    <a href=ordonnances-form-add.php class='btn btn-success ttip' data-bs-toggle='tooltip' title='Ajouter une ordonnance'><i class='fa-solid fa-plus'></i></a>

    <a href=ordonnances-print.php class='btn btn-secondary' data-bs-toggle='tooltip' title='Imprimer toutes les ordonnances'><i class="fa-solid fa-print"></i></a>

    <br>
    <br>
    <div class="card shadow">
        <div class="card-body">
            <table id="example" class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Id Ordonnance</th>
                        <th>Patient</th>
                        <th>Consultation</th>
                        <th>Oeil</th>
                        <th>Sphère</th>
                        <th>Cylindre</th>
                        <th>Axe</th>
                        <th>Addition</th>
                        <th>Type Correction</th>
                        <th class="colm"></th>
                        <th class="colm"></th>
                    </tr>
                </thead>
                <tbody>
<?php

while ($data = mysqli_fetch_assoc($res))
{
    $id= $data['idordonnance'];
    echo "<tr>";
    echo "<td>" . $data['idordonnance'];
    echo "<td>" . $data['patient_nom_complet'];
    echo "<td>" . $data['idconsultation'] . " (" . $data['dateconsultation'] . ")";
    echo "<td>" . $data['oeil'];
    echo "<td>" . $data['sphere'];
    echo "<td>" . $data['cylindre'];
    echo "<td>" . $data['axe'];
    echo "<td>" . $data['addition'];
    echo "<td>" . $data['typecorrection'];
    echo "<td> <a href=ordonnances-form-update.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Modifier cette ligne'><i class='fa-solid fa-pencil'></i></a>";
    echo "<td> <a href=ordonnances-form-delete.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Supprimer cette ligne'><i class='fa-solid fa-trash-can iconrouge'></i></a>";
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
