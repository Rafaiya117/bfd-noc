<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('THIS_A_FILE_LOCATION', dirname(__FILE__).'/');

include THIS_A_FILE_LOCATION.'.../../../../api/util/_a.php';

// include THIS_A_FILE_LOCATION.'functions/permission_checks.php';
include THIS_A_FILE_LOCATION.'functions/display_views.php';
include THIS_A_FILE_LOCATION.'functions/view_functions.php';
include THIS_A_FILE_LOCATION.'functions/table_view_functions.php';
// include THIS_A_FILE_LOCATION.'functions/data_model.php';
$js_libs = [
    'assets/js/vendor/underscore.js',
    'assets/js/vendor/jquery-3.5.1.min.js',
    'assets/js/vendor/modernizr-3.6.0.min.js',
    // 'assets/js/vendor/bootstrap.min.js',
    //  'assets/js/vendor/sweetalert.min.js',
    
    'assets/js/vendor/popper.min.js',
    // 'assets/js/vendor/jquery.syotimer.min.js',
    'assets/js/main.js',
    'assets/js/lib/pages_and_libs.js',
    'assets/js/dashboard.js',
    'assets/js/list_of_nocs.js',
    'assets/js/sidebar.js',
    'assets/js/auto_complete.js',

];

$js_libs_sites = ['https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'];

$css_local = [];
$css_libs = [
    'assets/css/bootstrap.min.css',
    'assets/css/all.css',
    'assets/css/nice-select.css',
    'assets/css/default.css',
    'assets/css/style.css',
    'assets/css/approved_info.css',
    'assets/css/dashboard.css',
    'assets/css/list_of_nocs.css',
    'assets/css/noapproved_info.css',
    'assets/css/noc.css',
    'assets/css/add_new_nocs.css',
    'assets/css/navbar.css',
    // 'assets/css/sweetalert.min.css',
    // 'assets/css/notify.min.css',
    'assets/css/trader.css',
    'assets/css/user_profile.css',
    'assets/css/my_custom.css'
];

$css_sites = [
    'https://fonts.googleapis.com/css?family=Roboto|Varela+Round',
    'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css',
    'https://fonts.googleapis.com/icon?family=Material+Icons',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css'
];
define('APP_URL', ADMIN_URL);
define('APPNAME', 'admin');