<?php
include '_a.php';

// include 'pages/header.php';
// include 'pages/navbar.php';
pg_header();



if(!empty($_POST['memo_id']))
{
    $row = $db->select('SELECT * from noc_import where memo_id = ?',$_POST['memo_id']);
    $NOC = $row[0];
    
    header('Location:full_details.php?id='.$NOC['id']);
}       
else{
    header('Location:index.php');
}   



pg_footer();