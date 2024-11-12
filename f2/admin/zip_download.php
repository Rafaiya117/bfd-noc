<?php
include '_a.php';

must_login();

$noc_id = @$_GET['id'];
$noc = false;
$applicant = null;
if(!empty($noc_id)){
    $row = $db->select('SELECT * from noc_import where id = ?  limit 1', $noc_id);
    if(!empty($row)){
        $noc = $row[0];
        $applicant = $db->select('SELECT * from vendor where id = ?  limit 1', $noc['user_id'])[0];
    }
}


if(!$applicant){
    set_message('can not download Zip, Please check Files. ', 'danger');
    
    // get back 
    exit;
}

function _get_files($NOC, $user) {
    $files = [];

    if ($user['licence_copy'] != Null) {
        
        $files[] = $user['licence_copy'];
    }

    if ($NOC['health_certificate_img'] != Null) {
        
        $files[] = $NOC['health_certificate_img'];
    }
    if ($NOC['permit'] != Null) {
        
        $files[] = $NOC['permit'];
    }
    if ($NOC['invoice'] != Null) {
        
        $files[] = $NOC['invoice'];
    }
    if ($NOC['chalan_copy'] != Null) {
        
        $files[] = $NOC['chalan_copy'];
    }
    if ($NOC['cites_permit'] != Null) {
        $filePaths = $NOC['cites_permit'];
        if (!empty($filePaths)) {
            $filePathsArray = explode(',', $filePaths);
            foreach ($filePathsArray as $filePath) {
                $files[] = $filePath;
            }
        }
    }
    // pre($files, 'FILS');

    return $files;


    // $zipFileName = 'zip/files_' . $NOC['id'] . '.zip';
    // // $zipFilePath = createZipFile($files, $zipFileName);

    // // Display download button
    // $zipFileUrl = IMG_URL . '/' . $zipFileName;
    // echo '<br>
    //     <a href="' , $zipFileUrl , '" download="' , $zipFileName , '" class="btn btn-primary">Download all files</a> 
       
    
    // <br>';
}




// if($noc){
//     // echo IMG_URL . '/noc_pdf/' . $memo_id. '.pdf';
//     header("Content-type:application/zip");
//     header('Content-Disposition:attachment; filename= '. $memo_id. '.pdf');
//     readfile(IMG_PATH.'/noc_pdf/'. $memo_id. '.pdf');
//     exit;
// }else{
//     set_message('NOC (PDF File) Not found, Please contact BFD admin.', 'danger');
//     header('Location: ' .  $_SERVER['HTTP_REFERER']);
//     // get back 
//     exit;

// }


function _createZipFile($files, $zipFileName='deleted.zip') {
    $zip = new ZipArchive();
    $zipFilePath = IMG_PATH . '/zip/' . $zipFileName;

    if ($zip->open($zipFilePath, ZipArchive::CREATE) !== TRUE) {
        exit("Unable to create the ZIP file: $zipFilePath");
    }

    foreach ($files as $file) {
        $filePath = IMG_PATH. $file;
        
        if (file_exists($filePath)) {
            
            $zip->addFile($filePath, basename($filePath));
        } else {
            echo 'File not found: $filePath<br>';
        }
    }
    // echo  $zipFilePath;

    $zip->close();
    // echo $zipFilePath;
    header('location: ' . IMG_URL . '/zip/' . $zipFileName);
    // readfile($zipFilePath);
    // header('Content-Type: application/zip');
    // header('Content-Transfer-Encoding: Binary');
    // header('Content-disposition: attachment; filename='.$zipFileName);
    // header('Content-Length: ' . filesize($zipFilePath));
    
    // readfile($zipFilePath);
    // unlink($zipFilePath);
    exit;
}


$files = _get_files($noc, $applicant);
_createZipFile($files, $noc['id'].'.zip');