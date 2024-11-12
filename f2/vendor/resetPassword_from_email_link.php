<?php
include '_a.php';



$session_id = @$_GET['SESSION_VALID'];
$user_id = @$_GET['user_id'];
// if(!empty(auth())){
//     header('location: user_profile.php');
//     exit;
// }

function error_try_again(){

    set_message('Sorry! Wrong Link, Please send reset password again.', 'danger');
    header('location:login.php');
    exit;
}


if(empty($session_id) || empty($user_id)){
    
    error_try_again();
}

$mdata = $db->select('SELECT * from vendor where `id` = ? AND `forgot_password` = ? limit 1; ', $user_id, $session_id);
if(empty($mdata)){
    error_try_again();
}

$user = $mdata[0];




// $my_profile = $db->select('SELECT * from `vendor` where id = ?',auth()['id'])[0];

// if(empty($my_profile)){
//    set_message('User not found.', 'danger');
//    header('location: user_profile.php');
// }

if (!empty($_POST)) { 
   $_POST['password'] = trim($_POST['password']);
   $_POST['repassword'] = trim($_POST['repassword']);
   if($_POST['password'] === $_POST['repassword']){
      // $password = ($_POST['password']); 
      // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $updt = $db->action('UPDATE member SET `password`= md5(?),  `forgot_password` = LEFT(UUID(), 8) WHERE `id`= ? limit 1;', $_POST['repassword'], $user['id']);
      // echo 'UPDATE users SET `password`= md5(?) WHERE `id`= ? limit 1;',$_POST['repassword'], auth()['id'];

      set_message('Password reset successfully.', 'success');
      header('location: login.php');
      exit();
   }else{
      set_message('Password Miss Match.', 'danger');
      header('location: '. $_SERVER['REQUEST_URI']);
      exit();
   }

} 

pg_header();
show_banner('login', 'Rest your password.');
// pg_topnavbar();
// pg_navbar2();





?>
<div class="card">
   <div class="container card-body">
     <h3 class="table-title1">Reset Your Password</h3>
        
        <form method="POST" >

           <label for="pasword">Set Password</label>
           <input type="password" name="password" id="pasword" class="form-control" /><br>
           <label for="repassword">Repeat Password</label>
           <input type="password" name="repassword" id="repassword" class="form-control" /><br>
           <button type="submit" name="submit" value="Upload" class="btn btn-primary">Save Password </button>
        </form>
       
   </div>
</div>
<?php pg_footer();