<?php

	if (isset(auth()['id'])) {
    	header('Location:dashboard.php');
    	exit;
	}
	
	if(!empty($_POST['email']) && !empty($_POST['password']) ){	
		$_POST['email'] = trim($_POST['email']);
		$_POST['password'] = trim($_POST['password']);

		
		$user = $db->select('SELECT * FROM `users` WHERE `email`=? AND `password`= md5(?) limit 1;',
		$_POST['email'], $_POST['password']);

		// echo 'SELECT * FROM `users` WHERE `email`=? AND `password`= md5(?) limit 1; ',$_POST['email'], ' <<===>> ' ,$_POST['password'];
		// pre($user, 'STOP');

		if(empty($user)){
			set_message('Invalid email or password', 'danger');
			header('location: login.php');
			exit;
		}

		unset($user[0]['password']);
		auth_set($user[0]);

		
		if(!empty($user) && empty($user[0]['sign'])){			
			header("location:admin_signature.php");
			exit;
		}

		
		header("location:dashboard.php");
		exit;


	}
	