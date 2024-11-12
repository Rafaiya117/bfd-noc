<?php

include '_a.php';

if(@$_GET['id']){
    $user_id = $_GET['id'];
    $rows  = $db->select('SELECT * from users where id = ? ',$user_id);
    
    $user_info = $rows[0];

    if(!empty($_POST) && !empty($user_info)){
        // pre($_POST,'POST');
        //print_r($_POST);
       $update_data = $db->action('UPDATE users SET `username`= ?,`name`= ?,`email`= ?,`phone` = ?, `employee_id` = ?,`organization` = ?,
       `designation` = ? , `role` = ? where id = ?',
       $_POST['username'], $_POST['name'], $_POST['email'],$_POST['phone'],$_POST['employee_id'],$_POST['organization'],$_POST['designation'], $_POST['role'],$user_id);
       header('Location:admin_list.php');
    }
}


include THIS_A_FILE_LOCATION . '/super-admin-view/page-section-view/admin_details_view.php'; 

// if($user_info['account_active']===1){
    //     echo'<div  style="float:right;padding-top:10%;margin-right:20%">
    //         <button type="submit" name="submit" value="Upload" class="btn btn-danger"> BAN </button>
    //     </div>';
    //     $ac_update = $db->action('UPDATE `users` SET `account_active`= 0 WHERE `id`='.$user_id.' ');
    // }