<?php
// include '_a.php';
pg_header();
show_banner('cites_non_cites', 'Super Admin  :: Update Applicant Details');
// $applicants = $db->select('select * from `vendor` order by `id` desc limit 40');
pg_topnavbar();

?>
<div class="container">
    <form class="card-body" method="POST"  enctype="multipart/form-data">
        <h4>Update Applicant's Details  </h4>
        <table class="table table-hover card-body">
            <tr>
                <th>Name</th>
                <td><input class="form-control" name ="name" value="<?= $user_data['name']?>" /></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><input class="form-control" name ="address" value="<?= $user_data['address']?>" /></td>
            </tr>
            <tr>
                <th>Purpose</th>
                <td><input class="form-control" name ="purpose" value="<?= $user_data['purpose']?>" /></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><input class="form-control" name ="phone" value="<?= $user_data['phone']?>" /></td>
            </tr>
            <tr>
                <th>NID</th>
                <td><input class="form-control" name ="nid" value="<?= $user_data['nid']?>" /></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input class="form-control" name ="email" value="<?= $user_data['email']?>" /></td>
            </tr>
            
            
            <tr>
                <th>District</th>
                <td><input class="form-control" name ="district" value="<?= $user_data['district']?>" /></td>
            </tr>
            <tr>
                <th>Upazila</th>
                <td><input class="form-control" name ="upazila" value="<?= $user_data['upazila']?>" /></td>
            </tr>
            <tr>
                <th>Company Name</th>
                <td><input class="form-control" name ="company_name" value="<?= $user_data['company_name']?>" /></td>
            </tr>
            <tr>
                <th>Company Licence No.</th>
                <td><input class="form-control" name ="company_licence_num" value="<?= $user_data['company_licence_num']?>" />
            </tr></td>
            <tr>
                <th>Licence Validity Date</th>
                <td><input class="form-control" name ="company_licence_validity" value="<?= $user_data['company_licence_validity']?>" /></td>
            </tr>
            <tr>
                <th>Applicant Designation</th>
                <td><input class="form-control" name ="applicant_designation" value="<?= $user_data['applicant_designation']?>" /></td>
            </tr>
            <tr>
                <th>Affiliation</th>
                <td><input class="form-control" name ="affliation_applicant" value="<?= $user_data['affliation_applicant']?>" /></td>
            </tr>
            <tr>
                <th>Signature</th>
                <td><img style="width:30%;" class="img-thumbnail" src="<?= $user_data['signature']?>" /></td>
            </tr>
            </table>
        <button type="submit" name="submit" value="Upload" class="btn btn-primary"> Save </button>
</div>
<?php
include '../super-admin-view/page-section/footer.php'; ?>