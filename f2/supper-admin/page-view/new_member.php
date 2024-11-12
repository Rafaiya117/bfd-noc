<?php
include '_a.php';

if (isset($_POST['name'])) {
    //print_r($_POST);
    
        if ($_POST['name'] != "" && $_POST['email'] != "" && $_POST['designation'] != "" ) {
            
            try {
                $username = $_POST['username'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $organization = $_POST['organization'];
                $designation = $_POST['designation'];
                $phone = $_POST['phone'];
                $role = $_POST['role'];
                // md5 encrypted
                // $password = md5($_POST['password']);
                $password = $_POST['password'];
                $email_exists = $db->select("SELECT email FROM users WHERE email = ?", $email);

                if ($email_exists) {
                    echo "<script>
					    if(confirm('Email address already exists. Do you want to go back to the registration page?')) {
						    window.location.href = 'new_member.php';
					    }
                        else{
                            window.location.href = 'index.php';
                        }
				    </script>";
                    exit;
                }
                $sql = $db->action(
                    'INSERT into `users` (`username`,`name`,`email`,`organization`,`designation`,`role`,`phone`,`password`) values(?,?,?,?,?,?,?,md5(?))',
                    $username,
                    $name,
                    $email,
                    $organization,
                    $designation,
                    $role,
                    $phone,
                    $email
                );

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            // Show success message and redirect to login page
            // $_SESSION['message'] = array("text" => "User successfully created.", "alert" => "info");
            set_message('User successfully created.', 'success');
            set_message('User Email is temporary password. ', 'info');
            $sql = null;
            // print_r($_POST['register']);
            header('location:admin_list.php');
        } else {
            echo "
                <script>alert('Please fill up the required field!')</script>
                <script>window.location = 'new_member.php'</script>";
        }
    
}


include THIS_A_FILE_LOCATION .'/super-admin-view/page-section-view/new_member_view.php';
