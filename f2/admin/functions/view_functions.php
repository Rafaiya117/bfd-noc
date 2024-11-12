<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




function urlToFilePath($url) {
    return str_replace(IMG_URL, IMG_PATH, $url);
}

// function.php
function file_show($NOC, $user) {
    $files = [];

    if ($user['licence_copy'] != Null) {
        displayFile($user['licence_copy'], 'Company licence certificate');
        $files[] = $user['licence_copy'];
    }
    if ($NOC['health_certificate_img'] != Null) {
        displayFile($NOC['health_certificate_img'], 'Health certificate');
        $files[] = $NOC['health_certificate_img'];
    }
    if ($NOC['permit'] != Null) {
        displayFile($NOC['permit'], 'Exporter permit Copy');
        $files[] = $NOC['permit'];
    }
    if ($NOC['invoice'] != Null) {
        displayFile($NOC['invoice'], 'Invoice Copy');
        $files[] = $NOC['invoice'];
    }
    if ($NOC['chalan_copy'] != Null) {
        displayFile($NOC['chalan_copy'], 'Chalan Copy');
        $files[] = $NOC['chalan_copy'];
    }
    if ($NOC['cites_permit'] != Null) {
        $filePaths = $NOC['cites_permit'];
        if (!empty($filePaths)) {
            $filePathsArray = explode(',', $filePaths);
            foreach ($filePathsArray as $filePath) {
                displayFile($filePath, 'CITES permit Copy');
                $files[] = $filePath;
            }
        }
    }

    // $zipFileName = 'zip/files_' . $NOC['id'] . '.zip';
    // $zipFilePath = createZipFile($files, $zipFileName);

    // Display download button
    // $zipFileUrl = IMG_URL . '/' . $zipFileName;
    echo '<br>
        <a href="' , APP_URL, 'zip_download.php?id=',$NOC['id'] , '"  class="btn btn-primary">Download all files</a> 
       
    
    <br>';
}



// function Uploader_div($noc_id, $fileupload_id, $title, $noc)
// {
//   echo '<div class="container card-body">   
//     <h3 class="table-title1" >', $title, ' </h3>
//     <form class="" method="POST"  enctype="multipart/form-data">
//     File : <input type="file" id="', $fileupload_id, '" name="', $fileupload_id, '"><br><br>'; 
//     displayFile($noc[$fileupload_id], $title);
//     echo '<input name="noc-id" id="noc-id" value="', $noc_id, '" type="hidden" />
//     <br><button type="submit" name="submit" value="Upload" class="btn btn-primary">Upload </button>
//   </form>
// </div>';
// }







// function breadcrumbs($separator = ' &raquo; ') {
//     $url = $_SERVER['REQUEST_URI'];
//     $urlParts = explode('/', trim($url, '/'));
//     $breadcrumbs = array();
//     $crumb = '';
//     $exclude = array('bfd-noc', 'f2');

//     $queryMapping = [
//         'role=10_Assistant' => 'New NOC Application',
//         'role=20_Officer' => 'Desk Officer',
//         'role=30_DCF' => 'DCF',
//         'role=40_CF' => 'CF',
//         'role=50_CCF' => 'CCF',
//         'role=0_Vendor' => 'Waiting for Payment',
//         'status=1000_signed_document' => 'Approved NOCs',
//         'status=99_rejected' => 'Rejected NOCs'
//     ];

//     foreach ($urlParts as $part) {
//         if (!in_array(strtolower($part), $exclude)) {

//             $part = preg_replace('/\.php$/', '', $part); 
//             $part = preg_replace('/\?.*$/', '', $part); 
            
//             $crumb .= '/' . $part;
            
//             $formattedPart = ucfirst(str_replace('_', ' ', $part));
            
//             if ($part == basename($_SERVER['PHP_SELF'])) {
//                 $breadcrumbs[] = $formattedPart;
//             } else {
//                 $breadcrumbs[] = '<a href="' . $crumb . '">' . $formattedPart . '</a>';
//             }
//         }
//     }
//     if ($_SERVER['QUERY_STRING']) {
//         foreach ($queryMapping as $query => $label) {
//             if (strpos($_SERVER['QUERY_STRING'], $query) !== false) {
//                 $breadcrumbs[] = $label;
//             }
//         }
//     }

//     $breadcrumbs = implode($separator, $breadcrumbs);
//     return '<p class="breadcrumbs">' . $breadcrumbs . '</p>';
// }



function generateDateFilter($formAction, $inputFieldNameFrom, $inputFieldNameTo) {
    ?>
    <div class="date-filter">
    <form method="POST" action="<?php echo $formAction ?>" style="display:flex; gap:5px; padding:10px; background-color:transparent;">
    
        <label for="<?php echo $inputFieldNameFrom; ?>">From</label>
        <input class="form-control" type="date" id="<?php echo $inputFieldNameFrom; ?>" name="<?php echo $inputFieldNameFrom; ?>">
         <label for="<?php echo $inputFieldNameTo; ?>">To</label>
        <input class="form-control" type="date" id="<?php echo $inputFieldNameTo; ?>" name="<?php echo $inputFieldNameTo; ?>">
      
        <button type="submit" class="btn btn-primary" style="color:white;"  id="filter-btn">Filter</a> 
    </form></div>
    
<?php
    // <script>
    //     function submitForm(fromFieldName, toFieldName) {
    //         document.getElementById(fromFieldName + '-hidden').value = document.getElementById(fromFieldName).value;
    //         document.getElementById(toFieldName + '-hidden').value = document.getElementById(toFieldName).value;
    //         document.forms[0].submit();
    //     }
    // </script>
    ?>
    <?php
}

