<?php
include '_a.php';
must_login();


// $rows = $db->select('SELECT * from noc_import  limit 20');
// $row = $db->select('SELECT COUNT(id) AS `Total` FROM noc_import where noc_type ="import" AND sub_of_noc ="CITES"');
// $row1 = $db->select('SELECT COUNT(id) AS `Total` FROM noc_import where noc_type ="export" AND sub_of_noc ="CITES"');
// $row2 = $db->select('SELECT COUNT(id) AS `Total` FROM noc_import where noc_type ="import" AND sub_of_noc ="NON-CITES"');
// $row3 = $db->select('SELECT COUNT(id) AS `Total` FROM noc_import where noc_type ="export" AND sub_of_noc ="NON-CITES"');

$db_dash = $db->select('SELECT
sum(if(noc_import.noc_type = "import" and noc_import.sub_of_noc ="CITES" and noc_import.status = "200_vendor_submitted" , 1, 0)) as new_cities_import,
sum(if(noc_import.noc_type = "export" and noc_import.sub_of_noc ="CITES" and noc_import.status = "200_vendor_submitted", 1, 0)) as new_cities_export,
sum(if(noc_import.noc_type = "import" and noc_import.sub_of_noc ="NON-CITES" and noc_import.status = "200_vendor_submitted" , 1, 0)) as new_non_cities_import,
sum(if(noc_import.noc_type = "export" and noc_import.sub_of_noc ="NON-CITES" and noc_import.status = "200_vendor_submitted" , 1, 0)) as new_non_cities_export, 

sum(if(noc_import.noc_type = "import" and noc_import.sub_of_noc ="CITES", 1, 0)) as cities_import,
sum(if(noc_import.noc_type = "export" and noc_import.sub_of_noc ="CITES", 1, 0)) as cities_export,
sum(if(noc_import.noc_type = "import" and noc_import.sub_of_noc ="NON-CITES", 1, 0)) as non_cities_import,
sum(if(noc_import.noc_type = "export" and noc_import.sub_of_noc ="NON-CITES", 1, 0)) as non_cities_export

from noc_import
where noc_import.status != "100_draft"
')[0];

//  pre( $db_dash , 'ss');
// $count = $db->select('SELECT COUNT(id) AS `Total` FROM noc_export');
pg_header();
show_banner('admin-dashboard', 'Dashboard');
pg_topnavbar();
breadcrumbs(' > ');
?>



    
    <div class="row" style="margin-left:20px;margin-right:20px; min-height:270px;">
    
    <div class="col-xl-6" style="padding:10px;">
        <div class="card" >
            <div class="card-body" onclick="window.location.assign('cities_import/list_of_nocs.php')">

                <h4 class="header-title mb-3" style="text-align:center;">Import CITES </h4>
                <div class="inbox-widget">
                    <img src="<?php echo APP_URL;?>/assets/images/cities-logo.png" class="img-cites-badge"  />
                    <h1 style="text-align:center;"><i class="fa-solid fa-right-long"></i>   <?php echo  $db_dash['new_cities_import'],'/', $db_dash['cities_import']; ?> </h1>                   
                </div>
            </div>
            <?php generateDateFilter('cities_import/list_of_nocs.php', 'date-from', 'date-to'); ?>
        </div>
    </div>
    <!-- end col -->
    <div class="col-xl-6" style="padding:10px;">
        <div class="card">
            <div class="card-body"  onclick="window.location.assign('cities_export/list_of_nocs.php')">
                <h4 class="header-title mb-3" style="text-align:center;">Export CITES </h4>
                <div class="inbox-widget">
                    <img src="<?php echo APP_URL;?>/assets/images/cities-logo.png" class="img-cites-badge" />
                <h1 style="text-align:center;"><i class="fas fa-left-long" style="color:Tomato"> </i> <?php echo  $db_dash['new_cities_export'],'/', $db_dash['cities_export']; ?></h1>
                </div>
            </div>
            <?php generateDateFilter('cities_export/list_of_nocs.php', 'date-from', 'date-to'); ?>
        </div>
        
    </div>
    <!-- end col -->  
</div>
<div class="row" style="margin-left:20px;margin-right:20px; min-height:270px;display:flex;">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body" onclick="window.location.assign('non_cities_import/list_of_nocs.php')">
                <h4 class="header-title mb-3" style="text-align:center;">Import NON-CITES </h4>
                <div class="inbox-widget">
                <h1 style="text-align:center;"><i class="fa-solid fa-right-long"></i>   <?php echo  $db_dash['new_non_cities_import'],'/', $db_dash['non_cities_import']; ?> </h1> 
                    
                </div>
            </div>
            <?php generateDateFilter('non_cities_import/list_of_nocs.php', 'date-from', 'date-to'); ?>
        </div>
    </div>
    <!-- end col -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body" onclick="window.location.assign('non_cities_export/list_of_nocs.php')">
                <h4 class="header-title mb-3" style="text-align:center;">Export NON-CITES </h4>
                <div class="inbox-widget">
                <h1 style="text-align:center;"><i class="fas fa-left-long" style="color:Tomato"> </i> <?php echo  $db_dash['new_non_cities_export'],'/', $db_dash['non_cities_export']; ?></h1>
                </div>
                          
            </div>
            <?php generateDateFilter('non_cities_export/list_of_nocs.php', 'date-from', 'date-to'); ?>
        </div> 
    </div>
    <!-- end col -->  
</div>
<?php pg_footer();