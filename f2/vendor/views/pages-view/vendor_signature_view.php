<?php
  pg_header();
  show_banner('cites_non_cites');
  pg_topnavbar();
  breadcrumbs();
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
                    <?php Uploader_div($user_id,'signature','Submit scanned copy of your signature', $members); ?>
                    
                    <sub>(Signature must be 300 X 80 pixel (width X height) and file size not more than 60 KB. Colour Photo is a must.)</sub><br>
                    
                </div><br>             
            </form>
        </div>
    </div>
    <?php pg_footer(); ?>
	