<?php
pg_header();
show_banner('login', 'Super Admin  :: Edit Employee Information');

pg_topnavbar();
add_js(['assets/js/supper-admin/update_user_role.js']);

?>
<div class="card"> 
    <form class="container card-body" method="POST"  enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <h3>Edit Employee Information</h3>
            </div>
            <!-- <div class="col-md-6" style="float:right;padding-left:40%;">
                <button type="submit" name="account_active" value="0" class="btn btn-danger"> BAN </button>
            </div> -->
        </div>
        <table class="table table-hover">
        <tr>
                <th>Employee Id</th>
                <td><input type="text" class="form-control" name="employee_id" value="<?php echo $user_info['employee_id'];?>"  /></td>
            </tr>
            <tr>
                <th>User Name</th>
                <td><input type="text" class="form-control" name="username" value="<?php echo $user_info['username'];?>" /></td>    
            </tr>
            <tr>
                <th>Name</th>
                <td><input type="text" class="form-control" name="name" value="<?php echo $user_info['name'];?>" /></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input type="email" class="form-control" name="email" value="<?php echo $user_info['email'];?>" /></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><input type="text" class="form-control" name="phone" value="<?php echo $user_info['phone'];?>" /></td>
            </tr>     
           
            <tr>
                <th>Organization</th>
                <td><input type="text" class="form-control" name="organization" value="<?php echo $user_info['organization'];?>" /></td>
            </tr>
            <tr>
                <th>Designation</th>
                <td><select class="form-control" id="designation" name="designation" data-designation="<?php echo $user_info['designation'];?>" >
                <option value="Office Assistant" data-role="10_Assistant">Office Assistant (CITES/Non-CITES) </option>
                <option value="Desk Officer" data-role="20_Officer">Desk Officer (CITES/Non-CITES)</option>
                <option value="Deputy Conservator of Forests" data-role="30_DCF">Deputy Conservator of Forests (DCF)</option>
                <option value="Conservator of Forests" data-role="40_CF">Conservator of Forests (CF)</option>
                <option value="Chief Conservator of Forests" data-role="50_CCF">Chief Conservator of Forests (CCF)</option>
                <option value="Inspection officer" data-role="60_IO">Inspection officer</option>
                </select>
                <input type="hidden" id="role" name="role"  value="<?php echo $user_info['role'];?>" /> 
            </td>
            </tr>
            <tr>
                <th>Signature</th>
                <td><img style="width:30%;" class="img-thumbnail" src="<?php echo IMG_URL, $user_info['sign']?>" /></td>
            </tr>
            </table>
            <button type="submit" name="submit" value="Upload" class="btn btn-primary"> Update </button>
        </div>
    </div>

    
    <?php
	pg_footer();
	