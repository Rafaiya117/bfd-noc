<?php
	include '_a.php';	
	auth_logout();
	set_message('You have been logged out.', 'success');
	header('location: login.php');
