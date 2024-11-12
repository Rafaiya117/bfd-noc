<?php
if(!empty(@$_POST) && !empty(@$_POST['register'])){

  if(isset($_POST['register']) && ($_POST['agree'])) {
    $commercial_fields = [
      'name'=> ['type'=>'string', 'required'=>true, 'length'=> 3],
      'email'=> ['type'=>'email', 'required'=>true],
      'password'=> ['type'=>'string', 'required'=>true, 'length'=> 3],
      
      'nid'=> ['type'=>'string', 'required'=>true, 'pattern' => '/^.{10,13}$/'],
      'district'=> ['type'=>'string', 'required'=>true, 'length'=> 3],
      'upazila'=> ['type'=>'string', 'required'=>true, 'length'=> 3],
      'company_name'=> ['type'=>'string', 'required'=>true, 'length'=> 3],
      'company_phone'=> ['type'=> 'string', 'required'=>true,'length'=> 11],
      'company_licence_num'=> ['type'=>'string', 'required'=>true, 'length'=> ''],
      'company_licence_validity'=> ['type'=>'string', 'required'=>true, 'length'=> 3],
      'address'=> ['type'=>'string', 'required'=>true, 'length'=> 3],
      'purpose'=> ['type'=>'string', 'required'=>true, 'length'=> 2],
      'affliation_applicant'=> ['type'=>'string', 'required'=>true, 'length'=> 3]
    ];
    

    $institutional_fields = [
      'name'=> ['type'=>'string', 'required'=>true, 'length'=> 3],
      'email'=> ['type'=>'email', 'required'=>true],
      'password'=> ['type'=>'string', 'required'=>true, 'length'=> 3],
      'nid'=> ['type'=>'string', 'required'=>true, 'length'=> 10],
      'district'=> ['type'=>'string', 'required'=>true, 'length'=> 3],
      'upazila'=> ['type'=>'string', 'required'=>true, 'length'=> 3],
      
      'address'=> ['type'=>'string', 'required'=>true, 'length'=> 5],
      'purpose'=> ['type'=>'string', 'required'=>true, 'length'=> 2],

      'institutional_name'=>['type'=>'string', 'required'=>true, 'length'=> 3],
      'institutional_address'=>['type'=>'string', 'required'=>true, 'length'=> 3],
      'institutional_contact'=> ['type'=> 'string', 'required'=>true,'length'=> 11],
      
      'intitute_email'=>['type'=>'string', 'required'=>true, 'length'=> 3],
      'purpose_import_export'=>['type'=>'string', 'required'=>true, 'length'=> 3],
      'source_species'=>['type'=>'string', 'required'=>true, 'length'=> 3],
      
      // 'affliation_applicant'=> ['type'=>'string', 'required'=>true, 'length'=> 3]
    ];

    $personal_fields = [
      'name'=> ['type'=>'string', 'required'=>true, 'length'=> 3],
      'email'=> ['type'=>'email', 'required'=>true],
      'password'=> ['type'=>'string', 'required'=>true, 'length'=> 3],
      'phone'=> ['type'=>'string', 'required'=>true, 'length'=> 11],
      'nid'=> ['type'=>'string', 'required'=>true, 'length'=> 10],
      'district'=> ['type'=>'string', 'required'=>true, 'length'=> 3],
      'upazila'=> ['type'=>'string', 'required'=>true, 'length'=> 3],
      
      'address'=> ['type'=>'string', 'required'=>true, 'length'=> 5],
      'purpose'=> ['type'=>'string', 'required'=>true, 'length'=> 2],
      
      
      // 'affliation_applicant'=> ['type'=>'string', 'required'=>true, 'length'=> 3]
    ];

    if(@$_POST['purpose'] === 'Commercial'){
      $fields = $commercial_fields;
      $_POST['phone'] = $_POST['company_phone'];
      if(@$_POST['affliation_applicant'] === 'employee'){
          $fields['applicant_designation'] = ['type'=>'string', 'required'=>false, 'length'=> 3];
      } elseif (@$_POST['affliation_applicant'] === 'owner') {
          unset($fields['applicant_designation']);
      }
  } 
  else if((@$_POST['purpose'] === 'Institution')){
      $fields = $institutional_fields;
      $_POST['phone'] = $_POST['institutional_contact'];
      unset($fields['applicant_designation']);
  }
  else if((@$_POST['purpose'] === 'Individual')) {
    $_POST['purpose'] = 'Personal';  
    $fields = $personal_fields;
      unset($fields['applicant_designation']);
  }
    
    $validationErrors = Validation::user_input_rq($fields);

    
    
    if($validationErrors != ''){
      // echo 'Errors Found';   
      set_message( 'Please fill up all required fields accordingly! <br> ' . $validationErrors);  
        // header('location:registration.php');
        // exit();
        
    } 
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $phone = $_POST['phone'];
      $nid = $_POST['nid'];
      $district = $_POST['district'];
      $upazila = $_POST['upazila'];
      $address = $_POST['address'];
      $permanent_address = $_POST['permanent_address'];
      $purpose = $_POST['purpose'];

      // if commercial then value otherwise null
        $company_name = isset($_POST['company_name']) ? $_POST['company_name'] : null;
        $company_licence_num = isset($_POST['company_licence_num']) ? $_POST['company_licence_num'] : null;
        $company_licence_validity = isset($_POST['company_licence_validity']) ? $_POST['company_licence_validity'] : null;
        $designation = isset($_POST['applicant_designation']) ? $_POST['applicant_designation'] : null;
        $affialation = isset($_POST['affliation_applicant']) ? $_POST['affliation_applicant'] : null;

      //institutional
      $institutional_name = isset($_POST['institutional_name']) ? $_POST['institutional_name'] : null;
      $institutional_address = isset($_POST['institutional_address']) ? $_POST['institutional_address'] : null;
      $intitute_email = isset($_POST['intitute_email']) ? $_POST['intitute_email'] : null;
      $purpose_import_export = isset($_POST['purpose_import_export']) ? $_POST['purpose_import_export'] : null;
      $source_species = isset($_POST['source_species']) ? $_POST['source_species'] : null;

      // $password = password_hash($password, PASSWORD_DEFAULT);
      // Check if email already exists
      $email_exists = $db->select("SELECT email FROM member WHERE email = ?", $email);
      if (!empty($email_exists)) {
          set_message('This Email address is already registered. Please login using this email.', 'info');
          header('location:login.php');
          exit;
      }
      $existing_user = $db->select("SELECT * FROM member WHERE nid = ? AND purpose = ?", $nid, $purpose);

          if (!empty($existing_user)) {
              set_message('A user with this NID number and purpose already exists. Please login or use a different NID number.', 'info');
              // header('location:registration.php');
              // exit;
          } else {
              // Insert the new user into the database
              $user_id = $db->action(
                  'INSERT INTO `member` (`name`, `email`, `password`, `phone`, `nid`, `district`, `upazila`, `company_name`, `company_licence_num`, `company_licence_validity`, `address`, `permanent_address` ,`purpose`, `applicant_designation`, `affliation_applicant`,`institutional_name`,`institutional_address`,`intitute_email`,`purpose_import_export`,`source_species`) 
                  VALUES (?, ?, md5(?), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                  $name, $email, $password, $phone, $nid, $district, $upazila, $company_name, $company_licence_num, $company_licence_validity, $address, $permanent_address ,$purpose, $designation, $affialation, $institutional_name , $institutional_address, $intitute_email,$purpose_import_export, $source_species
              );
          }
      

      //die($user_id);
      // echo 'QQQ <pre>';
      // print_r($_POST);
      // echo '=== === === ';
      // print_r($validationErrors);
      // die();

      
      if ($user_id) {
          set_message('Your account has been created successfully.', 'success');
          header('location:login.php');
          exit;
      } else {

      //     echo 'INSERT INTO `member` (`name`, `email`, `password`, `phone`, `nid`, `district`, `upazila`, `company_name`, `company_licence_num`, `company_licence_validity`, `address`, `purpose`, `applicant_designation`, `affliation_applicant`) 
      //     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
      //     $name, $email, $password, $phone, $nid, $district, $upazila, $company_name, $company_licence_num, $company_licence_validity, $address, $purpose, $designation, $affialation
      // ; 
      // die();   
      // exit;

          set_message('Error occurred while registering. Please try again later.', 'error');
          // header('location:registration.php');
          // exit;
      }
  }

  // header('location:registration.php');
}