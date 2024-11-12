<style>

    .navbar {
        border: 0.1em solid #e0e0e0;
        margin: 0 0.3em 0.3em 0.3em 0.3em;
        border-radius: 0.12em;
        box-sizing: border-box;

    }
</style>



    
    
    
    <div class="topnav">
        <a class="navbar" href="<?php echo VENDOR_URL;?>home.php">Home Page</a>
        <!-- <a class="" href="./all_list.php">All list of NOCs</a> -->
        <a class="navbar" href="<?php echo VENDOR_URL;?>add_new_nocs.php">Apply for NOC</a>
        
        <?php // <sup> echo auth()['name'] </sup>          ?>
        <a class="navbar" href="<?php echo VENDOR_URL;?>logout.php" style="float:inline-end">Logout</a>
        <a class="navbar" href="<?php echo VENDOR_URL;?>user_profile.php" style="float:inline-end"> My Profile</a>
        
        
    </div>

<?php show_message();?>