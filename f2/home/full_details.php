<?php
include '_a.php';
// use function Composer\Autoload\includeFile;
// include '../admin/assets/lib/phpqrcode/qrlib.php';


function _image_endcore($img){
    global $pdf_gen;
    
    
    
    if($pdf_gen){
        $re =  base64_encode(file_get_contents( IMG_PATH.$img ));
        echo 'data:image/jpg;base64,',$re ;
    }else{
        echo IMG_URL,$img;
    }
    
    

}

function _noc_signatory_small_home($noc){ 
    
    
    ?>
    
    <div class="row">
    <div class="col-md-4" style="text-align:left; float:left;">
        
        <!-- <br><br>
        Chief Controller, CCI&E -->
    </div>
    <div class="col-md-3" style=" float:left;">    </div>
    <div class="col-md-4 sign" style="text-align:center; float:left;">
        
        <?php 
        if($noc['signatory']['id']){ 
            echo  '<p><img src="', _image_endcore('/admin_sign/'.$noc['signatory']['id'].'.jpg'), '" style="max-width: 100px; max-height: 100px;" ></p>';
            echo '<p>', bd_date_format($noc['approved_date']),'</p>';
            echo '<p>',$noc['signatory']['name'],'</p>';
            echo '<p>',$noc['signatory']['designation'],'</p>';
        
        } 
        ?>

        
    </div>
    </div>
    <div class="clear"></div>
<?php };


add_js(['../assets/js/change_status.js', '../assets/js/uploader.js', '../assets/js/insert_condition.js']);


