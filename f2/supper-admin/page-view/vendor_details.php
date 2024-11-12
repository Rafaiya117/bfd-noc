<?php

include '_a.php';

if(@$_GET['id']){
    $user_id = $_GET['id'];
    $user_data  = $db->select('SELECT * from member where id =?',$user_id)[0];
    // echo'<pre>';
    // print_r($user_data);
}
if(!empty($_POST)){
   $update_data = $db->action('UPDATE member SET `name`= ?,`address`= ?,`phone`= ?,`nid` = ?,`email` = ?,`password` = md5(?),`district` = ?,`upazila` = ?,
   `company_name` = ?,`company_licence_validity` = ?, `applicant_designation` = ?,`affliation_applicant` = ?,`company_licence_num` = ?, `purpose` =? where id= ?',
   $_POST['name'],$_POST['address'],$_POST['phone'],$_POST['nid'],$_POST['email'],$_POST['password'],$_POST['district'],$_POST['upazila'],$_POST['company_name'],
   $_POST['company_licence_validity'],$_POST['applicant_designation'],$_POST['affliation_applicant'],$_POST['company_licence_num'],$_POST['purpose'],$user_id);
   header('Location:vendor_list.php');
}

include '../super-admin-view/page-section-view/vendor_details_view.php';