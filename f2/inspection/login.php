<?php
// include 'api/util/_a.php';
include '../../api/util/_a.php'; // for testing purposes
include 'pages/header.php';
?>

<body>

    <div class="banner-wrapper" style="background-image:url(assets/images/8.png);background-size:cover;background-position:center; background-repeat:no-repeat;">
        <div class="logo-container p-0">
            <table>
                <td><img src="assets/images/bon-logo.png" style="margin-top: 30px;" width="100" /></td>
                <td align="right"><img src="assets/images/cities-logo.png" style="margin-left:25px;    margin-top: -25px;" width="100" /></td>
            </table>
        </div>
        <h1 class="text-center text-white" style="text-shadow:1px 1px 3px black;margin-top: -70PX">
            <p class="text-center text-white" style="text-shadow:1px 1px 3px black;     font-size: 30px;">CITES Permit/Certificate and NOC System</p>

        </h1>
    </div>

    <section class="d-block d-md-flex align-items-center error-area pb-5">



        <!-- <div class="banner-thumb">
            <img src="../assets/images/banner-thumb.png" alt="thumb">
        </div> -->



        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="login-box rounded">
                        <div class="login-title text-center">
                            <!-- <img src="../assets/images/cities-logo.png" alt="logo" width="80"> -->
                            <h3 class="title">Post Management Login</h3>
                        </div>
                        <div class="login-input">
                            <?php if (isset($_SESSION['message'])) : ?>
                            <div class="alert alert-<?php echo $_SESSION['message']['alert'] ?> msg">
                                <?php echo $_SESSION['message']['text'] ?></div>
                            <script>
                            (function() {
                                // removing the message 3 seconds after the page load
                                setTimeout(function() {
                                    document.querySelector('.msg').remove();
                                }, 3000)
                            })();
                            </script>
                            <?php
                            endif;
                            // clearing the message
                            unset($_SESSION['message']);
                            ?>
                            <form action="login_query.php" method="POST" class="form-group bg-white">


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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>



    <?php pg_footer();