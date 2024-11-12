<?php
// function  show_next_status_button($noc){
//     global $status_change_plan;

//     $next_status = $status_change_plan[$noc['status']][NEXT];
//     $rq_role = $status_change_plan[$noc['status']][ROLE];
//     $action_role_required = role_cutter($rq_role);
//     $login_user_role = role_cutter(auth()['role']);

//     // echo '<pre>';
//     echo 'Current Status: ', $noc['status'], '<br>';
//     echo 'Next role: ',  $action_role_required, '<br>';
//     echo 'User Next role: ', $login_user_role, '<br>';

//     if( $action_role_required <= $login_user_role){
//         echo '<div>';
//         echo '<form style="background:transparent;" method=POST >';
//         echo '<input type=hidden name=noc_id value=',$noc['id'],' />';
//         echo '<input type=hidden name=current_status value=',$noc['status'],' />';
//         echo '<input type=hidden name=next_status value=',$next_status,' />';
//         echo '<input type=hidden name=role value=',$rq_role,' />';
//         echo '<input type=submit class="btn btn-success" Value="Accept this NOC application" />';
//         echo '</form>';
//         echo '</div><br>';

//         if( $login_user_role > 39){
//             echo '<div>';
//             echo '<form style="background:transparent;" method=POST>';
//             echo '<input type=hidden name=noc_id value=',$noc['id'],' />';
//             echo '<input type=hidden name=current_status value=',$noc['status'],' />';
//             echo '<input type=hidden name=next_status value=',$next_status,' />';
//             echo '<input type=hidden name=role value=',$rq_role,' />';
//             echo '<input type=submit class="btn btn-danger" Value="Deny This Application" />';
//             echo '</form>';
//             echo '</div>';
//         }
//     }else{
//         global $role_admin;
//         echo 'You have to be ',$role_admin[$rq_role], ' or above to approve this NOC';
//     }    
// }

// function update_next_status($NOC){
//     global $status_change_plan, $db;
//     $next_status = $status_change_plan[$NOC['status']][NEXT];
//     $rq_role = $status_change_plan[$NOC['status']][ROLE];
//     $action_role_required = role_cutter($rq_role);
//     $login_user_role = role_cutter(auth()['role']);
//     if(empty($_POST)){
//         return;
//     }
//     if($_POST['noc_id']!= $NOC['id']){
//         return;
//         // echo 'NOC ID does not match';
//         // die();
//     }
    

//     if($action_role_required == 0 && $action_role_required!= $login_user_role ){
//         echo 'Vendor needs to do this step';
//         return;
//     }
//     if( $action_role_required > $login_user_role){
//         echo 'You are not authorized to change this NOC status';
//         return;
//     }

//     $db->action('Update noc_import set status =?  where id =? ', 
//         $_POST['next_status'], $NOC['id']);

//     $db->action('INSERT into digital_info (noc_id ,`status` ) values (?,?) ',
//      $NOC['id'],$next_status);

//     // header('Location: '. $_SERVER['REQUEST_URI']);
//     // exit();
//     header('Location:list_of_nocs.php?status='.$next_status);
//     exit();
// }

//7/6/2024
// function update_next_status($NOC)
// {
//     global $status_change_plan, $db;
//     $next_status = $status_change_plan[$NOC['status']][NEXT] ?? null;
//     $rq_role = $status_change_plan[$NOC['status']][ROLE] ?? null;
//     $action_role_required = role_cutter($rq_role);
//     $login_user_role = role_cutter(auth()['role']);

//     if (empty($_POST) || !isset($_POST['noc_id'])) {
//         return; 
//     }
//     if (!$next_status || !$rq_role) {
//         return; 
//     }

//     if ($action_role_required == 0 && $action_role_required != $login_user_role) {
//         echo 'Vendor needs to do this step';
//         return;
//     }

//     if ($action_role_required > $login_user_role) {
//         echo 'You are not authorized to change this NOC status';
//         return;
//     }

//     if (isset($_POST['accept'])) {
//         $db->action('UPDATE noc_import SET status =? WHERE id =?', $next_status, $NOC['id']);
//         header('Location: '. $_SERVER['REQUEST_URI']);
//         exit();
//     } elseif (isset($_POST['deny'])) {
//         $db->action('UPDATE noc_import SET status =? WHERE id =?', '99_rejected', $NOC['id']);
//         header('Location: '. $_SERVER['REQUEST_URI']);
//         exit();
//     }

  
    // $db->action('UPDATE noc_import SET status = ? WHERE id = ?', $next_status, $NOC['id']);

    // header('Location: ' . $_SERVER['REQUEST_URI']);
    // exit();
