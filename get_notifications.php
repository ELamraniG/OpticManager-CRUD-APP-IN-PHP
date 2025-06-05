<?php
if (!isset($con)) {
    require(__DIR__ . "/connexion.php");
}

$notifications = array();
$high_priority_count = 0;

$r = "select nomproduit, qteenstock, seuildalerte
      from produit
      where qteenstock <= seuildalerte
      order by qteenstock asc
      limit 5";

$res = mysqli_query($con, $r);
if ($res) {
    while ($data = mysqli_fetch_assoc($res)) {
        $notifications[] = array(
            "title" => "Stock faible",
            "message" => $data['nomproduit'] . " : " . $data['qteenstock'],
            "action" => "../Stock/inventory-manager.php"
        );
        $high_priority_count++;
    }
}

$r = "select count(*) as nbr from rendezvous where daterendezvous = CURDATE()";
$res = mysqli_query($con, $r);
if ($res) {
    $data = mysqli_fetch_assoc($res);
    if ($data['nbr'] > 0) {
        $notifications[] = array(
            "title" => "Rendez-vous aujourd'hui",
            "message" => $data['nbr'] . " rendez-vous",
            "action" => "../Rendezvous/appointment-manager.php"
        );
    }
}
?>
