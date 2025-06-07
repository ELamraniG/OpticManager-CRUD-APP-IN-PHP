<?php
	$id=$_GET['id'];
	require("../connexion.php");
	$res = mysqli_query($con, "select * from commande where idcommande = ".$id );
	$data = mysqli_fetch_assoc($res);
	mysqli_close($con);
	require("../head.php");
	require("../fonctions.php");
?>
<div class="container" style="margin-top: 100px;">
<form method="POST">
	<div class="row">
		<div class="datadelete col-6">
			<fieldset>
				<legend>Produit à supprimer</legend>
				<label>Id Commande</label>
				<input type="text" name="idcommande" value="<?php echo $data['idcommande']; ?>" class="form-control" disabled>
				<input type="text" name="id" value="<?php echo $data['idcommande']; ?>" hidden>
				<label>id Client</label>
				<input type="text" name="nomp" value="<?php echo $data['idclient']; ?>" class="form-control" disabled>
				<label>Id Produit</label>
				<input type="text" name="nomp" value="<?php echo $data['idproduit']; ?>" class="form-control" disabled>
				<a href="./commande-list.php"><input type="button"  class="btn btn-secondary" value="Return"></a>
			</fieldset>
		</div>
		<div class="cledelete col-6">
			<i class="fa-solid fa-key"></i>
			<h2>Suppression</h2>
			<label>Entrez la clé de la suppression</label>
			<input type="password" name="cledelete" class="form-control" style="width: 300px;text-align: center; margin: auto;" autofocus>
			
			<div class="container mt-3">
    <div class="alert alert-warning" role="alert">
        <i class="fa-solid fa-triangle-exclamation"></i><br>Les données supprimées ne seront plus récupérables. Êtes-vous sûr de vouloir continuer ?
    </div>
    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-can"></i> Supprimer </button>
	</div>

		</div>
	</div>

</form>
</div>
<?php
	extract($_POST);
	if (isset($cledelete)) 
	{
		if ($cledelete != "123")
		{
			echo "<div class='alert alert-info' role='alert'><center>
        <h4><i class='fa-solid fa-triangle-exclamation'></i> Clé de suppression incorrecte...</h4></center></div>";
		}
		else
		{
			$r = "delete from commande where idcommande = '".$id."'";
			require("../connexion.php");
			mysqli_query($con, $r);
			mysqli_close($con);
			redirection("commande-list.php");
		}
	}
?>