//}
// function show_next_status_button($noc)
// {
//     global $status_change_plan;

//     $next_status = $status_change_plan[$noc['status']][NEXT];
//     $rq_role = $status_change_plan[$noc['status']][ROLE];

//     if (!isset($status_change_plan[$next_status])) {
//         return; 
//     }
//     $new_role= $status_change_plan[$next_status][ROLE];
//     $action_role_required = role_cutter($rq_role);
//     $login_user_role = role_cutter(auth()['role']);

//     // echo '<pre>';
//     // echo 'Current Status: ', $noc['status'], '<br>';
//     // echo 'Next role: ',  $new_role, '<br>';
//     // echo 'User role: ', $login_user_role, '<br>';

//     if ($action_role_required <= $login_user_role) {
      
//         echo '<div >';
//         echo '<form style="background:transparent;" method=POST >';
//         echo '<input type=hidden name=noc_id value=', $noc['id'], ' />';
//         echo '<input type=hidden name=current_status value=', $noc['status'], ' />';
//         echo '<input type=hidden name=next_status value=', $next_status, ' />';
//         echo '<input type=hidden name=role value=', $rq_role, ' />';
        
//         echo '<input type=submit name="accept" class="btn btn-success" Value="Accept this NOC application" />';
//         echo '</form>';
//         echo '</div><br><br>';
        
       
//         if ($login_user_role > 39) {
//             echo '<div>';
//             echo '<form style="background:transparent;" method=POST>';
//             echo '<input type=hidden name=noc_id value=', $noc['id'], ' />';
//             echo '<input type=hidden name=current_status value=', $noc['status'], ' />';
//             echo '<input type=hidden name=next_status value=', $next_status, ' />';
//             echo '<input type=hidden name=role value=', $rq_role, ' />';
//             echo '<input type=submit  name="deny" class="btn btn-danger" Value="Deny this Application" />';
//             echo '</form>';
//             echo '</div>';
//         }
//     } 
//     else {
//         global $role_admin;
//         echo 'You have to be ', $role_admin[$rq_role], ' or above to approve this NOC';
//     }

    
// }

///oldddddd
// function update_next_status($NOC)
// {
//     global $status_change_plan, $db;
//     $next_status = $status_change_plan[$NOC['status']][NEXT];
//     $rq_role = $status_change_plan[$NOC['status']][ROLE];
//     $action_role_required = role_cutter($rq_role);
//     $login_user_role = role_cutter(auth()['role']);
//     // echo '<pre>';
//     // echo 'cc :: ', $NOC['status'], ':: ';; 
//     // echo 'cd :: ', $next_status, ':: ';; 

//     // print_r($status_change_plan);
//     // print_r($NOC);
//     // die();

   

//     if (empty($_POST)) {
//         return;
//     }
//     if ($_POST['noc_id'] != $NOC['id']) {
//         return;
//         // echo 'NOC ID does not match';
//         // die();
//     }

//     if(empty($_POST['current_status']) && empty($_POST['next_status']) && empty($NOC['status']) && empty($next_status) ) {
        
//         return;
//     }


//     if ($action_role_required == 0 && $action_role_required != $login_user_role) {
//         echo 'Vendor needs to do this step';
//         return;
//     }
//     if ($action_role_required > $login_user_role) {
//         echo 'You are not authorized to change this NOC status';
//         return;
//     }

  
//     // if($login_user_role == 20){
//     //     $db->action('UPDATE noc_import SET conditions = ? where id = ?', $_POST['conditions'], $NOC['id']);
//     // }
    

//     $db->action('Update noc_import set status = ?  where id = ? ',
//     $next_status, $NOC['id']);

//     $db->action('INSERT into digital_info (noc_id ,`status` , type_note,admin_designation,admin_note,sign,admin_name ) values (?,?, "status_change",?,?,?,?) ',
//         $NOC['id'], $next_status);

//     // $action = $db->select('SELECT * FROM useres WHERE `role` = ?', $new_role);
// 	// $recipientData = $action[0];
// 	// $recipientEmail = $recipientData['email'];
// 	// $subject = "";
// 	// $body = "";
// 	// $adminDesignation = $recipientData['designation'];
	 
// 	// sendEmail($recipientEmail, $subject, $body);
// 	// $db->action('INSERT into  email_details (`status`, recipient_email, `subject`, body, admin_designation) values (?, ?, ?, ?, ?)',$NOC['status'], $recipientEmail, $subject, $body, $adminDesignation);    

//     header('Location: '. $_SERVER['REQUEST_URI']);
//     exit();
//     // header('Location:list_of_nocs.php?status=' . $next_status);
//     // exit();
// }

