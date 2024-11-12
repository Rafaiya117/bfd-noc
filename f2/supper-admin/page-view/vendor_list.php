<?php

include '_a.php';

$rows = $db->select('SELECT * from member order by id desc limit 100');

include THIS_A_FILE_LOCATION. '/super-admin-view/page-section-view/vendor_list_view.php';
