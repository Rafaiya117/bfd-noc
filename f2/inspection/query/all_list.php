<?php 
include '_a.php';

// $member_info = $db->select('SELECT * from member order by id desc limit 100');

$rows = $db->select('SELECT * from noc_import  where `status` = ?  order by id desc limit 100', "1000_signed_document");

include '../page_view/all_list_view.php';