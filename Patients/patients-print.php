<?php
require("../head.php");
require("../connexion.php");
$r = "select * from patients";
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
        <h1 class="display-4">Liste des Patients - Impression</h1>
        <div>
            <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print"></i> Imprimer</button>
            <a href="patients-list.php" class="btn btn-secondary">Retour</a>
        </div>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Date Naissance</th>
                <th>Sexe</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>Adresse</th>
            </tr>
        </thead>
        <tbody>
<?php
while ($data = mysqli_fetch_assoc($res))
{
    echo "<tr>";
    echo "<td>" . $data['idpatient'] . "</td>";
    echo "<td>" . $data['nom'] . "</td>";
    echo "<td>" . $data['prenom'] . "</td>";
    echo "<td>" . $data['datenaissance'] . "</td>";
    echo "<td>" . $data['sexe'] . "</td>";
    echo "<td>" . $data['telephone'] . "</td>";
    echo "<td>" . $data['email'] . "</td>";
    echo "<td>" . $data['adresse'] . "</td>";
    echo "</tr>";
}
mysqli_close($con);
?>
        </tbody>
    </table>
</div>

<?php require("../footer.php"); ?>
