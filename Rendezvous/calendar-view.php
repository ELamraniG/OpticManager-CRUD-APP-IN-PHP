<?php
require("../head.php");
require("../connexion.php");
require("../fonctions.php");

$current_month = isset($_GET['month']) ? intval($_GET['month']) : date('m');
$current_year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

if ($current_month < 1) { $current_month = 12; $current_year--; }
if ($current_month > 12) { $current_month = 1; $current_year++; }

$first_day = mktime(0, 0, 0, $current_month, 1, $current_year);
$month_name = strftime('%B %Y', $first_day);
$days_in_month = date('t', $first_day);
$first_day_of_week = date('w', $first_day);

$start_date = "$current_year-" . sprintf('%02d', $current_month) . "-01";
$end_date = "$current_year-" . sprintf('%02d', $current_month) . "-$days_in_month";

$appointments_query = "SELECT r.daterendezvous, r.heurerendezvous, c.nom, c.prenom, r.notes, r.niveaudecredibilite
                       FROM rendezvous r
                       JOIN client c ON r.idclient = c.idl
                       WHERE r.daterendezvous BETWEEN '$start_date' AND '$end_date'
                       ORDER BY r.daterendezvous, r.heurerendezvous";

$appointments_result = mysqli_query($con, $appointments_query);
$appointments = array();

while ($appointment = mysqli_fetch_assoc($appointments_result)) {
    $day = date('j', strtotime($appointment['daterendezvous']));
    if (!isset($appointments[$day])) {
        $appointments[$day] = array();
    }
    $appointments[$day][] = $appointment;
}


