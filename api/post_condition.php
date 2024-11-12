<?php
include 'util/_a.php';

echo '<pre>';
print_r($_POST);

if(isset($_POST['id'])){
  // check required list
 global $db;
  $id = $db->action(
    'INSERT into -- noc_import (
      condition, cif_name, email_fwrd) values (?,?,?) ', 
       $_POST['condition'], $_POST['cif_name'], $_POST['email_fwrd'] );
       
      //header('Location:login.php');
      //exit();
  

}