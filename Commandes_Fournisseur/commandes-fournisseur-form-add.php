<?php
require("../head.php");
require("../connexion.php");
$r_list_idfournisseur = "select `idf` as value, `nom` as label from `fournisseur` order by label";
$list_idfournisseur = mysqli_query($con, $r_list_idfournisseur);
?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Ajouter - Commandes fournisseurs</h2>
            <form method="post" action="commandes-fournisseur-add.php">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Fournisseur</label>
            <select name="idfournisseur" class="form-select" required>
                <?php while ($x = mysqli_fetch_assoc($list_idfournisseur)) { ?>
                    <option value="<?php echo e($x['value']); ?>" <?php if ((string)'' == (string)$x['value']) echo "selected"; ?>>
                        <?php echo e($x['label']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="datecommande" class="form-control" value="<?php echo e(''); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Statut</label>
            <select name="statut" class="form-select">
                <option value="en_attente" <?php if ((string)'' == 'en_attente') echo "selected"; ?>>en_attente</option>
                <option value="en_cours" <?php if ((string)'' == 'en_cours') echo "selected"; ?>>en_cours</option>
                <option value="livrée" <?php if ((string)'' == 'livrée') echo "selected"; ?>>livrée</option>
                <option value="annulée" <?php if ((string)'' == 'annulée') echo "selected"; ?>>annulée</option>
            </select>
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Enregistrer</button>
                <a href="commandes-fournisseur-list.php" class="btn btn-secondary">Retour</a>
            </form>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