$today = date('Y-m-d');
$today_appointments = mysqli_query($con, "SELECT r.heurerendezvous, c.nom, c.prenom, r.notes
                                         FROM rendezvous r
                                         JOIN client c ON r.idclient = c.idl
                                         WHERE r.daterendezvous = '$today'
                                         ORDER BY r.heurerendezvous");

$total_appointments = mysqli_num_rows(mysqli_query($con, "SELECT * FROM rendezvous WHERE daterendezvous BETWEEN '$start_date' AND '$end_date'"));
?>

<div class="container-fluid" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="display-4">
                    <i class="fas fa-calendar-alt"></i> 
                    Agenda des Rendez-vous
                </h1>
                <div>
                    <span class="badge bg-primary fs-6"><?php echo $total_appointments; ?> RDV ce mois</span>
                </div>
            </div>
        </div>
    </div>


    <div class="row mb-4">
        <div class="col-md-6">
            <div class="btn-group" role="group">
                <a href="?month=<?php echo ($current_month == 1) ? 12 : $current_month - 1; ?>&year=<?php echo ($current_month == 1) ? $current_year - 1 : $current_year; ?>" 
                   class="btn btn-outline-primary">
                    <i class="fas fa-chevron-left"></i> Mois Précédent
                </a>
                <button class="btn btn-primary" disabled>
                    <?php echo ucfirst(strftime('%B %Y', $first_day)); ?>
                </button>
                <a href="?month=<?php echo ($current_month == 12) ? 1 : $current_month + 1; ?>&year=<?php echo ($current_month == 12) ? $current_year + 1 : $current_year; ?>" 
                   class="btn btn-outline-primary">
                    Mois Suivant <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-6 text-end">
            <a href="../Rendezvous/rendezvous-form-add.php" class="btn btn-success">
                <i class="fas fa-plus"></i> Nouveau RDV
            </a>
            <a href="../Rendezvous/rendezvous-list.php" class="btn btn-secondary">
                <i class="fas fa-list"></i> Liste Complète
            </a>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-calendar"></i> Calendrier - <?php echo ucfirst(strftime('%B %Y', $first_day)); ?>
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center text-danger">Dim</th>
                                    <th class="text-center">Lun</th>
                                    <th class="text-center">Mar</th>
                                    <th class="text-center">Mer</th>
                                    <th class="text-center">Jeu</th>
                                    <th class="text-center">Ven</th>
                                    <th class="text-center text-primary">Sam</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $day_counter = 1;
                                $current_day = date('j');
                                $current_month_now = date('m');
                                $current_year_now = date('Y');
                                
                                for ($week = 0; $week < 6; $week++) {
                                    echo "<tr>";
                                    for ($day_of_week = 0; $day_of_week < 7; $day_of_week++) {
                                        if ($week == 0 && $day_of_week < $first_day_of_week) {
                                            echo "<td class='text-muted' style='height: 120px;'></td>";
                                        } elseif ($day_counter > $days_in_month) {
                                            echo "<td class='text-muted' style='height: 120px;'></td>";
                                        } else {
                                            $is_today = ($day_counter == $current_day && $current_month == $current_month_now && $current_year == $current_year_now);
                                            $has_appointments = isset($appointments[$day_counter]);
                                            
                                            echo "<td style='height: 120px; vertical-align: top; position: relative;' class='" . 
                                                 ($is_today ? 'bg-light-primary' : '') . "'>";
                                            
                                            echo "<div class='d-flex justify-content-between'>";
                                            echo "<span class='fw-bold " . ($is_today ? 'text-primary' : '') . "'>" . $day_counter . "</span>";
                                            if ($has_appointments) {
                                                echo "<span class='badge bg-danger rounded-pill'>" . count($appointments[$day_counter]) . "</span>";
                                            }
                                            echo "</div>";
                                            
                                            if ($has_appointments) {
                                                echo "<div class='mt-1'>";
                                                $count = 0;
                                                foreach ($appointments[$day_counter] as $apt) {
                                                    if ($count < 2) {
                                                        $credibility_color = '';
                                                        switch ($apt['niveaudecredibilite']) {
                                                            case 'haute': $credibility_color = 'success'; break;
                                                            case 'moyenne': $credibility_color = 'warning'; break;
                                                            case 'faible': $credibility_color = 'danger'; break;
                                                            default: $credibility_color = 'secondary';
                                                        }
                                                        echo "<div class='badge bg-$credibility_color text-wrap mb-1' style='font-size: 0.7em; max-width: 100%;'>";
                                                        echo substr($apt['heurerendezvous'], 0, 5) . " " . substr($apt['nom'], 0, 8);
                                                        echo "</div><br>";
                                                    }
                                                    $count++;
                                                }
                                                if (count($appointments[$day_counter]) > 2) {
                                                    echo "<small class='text-muted'>+" . (count($appointments[$day_counter]) - 2) . " autres</small>";
                                                }
                                                echo "</div>";
                                            }
                                            echo "</td>";
                                            $day_counter++;
                                        }
                                    }
                                    echo "</tr>";
                                    if ($day_counter > $days_in_month) break;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

 
        <div class="col-lg-4">
        
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-calendar-day"></i> Rendez-vous d'aujourd'hui
                    </h6>
                </div>
                <div class="card-body">
                    <?php if (mysqli_num_rows($today_appointments) > 0): ?>
                        <div class="list-group list-group-flush">
                            <?php while ($today_apt = mysqli_fetch_assoc($today_appointments)): ?>
                            <div class="list-group-item px-0">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1"><?php echo $today_apt['nom'] . ' ' . $today_apt['prenom']; ?></h6>
                                    <small class="text-primary fw-bold"><?php echo substr($today_apt['heurerendezvous'], 0, 5); ?></small>
                                </div>
                                <?php if (!empty($today_apt['notes'])): ?>
                                <p class="mb-1 small text-muted"><?php echo substr($today_apt['notes'], 0, 50) . '...'; ?></p>
                                <?php endif; ?>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center text-muted">
                            <i class="fas fa-calendar-times fa-3x mb-3"></i>
                            <p>Aucun rendez-vous aujourd'hui</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

     
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-bar"></i> Statistiques Rapides
                    </h6>
                </div>
                <div class="card-body">
                    <?php
                    $stats = array();
                    $stats['total_month'] = $total_appointments;
                    $stats['today'] = mysqli_num_rows(mysqli_query($con, "SELECT * FROM rendezvous WHERE daterendezvous = '$today'"));
                    $stats['week'] = mysqli_num_rows(mysqli_query($con, "SELECT * FROM rendezvous WHERE WEEK(daterendezvous) = WEEK(NOW())"));
                    $stats['high_priority'] = mysqli_num_rows(mysqli_query($con, "SELECT * FROM rendezvous WHERE niveaudecredibilite = 'haute' AND daterendezvous BETWEEN '$start_date' AND '$end_date'"));
                    ?>
                    
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="border rounded p-2">
                                <h4 class="text-primary mb-0"><?php echo $stats['today']; ?></h4>
                                <small class="text-muted">Aujourd'hui</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="border rounded p-2">
                                <h4 class="text-success mb-0"><?php echo $stats['week']; ?></h4>
                                <small class="text-muted">Cette semaine</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="border rounded p-2">
                                <h4 class="text-info mb-0"><?php echo $stats['total_month']; ?></h4>
                                <small class="text-muted">Ce mois</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="border rounded p-2">
                                <h4 class="text-warning mb-0"><?php echo $stats['high_priority']; ?></h4>
                                <small class="text-muted">Priorité haute</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-light-primary {
    background-color: rgba(0, 123, 255, 0.1) !important;
}

.table td {
    padding: 0.3rem;
}

.badge {
    font-size: 0.65em;
}
</style>

<?php
mysqli_close($con);
require("../footer.php");
?>
