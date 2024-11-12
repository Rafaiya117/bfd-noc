<?php 

// Comomn Configaration for BFD

// File Upload size
define('FILE_UPLOADER_MAX_MB', 1);

define('BFD_FEE_PER_HEADCOUNT_BDT', 20);
define('BFD_FEE_VAT_CITES', 0.15);
define('BFD_FEE_VAT_NON_CITES', 0.15);
define('BD_TIME_ZONE', 'Asia/Dhaka');

define('BFD_APP_NAME_BANNER', 'CITES Permit/Certificate and NOC System');
date_default_timezone_set(BD_TIME_ZONE);




if(!defined('SITEURL')){
    page_blocking_message('Configuration Error Detected', '<div class="error-message">
  
  <p>We\'ve encountered an issue with the configuration settings in your config.php file. Please review the following potential causes and take appropriate action:</p>
  <ul>
    <li><strong>Missing File:</strong> Ensure that the config.php file exists in the util directory of your application. in that folder, there is a sample config file rename it config.php. </li>
    <li><strong>Incorrect Database Credentials:</strong> Double-check your database hostname, username, password, and database name.</li>
    <li><strong>Invalid Paths:</strong> Ensure that any paths specified in the file are accurate and point to the correct locations on your server.</li>
    <li><strong>Syntax Errors:</strong> Carefully inspect the file for typos, missing semicolons, or other syntax mistakes.</li>
    <li><strong>Permission Issues:</strong> Verify that the config.php file has the correct permissions (usually 644 or 600).</li>
  </ul>
  <p>For detailed troubleshooting steps, please contact our <a href="https://softlh.com/">support team</a>.</p>
</div> ');
    exit;
}





// Commbain config

define('VENDOR_URL', SITEURL . 'vendor/');
define('ADMIN_URL', SITEURL . 'admin/');
define('SUPPERADMIN_URL', SITEURL . 'supper-admin/');

define('SERVER_URL', SITEURL );