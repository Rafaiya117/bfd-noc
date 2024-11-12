<?php
include '_a.php';
must_login();


if (isset($_GET['id'])) {

    $noc_data = $db->select('SELECT noc_id from imp_noc_species_duplicate where id = ?', $_GET['id']);
    $noc_id = $noc_data[0]['noc_id'];

    $row = $db->action('DELETE from imp_noc_species_duplicate where id = ?', $_GET['id']);


    
    update_headcount($noc_data[0]);
    $updat_status = $db->action('UPDATE imp_noc_species_duplicate SET `status`= ?, admin_id= ? WHERE  noc_id = ?',"Done",
    auth()['id'],
    $noc_id);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    echo 'Invalid parameters';
}