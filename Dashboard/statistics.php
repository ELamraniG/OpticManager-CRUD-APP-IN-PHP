<?php
require("../head.php");
require("../connexion.php");


$monthSales = mysqli_query($con, "SELECT DATE(datevente) AS day, SUM(montanttotal) AS total
                                  FROM ventes
                                  WHERE datevente >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                                  GROUP BY DATE(datevente)
                                  ORDER BY day");

$monthConsultations = mysqli_query($con, "SELECT dateconsultation AS day, COUNT(*) AS total
                                          FROM consultations
                                          WHERE dateconsultation >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                                          GROUP BY dateconsultation
                                          ORDER BY day");

$salesRows = mysqli_fetch_all($monthSales, MYSQLI_ASSOC);
$consultRows = mysqli_fetch_all($monthConsultations, MYSQLI_ASSOC);

$res = mysqli_query($con, 'SELECT COUNT(*) AS total FROM patients');
$totalPatients = mysqli_fetch_assoc($res)['total'];

$res = mysqli_query($con, 'SELECT COUNT(*) AS total FROM produit WHERE qteenstock <= seuildalerte');
$lowStock = mysqli_fetch_assoc($res)['total'];

$res = mysqli_query($con, 'SELECT COALESCE(SUM(montanttotal), 0) AS total FROM ventes');
$totalSales = mysqli_fetch_assoc($res)['total'];
?>
<div class="container">
    <h1 class="h2 mb-4">Statistiques</h1>

    <div class="row g-3 mb-4">
        <div class="col-md-4"><div class="card card-body shadow-sm"><small class="text-muted">Patients</small><strong class="fs-3"><?php echo e($totalPatients); ?></strong></div></div>
        <div class="col-md-4"><div class="card card-body shadow-sm"><small class="text-muted">Produits en alerte</small><strong class="fs-3"><?php echo e($lowStock); ?></strong></div></div>
        <div class="col-md-4"><div class="card card-body shadow-sm"><small class="text-muted">Total ventes</small><strong class="fs-3"><?php echo e(number_format((float) $totalSales, 2)); ?> DH</strong></div></div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header"><strong>Ventes - 30 derniers jours</strong></div>
                <div class="card-body"><canvas id="salesChart"></canvas></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header"><strong>Consultations - 30 derniers jours</strong></div>
                <div class="card-body"><canvas id="consultChart"></canvas></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('salesChart'), {
    type: 'line',
    data: {
        labels: <?php echo json_encode(array_column($salesRows, 'day')); ?>,
        datasets: [{ label: 'DH', data: <?php echo json_encode(array_column($salesRows, 'total')); ?> }]
    }
});
new Chart(document.getElementById('consultChart'), {
    type: 'bar',
    data: {
        labels: <?php echo json_encode(array_column($consultRows, 'day')); ?>,
        datasets: [{ label: 'Consultations', data: <?php echo json_encode(array_column($consultRows, 'total')); ?> }]
    }
});
</script>
<?php require("../footer.php"); ?>
