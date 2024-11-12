<?php
include '_a.php';

$user_id = auth()['id'];
$users =$db->select('SELECT * from users where id =?',$user_id)[0];

  if(!empty($_FILES['sign'])){
    $image_show = handleFileUpload('sign','admin_sign/'.$user_id, 300, 80);
    $db->action('UPDATE users SET `sign` = ? WHERE  `id` = ?',
      $image_show,$user_id
    ); 
  header('Location:dashboard.php');
  exit();
}

pg_header();
show_banner('home8', 'Update Signature');
pg_topnavbar();
// pg_navbar2();
breadcrumbs(' > ');
?>

<div class="container card-body">
    <form method="POST"  enctype="multipart/form-data" >
        <div class="card table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <h3 style="color:white"> &nbsp;Signature: &nbsp;<?php echo $users['name']  ?></h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <?php Uploader_div($user_id,'sign','Upload your signature', $users, true, 'Signature must be width 300px X height 80px and file size not more than 1MB.'); ?>
                    
                </div><br>
            </form>
        </div>
    </div>
<?php pg_footer();