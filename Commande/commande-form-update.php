<?php
require("../head.php");
require("../connexion.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';
$id_sql = mysqli_real_escape_string($con, $id);
$r = "select * from `commande` where `idcommande` = '$id_sql'";
$res = mysqli_query($con, $r);
$data = mysqli_fetch_assoc($res);

$r_list_idclient = "select `idl` as value, CONCAT(nom, ' ', prenom) as label from `client` order by label";
$list_idclient = mysqli_query($con, $r_list_idclient);
$r_list_idproduit = "select `idproduit` as value, `nomproduit` as label from `produit` order by label";
$list_idproduit = mysqli_query($con, $r_list_idproduit);
?>
<div class="container form-box">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Modifier - Commandes clients</h2>
            <?php if (!$data) { ?>
                <div class="alert alert-danger">Ligne introuvable</div>
            <?php } else { ?>
            <form method="post" action="commande-update.php">
                <input type="hidden" name="id" value="<?php echo e($data['idcommande']); ?>">
                <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="datecommande" class="form-control" value="<?php echo e($data['datecommande']); ?>" required>
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
            <label class="form-label">Produit</label>
            <select name="idproduit" class="form-select" required>
                <?php while ($x = mysqli_fetch_assoc($list_idproduit)) { ?>
                    <option value="<?php echo e($x['value']); ?>" <?php if ((string)$data['idproduit'] == (string)$x['value']) echo "selected"; ?>>
                        <?php echo e($x['label']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Statut</label>
            <select name="statut" class="form-select">
                <option value="En attente" <?php if ((string)$data['statut'] == 'En attente') echo "selected"; ?>>En attente</option>
                <option value="En cours" <?php if ((string)$data['statut'] == 'En cours') echo "selected"; ?>>En cours</option>
                <option value="Livrée" <?php if ((string)$data['statut'] == 'Livrée') echo "selected"; ?>>Livrée</option>
                <option value="Annulée" <?php if ((string)$data['statut'] == 'Annulée') echo "selected"; ?>>Annulée</option>
            </select>
        </div>
                </div>
                <button class="btn btn-primary" type="submit">Modifier</button>
                <a href="commande-list.php" class="btn btn-secondary">Retour</a>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
