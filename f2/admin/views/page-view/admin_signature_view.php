<?php
include '../view/page-section/header.php';
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
                    <?php Uploader_div($user_id,'sign','Upload your signature', $users); ?>
                    <br>
                </div><br>
            </form>
        </div>
    </div>
        <?php
            pg_footer();