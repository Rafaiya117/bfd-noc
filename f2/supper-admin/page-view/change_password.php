<?php
include '_a.php';

if(@$_GET['id']){
    // print_r($_GET['id']);
   $data = $db->select('SELECT * from `super-admin` where id=?',$_GET['id'])[0]; 
    $email = $data['email'];
    if(!empty($_POST)){
        $userData = $db->select('SELECT * FROM `super-admin` WHERE email=?', $email)[0];
        if (!$userData) {
            return "User not found"; 
        }
        else if($userData){
            $db->action('UPDATE `super-admin` SET `forgot_password` = md5(now()) WHERE `id` = ? ',$data['id']);
            $userData = $db->select('SELECT * FROM `super-admin` WHERE id=?', $data['id'])[0];
            $baseUrl= BASEURL; // Base URL of my website
            $resetLink = $baseUrl . '/f2/supper-admin/page-view/resetPassword_field.php?user_id=' . $userData['id'].  '&SESSION_VALID=' .$userData['forgot_password'];
            $result = resetPassword($_POST['email'], $resetLink);
            //echo $result;
            // if ($result == true) {
            //     header('Loaction:resetPassword.php?id'.$data['id']);
            // }
        }
       
    }
}

include '../super-admin-view/page-section-view/change_password_view.php';