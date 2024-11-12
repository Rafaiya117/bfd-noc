<?php


$response = ['done' => false];

// Check if id and quantity are provided in POST data
if (!empty($_POST['id']) && !empty($_POST['quantity']) && !empty($_POST['noc_id'])) {
    // Perform database update
    $updat_quantity = $db->action('UPDATE imp_noc_species_duplicate SET quantity= ?, admin_id= ?, `status` = "Done"  WHERE id = ?',
        $_POST['quantity'],
        auth()['id'],
        $_POST['id']
    );
    

    // Get noc_id for the updated record
    $noc_data = $db->select('SELECT noc_id FROM imp_noc_species_duplicate WHERE id = ?', $_POST['id']);
    update_headcount(['id' =>$_POST['noc_id']]);
    $response['done'] = true;

    
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);

