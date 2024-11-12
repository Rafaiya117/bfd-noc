<?php
include '../super-admin-view/page-section/header.php';
include '../super-admin-view/page-section/navbar.php';
?>
<div class="card">
    <div class="container card-body">
      <h3 class="table-title1"></h3>
         <h4>Reset Your Password</h4>
         <form method="POST" enctype="multipart/form-data">
            <label>Email</label>
            <input  class="form-control" placeholder="<?=$r['email']?>" readonly/><br>
            <label>New Password</label>
            <input name="password" id="password" class="form-control" value=""/><br>
            <button type="submit" name="submit" value="Upload" class="btn btn-primary">Save Password </button>
         </form>
        
    </div>
</div>

<?php
	include '../super-admin-view/page-section/footer.php';
?>