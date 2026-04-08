<?php
require("../head.php");
require("../connexion.php");
require("../fonctions.php");

$search_term = "";
$results = array();
$search_performed = false;

if (isset($_GET['q']) && !empty($_GET['q'])) {
    $search_term = mysqli_real_escape_string($con, $_GET['q']);
    $search_performed = true;
    
    // Search patients with more detailed information
    $patients_query = "SELECT p.*, 
                       COUNT(c.idconsultation) as nb_consultations,
                       MAX(c.dateconsultation) as derniere_consultation
                       FROM patients p 
                       LEFT JOIN consultations c ON p.idpatient = c.idpatient
                       WHERE p.nom LIKE '%$search_term%' 
                       OR p.prenom LIKE '%$search_term%' 
                       OR p.telephone LIKE '%$search_term%'
                       OR p.email LIKE '%$search_term%'
                       OR CONCAT(p.nom, ' ', p.prenom) LIKE '%$search_term%'
                       GROUP BY p.idpatient
                       ORDER BY p.nom, p.prenom
                       LIMIT 20";
    
    $results = mysqli_query($con, $patients_query);
}

// Get recent patients (last 10 added)
$recent_patients_query = "SELECT idpatient, nom, prenom, telephone, datecreation 
                          FROM patients 
                          ORDER BY datecreation DESC 
                          LIMIT 10";
$recent_patients = mysqli_query($con, $recent_patients_query);

// Get patients with consultations today
$today_consultations_query = "SELECT DISTINCT p.idpatient, p.nom, p.prenom, p.telephone, c.dateconsultation, c.motif
                              FROM patients p 
                              JOIN consultations c ON p.idpatient = c.idpatient
                              WHERE DATE(c.dateconsultation) = CURDATE()
                              ORDER BY c.dateconsultation DESC";
$today_consultations = mysqli_query($con, $today_consultations_query);
?>

