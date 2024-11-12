<?php
include 'CITES_API/CITES_API.php';

$species_name = @$_GET['scientific_name'];


if(empty($species_name)){
    return [];
}
// echo '<pre>';

$re = $cities->action(urlencode($species_name));

// print_r($re);

json_send($re);
