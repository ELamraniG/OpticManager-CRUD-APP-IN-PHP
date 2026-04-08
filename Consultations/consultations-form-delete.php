<?php
	$id=$_GET['id'];
	$r = "SELECT c.*, CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet
	FROM consultations c, patients p
	WHERE c.idpatient = p.idpatient
	AND c.idconsultation = " . $id;
	require("../connexion.php");
	$res = mysqli_query($con, $r);
	$data = mysqli_fetch_assoc($res);
	require("../head.php");
	require("../fonctions.php");
?>
<div class="container" style="margin-top: 100px;">
<form method="POST">
	<div class="row">
		<div class="datadelete col-6">
			<fieldset>
				<legend>Consultation à supprimer</legend>
				<label>Id Consultation</label>
				<input type="text" name="idconsultation" value="<?php echo $data['idconsultation']; ?>" class="form-control" disabled>
				<input type="text" name="id" value="<?php echo $data['idconsultation']; ?>" hidden>
				<label>Patient</label>
				<input type="text" name="patient" value="<?php echo $data['patient_nom_complet']; ?>" class="form-control" disabled>
				<label>Date Consultation</label>
				<input type="text" name="dateconsultation" value="<?php echo $data['dateconsultation']; ?>" class="form-control" disabled>
				<label>Motif</label>
				<textarea name="motif" class="form-control" rows="2" disabled><?php echo $data['motif']; ?></textarea>
				<a href="./consultations-list.php"><input type="button"  class="btn btn-secondary" value="Return"></a>
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
			$r = "delete from consultations where idconsultation = ".$id;
			require("../connexion.php");
			mysqli_query($con, $r);
			mysqli_close($con);
			redirection("consultations-list.php");
		}
	}
?>
<?php
    require("../footer.php");
?>

