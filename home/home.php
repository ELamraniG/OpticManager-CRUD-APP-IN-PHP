<?php
require_once '../head.php';
?>
<div class="container">
    <div class="p-4 p-md-5 mb-4 bg-white border rounded-3">
        <h1 class="display-6">Bienvenue dans OpticManager</h1>
        <p class="lead mb-4">Clients, patients, consultations, rendez-vous, produits, stock et ventes dans une seule application.</p>
        <a class="btn btn-primary" href="../Dashboard/dashboard.php">Ouvrir le dashboard</a>
    </div>

    <div class="row g-3">
        <?php
        $links = array(
            array('Clients', '../Client/client-list.php'),
            array('Patients', '../Patients/patients-list.php'),
            array('Produits', '../Produit/produit-list.php'),
            array('Rendez-vous', '../Rendezvous/rendezvous-list.php'),
            array('Consultations', '../Consultations/consultations-list.php'),
            array('Ventes', '../Ventes/ventes-list.php')
        );
        foreach ($links as $link):
        ?>
        <div class="col-md-4">
            <a class="card card-body text-decoration-none h-100" href="<?php echo e($link[1]); ?>">
                <strong><?php echo e($link[0]); ?></strong>
                <span class="text-muted small">Ouvrir</span>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php require_once '../footer.php'; ?>
