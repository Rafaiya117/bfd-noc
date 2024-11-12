<?php
include '_a.php';
// session_start();
unset($_SESSION);
session_destroy();
set_message('You have been logged out', 'success');

header('Location:login.php');
exit;