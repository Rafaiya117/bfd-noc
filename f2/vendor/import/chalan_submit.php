<?php
include '_a.php';
must_login();


add_js(['../assets/js/change_status.js', '../assets/js/uploader.js', '../assets/js/insert_condition.js', '../assets/js/pages/import_details.js']);

$randomNumber = rand(1, 9999); // generates a random integer between 1 and 9999
$currentDateTime = date('YmdHis');
$now = date('Y-m-d');

if (!empty($_FILES)) {
	//print_r($_POST);
	$id = (int)$_POST['noc-id'];
    if(!empty($_FILES['chalan_copy'])){
        $image_show = handleFileUpload('chalan_copy', 'chalan_copy');
       $db->action('UPDATE noc_import SET `chalan_copy` = ?, `chalan_date` = ?, `status`= "850_payment_check " WHERE  `id` = ?', $image_show, $now,$id);
      }
	}


if (!empty(@$_GET['id'])) {

	$row = $db->select('SELECT* from noc_import where id = ? limit 1', $_GET['id']);
	$NOC = $row[0];

	$aplicant_id = $NOC['user_id'];
    $aplicant = $db->select('SELECT * from member where id = ?',$aplicant_id)[0];
	
	$species_on_this_noc = $db->select('SELECT * from imp_noc_species_duplicate where noc_id = ? order by status', $_GET['id']);
	$j = 1;
	$ilen = sizeof($species_on_this_noc);
	if (!empty($species_on_this_noc)) {
		$admin = $species_on_this_noc[0];
	} else {
		$admin = [''];
	}

	$row2 = $db->select('SELECT * from users where designation = ? limit 1', "Chief  Conservator of Forests");
	$user = $row2[0];
}
include '../views/pages-view/chalan_submit_view.php';