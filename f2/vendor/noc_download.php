<?php
include '_a.php';

must_login();
$memo_id = false;
$noc_id = @$_GET['id'];
if(!empty($noc_id)){
    $row = $db->select('SELECT memo_id from noc_import where `status` = "1000_signed_document" and id = ? and user_id = ?', $noc_id, auth()['id']);
    if(!empty($row)){
        $memo_id = $row[0]['memo_id'];
    }
}



if($memo_id){
    // echo IMG_URL . '/noc_pdf/' . $memo_id. '.pdf';
    // header('location: ' . IMG_URL.'/noc_pdf/'. $memo_id. '.pdf');
    // exit;
    header("Content-type:application/pdf");
    header('Content-Disposition:attachment; filename= '. $memo_id. '.pdf');
    readfile(IMG_PATH.'/noc_pdf/'. $memo_id. '.pdf');
    exit;
}else{
    set_message('NOC (PDF File) Not found, Please contact BFD admin.', 'danger');
    header('Location: ' .  $_SERVER['HTTP_REFERER']);
    // get back 
    exit;

}






