<?php
include '_a.php';

add_js(['assets/js/dropdown.js']);


include 'pages/header.php';

// include 'pages/nav.php';
?>
<br><div class="banner-wrapper" style="background-image:url(assets/images/2_1.png);background-size:cover;background-position:center; background-repeat:no-repeat;" >

</div>
<?php include 'pages/navbar.php'; ?>
<div class="row" style="margin-top:200px;margin-left:20px;margin-right:20px; min-height:270px;">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body" style="border:1px solid #5a6d91; box-sizing:border-box; background-color:#E5E4E2;">
                                        
    
                                        <h4 class="header-title mb-3" style="text-align:center;"><i class="fas fa-file-import"></i>&nbsp;<a href="cities_import/all_list.php" >Import</a></h4>
    
                                        <div class="inbox-widget">
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div><!-- end col -->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body" style="border:1px solid #5a6d91; box-sizing:border-box; background-color:#E5E4E2;">
                                       
    
                                        <h4 class="header-title mb-3" style="text-align:center;"><i class="fas fa-file-export"></i>&nbsp;<a href="cities_export/all_list.php">Export</a></h4>
    
                                        <div class="inbox-widget">
                                            
                                        </div>
                                    </div>
                                       
                                </div>
                               
                            </div>
                            <!-- end col -->

                        </div>    
                        

    
  <?php pg_footer();