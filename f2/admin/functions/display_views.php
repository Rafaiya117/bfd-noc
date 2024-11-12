<?php 


function show_user_info(){
    $user = auth();
    if(!$user){
        return;
    }
    
    echo '<div class="banner-user-info">';
    echo '<div class="user-info__name"><a class="user-info-a" href="', APP_URL, 'user_profile.php" ><b>', $user['name'], '</b></a></div>';
    echo '<div class="user-info__role"><a class="user-info-a" href="', APP_URL, 'user_profile.php" > ', $user['designation'], '</a></div>';
    echo '</div>';

}
function show_banner($type = 'login', $title='Welcome to Online NOC Application System'){


    $image = [ 'login' => 'assets/images/canva_0.png'
               , 'login2' => 'assets/images/login_banner.png'
                , 'home' => 'assets/images/home.png'
                , 'home2' => 'assets/images/home-down.png'
                , 'home8' => 'assets/images/8.png'
                , 'import-export-2_1'=>'assets/images/2_1.png'
                , 'import-export' => 'assets/images/vendor_import_export.png'    
                , 'cites_non_cites' => 'assets/images/cites_non_cites.png'
                , 'CITES' => 'assets/images/dashboard-banner.png'
                , 'NON-CITES' => 'assets/images/cites_non_cites.png'
                , 'admin-dashboard' => 'assets/images/bg.png'
            ];


    // background-size:cover;background-position:center; background-repeat:no-repeat;
    echo 
    '<div class="banner-wrapper" style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.9)), url(',VENDOR_URL, $image[$type],') repeat-x top center fixed ;;z-index: 99;"> 
        
        <div class="logo-container p-0">
            <table>
            <tr>
                <td width="33%"><a href="',APP_URL,'" ><img src="',VENDOR_URL,'assets/images/bon-logo.png" width="70px"  /></a></td>
                <td width="33%" align="center"><a href="',APP_URL,'" ><img  class="img_logo_bg" src="',VENDOR_URL,'assets/images/bangladesh_gov.png" width="70px"  /></a></td>
                <td width="33%" align="right"><a href="',APP_URL,'" > <img src="',VENDOR_URL,'assets/images/cities-logo-white.png" style="margin-left:25px;" width="70px" /></a></td>
            </tr>
            </table>
        </div>
        
        <h1 class="text-center text-white" style="text-shadow:1px 1px 3px black; margin-top: 5px;font-size: 35px;">
            ',BFD_APP_NAME_BANNER, '<br>',$title,'
        </h1>';
    show_user_info();
    echo  '</div>';
    
    
   
}



function pg_header(){
    global $css_libs, $css_sites;
    include THIS_A_FILE_LOCATION. 'views/page-sections/header.php';
}

function pg_footer(){
    global $js_libs, $js_add_footer, $js_libs_sites;
    include THIS_A_FILE_LOCATION. 'views/page-sections/footer.php';
}

function pg_topnavbar(){
    include THIS_A_FILE_LOCATION. 'views/page-sections/navbar.php';
}

function pg_navbar2(){
    include THIS_A_FILE_LOCATION. 'views/page-sections/import_navbar.php';
}









// pg_header();
// pg_footer();
// pg_navbar();
// die("loxxxs");