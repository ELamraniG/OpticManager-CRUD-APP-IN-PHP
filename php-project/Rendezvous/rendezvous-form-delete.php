<?php
	$id=$_GET['id'];	require("../connexion.php");
	$res = mysqli_query($con, "select * from rendezvous where idrendezvous = ".$id );
	$data = mysqli_fetch_assoc($res);
	require("../head.php");
	require("../fonctions.php");
?>
<div class="container" style="margin-top: 100px;">
<form method="POST">
	<div class="row">
		<div class="datadelete col-6">
			<fieldset>
				<legend>Rendez-Vous à supprimer</legend>
				<label>Id Rendez-Vous</label>
				<input type="text" name="idrendezvous" value="<?php echo $data['idrendezvous']; ?>" class="form-control" disabled>
				<input type="text" name="id" value="<?php echo $data['idrendezvous']; ?>" hidden>
				<label>id Client</label>
				<input type="text" value="<?php echo $data['idclient']; ?>" class="form-control" disabled>
				<label>Id Cabinet</label>
				<input type="text" value="<?php echo $data['idcabinet']; ?>" class="form-control" disabled>
				<a href="./rendezvous-list.php"><input type="button"  class="btn btn-secondary" value="Return"></a>
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
			$r = "delete from rendezvous where idrendezvous = '".$id."'";
			require("../connexion.php");
			mysqli_query($con, $r);
			mysqli_close($con);
			redirection("rendezvous-list.php");
		}
	}
?>