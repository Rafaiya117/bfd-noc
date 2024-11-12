<?php

	// if(empty($_SESSION['email'])){
	// 	echo "<p>You have been logged out successfully.</p>";
	// 	echo "<p>Please <a href='login.php'>login</a> to continue.</p>";
	// 	exit(); // stop the script execution
	// }
    session_destroy();
	session_start();
	
	header('location: login.php');