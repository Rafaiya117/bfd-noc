<?php 
include_once '_a.php';


// pre('sala',  'salar put');

function check_final_items($id){
    global $db;
    // $db->action('UPDATE noc_import SET `status` = ? WHERE  id = ?', '1000_signed_document', $id);
    $NOC = $db->select('SELECT * from noc_import where id = ?  limit 1', $id)[0];

    final_status_updated_print($NOC, NEXT);

    $NOC = $db->select('SELECT * from noc_import where id = ?  limit 1', $id)[0];
    pre($NOC, 'Final check');
}


// function reset_noc_admin_bar($id){
//     global $db;
//     $db->action('UPDATE noc_import SET `status` = ?, admin_bar_status = "",
//         approved_date = "",
//          validity_date = "",
//          qr_code = "",
//          invoice = ""

    
//      WHERE  id = ?', '200_vendor_submitted', $id);
//     $NOC = $db->select('SELECT * from noc_import where id = ?  limit 1', $id)[0];

//     // final_status_updated_print($NOC, NEXT);

//     // $NOC = $db->select('SELECT * from noc_import where id = ?  limit 1', $id)[0];
//     pre($NOC, 'Reset admin bar check');
// }


// $id = 664; 
// reset_noc_admin_bar($id);
// // check_final_items($id);



// update_headcount(['id'=>672]);
// final_status_updated_print(['id'=>689], NEXT);

check_final_items($id = 689);