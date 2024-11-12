<?php

include '_a.php';

if(@$_GET['id']){
    $user_id = $_GET['id'];
    $rows  = $db->select('SELECT * from `super-admin` where id =?',$user_id);
    
    $user_info = $rows[0];
  
}
if(!empty($_POST)){
    //print_r($_POST);
   $update_data = $db->action('UPDATE users SET `username`= ?,`name`= ?,`email`= ?,`phone` = ?, `employee_id` = ?,`organization` = ?, `designation` = ?, `role`= ?  where id= ?',
   $_POST['username'], $_POST['name'], $_POST['email'],$_POST['phone'],$_POST['employee_id'],$_POST['organization'],$_POST['designation'],$_POST['role'],$user_id);
   header('Location:admin_list.php');
}

include '../super-admin-view/page-section-view/Useredit_profile_view.php';