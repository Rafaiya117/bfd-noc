<?php
include 'CITES_API/CITES_API.php';


// $species_name = 'Vulpes cana';
// $re = $cities->action(urlencode($species_name));
// print_r($cities->result_obj);
// print_r($re);



// $species_name = 'Moschus moschiferus';
// $re = $cities->action(urlencode($species_name));
// print_r($cities->result_obj);
// print_r($re);



// $species_name = 'Viverra zibetha';
// $re = $cities->action(urlencode($species_name));
// print_r($cities->result_obj);
// print_r($re);

$species_name =  'Oligodon arnensis';
$re = $cities->action(urlencode($species_name));
print_r($cities->result_obj);
print_r($re);