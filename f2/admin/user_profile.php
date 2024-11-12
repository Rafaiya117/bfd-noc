<?php
include '_a.php';

$my_profile = $db->select('SELECT * from `users` where id=?', auth()['id'])[0];


pg_header();
show_banner('home', 'My Profile');
pg_topnavbar();
// pg_navbar2();
breadcrumbs(' > ');


?>
<body>
    <div class="container">
        <div class="profile">
            <!-- <img style="float:right;right:40px;position:relative;height:250px;" src="https://img.freepik.com/premium-vector/social-avatar-stories-gradient-frame_41737-3.jpg" alt="Profile Picture" /> -->
            <table class="table">
            <tr><td colspan="2" ><h2><?php echo $my_profile['name']; ?></h2></td> </tr>
            
            <tr><td>Email </td><td><?php echo $my_profile['email']; ?> </td></tr>
            <tr><td>Role </td><td> <?php echo $my_profile['role']; ?> </td></tr>
            <tr><td>Designation </td><td> <?php echo $my_profile['designation']; ?></td></tr>
            <tr><td>Phone </td><td> <?php echo $my_profile['phone']; ?></td></tr>
            <tr><td>Organization </td><td> <?php echo $my_profile['organization']; ?></td></tr>
            <tr><td>Joined </td><td> <?php echo bd_date_format($my_profile['created_at']); ?></td></tr>

            </table>
            

            <p>
                <a class="btn btn-primary" href="./resetPassword_field.php">Reset Password</a> 
             <a class="btn btn-primary" href="./admin_signature.php">Update Signature</a></p>
            <!-- <p><input type="checkbox"/> Get mail for all Status</p> -->
        </div>
    </div>
</body>
<?php pg_footer();