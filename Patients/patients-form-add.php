<?php
require("../head.php");
require("../connexion.php");

?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Ajouter - Patients</h2>
            <form method="post" action="patients-add.php">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Date de naissance</label>
            <input type="date" name="datenaissance" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Sexe</label>
            <select name="sexe" class="form-select" required>
                <option value="Masculin" <?php if ((string)'' == 'Masculin') echo "selected"; ?>>Masculin</option>
                <option value="Féminin" <?php if ((string)'' == 'Féminin') echo "selected"; ?>>Féminin</option>
                <option value="Autre" <?php if ((string)'' == 'Autre') echo "selected"; ?>>Autre</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Adresse</label>
            <textarea name="adresse" class="form-control"><?php echo e(''); ?></textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Date création</label>
            <input type="date" name="datecreation" class="form-control" value="<?php echo e(''); ?>">
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Enregistrer</button>
                <a href="patients-list.php" class="btn btn-secondary">Retour</a>
            </form>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
