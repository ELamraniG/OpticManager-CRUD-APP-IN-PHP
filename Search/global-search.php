<?php
require("../head.php");
require("../connexion.php");

$q = trim(isset($_GET['q']) ? $_GET['q'] : '');
$results = array();

if ($q !== '') {
    $like = mysqli_real_escape_string($con, '%' . $q . '%');

    $r = "SELECT idl AS id, CONCAT(nom, ' ', prenom) AS title, email AS detail
          FROM client WHERE nom LIKE '$like' OR prenom LIKE '$like' OR email LIKE '$like' LIMIT 20";
    $results['Clients'] = mysqli_fetch_all(mysqli_query($con, $r), MYSQLI_ASSOC);

    $r = "SELECT idpatient AS id, CONCAT(nom, ' ', prenom) AS title, telephone AS detail
          FROM patients WHERE nom LIKE '$like' OR prenom LIKE '$like' OR telephone LIKE '$like' LIMIT 20";
    $results['Patients'] = mysqli_fetch_all(mysqli_query($con, $r), MYSQLI_ASSOC);

    $r = "SELECT idproduit AS id, nomproduit AS title, marque AS detail
          FROM produit WHERE nomproduit LIKE '$like' OR marque LIKE '$like' OR notes LIKE '$like' LIMIT 20";
    $results['Produits'] = mysqli_fetch_all(mysqli_query($con, $r), MYSQLI_ASSOC);

    $r = "SELECT idf AS id, nom AS title, email AS detail
          FROM fournisseur WHERE nom LIKE '$like' OR contact LIKE '$like' OR email LIKE '$like' LIMIT 20";
    $results['Fournisseurs'] = mysqli_fetch_all(mysqli_query($con, $r), MYSQLI_ASSOC);
}
?>
<div class="container" style="max-width: 1000px">
    <h1 class="h2 mb-4">Recherche globale</h1>

    <form class="input-group mb-4">
        <input name="q" class="form-control form-control-lg" value="<?php echo e($q); ?>" placeholder="Nom, email, produit, téléphone...">
        <button class="btn btn-primary">Rechercher</button>
    </form>

    <?php if ($q !== '') { ?>
        <?php foreach ($results as $group => $rows) { ?>
        <div class="card shadow-sm mb-3">
            <div class="card-header"><strong><?php echo e($group); ?></strong> <span class="badge bg-secondary"><?php echo count($rows); ?></span></div>
            <div class="list-group list-group-flush">
                <?php if (!$rows) { ?><div class="list-group-item text-muted">Aucun résultat.</div><?php } ?>
                <?php foreach ($rows as $row) { ?>
                <div class="list-group-item d-flex justify-content-between">
                    <span><?php echo e($row['title']); ?></span>
                    <small class="text-muted"><?php echo e($row['detail']); ?></small>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    <?php } ?>
</div>
<?php require("../footer.php"); ?>
