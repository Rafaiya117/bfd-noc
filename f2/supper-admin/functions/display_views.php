<?php 






function show_banner($type = 'login', $title='Welcome to Online NOC Application System'){


    $image = [ 'login' => 'assets/images/login_banner.png'
                , 'home' => 'assets/images/home.png'
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


function pg_topnavbar2(){
    include THIS_A_FILE_LOCATION. 'views/page-sections/import_navbar.php';
}

// function breadcrumbs($separator = ' > ') { // &raquo; 
//     $url = $_SERVER['REQUEST_URI'];
//     $url = parse_url($url, PHP_URL_PATH);
//     $url = str_replace(VENDOR_URL, '', $url);
    
//     $urlParts = explode('/', trim($url, '/'));
//     $breadcrumbs = array();
//     $crumb = '';
//     $exclude = array('bfd-noc', 'f2');
//     $queryHandled = false;



    
//     $navLinks = [
//         'home.php' => 'Home',
//         'vendor' => 'Applicant',
//         'import' => 'Import',
//         'create_new_noc.php' => 'New NOC Application',
//         'add_species_on_nocs.php' => 'Add New Species',
//         'noc_details.php'=>'NOC Details',
//         'chalan_submit.php'=>'Submit Chalan Document',
//         'all_list.php' => 'All NOCs',
//         'list_of_nocs.php?status=100_draft' => 'Drafts',
//         'list_of_nocs.php?status=200_vendor_submitted' => 'Submitted NOCs',
//         'list_of_nocs.php?status=800_waiting_for_vendor_payment' => 'Waiting for Payment',
//         'list_of_nocs.php?status=850_payment_check' => 'Check Payment Status',
//         'list_of_nocs.php?status=1000_signed_document' => 'Approved NOCs',
//         'list_of_nocs.php?status=99_rejected' => 'Rejected NOCs'
//     ];



//     echo '<span class="breadcrumbs">';
//     echo '<a href="' , VENDOR_URL , '"> Vendor </a>';


//     $partial_url = VENDOR_URL;
//     for($i=0, $ilen = sizeof($urlParts); $i <$ilen ; $i+=1 ){
//         $partial_url .= $urlParts[$i] . '/'; 
//         $show = $navLinks[$urlParts[$i]];
//         echo $separator, '<a href="' ,  $partial_url , '"> ',$show,' </a>';
//     }


//     foreach ($urlParts as $part) {
//         if (!in_array(strtolower($part), $exclude)) {
//             $crumb .= '/' . $part;
//             if (isset($navLinks[$part])) {
//                 $breadcrumbs[] = '<a href="' . $crumb . '">' . $navLinks[$part] . '</a>';
//             } elseif (isset($navLinks[$part . '.php'])) {
//                 $breadcrumbs[] = '<a href="' . $crumb . '">' . $navLinks[$part . '.php'] . '</a>';
//             } elseif (!$queryHandled && strpos($_SERVER['REQUEST_URI'], $part) !== false) {
//                 foreach ($navLinks as $link => $label) {
//                     if (strpos($link, $part) !== false && strpos($_SERVER['REQUEST_URI'], $link) !== false) {
//                         $breadcrumbs[] = '<a href="' . $crumb . '">' . $label . '</a>';
//                         $queryHandled = true; 
//                     }
//                 }
//             } elseif ($part == basename($_SERVER['PHP_SELF'])) {
//                 $breadcrumbs[] = ucfirst(str_replace('-', ' ', $part));
//             } else {
//                 $breadcrumbs[] = '<a href="' . $crumb . '">' . ucfirst(str_replace('-', ' ', $part)) . '</a>';
//             }
//         }
//     }

//     $breadcrumbs = implode($separator, $breadcrumbs);
    
    
//     echo '</span>';
    

// }


// function bd_date_format($olddate){
    
    
//     return date_format(date_create($olddate),'d-m-Y');;
// }


// pg_header();
// pg_footer();
// pg_navbar();
// die("loxxxs");