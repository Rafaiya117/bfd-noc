<?php

include '../super-admin-view/page-section/header.php';
include '../super-admin-view/page-section/navbar.php';
?>
<div class="card">
    <div class="container card-body">
      <h3 class="table-title1"><?= $data['username'] ?></h3>
         <h4>Enter Your Email</h4>
         <form method="POST" enctype="multipart/form-data">
            <input name="email" id="email" class="form-control" value="<?= $data['email'] ?>" readonly/><br>
            <button type="submit" name="submit" value="Upload" class="btn btn-primary"> Send mail </button>
         </form>
        
    </div>
</div>

<?php
	include '../super-admin-view/page-section/footer.php';
?>