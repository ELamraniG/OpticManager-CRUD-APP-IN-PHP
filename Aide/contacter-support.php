<?php
require("../head.php");

$sent = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sent = true;
}
?>
<div class="container" style="max-width: 760px">
    <h1 class="h2 mb-3">Contacter le support</h1>
    <?php if ($sent) { ?><div class="alert alert-success">Message préparé. Configurez votre serveur mail pour l’envoi réel.</div><?php } ?>
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="post">
                <div class="mb-3"><label class="form-label">Sujet</label><input name="subject" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Message</label><textarea name="message" rows="7" class="form-control" required></textarea></div>
                <button class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>
</div>
<?php require("../footer.php"); ?>
