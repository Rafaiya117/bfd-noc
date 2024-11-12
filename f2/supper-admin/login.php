<?php
// include 'api/util/_a.php';
include '_a.php'; // for testing purposes




if (isset(auth()['id'])) {
    header('Location: dashboard.php');
    exit;
}


if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $user = $db->select('SELECT * FROM `super-admin` WHERE `email`=? AND `password`= md5(?)', $_POST['email'],  $_POST['password']);

    if (!empty($user)) {
        unset($user[0]['password']); 
        auth_set($user[0]);
        // $_SESSION = ;
        header("Location: dashboard.php");
        // exit;
    } else {
        set_message('Invalid email or password');    
        
    }
}


add_js(['assets/js/libs/form.js']);
pg_header();
show_banner('login', 'Super Admin Login :: Online NOC System');

// include 'pages/header.php';
?>




        <div class="container">
            <div class="row">
            <div class="col-6 text-center pt-100">
                <h4>Warring:  Restricted Section  </h4>
                <p> This section of the app is for only BFD system managers. <br>
                Please go back to <a href="../home/">Home Section. </a> </p>


            </div>
                <div class="col-5 card pt-20">

                    <div class="login-box rounded">
                        <div class="login-title text-center">
                            <!-- <img src="../assets/images/cities-logo.png" alt="logo" width="80"> -->
                            <h3 class="title">Super Admin Login</h3>
                        </div>
                        <div class="login-input">
                            <?php show_message(); ?>
                            <form action="" method="POST" class="form-group bg-white">


                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" />
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" />
                                </div>
                                <br />
                                <div class="form-group">
                                    <button class="btn main-btn form-control" name="login">Login <i
                                            class="fal fa-arrow-right"></i></button>
                                </div>
                               

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    



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
<?php pg_footer();