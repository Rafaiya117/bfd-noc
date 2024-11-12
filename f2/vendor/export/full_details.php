<?php
include '_a.php';
must_login();



use function Composer\Autoload\includeFile;
include '../../admin/assets/lib/phpqrcode/phpqrcode.php';
add_js(['../assets/js/change_status.js', '../assets/js/uploader.js', '../assets/js/insert_condition.js']);


if (!empty(@$_GET['id'])) {
	$row = $db->select('SELECT * from noc_import where id = ? limit 1', $_GET['id']);
	$id = $_GET['id'];
	$NOC = $row[0];

	
    $aplicant_id = $NOC['user_id'];
    $aplicant = $db->select('SELECT * from member where id = ?',$aplicant_id)[0];
	
	$row2 = $db->select('SELECT * from users where designation = ? limit 1', "Conservator of Forests");
	$user = $row2[0];

	//$species_on_this_noc = $db->select('SELECT * from imp_noc_species where noc_id = ? order by status', $_GET['id']);
	$species_on_this_noc = $db->select('SELECT * from imp_noc_species_duplicate where noc_id = ? order by status', $_GET['id']);
	$j = 1;
	$ilen = sizeof($species_on_this_noc);
	//$animal = $species_on_this_noc[0];
    if (!empty($species_on_this_noc)) {
		$admin = $species_on_this_noc[0];
	} else {
		$admin = [''];
	}

	if (!empty(@$_GET['status'])) {

		$sql = $db->action(
			'UPDATE noc_import SET `status` = ? WHERE  id = ?',
			$_GET['status'],
			$_GET['id']
		);
		header('Location:noc_details.php?id=' . $_GET['id']);
		exit();
	}
	if(isset($_POST['confirm_noc'])){
	    $st=$db->action('UPDATE `noc_import` SET `status` = "900_payment_confirmed" where id=? ',$NOC['id']);
		header('Location:list_of_nocs.php?status=900_payment_confirmed');
	}
}

include '../views/pages-view/full_details_view.php';