<?php

if(isset($_SESSION['v_session']) && $_SESSION['v_session'] == 1) {

    if(!isset($con)) {
        require_once("connexion.php");
    }
    
    $notifications = array();
 
    $query = "SELECT nomproduit, qteenstock, seuildalerte FROM produit WHERE qteenstock <= seuildalerte ORDER BY qteenstock ASC LIMIT 5";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_assoc($result)) {
        $notifications[] = array(
            'type' => 'stock',
            'priority' => 'high',
            'icon' => 'fas fa-exclamation-triangle text-danger',
            'title' => 'Stock critique',
            'message' => $row['nomproduit'] . ' (Stock: ' . $row['qteenstock'] . ')',
            'action' => '../Stock/inventory-manager.php',
            'time' => 'maintenant'
        );
    }

    $query = "SELECT COUNT(*) as nb_rdv FROM rendezvous WHERE DATE(daterendezvous) = CURDATE()";
    $result = mysqli_query($con, $query);
    $nb_rdv_row = mysqli_fetch_assoc($result);
    $nb_rdv = $nb_rdv_row['nb_rdv'];
    if($nb_rdv > 0) {
        $notifications[] = array(
            'type' => 'rdv',
            'priority' => 'medium',
            'icon' => 'fas fa-calendar-check text-primary',
            'title' => 'RDV aujourd\'hui',
            'message' => $nb_rdv . ' rendez-vous programmé(s)',
            'action' => '../Rendezvous/rendezvous-list.php',
            'time' => 'aujourd\'hui'
        );
    }
    

    $query = "SELECT COUNT(*) as nb FROM consultations WHERE prescriptionpdf IS NULL AND dateconsultation >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
    $result = mysqli_query($con, $query);
    $nb_sans_ord_row = mysqli_fetch_assoc($result);
    $nb_sans_ord = $nb_sans_ord_row['nb'];
    if($nb_sans_ord > 0) {
        $notifications[] = array(
            'type' => 'ordonnance',
            'priority' => 'medium',
            'icon' => 'fas fa-prescription text-warning',
            'title' => 'Ordonnances manquantes',
            'message' => $nb_sans_ord . ' consultation(s) sans ordonnance',
            'action' => '../Ordonnances/ordonnances-form-add.php',
            'time' => 'cette semaine'
        );
    }
    
 
    $query = "SELECT COUNT(*) as nb FROM patients WHERE datecreation >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
    $result = mysqli_query($con, $query);
    $nouveaux_patients_row = mysqli_fetch_assoc($result);
    $nouveaux_patients = $nouveaux_patients_row['nb'];
    if($nouveaux_patients > 0) {
        $notifications[] = array(
            'type' => 'patient',
            'priority' => 'low',
            'icon' => 'fas fa-user-plus text-success',
            'title' => 'Nouveaux patients',
            'message' => $nouveaux_patients . ' nouveau(x) patient(s)',
            'action' => '../Patients/patients-list.php',
            'time' => 'cette semaine'
        );
    }
    
    function sortByPriority($a, $b) {
        $priority_order = array('high' => 1, 'medium' => 2, 'low' => 3);
        return $priority_order[$a['priority']] - $priority_order[$b['priority']];
    }
    usort($notifications, 'sortByPriority');
    

    $high_priority_count = 0;
    foreach($notifications as $notification) {
        if($notification['priority'] == 'high') {
            $high_priority_count++;
        }
    }
}
?>
