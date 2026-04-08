<?php
	$id=$_GET['id'];
	$r = "SELECT vd.*, v.datevente, CONCAT(p.nom, ' ', p.prenom) as patient_nom, pr.nomproduit, pr.marque
	FROM vente_details vd, ventes v, patients p, produit pr
	WHERE vd.iddetail = " . $id . "
	AND vd.idvente = v.id_vente
	AND v.idpatient = p.idpatient
	AND vd.idproduit = pr.idproduit";
	require("../connexion.php");
	$res = mysqli_query($con, $r);
	$data = mysqli_fetch_assoc($res);
	require("../head.php");
	require("../fonctions.php");
?>

<div class='container' style='margin-top: 100px;'>
    <form method='POST' action='vente_details-delete.php'>
    <div class='row'>
        <div class='datadelete col-6'>
            <fieldset>
                <legend>Détail Vente à supprimer</legend>

<label>Id Détail</label>
<input type='text' class='form-control' value='<?php echo $data['iddetail'];?>' disabled>
<input type='text' name='id' value='<?php echo $data['iddetail'];?>' hidden>

<label>Patient</label>
<input type='text' class='form-control' value='<?php echo $data['patient_nom'];?>' disabled>

<label>Vente</label>
<input type='text' class='form-control' value='<?php echo $data['idvente'] . " (" . $data['datevente'] . ")";?>' disabled>

<label>Produit</label>
<input type='text' class='form-control' value='<?php echo $data['nomproduit'] . " (" . $data['marque'] . ")";?>' disabled>

<label>Quantité</label>
<input type='text' class='form-control' value='<?php echo $data['quantite'];?>' disabled>

<label>Prix Unitaire</label>
<input type='text' class='form-control' value='<?php echo $data['prixunitaire'] . "€";?>' disabled>

<label>Total</label>
<input type='text' class='form-control' value='<?php echo number_format($data['quantite'] * $data['prixunitaire'], 2) . "€";?>' disabled>

            </fieldset>
        </div>
        <div class='cledelete col-6'>
            <i class='fa-solid fa-key'></i>
            <h2>Suppression</h2>
            <label>Entrez la clé de la suppression</label>
            <input type='password' name='cledelete' class='form-control' style='width: 300px;text-align: center; margin: auto;' autofocus>
            <div class='container mt-3'>
    <div class='alert alert-warning' role='alert'>
        <strong>Attention!</strong> Cette action est irréversible.
    </div>
</div>
            <div class='text-center mt-3'>
                <button type='submit' class='btn btn-danger me-2'>
                    <i class='fa-solid fa-trash'></i> Supprimer
                </button>
                <button type='button' class='btn btn-secondary' onclick="window.location.href='./vente_details-list.php'">
                    <i class='fa-solid fa-arrow-left'></i> Annuler
                </button>
            </div>
        </div>
    </div>
    </form>
</div>

<?php
    if(isset($_POST['cledelete']))
    {
        $cledelete = $_POST['cledelete'];
        $id = $_POST['id'];
        
        if ($cledelete == "supprimer")
        {
            $r = "delete from vente_details where iddetail = " . $id;
            mysqli_query($con, $r);
            
            mysqli_close($con);
            require("../fonctions.php");
            redirection("vente_details-list.php");
        }
    }
    
    require("../footer.php");
?>
