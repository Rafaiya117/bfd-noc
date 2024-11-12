<?php

include '_a.php';
if(@$_GET['id']){

    $member_data = $db->select('SELECT * from member where id=?',$_GET['id'])[0];
    $email = $member_data['email'];
    if(!empty($_POST) && !empty($member_data)){
        
        
        
            $db->action('UPDATE `member` SET `forgot_password` = md5(now()) WHERE `id` = ? ',$member_data['id']);
            $userData = $db->select('SELECT * FROM member WHERE id=?', $member_data['id'])[0];
            $baseUrl= BASEURL; // Base URL of my website
            $resetLink = $baseUrl . '/f2/vendor/resetPassword_from_email_link.php?user_id=' . $userData['id'].  '&SESSION_VALID=' .$userData['forgot_password'];
            $result = resetPassword($email, $resetLink);
            set_message('Password reset link has been sent to your email', 'success');
            header('Location:vendor_list.php');
            exit;
            //echo $result;
        
       
    } 

}

include '../super-admin-view/page-section-view/vendor_passwordchange_view.php';