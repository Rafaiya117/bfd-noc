<?php
include '_a.php';
must_login();
add_js(['assets/js/dropdown.js']);


// include '.../../views/page-sections/header.php';
pg_header();
show_banner('import-export');
pg_topnavbar();
?>


<div class="row" style="margin-top:200px;margin-left:20px;margin-right:20px; min-height:270px;">
    <div class="col-xl-6">
        <div class="card">
            <form method="POST" enctype="multipart/form-data">
            <div class="card-body" style="border:1px solid #5a6d91; box-sizing:border-box; background-color:#E5E4E2;">
                    <input type="hidden" name="noc_type" id="noc_type" value="import"/>
                    <h4 class="header-title mb-3" style="text-align:center;"><i class="fas fa-file-import"></i>&nbsp;<a href="import/create_new_noc.php?noc_type=import" type="submit" name="id" id="id">Import</a></h4>
                    <!-- <button type="submit" name="id" id="id" class="btn btn-primary">Import</button> -->
                <div class="inbox-widget"></div>
            </form> 
            </div>
        </div>
    </div><!-- end col -->
    <div class="col-xl-6">
        <div class="card">
            <form method="POST" enctype="multipart/form-data">
                <div class="card-body" style="border:1px solid #5a6d91; box-sizing:border-box; background-color:#E5E4E2;">
                    <input type="hidden" name="noc_type" id="noc_type" value="export"/>
                    <h4 class="header-title mb-3" style="text-align:center;"><i class="fas fa-file-import"></i>&nbsp;<a href="export/create_new_noc.php?noc_type=export"  type="submit" name="id" id="id">Export</a></h4>
                    <!-- <button type="submit" name="id" id="id" class="btn btn-primary">Export</button> -->      
                <div class="inbox-widget"></div></div>
            </form></div>
        </div>
    </div>

<?php
pg_footer();
