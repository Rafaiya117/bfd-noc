<?php
include '_all_no_login.php';
include _A_API_FILE_LOCATION .'../email/function.php';


if(!empty($_POST['email'])){

    $member_data = $db->select('SELECT * from users where `email` = ?',$_POST['email'])[0];
    //print_r($member_data);
    $id = $member_data['id'];

        if (!$member_data) {
            return "User not found"; 
        }
        else if($member_data){
            $db->action('UPDATE users SET `forgot_password` = md5(now()) WHERE `id` = ? ',$member_data['id']);
            $member_data = $db->select('SELECT * FROM users WHERE id=?', $member_data['id'])[0];
            $baseUrl= BASEURL;
            $resetLink = $baseUrl . '/f2/admin/resetPassword_from_email_link.php?user_id=' . $member_data['id'].  '&SESSION_VALID=' .$member_data['forgot_password'];
            $result = resetPassword($_POST['email'], $resetLink);
            set_message('An email has been sent. Please check your email.', 'success');
            header('location:login.php');
            exit;
            //echo $result;
        }
       
    } 

pg_header();
show_banner('login', 'Please enter your email to reset your password.');
?>
<div class="card">
    <div class="container card-body">
        <h4>Enter Your Email</h4>
         <form method="POST" action="forgot_password.php" enctype="multipart/form-data">
            <input name="email" id="email" class="form-control" value=""/><br>
            <button type="submit" name="submit" value="Upload" class="btn btn-primary"> Send mail </button>
        </form>
    </div>
</div>
<?php pg_footer();