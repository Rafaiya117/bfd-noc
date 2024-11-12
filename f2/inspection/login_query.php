<?php
	// session_start(); // start the session
	include '../../api/util/_a.php';
	
	if(!empty($_POST['email']) && !empty($_POST['password']) ){	
		// 'SELECT * FROM `member` WHERE `email`=? AND `password`= md5(?)'
		$user = $db->select('SELECT * FROM `users` WHERE `email`=? AND `password`= md5(?)',
		$_POST['email'], $_POST['password']);
		
		 if(!empty($user)){
			unset($user[0]['password']);
			$_SESSION = $user[0];
			//print_r($_SESSION);
			header("location:./query/all_list.php");
			//echo"<script>window.location = 'dashboard.php'</script>";	
		}
		else{
			echo "
			<script>alert('Invalid email or password')</script>
			<script>window.location = 'login.php'</script>
			";
		}

	}else{
			echo "
				<script>alert('Invalid email or password!')</script>
				<script>window.location = 'login.php'</script>
			";
		}
	