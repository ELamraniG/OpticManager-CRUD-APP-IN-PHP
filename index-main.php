<?php
session_start();
require("connexion.php");
require("fonctions.php");

$message = "";

if (isset($_POST['login']) && isset($_POST['mdp'])) {
    $login = mysqli_real_escape_string($con, $_POST['login']);
    $mdp = mysqli_real_escape_string($con, $_POST['mdp']);

    $r = "select * from utilisateurs
          where nomutilisateur = '$login'
          and motdepasse = MD5('$mdp')
          ";

    $res = mysqli_query($con, $r);

    if (mysqli_num_rows($res) == 1) {
        $data = mysqli_fetch_assoc($res);

        $_SESSION['v_session'] = 1;
        $_SESSION['vs_login'] = $login;
        $_SESSION['user_role'] = $data['role'];

        redirection("home/home.php");
    } else {
        $message = "login incorrect";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OPTIRENT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-5" style="max-width:520px">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-3">OpticManager</h2>
            <p class="text-muted">Application de gestion pour cabinet d'optique</p>

            <?php if ($message != "") { ?>
                <div class="alert alert-danger"><?php echo e($message); ?></div>
            <?php } ?>

            <form method="post">
                <label class="form-label">Login</label>
                <input type="text" name="login" class="form-control mb-3" required>

                <label class="form-label">Mot de passe</label>
                <input type="password" name="mdp" class="form-control mb-3" required>

                <input type="submit" value="Connexion" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
</body>
</html>
