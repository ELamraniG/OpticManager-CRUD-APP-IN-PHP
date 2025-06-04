<?php
require("../head.php");
require("../connexion.php");

$month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');
if (!preg_match('/^\d{4}-\d{2}$/', $month)) {
    $month = date('Y-m');
}

$start = $month . '-01';
$end = date('Y-m-t', strtotime($start));

$start_sql = mysqli_real_escape_string($con, $start);
$end_sql = mysqli_real_escape_string($con, $end);
$r = "SELECT r.daterendezvous, r.heurerendezvous, CONCAT(c.nom, ' ', c.prenom) AS client
      FROM rendezvous r
      JOIN client c ON c.idl = r.idclient
      WHERE r.daterendezvous BETWEEN '$start_sql' AND '$end_sql'
      ORDER BY r.daterendezvous, r.heurerendezvous";
$rows = mysqli_fetch_all(mysqli_query($con, $r), MYSQLI_ASSOC);

$byDay = array();
foreach ($rows as $row) {
    $byDay[$row['daterendezvous']][] = $row;
}

$days = (int) date('t', strtotime($start));
$firstWeekday = (int) date('N', strtotime($start));
?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h2">Calendrier rendez-vous</h1>
        <form>
            <input type="month" name="month" value="<?php echo e($month); ?>" onchange="this.form.submit()" class="form-control">
        </form>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row row-cols-7 g-2 fw-semibold text-center mb-2">
                <?php foreach (array('Lun','Mar','Mer','Jeu','Ven','Sam','Dim') as $day) { ?>
                    <div class="col"><?php echo e($day); ?></div>
                <?php } ?>
            </div>

            <div class="row row-cols-7 g-2">
                <?php for ($blank = 1; $blank < $firstWeekday; $blank++) { ?>
                    <div class="col"><div class="border rounded p-2 h-100 bg-light" style="min-height:110px"></div></div>
                <?php } ?>

                <?php for ($day = 1; $day <= $days; $day++) { ?>
                    <?php $date = $month . '-' . str_pad((string) $day, 2, '0', STR_PAD_LEFT); ?>
                    <div class="col">
                        <div class="border rounded p-2 h-100" style="min-height:110px">
                            <strong><?php echo $day; ?></strong>
                            <?php foreach ((isset($byDay[$date]) ? $byDay[$date] : array()) as $rdv) { ?>
                                <div class="small bg-primary-subtle rounded p-1 mt-1">
                                    <?php echo e(substr($rdv['heurerendezvous'], 0, 5)); ?> <?php echo e($rdv['client']); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
