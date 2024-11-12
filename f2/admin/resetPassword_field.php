<?php

include '_all_no_login.php';

$my_profile = $db->select('SELECT * from `users` where id = ?',auth()['id'])[0];

if(empty($my_profile)){
   set_message('User not found.', 'danger');
   header('location: user_profile.php');
}

if (!empty($_POST)) { 
   $_POST['password'] = trim($_POST['password']);
   $_POST['repassword'] = trim($_POST['repassword']);
   if($_POST['password'] === $_POST['repassword']){
      // $password = ($_POST['password']); 
      // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $updt = $db->action('UPDATE users SET `password`= md5(?) WHERE `id`= ? limit 1;', $_POST['repassword'], auth()['id']);
      // echo 'UPDATE users SET `password`= md5(?) WHERE `id`= ? limit 1;',$_POST['repassword'], auth()['id'];

      set_message('Password reset successfully.', 'success');
      header('location: user_profile.php');
      exit();
   }else{
      set_message('Password Miss Match.', 'danger');
      header('location: resetPassword_field.php');
      exit();
   }

} 

pg_header();
show_banner('home', 'Reset Password');
pg_topnavbar();
// pg_navbar2();
breadcrumbs(' > ');




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