if (!empty(@$_GET['id'])) {
	$row = $db->select('SELECT * from noc_import where id = ? limit 1', $_GET['id']);
	$id = $_GET['id'];
	$NOC = $row[0];
    $aplicant_id = $NOC['user_id'];
    $admin_bar = json_decode($NOC['admin_bar_status'], true);
    $signatory_id = $admin_bar['1000_signed_document']['id'];
    $NOC['species'] = $db->select('SELECT * from imp_noc_species_duplicate where noc_id = ? order by id ', $id);   
    $NOC['applicant'] = $db->select('SELECT * from vendor where id = ?',$aplicant_id)[0];
    $NOC['signatory'] = $db->select('SELECT * from users where id = ? limit 1', $signatory_id)[0];

	
    $aplicant_id = $NOC['user_id'];
    $aplicant = $db->select('SELECT * from member where id = ? ', $aplicant_id)[0];
	
	$row2 = $db->select('SELECT * from users where designation = ? limit 1', "Conservator of Forests");
	$user = $row2[0];

	//$species_on_this_noc = $db->select('SELECT * from imp_noc_species where noc_id = ? order by status', $_GET['id']);
	$species_on_this_noc = $db->select('SELECT * from imp_noc_species_duplicate where noc_id = ? order by status', $_GET['id']);
	$j = 1;
	$ilen = sizeof($species_on_this_noc);
	//$animal = $species_on_this_noc[0];
    if (!empty($species_on_this_noc)) {
		$admin = $species_on_this_noc[0];
	} else {
		$admin = [''];
	}

	

    if($NOC['status']==='1000_signed_document' && $NOC['noc_type']=="import"){
        $path = IMG_URL . '/qr_code/';
        $path2 = IMG_PATH . '/qr_code/';
        $qr_image = BASEURL . '/vendor/import/full_details.php?id=' . $NOC['id'];
        //move_uploaded_file($_FILES['name'], $path2);
        $qrcode = $path2 . 'noc_im' . $NOC['id'] . '.png'; 
        $qrcode2 = $path . 'noc_im' . $NOC['id'] . '.png'; 
        // QRcode::png($qr_image, $qrcode);      
        // $updat_status = $db->action('UPDATE noc_import SET `qr_code` = ? WHERE  id = ?',$qrcode2, $NOC['id']);
    }
    else if($NOC['status']==='1000_signed_document' && $NOC['noc_type']=="export"){
        $path = IMG_URL . '/qr_code/';
        $path2 = IMG_PATH . '/qr_code/';
        $qr_image = BASEURL . '/vendor/export/full_details.php?id=' . $NOC['id'];
        //move_uploaded_file($_FILES['name'], $path2);
        $qrcode = $path2 . 'noc_im' . $NOC['id'] . '.png'; 
        $qrcode2 = $path . 'noc_im' . $NOC['id'] . '.png'; 
        // QRcode::png($qr_image, $qrcode);      
        // $updat_status = $db->action('UPDATE noc_import SET `qr_code` = ? WHERE  id = ?',$qrcode2, $NOC['id']);
    }
}else{
    set_message('Wrong Memo No, NOC not found', 'danger');
    header('Location:index.php');
}
// include 'pages/header.php';
pg_header();
//include 'pages/navbar.php';
?>
<div class="container-xl ">
	<div class="card table-responsive">
		<div class="table-wrapper">
			<div class="table-title" style="background-color:whitesmoke !important;">
            <?php  
                $subOfNOC = $NOC['sub_of_noc'];
                $category = $NOC['category'];
                $memoID = $NOC['memo_id'];
                $validity_date = $NOC['validity_date'];
                $applicationDate = $NOC['application_date'];
                $application_type = $NOC['noc_type'];
                 headerAll($subOfNOC, $category, $memoID, $applicationDate,$validity_date);
                ?>
			</div>
		<div> <?php generateTableContentimport($NOC,$aplicant); ?> </div>
        <?php
             if ($NOC['status'] === "1000_signed_document") {

                
                // $last_status = '';
                // $j = 1;
                echo '<h4 style="padding-top: 90px;"><b>Approved Animal List:</b></h4>';
                   
                   
                   
                        echo '<table class="table table-striped table-hover card-body">';
                        echo '<thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>English Name</th>
                            <th>Scientific Name</th>
                            <th>CITES Appendix Status</th>
                            <th>IUCN</th>
                            <th>Quantity</th>
                            <th>Ring ID & Species Image</th>
                            
                        </tr>
                    </thead><tbody>';
                for ($i = 0, $ilen = sizeof($species_on_this_noc); $i < $ilen; $i += 1, $j += 1) {
                    $animal = $species_on_this_noc[$i];
                   
                   
                   
                   
    
                   
                   
                            
                
                    echo '<tr>
                        <td>', $j, '</td>
                        <td>', $animal['species_english_name'], '</td>
                        <td><i style="font-size:16px!important;">', $animal['species_scientific_name'], '</i></td>
                        <td>', $animal['CITES'], '<p></td>
                        <td>', $animal['IUCN'], '</td>
                        <td>', $animal['quantity'], '</td>

                         <td>';
                        echo $animal['ring_number'], '<br>';
                        if (!empty($animal['species_images'])) {
                            echo '<a href="',IMG_URL,'/', $animal['species_images'] ,'" ><img src="' ,IMG_URL,'/', $animal['species_images'] , '"/></a>';
                        } else {
                            echo '<small style="color:#cacaca">No Image Found</small>';
                        }
                        echo '</td>';
                    
                                
                    echo '</tr>';
                }
                echo '</tbody></table>';
                echo '<div style="text-align:left; margin-left:20px">
                <p style="font-size:18px; font-weight:bold;display: inline;margin-top:20px;"><u>Conditions:</u></p>
                <li>Imported birdsmust be kept in cages, so that they could not come in contact with any other animals.</li>
                <li>Imported cage birds cannot be released in nature.</li>
                <li>Dead birds must be buried deep in the ground</li>
                <li>After import, rings must be worn on the legs of imported birds within 7(seven) days and inform the licensing authority.</li>
                <li>This NOC is not transferable and the import of wild birds is strictly prohibited</li>
                <li>This NOC is issued for one consignment only</li>';
                if(!empty($NOC['conditions'])){
                    $conditions = explode(',', $NOC['conditions']);
                    foreach ($conditions as $condition) {
                        echo '<li>'. trim($condition) . '.' . '</li>';
                    }
                }
            echo '<div style="text-align:left; margin-left:20px;">

                <img src=',IMG_URL, $NOC['qr_code'], '></div>
                <p style="font-size:18px;text-align:right; margin-right:20px;">';
                
                
                _noc_signatory_small_home($NOC);
                echo '</p>';    
                echo '</div>';

                echo '<div style="padding-left:20px;"> 
                <p>Copy forworded for information and necessary action:</p>
                <li>Commissioner of Customs, Customs House, Hazrat Shahjalal International Airport, Dhaka.</li>
                <li>Executive Director, Bangladesh Civil Aviation Authority. Hazrat Shahjalal International Airport, Dhaka.</li>
                <li>Director, Wildlife Crime Control Unit, Bana Bhaban, Agargaon, Dhaka. </li>
                <li>Deputy Conservator of Forest, RIMS Unit, Ban Bhaban, Agargaon, Dhaka. Please publish this NOC in Forest Departments website.</li>
                <li>Divisional Forest Officer, Wildlife Management and Nature Conservation Division, Dhaka.</li>
                <li>Deputy Conservator of Forest, Wildlife and Nature Conservation Circle, Ban Bhaban, Agargaon, Dhaka.</li>
                <li>Assistant Director, Livestock Quarantine Station, Terminal-1, Hazrat Shahjalal International Airport, Dhaka</li>
                <li>Ms. Fa-Tu-Zo Khaleque Mila / Ms. Shakila Nargis, Wildlife & Biodiversity Conservation Officer, Ban Bhaban, Agargaon, Dhaka-1207. </li>
                <li>M/S. I.S. Entertainment Pvt. Ltd. Sel Trident Tower, 57, Purana Paltan Lane, Dhaka-1000.</li>
            </div>';
            echo '<br>';
        } 
        ?>
</div>
</div>
</div>
<?php pg_footer();