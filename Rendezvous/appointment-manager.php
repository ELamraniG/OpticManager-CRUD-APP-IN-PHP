<?php
session_start();
if(!isset($_SESSION['v_session']) || $_SESSION['v_session'] != 1) {
    header('Location: ../index-main.php');
    exit();
}

include('../connexion.php');

// Get all patients and clients for the select dropdown
$patients_query = "SELECT idpatient as id, CONCAT(nom, ' ', prenom) as nom_complet, telephone, 'patient' as type 
                   FROM patients 
                   ORDER BY nom, prenom";
$patients_result = mysqli_query($con, $patients_query);

$clients_query = "SELECT idl as id, CONCAT(nom, ' ', prenom) as nom_complet, telephone, 'client' as type 
                  FROM client 
                  ORDER BY nom, prenom";
$clients_result = mysqli_query($con, $clients_query);

// Traitement des actions AJAX
if(isset($_POST['action'])) {
    header('Content-Type: application/json');
    
    if($_POST['action'] == 'get_appointments') {
        $date = mysqli_real_escape_string($con, $_POST['date']);
        $query = "SELECT r.*, 
                         COALESCE(p.nom, c.nom) as nom_patient,
                         COALESCE(p.prenom, c.prenom) as prenom_patient,
                         COALESCE(p.telephone, c.telephone) as telephone_patient
                  FROM rendezvous r 
                  LEFT JOIN patients p ON r.idpatient = p.idpatient
                  LEFT JOIN client c ON r.idclient = c.idl
                  WHERE DATE(r.daterendezvous) = '$date' 
                  ORDER BY r.heurerendezvous";
        
        $result = mysqli_query($con, $query);
        $appointments = array();
        
        while($row = mysqli_fetch_assoc($result)) {
            $appointments[] = $row;
        }
        
        echo json_encode($appointments);
        exit();
    }
    
    if($_POST['action'] == 'add_appointment') {
        $date = mysqli_real_escape_string($con, $_POST['date']);
        $heure = mysqli_real_escape_string($con, $_POST['heure']);
        $patient_data = mysqli_real_escape_string($con, $_POST['patient_data']);
        $notes = mysqli_real_escape_string($con, $_POST['notes']);
        
        // Parse patient data (format: "type:id")
        $patient_info = explode(':', $patient_data);
        $patient_type = $patient_info[0];
        $patient_id = $patient_info[1];
        
        if($patient_type == 'patient') {
            $query = "INSERT INTO rendezvous (daterendezvous, heurerendezvous, idpatient, notes) 
                     VALUES ('$date $heure', '$heure', '$patient_id', '$notes')";
        } else {
            $query = "INSERT INTO rendezvous (daterendezvous, heurerendezvous, idclient, notes) 
                     VALUES ('$date $heure', '$heure', '$patient_id', '$notes')";
        }
        
        if(mysqli_query($con, $query)) {
            echo json_encode(array('success' => true, 'message' => 'Rendez-vous ajouté avec succès'));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Erreur lors de l\'ajout'));
        }
        exit();
    }
}

// Récupérer les statistiques
$today = date('Y-m-d');
$query_today = "SELECT COUNT(*) as nb FROM rendezvous WHERE DATE(daterendezvous) = '$today'";
$result_today = mysqli_query($con, $query_today);
$rdv_today_data = mysqli_fetch_assoc($result_today);
$rdv_today = $rdv_today_data['nb'];

$query_week = "SELECT COUNT(*) as nb FROM rendezvous WHERE WEEK(daterendezvous) = WEEK(NOW())";
$result_week = mysqli_query($con, $query_week);
$rdv_week_data = mysqli_fetch_assoc($result_week);
$rdv_week = $rdv_week_data['nb'];

$query_month = "SELECT COUNT(*) as nb FROM rendezvous WHERE MONTH(daterendezvous) = MONTH(NOW())";
$result_month = mysqli_query($con, $query_month);
$rdv_month_data = mysqli_fetch_assoc($result_month);
$rdv_month = $rdv_month_data['nb'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Rendez-vous - OptiRent</title>
    <style>
        .appointment-card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }
        .appointment-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }
        .time-slot {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            min-height: 80px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .time-slot:hover {
            background: #e9ecef;
        }
        .time-slot.occupied {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .time-slot.occupied:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }
        .calendar-nav {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            margin-bottom: 20px;
        }
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
        }
        .patient-search-result {
            cursor: pointer;
            padding: 10px;
            border-bottom: 1px solid #eee;
            transition: background 0.3s ease;
        }
        .patient-search-result:hover {
            background: #f8f9fa;
        }
        .time-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
    </style>
