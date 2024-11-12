<?php
// use function Composer\Autoload\includeFile;


if (empty(@$_GET['id'])) {
    header('Location: ' . APP_URL . '/dashboard.php');
    exit();
}
$noc = $db->select('SELECT * from noc_import where id = ?', @$_GET['id'])[0];
pg_header();
show_banner($noc['sub_of_noc'], ' Application Details');
pg_topnavbar();
pg_navbar2();
breadcrumbs(' > ');



if(!empty($noc)){
    echo '<div class="container card-body"> <a href="',IMG_URL,'/noc_pdf/', $noc['memo_id'],'.pdf" class="btn btn-success" >Download NOC</a></div>';
}

$NOC = $noc;

include 'body_approved_noc_detail_view.php';



pg_footer();
