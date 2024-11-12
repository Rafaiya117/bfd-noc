   
  
    
    <div class="topnav">
        <a class="navbar" href="<?php echo APP_URL;?>dashboard.php">Dashboard</a>
        <!-- <a class="" href="./all_list.php">All list of NOCs</a> -->
        <a class="navbar nv2" href="<?php echo APP_URL;?>cities_import"> CITES Import </a>
        <a class="navbar nv2" href="<?php echo APP_URL;?>cities_export"> CITES Export </a>
        <a class="navbar nv2" href="<?php echo APP_URL;?>non_cities_import"> Non-CITES Import </a>
        <a class="navbar nv2" href="<?php echo APP_URL;?>non_cities_export"> Non-CITES Export </a>
        
        <?php // <sup> echo auth()['name'] </sup>          ?>
        <a class="navbar" href="<?php echo APP_URL;?>logout.php" style="float:inline-end">Logout</a>
        <a class="navbar" href="<?php echo APP_URL;?>user_profile.php" style="float:inline-end"> My Profile</a>
        <a class="navbar" href="<?php echo APP_URL;?>reporting.php" style="float:inline-end"> Report</a>
        
        
        
    </div>
    
<?php show_message();?>