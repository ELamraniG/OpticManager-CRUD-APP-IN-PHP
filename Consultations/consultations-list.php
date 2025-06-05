<?php
require("../head.php");
require("../connexion.php");
$r = "SELECT c.idconsultation, c.dateconsultation, c.motif, c.observations, c.prescriptionpdf, 
      CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet, p.idpatient
      FROM consultations c, patients p
      WHERE c.idpatient = p.idpatient";
$res = mysqli_query($con, $r);
$nbr_service = mysqli_num_rows($res);
require("../fonctions.php");
?>
<div class="container" style="margin-top: 100px;">
    <div class=entete-list>
        <h1 class="display-4">Liste des Consultations</h1>
        <span class="nbr"><?php echo $nbr_service; ?></span>
    </div>

    <a href=consultations-form-add.php class='btn btn-success ttip' data-bs-toggle='tooltip' title='Ajouter une consultation'><i class='fa-solid fa-plus'></i></a>

    <a href=consultations-print.php class='btn btn-secondary' data-bs-toggle='tooltip' title='Imprimer toutes les consultations'><i class="fa-solid fa-print"></i></a>

    <br>
    <br>
    <table id="example" class="table table-striped table-responsive">
        <thead>
            <tr>
                <th>Id Consultation</th>
                <th>Patient</th>
                <th>Date Consultation</th>
                <th>Motif</th>
                <th>Observations</th>
                <th>Prescription PDF</th>
                <th class="colm"></th>
                <th class="colm"></th>
            </tr>
        </thead>
        <tbody>
<?php

while ($data = mysqli_fetch_assoc($res))
{
    $id= $data['idconsultation'];
    echo "<tr>";
    echo "<td>" . $data['idconsultation'];
    echo "<td>" . $data['patient_nom_complet'];
    echo "<td>" . $data['dateconsultation'];
    echo "<td>" . $data['motif'];
    echo "<td>" . $data['observations'];
    echo "<td>" . $data['prescriptionpdf'];
    echo "<td> <a href=consultations-form-update.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Modifier cette ligne'><i class='fa-solid fa-pencil'></i></a>";
    echo "<td> <a href=consultations-form-delete.php?id=".urlencode($id)." data-bs-toggle='tooltip' title='Supprimer cette ligne'><i class='fa-solid fa-trash-can iconrouge'></i></a>";
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
