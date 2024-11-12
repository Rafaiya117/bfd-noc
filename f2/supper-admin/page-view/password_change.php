<?php
include '_a.php';


if (@$_GET['id']) {
    $data = $db->select('SELECT * from users where id=?', $_GET['id'])[0];
    

    if (!empty($_POST)&& !empty($data)) {
    
        
        $email = $data['email'];
        $db->action('UPDATE `users` SET `forgot_password` = md5(now()) WHERE `id` =?', $data['id']);
        $userData = $db->select('SELECT * FROM users WHERE id=?', $data['id'])[0];
        $baseUrl = BASEURL; // Base URL of my website
        $resetLink = $baseUrl. '/f2/admin/resetPassword_from_email_link.php?user_id='. $userData['id']. '&SESSION_VALID='. $userData['forgot_password'];
        $result = resetPassword($email, $resetLink);
        set_message('Password reset link has been sent to your email', 'success');
        header('Location:admin_list.php');
        exit;
        
    }
}

function updateAndSendResetLink($data, $db, $email) {
    
    //echo $result;
}

include '../super-admin-view/page-section-view/password_change_view.php';