</head>
<body class="bg-light">
    <?php include('../head.php'); ?>

    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-calendar-alt me-3"></i>Gestionnaire de Rendez-vous</h1>
            <p class="mb-0">Planifiez et gérez efficacement vos rendez-vous</p>
        </div>
    </div>

    <div class="container">
        <!-- Statistiques -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-calendar-day fa-2x text-primary mb-2"></i>
                    <h4 class="text-primary"><?php echo $rdv_today; ?></h4>
                    <small class="text-muted">Aujourd'hui</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-calendar-week fa-2x text-success mb-2"></i>
                    <h4 class="text-success"><?php echo $rdv_week; ?></h4>
                    <small class="text-muted">Cette semaine</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-calendar fa-2x text-info mb-2"></i>
                    <h4 class="text-info"><?php echo $rdv_month; ?></h4>
                    <small class="text-muted">Ce mois</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                    <h4 class="text-warning" id="current-time"></h4>
                    <small class="text-muted">Heure actuelle</small>
                </div>
            </div>
        </div>

        <!-- Navigation du calendrier -->
        <div class="row">
            <div class="col-12">
                <div class="calendar-nav">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-calendar"></i>
                                </span>
                                <input type="date" class="form-control" id="selected-date" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <button class="btn btn-outline-primary me-2" onclick="changeDate(-1)">
                                <i class="fas fa-chevron-left"></i> Jour précédent
                            </button>
                            <button class="btn btn-outline-primary me-2" onclick="setToday()">
                                <i class="fas fa-calendar-day"></i> Aujourd'hui
                            </button>
                            <button class="btn btn-outline-primary" onclick="changeDate(1)">
                                Jour suivant <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Planning des rendez-vous -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-clock me-2"></i>
                            Planning du <span id="display-date"><?php echo date('d/m/Y'); ?></span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="time-grid" id="time-slots">
                            <!-- Les créneaux seront chargés par JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de détail du RDV -->
    <div class="modal fade" id="appointmentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-calendar-check me-2"></i>Détails du Rendez-vous</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="appointment-details">
                    <!-- Contenu chargé dynamiquement -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentDate = new Date();

        // Mise à jour de l'heure
        function updateCurrentTime() {
            const now = new Date();
            document.getElementById('current-time').textContent = now.toLocaleTimeString('fr-FR');
        }
        setInterval(updateCurrentTime, 1000);
        updateCurrentTime();

        // Changement de date
        function changeDate(days) {
            currentDate.setDate(currentDate.getDate() + days);
            updateCalendar();
        }

        function setToday() {
            currentDate = new Date();
            updateCalendar();
        }

        function updateCalendar() {
            const dateStr = currentDate.toISOString().split('T')[0];
            document.getElementById('selected-date').value = dateStr;
            document.getElementById('display-date').textContent = currentDate.toLocaleDateString('fr-FR');
            loadAppointments(dateStr);
        }

        // Gestionnaire de changement de date
        document.getElementById('selected-date').addEventListener('change', function() {
            currentDate = new Date(this.value);
            document.getElementById('display-date').textContent = currentDate.toLocaleDateString('fr-FR');
            loadAppointments(this.value);
        });

        // Charger les rendez-vous
        function loadAppointments(date) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    try {
                        var appointments = JSON.parse(xhr.responseText);
                        generateTimeSlots(appointments);
                    } catch (e) {
                        console.error('Error parsing appointments:', e);
                        console.log('Response:', xhr.responseText);
                        generateTimeSlots([]);
                    }
                }
            };
            xhr.send('action=get_appointments&date=' + date);
        }

        // Générer les créneaux horaires
        function generateTimeSlots(appointments) {
            const container = document.getElementById('time-slots');
            container.innerHTML = '';

            const slots = ['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', 
                          '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30'];

            slots.forEach(time => {
                const appointment = appointments.find(app => app.heurerendezvous === time + ':00');
                const slot = document.createElement('div');
                
                if (appointment) {
                    slot.className = 'time-slot occupied';
                    slot.innerHTML = `
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>${time}</strong><br>
                                <small>${appointment.nom_patient} ${appointment.prenom_patient}</small>
                            </div>
                            <i class="fas fa-eye"></i>
                        </div>
                    `;
                    slot.onclick = () => showAppointmentDetails(appointment);
                } else {
                    slot.className = 'time-slot';
                    slot.innerHTML = `
                        <div class="text-center">
                            <strong>${time}</strong><br>
                            <small class="text-muted">Disponible</small>
                        </div>
                    `;
                }
                
                container.appendChild(slot);
            });
            
            // Debug: Log the number of appointments loaded
            console.log('Loaded ' + appointments.length + ' appointments for date: ' + document.getElementById('selected-date').value);
        }

        // Afficher les détails d'un RDV
        function showAppointmentDetails(appointment) {
            const details = `
                <div class="row">
                    <div class="col-6"><strong>Heure:</strong></div>
                    <div class="col-6">${appointment.heurerendezvous}</div>
                </div>
                <div class="row mt-2">
                    <div class="col-6"><strong>Patient:</strong></div>
                    <div class="col-6">${appointment.nom_patient} ${appointment.prenom_patient}</div>
                </div>
                <div class="row mt-2">
                    <div class="col-6"><strong>Téléphone:</strong></div>
                    <div class="col-6">${appointment.telephone_patient || 'Non renseigné'}</div>
                </div>
                <div class="row mt-2">
                    <div class="col-12"><strong>Notes:</strong></div>
                    <div class="col-12 mt-1">${appointment.notes || 'Aucune note'}</div>
                </div>
            `;
            
            document.getElementById('appointment-details').innerHTML = details;
            new bootstrap.Modal(document.getElementById('appointmentModal')).show();
        }

        // Charger les RDV du jour actuel au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            loadAppointments(document.getElementById('selected-date').value);
        });
    </script>
</body>
</html>
