<?php
include '_a.php';


$rows = $db->select('SELECT * from users order by id asc limit 100');

include THIS_A_FILE_LOCATION.'/super-admin-view/page-section-view/admin_list_view.php';