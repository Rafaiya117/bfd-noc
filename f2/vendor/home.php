<?php
include '_a.php';
must_login();


$rows = $db->select('SELECT * from noc_import  limit 20');
$row = $db->select('SELECT COUNT(id) AS `Total` FROM noc_import where `user_id` = ? AND noc_type = "import" order by id desc limit 100',auth()['id'] );
$row1 = $db->select('SELECT COUNT(id) AS `Total` FROM noc_import where `user_id` = ? AND noc_type = "export" order by id desc limit 100',auth()['id'] );
$licence_validity = $db->select('SELECT * from member where  `id` = ?  limit 1',auth()['id'] )[0];



pg_header();
show_banner('home');
pg_topnavbar();
breadcrumbs(' > ');

// include 'pages/nav.php';
?>

    <br>
    
    <h2 style="text-align:center">Here's Your All NOC List </h2>
    <?php
    if($licence_validity['purpose']=="Commercial"){
        echo'<h4  style="text-align:center; margin-top: 50px;"> BFD License expires   ',bd_date_format($licence_validity['company_licence_validity']),' </h4>';
    }
    ?>
    <div class="row" style="margin-top:100px;margin-left:20px;margin-right:20px; min-height:270px;">
    <div class="col-xl-6">
    <div class="card"  onclick="window.location.assign('import/list_of_nocs.php?status=100_draft')">
        <div class="card-body">
            <h4 class="header-title mb-3" style="text-align:center;">Total Import NOCs</h4>
            <div class="inbox-widget">
                <?php
                for ($i = 0, $ilen = sizeof($row); $i < $ilen; $i++) {
                    echo '<h1 style="text-align:center;"><i class="fas fa-circle" style="color:Tomato">' . $row[$i]['Total'] . '</i></h1>';
                }
                ?>
            </div> 
        </div>
    </div>
</div>

<div class="col-xl-6">
    <div class="card" onclick="window.location.assign('export/list_of_nocs.php?status=100_draft')">
        <div class="card-body">
            <h4 class="header-title mb-3" style="text-align:center;">Total Export NOCs</h4>
            <div class="inbox-widget">
                <?php
                for ($i = 0, $ilen = sizeof($row1); $i < $ilen; $i++) {
                    echo '<h1 style="text-align:center;"><i class="fas fa-circle" style="color:Tomato">' . $row1[$i]['Total'] . '</i></h1>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
</div>
<?php pg_footer(); 
