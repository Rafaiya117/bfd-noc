<?php

include '_all_no_login.php';
include 'login_query.php';
pg_header();
show_banner('login', '<br>Welcome BFD Official');
// include 'pages/header.php';
?>



    <section class="d-block d-md-flex align-items-center error-area pb-5">
        <div class="container">
            <div class="row">
            <div class="col-6 text-center pt-150" >
                <h4>BFD Office Section  </h4>
                <p> 
                    
                This area is designed exclusively for BFD Officials. <br> If you are not a BFD Official, please return to the <a href="../home/">Home Section</a>. <br>Thank you for your understanding.
                </p>

                
            </div>
                <div class="col-5 card">

                    <div class="login-box rounded">
                        <div class="login-title text-center">
                            <!-- <img src="../assets/images/cities-logo.png" alt="logo" width="80"> -->
                            <h3 class="title">Admin Login</h3>
                        </div>
                        <div class="login-input">
                            <?php show_message(); ?>
                            <form method="POST" class="form-group bg-white">


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
                                    <button class="btn main-btn form-control" name="login">Login <i class="fal fa-arrow-right"></i></button>
                                </div>
                                <!-- <span>Need an account? <a href="forest_dept.php">Signup</a></span> -->
                                <span style="float:inline-start;"><a href="forgot_password.php">Forgot Password</a></span>
                                <span style="float:inline-end;"><a href="../supper-admin/login.php">Super Admin Login</a></span>
                                &nbsp;
                                <span style="float:inline-end; padding-right: 20px;"><a href="../inspection/login.php">Post management</a></span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>



    <?php   pg_footer(); 
