<?php
include '_a.php';


add_js(['assets/js/dropdown.js']);


pg_header();
show_banner('import-export-2_1', 'Home');
pg_topnavbar();
breadcrumbs(' > ');
// include 'pages/nav.php';
?>

<div class="row" style="margin-top:200px;margin-left:20px;margin-right:20px; min-height:270px;">
    <div class="col-xl-6">
        <div class="card" id="cites-card">
            <div class="card-body" style="border:1px solid #5a6d91; box-sizing:border-box; background-color:#E5E4E2;">
                <h4 class="header-title mb-3" style="text-align:center;">CITES</h4>
                <ul id="cites-list" style="display:none;">
                    <li><i class="fas fa-file-import"></i>&nbsp;<a href="cities_import/all_list.php" >Import</a></li>
                    <li><i class="fas fa-file-export"></i>&nbsp;<a href="cities_export/all_list.php">Export</a></li>
                </ul>
            </div>
        </div>
    </div><!-- end col -->
    <div class="col-xl-6">
        <div class="card" id="non-cites-card">
            <div class="card-body" style="border:1px solid #5a6d91; box-sizing:border-box; background-color:#E5E4E2;">
                <h4 class="header-title mb-3" style="text-align:center;">NON-CITES</h4>
                <ul id="non-cites-list" style="display:none;">
                    <li><i class="fas fa-file-import"></i>&nbsp;<a href="non_cities_import/all_list.php" >Import</a></li>
                    <li><i class="fas fa-file-export"></i>&nbsp;<a href="non_cities_export/all_list.php">Export</a></li>
                </ul>
            </div>
        </div>
    </div><!-- end col -->
</div>    

<script>
    document.getElementById('cites-card').addEventListener('click', function() {
        document.getElementById('cites-list').style.display = 'block';
    });
    
    document.getElementById('non-cites-card').addEventListener('click', function() {
        document.getElementById('non-cites-list').style.display = 'block';
    });
</script>

<?php pg_footer();