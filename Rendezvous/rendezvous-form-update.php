<?php
require("../head.php");
require("../connexion.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';
$id_sql = mysqli_real_escape_string($con, $id);
$r = "select * from `rendezvous` where `idrendezvous` = '$id_sql'";
$res = mysqli_query($con, $r);
$data = mysqli_fetch_assoc($res);

$r_list_idclient = "select `idl` as value, CONCAT(nom, ' ', prenom) as label from `client` order by label";
$list_idclient = mysqli_query($con, $r_list_idclient);
$r_list_idcabinet = "select `idcabinet` as value, `nomcabinet` as label from `cabinet` order by label";
$list_idcabinet = mysqli_query($con, $r_list_idcabinet);
?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Modifier - Rendez-vous</h2>
            <?php if (!$data) { ?>
                <div class="alert alert-danger">Ligne introuvable</div>
            <?php } else { ?>
            <form method="post" action="rendezvous-update.php">
                <input type="hidden" name="id" value="<?php echo e($data['idrendezvous']); ?>">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="daterendezvous" class="form-control" value="<?php echo e($data['daterendezvous']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Heure</label>
            <input type="time" name="heurerendezvous" class="form-control" value="<?php echo e($data['heurerendezvous']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Client</label>
            <select name="idclient" class="form-select" required>
                <?php while ($x = mysqli_fetch_assoc($list_idclient)) { ?>
                    <option value="<?php echo e($x['value']); ?>" <?php if ((string)$data['idclient'] == (string)$x['value']) echo "selected"; ?>>
                        <?php echo e($x['label']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Cabinet</label>
            <select name="idcabinet" class="form-select" required>
                <?php while ($x = mysqli_fetch_assoc($list_idcabinet)) { ?>
                    <option value="<?php echo e($x['value']); ?>" <?php if ((string)$data['idcabinet'] == (string)$x['value']) echo "selected"; ?>>
                        <?php echo e($x['label']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control"><?php echo e($data['notes']); ?></textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Crédibilité</label>
            <select name="niveaudecredibilite" class="form-select">
                <option value="Faible" <?php if ((string)$data['niveaudecredibilite'] == 'Faible') echo "selected"; ?>>Faible</option>
                <option value="Moyen" <?php if ((string)$data['niveaudecredibilite'] == 'Moyen') echo "selected"; ?>>Moyen</option>
                <option value="Élevé" <?php if ((string)$data['niveaudecredibilite'] == 'Élevé') echo "selected"; ?>>Élevé</option>
            </select>
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Modifier</button>
                <a href="rendezvous-list.php" class="btn btn-secondary">Retour</a>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
