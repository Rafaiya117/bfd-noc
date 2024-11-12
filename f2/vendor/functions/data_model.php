<?php

function get_upzila(){
    global $db;
    $districtsQuery = $db->select("SELECT * FROM districts ORDER BY name ASC");
    
    $upazilasQuery = $db->select("SELECT * FROM upazilas ORDER BY district_name asc, name ASC");

    
    $data = [
        'districts' => $districtsQuery,
        'upazilas' => $upazilasQuery
    ];
    
    return $data;
}