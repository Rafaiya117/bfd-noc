<?php
include '_a.php';

if(!empty($_SESSION['id'])){
    //print_r($_SESSION);
$my_id = $_GET['id'];
$my_profile = $db->select('SELECT * from `super-admin` where id=?',$my_id)[0];
}

include '../super-admin-view/page-section-view/user_profile_view.php';