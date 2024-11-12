<?php
include '_a.php';

if (isset($_POST['search'])) {
    $id = $_GET['id'];
    
}
// add_js(['assets/js/search.js']);

pg_header();
show_banner('home8', '');
// pg_topnavbar();
echo '<div class="container" >';
show_message();
echo '</div>';
?>


    <section>
    
        <div class="container">
        
            <div class="row">
                <div class="col-md-12">
                
                    <form class="card-body bg-secondary rounded" action="public_verify.php" method="POST">
                        <div class="banner-content">
                        
                            <h3 class="title text-white titleh3sm">Cross-checking of CITES Permit/Certificate or NOC</h3>
                            <label class="text-white">Enter Memo No.</label>
                            <div class="form-group">
                                <input type="text" name="memo_id" id="import_memo_id" class="form-control form-control-lg inner-textfield" placeholder="22.01.0000.101.23.113.2021.1977">
                            </div>
                            <ul>
                                <li><input id="search" class="btn btn-lg btn-primary" type="submit" value="Verify"></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <form class="c-card-body bgg-secondary rounded" action="public_verify_export.php" method="POST">
                        <div class="banner-content">
                            <!-- <h3 class="title text-white">Cross-checking of CITES Permit/Certificate or NOC (Export)</h3>
                            <label class="text-white">Enter Memo No.</label> -->
                            <!-- <div class="form-group">
                                <input type="text" name="export_memo_id" id="export_memo_id" class="form-control form-control-lg inner-textfield" placeholder="22.01.0000.101.23.113.2021.1977">
                            </div>
                            <ul>
                                <li><input id="search" class="btn btn-lg btn-primary" type="submit" value="Verify"></li>
                            </ul> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="banner-thumb">
            <img src="assets/images/banner-thumb.png" alt="thumb">
        </div> -->

        <div class="container">
            <div class="row">
                <div class="col-12 center-bx">
                    
                    <div class="card-body"><h3 class="title">Login</h3></div>
                    <a class="btn btn-primary btn_homeLogin" href="../vendor/login.php"> Applicant Login</a>
                    <a class="btn btn-success btn_homeLogin" href="../admin/login.php" > Admin Login </a>
                    
                </div>
            </div>
        </div>
    
</section>



    <!--====== scroll_up PART START ======-->

    <a id="scroll_up"><i class="far fa-angle-up"></i></a>

    <!--====== scroll_up PART ENDS ======-->

    <style>
        .error-area {
            height: auto;
            padding: 30px 0
        }
        section{
            display: flex;
            margin-bottom: 100px;
            
        }

        section .container {
            flex: 1;
            margin:  20px;
            /* background-color: white; */

        }
        .center-bx{
            display: grid;
            align-items: center;
        }
    </style>
<?php pg_footer();