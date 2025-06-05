<?php
require("../head.php");
require("../connexion.php");
$r = "SELECT c.idconsultation, c.dateconsultation, c.motif, c.observations, c.prescriptionpdf, 
      CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet
      FROM consultations c, patients p
      WHERE c.idpatient = p.idpatient";
$res = mysqli_query($con, $r);
require("../fonctions.php");
?>

<style>
    @media print {
        .btn, .navbar, .no-print {
            display: none !important;
        }
        body {
            font-size: 12px;
        }
        table {
            width: 100% !important;
        }
    }
</style>

<div class="container" style="margin-top: 100px;">
    <div class="d-flex justify-content-between align-items-center mb-3 no-print">
        <h1 class="display-4">Liste des Consultations - Impression</h1>
        <div>
            <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print"></i> Imprimer</button>
            <a href="consultations-list.php" class="btn btn-secondary">Retour</a>
        </div>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Patient</th>
                <th>Date</th>
                <th>Motif</th>
                <th>Observations</th>
                <th>Prescription</th>
            </tr>
        </thead>
        <tbody>
<?php
while ($data = mysqli_fetch_assoc($res))
{
    echo "<tr>";
    echo "<td>" . $data['idconsultation'] . "</td>";
    echo "<td>" . $data['patient_nom_complet'] . "</td>";
    echo "<td>" . $data['dateconsultation'] . "</td>";
    echo "<td>" . $data['motif'] . "</td>";
    echo "<td>" . $data['observations'] . "</td>";
    echo "<td>" . $data['prescriptionpdf'] . "</td>";
    echo "</tr>";
}
mysqli_close($con);
?>
        </tbody>
    </table>
</div>

<?php require("../footer.php"); ?>