/////9/9/24
// function update_next_status($NOC)
// {
//     global $status_change_plan, $db;
    
//     $next_status = $status_change_plan[$NOC['status']][NEXT] ?? null;
//     $rq_role = $status_change_plan[$NOC['status']][ROLE] ?? null;
//     $action_role_required = role_cutter($rq_role);
//     $login_user_role = role_cutter(auth()['role']);

    // $vendor = $db->select('SELECT * from member where id = ?', $NOC['user_id'])[0];
    // $result = $db->select('SELECT * from digital_info where noc_id = ?', $NOC['id']);
    // if (!empty($result)) {
    //     $admin_commnt = $result[0];
    // } else {
    //     $admin_commnt = null;
    // }

    // $status_required_role = [
    //     '401_deskofficer_verification_incomplete' => '20_Desk_Officer',
    //     '501_DCF_verification_incomplete' => '30_DCF',
    //     '601_CF_verification_incomplete' => '40_CF',
    //     '701_CCF_verification_incomplete' => '50_CCF'
    // ];
    

    // if (empty($_POST) || !isset($_POST['noc_id'])) {
    //     return; 
    // }
    // if (!$next_status || !$rq_role) {
    //     return; 
    // }

    // if ($action_role_required == 0 && $action_role_required != $login_user_role) {
    //     echo 'Vendor needs to do this step';
    //     //show_message();
    //     return;
    // }


    // if ($action_role_required > $login_user_role) {
    //     echo 'You are not authorized to change this NOC status';
    //     return;
    // }

    // if (isset($_POST['accept']) || isset($_POST['done'])) {
    //     $db->action('UPDATE noc_import SET status =? WHERE id =?', $next_status, $NOC['id']);
    //     header('Location: '. $_SERVER['REQUEST_URI']);
    //     exit();
    // }
    // else if (isset($_POST['deny']) && isset($_POST['denyReason'])) {
    //     $db->action('UPDATE noc_import SET `status` = ?, `denyReason` = ? WHERE id = ?', '99_rejected', $_POST['denyReason'], $NOC['id']);
    //     header('Location: ' . $_SERVER['REQUEST_URI']);
    //     exit();
    // }
    // else if (isset($_POST['incomplete'])) {
    //     $db->action('UPDATE noc_import SET status = ? WHERE id = ?', '201_vendor_application_incomplete', $NOC['id']);
    //     header('Location: ' . $_SERVER['REQUEST_URI']);
    //     exit();
    // }
    // else if (isset($_POST['submit_chalan_again']) && $_POST['noc_id']) {
    //     $db->action('UPDATE noc_import SET `status` = ? WHERE id = ?', '801_vendor_payment_inappropiate', $NOC['id']);
    //     $vendor_email = $vendor['email']; // assuming the vendor's email is stored in the $aplicant array
    //     $subject = "NOC Payment Inappropiate";
    //     $body = 'Dear Vendor, Your NOC payment has been marked as inappropiate."'.$admin_commnt ['admin_note'].'".Please review and resubmit the payment.';
    //     sendEmail($vendor_email, $subject, $body);
    //     header('Location: ' . $_SERVER['REQUEST_URI']);
    //     exit();
    // } 
    // else if (isset($_POST['documents_not_right']) || isset($_POST['incomplete']) && $_POST['noc_id']) {
    //     $db->action('UPDATE noc_import SET `status` = ? WHERE id = ?', '201_vendor_application_incomplete', $NOC['id']);
    //     $vendor_email = $vendor['email']; // assuming the vendor's email is stored in the $aplicant array
    //     $subject = "NOC Application Incomplete";
    //     $body = 'Dear Vendor, Your NOC application has been marked as incomplete."'.$admin_commnt ['admin_note'].'". Please review and resubmit the application.';
    //     sendEmail($vendor_email, $subject, $body);
    //     header('Location: ' . $_SERVER['REQUEST_URI']);
    //     exit();
    // }
    // else if (isset($_POST['back'])) {
    //     //print_r($_POST);
    //     $status = $_POST['status'];
    //     // Update status in database for send back action
    //     $db->action('UPDATE noc_import SET `status` =? WHERE id =?', $status, $NOC['id']);
    //     header('Location: '. $_SERVER['REQUEST_URI']);
    //     exit();
    // }
    
  
    // $db->action('UPDATE noc_import SET status = ? WHERE id = ?', $next_status, $NOC['id']);

    // header('Location: ' . $_SERVER['REQUEST_URI']);
    // exit();
//}

//include 'modal.php';