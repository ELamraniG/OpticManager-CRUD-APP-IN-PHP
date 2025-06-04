<?php
require("../head.php");
require("../connexion.php");

$q = trim(isset($_GET['q']) ? $_GET['q'] : '');
$rows = array();

if ($q !== '') {
    $like = mysqli_real_escape_string($con, '%' . $q . '%');
    $r = "SELECT idpatient, nom, prenom, datenaissance, telephone, email, adresse
          FROM patients
          WHERE nom LIKE '$like' OR prenom LIKE '$like' OR telephone LIKE '$like' OR email LIKE '$like'
          ORDER BY nom, prenom";
    $rows = mysqli_fetch_all(mysqli_query($con, $r), MYSQLI_ASSOC);
}
?>
<div class="container" style="max-width: 950px">
    <h1 class="h2 mb-3">Recherche patients</h1>

    <form class="input-group mb-4">
        <input name="q" class="form-control" value="<?php echo e($q); ?>" placeholder="Nom, prénom, téléphone ou email">
        <button class="btn btn-primary">Rechercher</button>
    </form>

    <?php if ($q !== '') { ?>
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead><tr><th>Patient</th><th>Naissance</th><th>Téléphone</th><th>Email</th><th></th></tr></thead>
                <tbody>
                <?php if (!$rows) { ?><tr><td colspan="5" class="text-center text-muted py-4">Aucun patient trouvé.</td></tr><?php } ?>
                <?php foreach ($rows as $row) { ?>
                <tr>
                    <td><?php echo e($row['nom'] . ' ' . $row['prenom']); ?></td>
                    <td><?php echo e($row['datenaissance']); ?></td>
                    <td><?php echo e($row['telephone']); ?></td>
                    <td><?php echo e($row['email']); ?></td>
                    <td><a class="btn btn-sm btn-outline-primary" href="patients-form-update.php?id=<?php echo urlencode($row['idpatient']); ?>">Ouvrir</a></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php } ?>
</div>
<?php require("../footer.php"); ?>
