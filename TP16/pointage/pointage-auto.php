<?php
	extract($_POST);
	$r = "select * from employe";
	require("../connexion.php");
	$res = mysqli_query($con, $r);
	$he = "9:00";
	$hs = "16:00";
	$notes = "AUCUN";
	while ($data = mysqli_fetch_assoc($res)){
		$idemploye = $data['idemploye'];
		$r_auto = "insert into pointage values(null,".$idemploye.", '".$ddp."', '".$he."', '".$hs."', '".$notes."')";
		mysqli_query($con, $r_auto);
	}
	mysqli_close($con);
	require("../fonctions.php");
	redirection("pointage-list.php");
?>