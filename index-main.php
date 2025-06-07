<?php
session_start();
?>
<head>
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

 
    <link rel="icon" type="image/png" sizes="16x16"  href="images/logo_bg.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <title>OPTIRENT</title>
    <style type="text/css">
        
        input{
        	margin-bottom: 10px;
        }
        .alert.alert-danger{
        	width: 400px;
        	margin:auto;
        }
        .container{
        	width: 500px;
        	margin: auto;
        }
        </style>

</head>
<div class="container">
	<div class="authentification">
	<center><img src="images/logo_nbg.png" width ="200rem"></center>
	<form method="POST">
		<label>Login</label>
		<input type="text" name="login" class="form-control">
		<label>Mot de passe</label>
		<input type="password" name="mdp" class="form-control">
		<input type="submit" value="Entrée" class="btn btn-primary">
	</form>
	<div class="alert alert-info">
		<b>OPTIRENT</b> :Application Web de Gestion Intégrée pour Cabinets d'Opticiens
		<ul>
			<li>Gestion des rendez-vous</li>
			<li>Gestion des commandes</li>
			<li>Gestion des dossiers clients</li>
			<li>Gestion des stocks</li>
			<li>Gestion de la facturation</li>
			<li>Gestion du site web du cabinet</li>
		</ul>
	</div>
	</div>
</div>
<?php
extract($_POST);
if (isset($mdp))
{
	require("connexion.php");
	$r = "select * from utilisateurs where nomutilisateur = '" . $login . "' and motdepasse = MD5('" . $mdp . "')";
	$res = mysqli_query($con, $r);
	$nbr_res = mysqli_num_rows($res);
	if ($nbr_res == 1)
	{
		$user_data = mysqli_fetch_assoc($res);
		$_SESSION['v_session']=1;
		$_SESSION['vs_login']=$login;
		$_SESSION['vs_motdepasse']=$mdp;
		$_SESSION['user_role']=$user_data['role'];
		require("fonctions.php");
		redirection("home/home.php");
	}
	else
	{
    echo "<div class='alert alert-danger'><i class='fa-solid fa-triangle-exclamation'></i> <b>LaPduP</b> : Echec de connexion...</div>";
	}
	mysqli_close($con);
}
?>