<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h1 class="display-4 mb-4">
                <i class="fas fa-user-search"></i> Recherche Patients
            </h1>
        </div>
    </div>

    <!-- Search Section -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-search"></i> Rechercher un Patient</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="">
                <div class="row">
                    <div class="col-md-9">
                        <input type="text" 
                               name="q" 
                               class="form-control form-control-lg" 
                               placeholder="Nom, prénom, téléphone ou email du patient..." 
                               value="<?php echo htmlspecialchars($search_term); ?>"
                               autofocus>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-search"></i> Rechercher
                        </button>
                    </div>
                </div>
            </form>
            
            <div class="mt-3">
                <small class="text-muted">
                    <i class="fas fa-lightbulb"></i> 
                    Astuce: Vous pouvez rechercher par nom complet "Jean Dupont" ou par téléphone "0612345678"
                </small>
            </div>
        </div>
    </div>

    <?php if ($search_performed): ?>
        <?php if (mysqli_num_rows($results) > 0): ?>
            <!-- Search Results -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-users"></i> 
                        Résultats pour: "<?php echo htmlspecialchars($search_term); ?>"
                        <span class="badge bg-primary"><?php echo mysqli_num_rows($results); ?> patient(s)</span>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php while ($patient = mysqli_fetch_assoc($results)): ?>
                            <div class="col-md-6 mb-3">
                                <div class="card border-left-primary h-100">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <h5 class="card-title mb-1">
                                                    <?php echo $patient['nom'] . ' ' . $patient['prenom']; ?>
                                                </h5>
                                                <p class="card-text mb-1">
                                                    <?php if ($patient['telephone']): ?>
                                                        <i class="fas fa-phone text-primary"></i> <?php echo $patient['telephone']; ?><br>
                                                    <?php endif; ?>
                                                    <?php if ($patient['email']): ?>
                                                        <i class="fas fa-envelope text-primary"></i> <?php echo $patient['email']; ?><br>
                                                    <?php endif; ?>
                                                    <?php if ($patient['datenaissance']): ?>
                                                        <i class="fas fa-birthday-cake text-primary"></i> 
                                                        <?php 
                                                        $birth_date = strtotime($patient['datenaissance']);
                                                        $today = time();
                                                        $age = floor(($today - $birth_date) / (365.25 * 24 * 3600));
                                                        echo date('d/m/Y', strtotime($patient['datenaissance'])) . " ($age ans)";
                                                        ?>
                                                    <?php endif; ?>
                                                </p>
                                                
                                                <small class="text-muted">
                                                    <?php echo $patient['nb_consultations']; ?> consultation(s)
                                                    <?php if ($patient['derniere_consultation']): ?>
                                                        | Dernière: <?php echo date('d/m/Y', strtotime($patient['derniere_consultation'])); ?>
                                                    <?php endif; ?>
                                                </small>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div class="btn-group-vertical">
                                                    <a href="../Patients/patients-form-update.php?id=<?php echo $patient['idpatient']; ?>" 
                                                       class="btn btn-outline-primary btn-sm mb-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="../Consultations/consultation-history.php?patient_id=<?php echo $patient['idpatient']; ?>" 
                                                       class="btn btn-outline-info btn-sm mb-1">
                                                        <i class="fas fa-history"></i>
                                                    </a>
                                                    <a href="../Consultations/consultations-form-add.php?patient_id=<?php echo $patient['idpatient']; ?>" 
                                                       class="btn btn-outline-success btn-sm">
                                                        <i class="fas fa-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
            
        <?php else: ?>
            <!-- No Results -->
            <div class="card shadow mb-4">
                <div class="card-body text-center py-5">
                    <i class="fas fa-user-slash text-muted" style="font-size: 4rem;"></i>
                    <h3 class="mt-3 text-muted">Aucun patient trouvé</h3>
                    <p class="lead text-muted">
                        Aucun patient ne correspond à "<?php echo htmlspecialchars($search_term); ?>"
                    </p>
                    <a href="../Patients/patients-form-add.php" class="btn btn-success">
                        <i class="fas fa-user-plus"></i> Créer un nouveau patient
                    </a>
                </div>
            </div>
        <?php endif; ?>
        
    <?php else: ?>
        <!-- Default View -->
        <div class="row">
            <!-- Today's Consultations -->
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-calendar-day"></i> Consultations Aujourd'hui
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php if (mysqli_num_rows($today_consultations) > 0): ?>
                            <?php while ($consultation = mysqli_fetch_assoc($today_consultations)): ?>
                                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                    <div>
                                        <strong><?php echo $consultation['nom'] . ' ' . $consultation['prenom']; ?></strong><br>
                                        <small class="text-muted">
                                            <?php echo date('H:i', strtotime($consultation['dateconsultation'])); ?> - 
                                            <?php echo $consultation['motif']; ?>
                                        </small>
                                    </div>
                                    <div>
                                        <a href="../Consultations/consultation-history.php?patient_id=<?php echo $consultation['idpatient']; ?>" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="text-center text-muted">
                                <i class="fas fa-calendar-times fa-2x mb-2"></i>
                                <p>Aucune consultation aujourd'hui</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Recent Patients -->
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-user-clock"></i> Patients Récents
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php while ($recent = mysqli_fetch_assoc($recent_patients)): ?>
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                <div>
                                    <strong><?php echo $recent['nom'] . ' ' . $recent['prenom']; ?></strong><br>
                                    <small class="text-muted">
                                        <?php echo $recent['telephone']; ?> | 
                                        Ajouté le <?php echo date('d/m/Y', strtotime($recent['datecreation'])); ?>
                                    </small>
                                </div>
                                <div>
                                    <a href="../Consultations/consultation-history.php?patient_id=<?php echo $recent['idpatient']; ?>" 
                                       class="btn btn-outline-info btn-sm">
                                        <i class="fas fa-history"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        
                        <div class="text-center mt-3">
                            <a href="../Patients/patients-list.php" class="btn btn-outline-primary">
                                <i class="fas fa-list"></i> Voir tous les patients
                            </a>
                        </div>
                    </div>
                </div>
            </div>        </div>
    <?php endif; ?>
</div>

<style>
.border-left-primary {
    border-left: 4px solid #007bff !important;
}

.card:hover {
    transform: translateY(-2px);
    transition: transform 0.2s;
}

.btn:hover {
    transform: translateY(-1px);
}
</style>

<script>
// Enhanced search functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="q"]');
    
    // Auto-submit on Enter
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            this.form.submit();
        }
    });
    
    // Clear search
    if (searchInput.value) {
        const clearBtn = document.createElement('button');
        clearBtn.type = 'button';
        clearBtn.className = 'btn btn-outline-secondary';
        clearBtn.innerHTML = '<i class="fas fa-times"></i>';
        clearBtn.onclick = function() {
            searchInput.value = '';
            window.location.href = 'patient-finder.php';
        };
        
        searchInput.parentNode.appendChild(clearBtn);
    }
});
</script>

<?php
mysqli_close($con);
require("../footer.php");
?>
