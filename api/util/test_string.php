<?php 
include '_a.php';


function test_show_btn_function(){
    global $db;
    $noc = $db->select('SELECT *  FROM noc_import limit 1')[0];

    // echo 'test_function 22';
    // echo '<pre>';
    // print_r($a);
     auth()['role'] = '20_Officer';
     auth()['role'] = '50_Officer';
    //  auth()['role'] = '50_CCF';
    update_next_status($noc);
    show_next_status_button($noc);
}

test_show_btn_function();