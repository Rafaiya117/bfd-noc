<?php
include '../super-admin-view/page-section/header.php';
include '../super-admin-view/page-section/navbar.php';
?>
<div class="card"> 
    <form class="container card-body" method="POST"  enctype="multipart/form-data">
        <h3>Edit User Information</h3>
            <!-- <div class="col-md-6" style="float:right;padding-left:40%;">
                <button type="submit" name="submit" value="Upload" class="btn btn-danger"> BAN </button>
            </div> -->
        <table class="table table-hover">
            <tr>
                <th>User Name</th>
                <td><input type="text" class="form-control" name="username" value="<?= $user_info['username']?>" /></td>    
            </tr>
            <tr>
                <th>Name</th>
                <td><input type="text" class="form-control" name="name" value="<?= $user_info['name']?>" /></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input type="email" class="form-control" name="email" value="<?= $user_info['email']?>" /></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><input type="text" class="form-control" name="phone" value="<?= $user_info['phone']?>" /></td>
            </tr>     
            <tr>
                <th>Employee Id</th>
                <td><input type="text" class="form-control" name="employee_id" value="<?= $user_info['employee_id']?>" /></td>
            </tr>
            <tr>
                <th>Rank</th>
                <td><input type="text" class="form-control" name="organization" value="<?= $user_info['organization']?>" /></td>
            </tr>
            <tr>
                <th>Designation</th>
                <td><input type="text" class="form-control" name="designation" value="<?= $user_info['designation']?>" /></td>
            </tr>
            <tr>
                <th>Signature</th>
                <td><img style="width:30%;" class="img-thumbnail" src="" /></td>
            </tr>
            </table>
            <button type="submit" name="submit" value="Upload" class="btn btn-primary"> Save </button>
            <a href="change_password.php?id=<?= $user_info['id']?>" type="button" style="color:white" class="btn btn-primary"> Change Password </a>
        </div>
    </div>
<?php
include '../super-admin-view/page-section/footer.php'; ?>