<?php
	include '_all_no_login.php';
	
	
	auth_logout();
	
	// 
	// header('location: login.php');
	// session_destroy();
	
	
	set_message('You have been logged out.', 'success');
	header('location: login.php');
	// pre(auth(), 'SESSION');