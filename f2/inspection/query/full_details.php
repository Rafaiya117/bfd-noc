<?php
include '_a.php';
include '../../admin/assets/lib/phpqrcode/phpqrcode.php';

add_js([
    '../assets/js/vendor/underscore-umd-min.js',
    '../assets/js/change_status.js', '../assets/js/uploader.js', '../assets/js/insert_condition.js',
    '../assets/js/full_details.js'
]);


if (!empty(@$_GET['id'])) {

    $row = $db->select('SELECT * from noc_import where id = ? limit 1', $_GET['id']);
    $NOC = $row[0];

    $aplicant_id = $NOC['user_id'];
    $aplicant = $db->select('SELECT * from member where id = ?',$aplicant_id)[0];

    $row2 = $db->select('SELECT * from users where designation = ? limit 1', "Conservator of Forests");
	$user = $row2[0];

	$digital_info = $db->select('SELECT * from digital_info where noc_id = ? limit 1', $_GET['id']);
    if (!empty($digital_info)) {
		$admin = $digital_info[0];
	} else {
		$admin = ['scanned_sign' => 'default_value'];
	}
    
    $species_on_this_noc = $db->select('SELECT * from imp_noc_species_duplicate where noc_id = ? order by status', $_GET['id']);
    $j = 1;
    $ilen = sizeof($species_on_this_noc);
    $animal = $species_on_this_noc[0];
    $roles = role_cutter($_SESSION['role']);
    $current_status = $NOC['status'];
     if($current_status ==='1000_signed_document'){

        // if (!empty($_POST)) {
            // //$id = (int)$_POST['id'];
            $path = IMG_URL . '/qr_code/';
            $path2 = IMG_PATH . '/qr_code/';
            $qr_image = BASEURL . '/vendor/import/full_details.php?id=' . $NOC['id'];
            //move_uploaded_file($_FILES['name'], $path2);
            $qrcode = $path2 . 'noc_im' . $NOC['id'] . '.png'; 
            $qrcode2 = $path . 'noc_im' . $NOC['id'] . '.png'; 
            QRcode::png($qr_image, $qrcode);      
            $updat_status = $db->action('UPDATE noc_import SET `qr_code` = ? WHERE  id = ?',$qrcode2, $NOC['id']);
        //}
     }
     if(isset($_POST['inspec_comment'])){
        //print_r($_POST);
	     $st=$db->action('UPDATE `noc_import` SET `inspec_comment` = ? where id=? ',$NOC['id']);
		// header('Location:list_of_nocs.php?status=900_payment_confirmed');
        header("Location: " . $_SERVER['REQUEST_URI']);
	}
    if(isset($_POST['inspector_verify'])){
        //print_r($_POST);
	     $sts=$db->action('UPDATE `noc_import` SET `status` = ?,`officer_name`=?, `officer_email`= ? where id=? ','1050_inspection_document',$_SESSION['name'],$_SESSION['email'],$NOC['id']);
		// header('Location:list_of_nocs.php?status=900_payment_confirmed');
        header("Location: " . $_SERVER['REQUEST_URI']);
	}
    
    //update_next_status($NOC);
}


include '../page_view/full_details_view.php';