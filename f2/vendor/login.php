<?php
include '_a.php';

if (isset(auth()['id'])) {
    header('Location: home.php');
    exit;
}
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $user = $db->select('SELECT * FROM `member` WHERE `email`= ? and password = md5(?)', $_POST['email'],  $_POST['password']);

    if (!empty($user)) {
        unset($user[0]['password']); 
        auth_set($user[0]);
        // $_SESSION = ;
        header("Location: home.php");
        // exit;
    } else {
        set_message('Invalid email or password');    
        
    }
}
add_js(['assets/js/libs/form.js']);
pg_header();
show_banner();
?>



    
    <section class="d-block d-md-flex align-items-center error-area pb-5">
        <div class="container">
            <div class="row">
            <div class="col-6 text-center pt-150" >
                <h4> Cross-Check NOC </h4>
                <p> If you are interested to Cross-Check a NOC.  <br>
                <ul>
                <li>- You can scan the QR code, to cross check. </li>
                <li>- You have to have a Memo Number. <li>
                <li> Please go to <a href="../home/">Home Section.  </a> </li>
                <ul>
            </p>

                
            </div>
                <div class="col-5 card">

                    <div class="login-box rounded">
                        <div class="login-title text-center">
                            <!-- <img src="assets/images/cities-logo.png" alt="logo" width="80"> -->
                            <h3 class="title">Applicant Login</h3>
                        </div>
                        <div class="login-input">
                            <?php show_message();?>
                            <form action="login.php" method="POST" class="form-group bg-white">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input Required type="email" class="form-control" name="email"  id=email value="<?php echo @$_POST['email']; ?>" />
                                    
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input Required type="password" class="form-control" name="password" value="<?php echo @$_POST['password']; ?>" />
                                </div>
                                <br/>
                                <div class="form-group">
                                    <button class="btn main-btn form-control" name="login">Login <i class="fal fa-arrow-right"></i></button>
                                </div>
                                <div>
                                    <span>Need an account? <a href="registration.php">Signup</a></span>
                                    <span style="float:right;"><a href="forgot_password.php">Forgot Password</a></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>



    <a id="scroll_up"><i class="far fa-angle-up"></i></a>

    <!--====== scroll_up PART ENDS ======-->

    <style>
    .error-area {
        height: auto;
        padding: 30px 0
    }

    .container {
        flex: 1
    }
    </style>
    <?php
    
    pg_footer();
    