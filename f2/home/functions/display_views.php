<?php 






function show_banner($type = 'login', $title='Welcome to Online NOC Application System'){


    $image = [ 'login' => 'assets/images/login_banner.png'
                , 'home' => 'assets/images/home.png'
                , 'home8' => 'assets/images/8.png'
                , 'import-export' => 'assets/images/vendor_import_export.png'    
                , 'cites_non_cites' => 'assets/images/cites_non_cites.png'
            ];


   
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
                </h1>
        
               </div>';
    
    
   
}



function pg_header(){
    global $css_libs, $css_sites;
    include THIS_A_FILE_LOCATION. 'views/page-sections/header.php';
}

function pg_footer(){
    global $js_libs, $js_add_footer;
    include THIS_A_FILE_LOCATION. 'views/page-sections/footer.php';
}

function pg_topnavbar(){
    include THIS_A_FILE_LOCATION. 'views/page-sections/navbar.php';
}


// function bd_date_format($olddate){
    
    
//     return date_format(date_create($olddate),'d-m-Y');;
// }


// pg_header();
// pg_footer();
// pg_navbar();
// die("loxxxs");