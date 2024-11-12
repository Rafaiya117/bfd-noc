<?php





$url_role = @$_GET['role'];
$status = @$_GET['status'] ?? '100_draft';


if ($url_role) {
    // $headx = 'List of NOC Application for Deskofficer';
    $headx = 'Application for NOC';
} else {
    $headx = $status_to_headx[$status];
}

if (!empty($url_role) && isset($links_to_detail_page[$url_role])) {
    $goto_link = $links_to_detail_page[$url_role];
} elseif (!empty($status) && isset($links_to_detail_page[$status])) {
    $goto_link = $links_to_detail_page[$status];
} else {
    $goto_link = ''; // or some default value
}




$roles = role_cutter(auth()['role']);

$query = 'SELECT * FROM noc_import WHERE `status` = ? AND `sub_of_noc` = ? AND noc_type = ? ORDER BY id DESC LIMIT 100';
$params = [$status, $this_sub, $this_noc_type];

if ($url_role === '10_Assistant') {
    $query = 'SELECT * FROM noc_import WHERE (`status` = ? OR `status` = ? OR `status` = ? OR `status` = ?) AND `sub_of_noc` = ? AND noc_type = ? ORDER BY id DESC LIMIT 100';
    $params = ['200_vendor_submitted','201_vendor_application_incomplete' ,'801_vendor_payment_inappropiate','850_payment_check', $this_sub, $this_noc_type];
} elseif ($url_role === '20_Officer') {
    $query = 'SELECT * FROM noc_import WHERE (`status` = ? OR `status` = ? OR `status` = ?) AND `sub_of_noc` = ? AND noc_type = ? ORDER BY id DESC LIMIT 100';
    $params = ['400_deskofficer_verification', '401_deskofficer_verification_incomplete', '950_waiting_for_printing', $this_sub, $this_noc_type];
} elseif ($url_role === '30_DCF') {
    $query = 'SELECT * FROM noc_import WHERE (`status` = ? OR `status` = ?) AND `sub_of_noc` = ? AND noc_type = ? ORDER BY id DESC LIMIT 100';
    $params = ['500_DCF_verification', '501_DCF_verification_incomplete', $this_sub, $this_noc_type];
} elseif ($url_role === '40_CF') {
    $query = 'SELECT * FROM noc_import WHERE (`status` = ? OR `status` = ? OR `status` = ?) AND `sub_of_noc` = ? AND noc_type = ? ORDER BY id DESC LIMIT 100';
    $params = ['600_CF_verification', '601_CF_verification_incomplete', '900_payment_confirmed', $this_sub, $this_noc_type];
} elseif ($url_role === '50_CCF') {
    $query = 'SELECT * FROM noc_import WHERE (`status` = ? OR `status` = ?) AND `sub_of_noc` = ? AND noc_type = ? ORDER BY id DESC LIMIT 100';
    $params = ['700_CCF_verification', '701_CCF_verification_incomplete', $this_sub, $this_noc_type];
}



if(empty( @$_GET['role']) && empty( @$_GET['status'])){
    $query = 'SELECT * FROM noc_import WHERE `status` != "100_draft" AND `sub_of_noc` = ? AND noc_type = ? ORDER BY id DESC LIMIT 200';
    $params = [$this_sub, $this_noc_type];
    $headx = 'List of All NOC Application';
}



//  pre($rows, 'LOOOKED');

if(!empty($_POST)){
    
    $headx = 'Search Result for NOC Application between "'.bd_date_format($_POST['date-from']).'" and "'.bd_date_format($_POST['date-to']).'" ';
    $query = 'SELECT * FROM noc_import WHERE `status` != "100_draft" AND `sub_of_noc` = ? AND noc_type = ? and application_date between ? and ? ORDER BY id DESC LIMIT 200';
    $params = [$this_sub, $this_noc_type, $_POST['date-from'], $_POST['date-to']];
    // pre($_POST, 'lockewww');

}

$rows = $db->select($query, ...$params);

$section_of_site = $this_sub . ' ' . ucfirst($this_noc_type);
pg_header();
show_banner($this_sub, $section_of_site);
pg_topnavbar();
pg_navbar2();
breadcrumbs(' > ');

?>

    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper card">
                <div class="table-title">
                    <div class="row">

                    <div class="card-body"><h3 style="color:  #FFFFFF"><?php echo $headx ?></h3></div>
                        
                    </div>
                </div>
                
                <?php
                show_noc_list($rows, $goto_link);
                ?>
            </div>
        </div>
    </div>

<?php pg_footer();