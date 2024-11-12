<?php
include_once '_a.php';
?>
<!doctype html>
<html lang="en">
<head>

    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    
    <?php 
    
    // write_css($css_libs, VENDOR_URL);
    // write_css($css_sites, ''); 
    ?>
   
</head>
<body>
<div id="modal_action" class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="exampleModalXlLabel" aria-hidden="true" role="dialog" >
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      
        <div class="modal-header"> </div>
        <div class="modal-body"> </div>

    </div>
  </div>
</div>
<div class="site-wrapper">


<?php 
include THIS_A_FILE_LOCATION.'views/page-view/body_approved_noc_detail_view.php';?>


<?php 
    // echo '<script> let APP_URL="',APP_URL,'"; </script>';
    // echo '<!--all JS!! --->',PHP_EOL;
    
    // write_js($js_libs ,APP_URL);
    // write_js($js_libs_sites ,'');
    // echo '<!--extra JS --->',PHP_EOL;
    // write_js($js_add_footer, APP_URL);
    // \u09F3 \u09F3
?>
<br>
<footer>
    <div class="footer">
        
        <p> <a href="https://bforest.gov.bd/" > Bangladesh Forest Department </a></p>
    </div>
</footer>
</div>
</body>
</html>