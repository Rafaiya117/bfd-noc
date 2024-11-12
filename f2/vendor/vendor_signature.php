<?php
include '_a.php';
must_login();


include 'functions/view_functions.php';



 $user_id = auth()['id'];
$members =$db->select('SELECT * from member where id =?',$user_id)[0];

if(!empty($_FILES['signature'])){
    $image_show = handleFileUpload('signature','vendor_sign/'.$user_id, 300, 80);
    $db->action('UPDATE member SET `signature` = ? WHERE  `id` = ?',
      $image_show, $user_id
    ); 
    header('Location: '. $_SERVER['REQUEST_URI']);
    //header('Location:add_new_nocs.php');
}
else if(!empty($_FILES['nid_copy'])){
    $image_show = handleFileUpload('nid_copy','nid_copy/'.$user_id, 500, 350); 
    $db->action('UPDATE member SET `nid_copy` = ? WHERE  `id` = ?',
      $image_show,$user_id
    ); 
    header('Location: '. $_SERVER['REQUEST_URI']);
    
}
else if(!empty($_FILES['licence_copy'])){
    $image_show = handleFileUpload('licence_copy', 'certificate/'.$user_id,595, 842);
      
    $db->action('UPDATE member SET `licence_copy` = ? WHERE  `id` = ?',
      $image_show,$user_id
    );
    header('Location: '. $_SERVER['REQUEST_URI']);
  }
  else if(!empty($_FILES['profile_image'])){
    $image_show = handleFileUpload('profile_image', 'profile_image/'.$user_id, 300, 300);
      
    $db->action('UPDATE member SET `profile_image` = ? WHERE  `id` = ?',
      $image_show,$user_id
    );
    header('Location: '. $_SERVER['REQUEST_URI']);
  }
  else if(!empty($_FILES['previous_report'])){
    $image_show = handleFileUpload('previous_report', 'vendor_previous_report');
      // make it a array and data will be loaded from array to files. 

    $db->action('UPDATE member SET `previous_report` = ? WHERE  `id` = ?',
      $image_show,$user_id
    );
    header('Location: '. $_SERVER['REQUEST_URI']);
  }


// die('----------------------------');
pg_header();
show_banner('cites_non_cites');
pg_topnavbar();


?>
    <div class="container card-body">
    <form method="POST"  enctype="multipart/form-data" >
        <div class="card table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <h3 style="color:white"> &nbsp;Signature: &nbsp;<?php echo $members['name']  ?></h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <?php Uploader_div($user_id,'signature','Submit scanned copy of your signature', $members, true,
                  'Signature must be 300 X 80 pixel (width X height) and file size not more than 60 KB. Image Format should be jpg, jpeg, png. '); ?>
                    
                </div><br>
                <div class="col-md-12">
                    <?php Uploader_div($user_id,'nid_copy','Submit scanned copy of National  Identity Card', $members,true, 
                  'NID must be 500 X 350 pixel (width X height) and file size not more than 1MB. Colour Photo is a must. Image Format should be jpg, jpeg, png. '
                  ); ?>
                    <br>
                </div><br>
                <?php
                if($members['purpose']=="Commercial"){
                  echo'<div class="col-md-12">';
                     Uploader_div($user_id,'licence_copy','Upload Company Licence Certificate', $members,true,
                     'License must be 595 x 842 pixel (width X height)(if image) and file size not more than 1MB. Colour Photo is a must.Image Format should be jpg, jpeg, png, pdf'); 
                    echo'<br>
                </div><br>';
                }
                ?>
                <div class="col-md-12">
                    <?php Uploader_div($user_id,'profile_image','Upload Profile Image', $members,true, 'Submit a photo that is 300 pixels wide by 300 pixels high, no larger than 1MB, and in JPG, PNG format.'); ?>
                    
                </div><br>
            </form>
        </div>
    </div>
<?php
	pg_footer();
?>