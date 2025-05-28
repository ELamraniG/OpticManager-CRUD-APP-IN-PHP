<?php
require("../head.php");
require("../connexion.php");
$r_list_idclient = "select `idl` as value, CONCAT(nom, ' ', prenom) as label from `client` order by label";
$list_idclient = mysqli_query($con, $r_list_idclient);
$r_list_idcabinet = "select `idcabinet` as value, `nomcabinet` as label from `cabinet` order by label";
$list_idcabinet = mysqli_query($con, $r_list_idcabinet);
?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Ajouter - Rendez-vous</h2>
            <form method="post" action="rendezvous-add.php">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="daterendezvous" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Heure</label>
            <input type="time" name="heurerendezvous" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Client</label>
            <select name="idclient" class="form-select" required>
                <?php while ($x = mysqli_fetch_assoc($list_idclient)) { ?>
                    <option value="<?php echo e($x['value']); ?>" <?php if ((string)'' == (string)$x['value']) echo "selected"; ?>>
                        <?php echo e($x['label']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Cabinet</label>
            <select name="idcabinet" class="form-select" required>
                <?php while ($x = mysqli_fetch_assoc($list_idcabinet)) { ?>
                    <option value="<?php echo e($x['value']); ?>" <?php if ((string)'' == (string)$x['value']) echo "selected"; ?>>
                        <?php echo e($x['label']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control"><?php echo e(''); ?></textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Crédibilité</label>
            <select name="niveaudecredibilite" class="form-select">
                <option value="Faible" <?php if ((string)'' == 'Faible') echo "selected"; ?>>Faible</option>
                <option value="Moyen" <?php if ((string)'' == 'Moyen') echo "selected"; ?>>Moyen</option>
                <option value="Élevé" <?php if ((string)'' == 'Élevé') echo "selected"; ?>>Élevé</option>
            </select>
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Enregistrer</button>
                <a href="rendezvous-list.php" class="btn btn-secondary">Retour</a>
            </form>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
