<?php
require("../head.php");
require("../connexion.php");
require("../fonctions.php");


$patient_id = isset($_GET['patient_id']) ? mysqli_real_escape_string($con, $_GET['patient_id']) : '';


$patients_query = "SELECT idpatient, CONCAT(nom, ' ', prenom) as nom_complet, telephone 
                   FROM patients 
                   ORDER BY nom, prenom";
$patients_result = mysqli_query($con, $patients_query);


$consultation_history = null;
$patient_info = null;
if ($patient_id) {

    $patient_query = "SELECT * FROM patients WHERE idpatient = '$patient_id'";
    $patient_info = mysqli_fetch_assoc(mysqli_query($con, $patient_query));

    $history_query = "SELECT c.*, 
                      GROUP_CONCAT(CONCAT(o.oeil, ': SPH ', IFNULL(o.sphere, '0'), 
                                         ' CYL ', IFNULL(o.cylindre, '0'), 
                                         ' AXE ', IFNULL(o.axe, '0')) SEPARATOR '; ') as ordonnances_detail
                      FROM consultations c 
                      LEFT JOIN ordonnances o ON c.idconsultation = o.idconsultation
                      WHERE c.idpatient = '$patient_id'
                      GROUP BY c.idconsultation
                      ORDER BY c.dateconsultation DESC";
    $consultation_history = mysqli_query($con, $history_query);
}
?>

<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h1 class="display-4 mb-4">
                <i class="fas fa-history"></i> Historique des Consultations
            </h1>
        </div>
    </div>


    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-user-md"></i> Sélection du Patient</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="">
                <div class="row">
                    <div class="col-md-10">
                        <select class="form-select form-select-lg" name="patient_id" required>
                            <option value="">Sélectionner un patient...</option>
                            <?php while ($patient = mysqli_fetch_assoc($patients_result)): ?>
                                <option value="<?php echo $patient['idpatient']; ?>" 
                                        <?php echo ($patient_id == $patient['idpatient']) ? 'selected' : ''; ?>>
                                    <?php echo $patient['nom_complet']; ?> 
                                    <?php if ($patient['telephone']): ?>
                                        - <?php echo $patient['telephone']; ?>
                                    <?php endif; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-search"></i> Voir Historique
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if ($patient_info): ?>
        <div class="card shadow mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-user"></i> Informations Patient</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4><?php echo $patient_info['nom'] . ' ' . $patient_info['prenom']; ?></h4>
                        <p><strong>Date de naissance:</strong> 
                           <?php echo $patient_info['datenaissance'] ? date('d/m/Y', strtotime($patient_info['datenaissance'])) : 'Non renseignée'; ?>
                        </p>
                        <p><strong>Sexe:</strong> <?php echo $patient_info['sexe'] ? $patient_info['sexe'] : 'Non renseigné'; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Téléphone:</strong> <?php echo $patient_info['telephone'] ? $patient_info['telephone'] : 'Non renseigné'; ?></p>
                        <p><strong>Email:</strong> <?php echo $patient_info['email'] ? $patient_info['email'] : 'Non renseigné'; ?></p>
                        <p><strong>Patient depuis:</strong> 
                           <?php echo date('d/m/Y', strtotime($patient_info['datecreation'])); ?>
                        </p>
                    </div>
                </div>
                
                <div class="mt-3">
                    <a href="../Patients/patients-form-update.php?id=<?php echo $patient_info['idpatient']; ?>" 
                       class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-edit"></i> Modifier Patient
                    </a>
                    <a href="../Consultations/consultations-form-add.php?patient_id=<?php echo $patient_info['idpatient']; ?>" 
                       class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Nouvelle Consultation
                    </a>
                </div>
            </div>
        </div>

      
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-clipboard-list"></i> Historique des Consultations
                    <span class="badge bg-light text-dark"><?php echo mysqli_num_rows($consultation_history); ?> consultation(s)</span>
                </h5>
            </div>
            <div class="card-body">
                <?php if (mysqli_num_rows($consultation_history) > 0): ?>
                    <div class="timeline">
                        <?php while ($consultation = mysqli_fetch_assoc($consultation_history)): ?>
                            <div class="timeline-item mb-4">
                                <div class="card border-left-primary">
                                    <div class="card-header bg-light">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="mb-0">
                                                    <i class="fas fa-calendar"></i> 
                                                    <?php echo date('d/m/Y', strtotime($consultation['dateconsultation'])); ?>
                                                </h6>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <small class="text-muted">
                                                    Consultation #<?php echo $consultation['idconsultation']; ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h6><i class="fas fa-stethoscope"></i> Motif de consultation:</h6>
                                                <p class="mb-2"><?php echo $consultation['motif'] ? $consultation['motif'] : 'Non renseigné'; ?></p>
                                                
                                                <?php if ($consultation['observations']): ?>
                                                    <h6><i class="fas fa-notes-medical"></i> Observations:</h6>
                                                    <p class="mb-2"><?php echo nl2br($consultation['observations']); ?></p>
                                                <?php endif; ?>
                                                
                                                <?php if ($consultation['ordonnances_detail']): ?>
                                                    <h6><i class="fas fa-prescription"></i> Prescriptions:</h6>
                                                    <div class="alert alert-info">
                                                        <?php echo str_replace('; ', '<br>', $consultation['ordonnances_detail']); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="d-grid gap-2">
                                                    <a href="../Consultations/consultations-form-update.php?id=<?php echo $consultation['idconsultation']; ?>" 
                                                       class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-edit"></i> Modifier
                                                    </a>
                                                    <a href="../Ordonnances/ordonnances-form-add.php?consultation_id=<?php echo $consultation['idconsultation']; ?>" 
                                                       class="btn btn-outline-success btn-sm">
                                                        <i class="fas fa-prescription"></i> Ajouter Ordonnance
                                                    </a>
                                                    <?php if ($consultation['prescriptionpdf']): ?>
                                                        <a href="../get_image.php?img=<?php echo $consultation['prescriptionpdf']; ?>" 
                                                           class="btn btn-outline-info btn-sm" target="_blank">
                                                            <i class="fas fa-file-pdf"></i> Voir PDF
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Aucune consultation trouvée</h4>
                        <p class="text-muted">Ce patient n'a pas encore de consultation enregistrée.</p>
                        <a href="../Consultations/consultations-form-add.php?patient_id=<?php echo $patient_info['idpatient']; ?>" 
                           class="btn btn-success">
                            <i class="fas fa-plus"></i> Première Consultation
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
.border-left-primary {
    border-left: 4px solid #007bff !important;
}

.timeline {
    position: relative;
}

.timeline-item {
    position: relative;
    padding-left: 20px;
}

.timeline-item:before {
    content: '';
    position: absolute;
    left: 0;
    top: 20px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: #007bff;
}

.timeline-item:not(:last-child):after {
    content: '';
    position: absolute;
    left: 4px;
    top: 30px;
    bottom: -20px;
    width: 2px;
    background-color: #dee2e6;
}

.card-header.bg-light {
    background-color: #f8f9fa !important;
    border-bottom: 1px solid #dee2e6;
}
</style>

<script>

document.addEventListener('DOMContentLoaded', function() {
    var hasPatientId = <?php echo $patient_id ? 'true' : 'false'; ?>;
    if (!hasPatientId) {
        document.querySelector('select[name="patient_id"]').focus();
    }
});
</script>

<?php
mysqli_close($con);
require("../footer.php");
?>
