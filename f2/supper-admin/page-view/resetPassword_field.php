<?php

include '_a.php';
if (@$_GET['user_id']) {
     $r_id = $_GET['user_id'];
      $r = $db->select('SELECT * from `super-admin` where id= ?', $r_id)[0]; 
      if (empty($r['forgot_password'])) {
         exit(); 
    } 
    else { 
        if (!empty($_POST)) { 
            $password = ($_POST['password']); 
            $updt = $db->action('UPDATE `super-admin` SET `password`= md5(?), `forgot_password` = "" WHERE `id`= ?', $password, $r_id);
        } 
    } 
}



include '../super-admin-view/page-section-view/resetPassword_field_view.php';