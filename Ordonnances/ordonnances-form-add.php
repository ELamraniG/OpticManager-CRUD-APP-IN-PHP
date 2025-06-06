<?php
	require("../head.php");
	require("../fonctions.php");
	require("../connexion.php");
	$nbr = mysqli_query($con ,"select idordonnance from ordonnances order by idordonnance desc limit 1;");
	$nbr_cat = mysqli_fetch_assoc($nbr);
?>
<div class="container" style="margin-top: 100px;">
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-prescription"></i> Nouvelle Ordonnance</h4>
                <small>Créer une nouvelle prescription optique</small>
            </div>
            <div class="card-body">
                <form method="POST" action="ordonnances-add.php" id="ordonnanceForm">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label"><i class="fas fa-id-badge"></i> ID Ordonnance</label>
                                <input type="text" class="form-control" value="<?php echo ++$nbr_cat['idordonnance']; ?>" disabled>
                                <input type="hidden" name="idordonnance" value="<?php echo $nbr_cat['idordonnance']; ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label"><i class="fas fa-user-md"></i> Consultation <span class="text-danger">*</span></label>
                                <select class="form-select" name="idconsultation" required>
                                    <option value="" disabled selected>Sélectionner une Consultation</option>
                                    <?php
                                        $res = mysqli_query($con, "SELECT c.idconsultation, c.dateconsultation, CONCAT(p.nom, ' ', p.prenom) as patient_nom 
                                        FROM consultations c, patients p 
                                        WHERE c.idpatient = p.idpatient 
                                        ORDER BY c.dateconsultation DESC");
                                        while ($data_consultation = mysqli_fetch_assoc($res))
                                            echo "<option value='". $data_consultation['idconsultation']."'>". $data_consultation['patient_nom'] . " - " . date('d/m/Y', strtotime($data_consultation['dateconsultation'])) . "</option>";
                                    ?>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label"><i class="fas fa-eye"></i> Œil <span class="text-danger">*</span></label>
                                <select class="form-select" name="oeil" required>
                                    <option value="" disabled selected>Sélectionner l'œil</option>
                                    <option value="Droit">Œil Droit (OD)</option>
                                    <option value="Gauche">Œil Gauche (OG)</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label"><i class="fas fa-circle"></i> Sphère</label>
                                <div class="input-group">
                                    <input type="number" step="0.25" min="-20" max="20" name="sphere" class="form-control" placeholder="Ex: -2.50">
                                    <span class="input-group-text">D</span>
                                </div>
                                <small class="form-text text-muted">Valeurs entre -20.00 et +20.00 par pas de 0.25</small>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label"><i class="fas fa-adjust"></i> Cylindre</label>
                                <div class="input-group">
                                    <input type="number" step="0.25" min="-6" max="6" name="cylindre" class="form-control" placeholder="Ex: -1.25">
                                    <span class="input-group-text">D</span>
                                </div>
                                <small class="form-text text-muted">Correction de l'astigmatisme (-6.00 à +6.00)</small>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label"><i class="fas fa-compass"></i> Axe</label>
                                <div class="input-group">
                                    <input type="number" min="0" max="180" name="axe" class="form-control" placeholder="Ex: 90">
                                    <span class="input-group-text">°</span>
                                </div>
                                <small class="form-text text-muted">Angle de 0° à 180°</small>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label"><i class="fas fa-plus"></i> Addition</label>
                                <div class="input-group">
                                    <input type="number" step="0.25" min="0" max="4" name="addition" class="form-control" placeholder="Ex: +2.00">
                                    <span class="input-group-text">D</span>
                                </div>
                                <small class="form-text text-muted">Correction presbytie (0.00 à +4.00)</small>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label"><i class="fas fa-glasses"></i> Type de Correction <span class="text-danger">*</span></label>
                                <select class="form-select" name="typecorrection" required>
                                    <option value="" disabled selected>Sélectionner le type</option>
                                    <option value="verre">
                                        <i class="fas fa-glasses"></i> Verres correcteurs
                                    </option>
                                    <option value="lentille">
                                        <i class="fas fa-eye"></i> Lentilles de contact
                                    </option>
                                </select>
                            </div>

                            <!-- Quick Info Panel -->
                            <div class="alert alert-info">
                                <h6><i class="fas fa-info-circle"></i> Information</h6>
                                <ul class="mb-0 small">
                                    <li><strong>Sphère :</strong> Myopie (-) / Hypermétropie (+)</li>
                                    <li><strong>Cylindre :</strong> Correction astigmatisme</li>
                                    <li><strong>Axe :</strong> Orientation de l'astigmatisme</li>
                                    <li><strong>Addition :</strong> Presbytie (vision de près)</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg me-3">
                            <i class="fas fa-save"></i> Enregistrer l'Ordonnance
                        </button>
                        <button type="button" class="btn btn-secondary btn-lg" onclick="window.location.href='./ordonnances-list.php'">
                            <i class="fas fa-arrow-left"></i> Retour à la Liste
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script>
// Form validation and user experience improvements
document.getElementById('ordonnanceForm').addEventListener('submit', function(e) {
    const oeil = document.querySelector('select[name="oeil"]').value;
    const consultation = document.querySelector('select[name="idconsultation"]').value;
    const typeCorrection = document.querySelector('select[name="typecorrection"]').value;
    
    if (!oeil || !consultation || !typeCorrection) {
        e.preventDefault();
        alert('Veuillez remplir tous les champs obligatoires (marqués d\'un *)');
        return false;
    }
    
    // Validate sphere and cylinder relationship
    const sphere = parseFloat(document.querySelector('input[name="sphere"]').value) || 0;
    const cylindre = parseFloat(document.querySelector('input[name="cylindre"]').value) || 0;
    const axe = parseInt(document.querySelector('input[name="axe"]').value) || 0;
    
    if (cylindre !== 0 && axe === 0) {
        if (!confirm('Vous avez saisi un cylindre sans axe. Voulez-vous continuer ?')) {
            e.preventDefault();
            return false;
        }
    }
});

// Auto-focus improvements
document.addEventListener('DOMContentLoaded', function() {
    // Focus on first required field
    document.querySelector('select[name="idconsultation"]').focus();
    
    // Show/hide axe field based on cylindre
    const cylindreInput = document.querySelector('input[name="cylindre"]');
    const axeInput = document.querySelector('input[name="axe"]');
    
    cylindreInput.addEventListener('input', function() {
        if (parseFloat(this.value) !== 0 && this.value !== '') {
            axeInput.required = true;
            axeInput.parentElement.parentElement.classList.add('border-warning');
        } else {
            axeInput.required = false;
            axeInput.parentElement.parentElement.classList.remove('border-warning');
        }
    });
});
</script>

<style>
.form-label {
    font-weight: 600;
    color: #495057;
}

.card-header {
    background: linear-gradient(45deg, #007bff, #0056b3) !important;
}

.form-control:focus, .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.btn-success {
    background: linear-gradient(45deg, #28a745, #20c997);
    border: none;
}

.btn-success:hover {
    background: linear-gradient(45deg, #218838, #1e7e34);
    transform: translateY(-1px);
}

.alert-info {
    background-color: #e3f2fd;
    border-color: #2196f3;
    color: #0d47a1;
}

.input-group-text {
    background-color: #f8f9fa;
    border-color: #ced4da;
    font-weight: 600;
}
</style>

<?php
    mysqli_close($con);
    require("../footer.php");
?>
