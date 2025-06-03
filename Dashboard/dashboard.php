<?php
require("../head.php");
require("../connexion.php");


function count_rows($table)
{
    global $con;
    $res = mysqli_query($con, 'SELECT COUNT(*) AS total FROM `' . $table . '`');
    $row = mysqli_fetch_assoc($res);
    return (int) $row['total'];
}

$patients = count_rows('patients');
$clients = count_rows('client');
$products = count_rows('produit');
$suppliers = count_rows('fournisseur');

$res = mysqli_query($con, 'SELECT COUNT(*) AS total FROM produit WHERE qteenstock <= seuildalerte');
$lowStockCount = (int) mysqli_fetch_assoc($res)['total'];

$res = mysqli_query($con, 'SELECT COALESCE(SUM(prixdevente * qteenstock), 0) AS total FROM produit');
$stockValue = (float) mysqli_fetch_assoc($res)['total'];

$lowStock = mysqli_query($con, 'SELECT nomproduit, marque, qteenstock, seuildalerte
                                FROM produit
                                WHERE qteenstock <= seuildalerte
                                ORDER BY qteenstock ASC
                                LIMIT 8');

$recent = mysqli_query($con, 'SELECT p.nom, p.prenom, c.dateconsultation, c.motif
                              FROM consultations c
                              JOIN patients p ON p.idpatient = c.idpatient
                              ORDER BY c.dateconsultation DESC
                              LIMIT 8');
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 mb-1">Dashboard</h1>
            <p class="text-muted mb-0">Vue rapide du cabinet.</p>
        </div>
        <a class="btn btn-outline-primary" href="statistics.php">Statistiques</a>
    </div>

    <div class="row g-3 mb-4">
        <?php
        $stats = array(
            array('Patients', $patients, 'primary'),
            array('Clients', $clients, 'success'),
            array('Produits', $products, 'info'),
            array('Fournisseurs', $suppliers, 'secondary'),
            array('Alertes stock', $lowStockCount, 'warning'),
            array('Valeur du stock', number_format($stockValue, 2) . ' DH', 'dark')
        );
        foreach ($stats as $stat) {
        ?>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card card-stat shadow-sm border-0">
                <div class="card-body">
                    <div class="text-muted small"><?php echo e($stat[0]); ?></div>
                    <div class="fs-4 fw-bold text-<?php echo e($stat[2]); ?>"><?php echo e($stat[1]); ?></div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header d-flex justify-content-between">
                    <strong>Stock faible</strong>
                    <a href="../Stock/inventory-manager.php">Inventaire</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead><tr><th>Produit</th><th>Marque</th><th>Stock</th><th>Seuil</th></tr></thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($lowStock)) { ?>
                            <tr>
                                <td><?php echo e($row['nomproduit']); ?></td>
                                <td><?php echo e($row['marque']); ?></td>
                                <td><span class="badge bg-danger"><?php echo e($row['qteenstock']); ?></span></td>
                                <td><?php echo e($row['seuildalerte']); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header d-flex justify-content-between">
                    <strong>Consultations récentes</strong>
                    <a href="../Consultations/consultations-list.php">Toutes</a>
                </div>
                <div class="list-group list-group-flush">
                <?php while ($row = mysqli_fetch_assoc($recent)) { ?>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <strong><?php echo e($row['nom'] . ' ' . $row['prenom']); ?></strong>
                            <span class="text-muted"><?php echo e($row['dateconsultation']); ?></span>
                        </div>
                        <div class="small text-muted"><?php echo e($row['motif']); ?></div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
