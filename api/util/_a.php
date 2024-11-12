<?php
session_start();
define('_A_API_FILE_LOCATION', dirname(__FILE__).'/');
@include 'config.php';
include 'util_pages.php';
include 'config_BFD.php';
include 'string.php';
include 'Database.php';
include 'autorun.php';

include 'auth.php';
include 'Validation.php';

// include 'conn.php';
include 'error_dev.php';
