<?php
use function Composer\Autoload\includeFile;
include dirname(__FILE__).'/../lib/phpqrcode/qrlib.php';

function qr_code_genator($NOC){
    global $db;
    $qrcode_partial = '/qr_code/'.'noc_' . $NOC['id'] . '.png';             
    QRcode::png(BASEURL . '/f2/home/full_details.php?id=' . $NOC['id'], IMG_PATH. $qrcode_partial);      
    $updat_status = $db->action('UPDATE noc_import SET `qr_code` = ? WHERE  id = ?',
     $qrcode_partial, $NOC['id']);
}