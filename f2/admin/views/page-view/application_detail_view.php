<?php

if(empty(@$_GET['id'])){
	header('location: dashboard.php');
	exit;	
}
$row = $db->select('SELECT * from noc_import where id = ? limit 1', $_GET['id']);
if(empty($row)){
	header('location: dashboard.php');
	exit;	
}
$NOC = $row[0];
$aplicant_id = $NOC['user_id'];
$aplicant = $db->select('SELECT * from vendor where id = ?',$aplicant_id)[0];
$species_on_this_noc = $db->select('SELECT * from imp_noc_species_duplicate where noc_id = ? order by status', $_GET['id']);
// pre($NOC);
// pre($aplicant);
// pre($species_on_this_noc, 'moooom');
if(isset($_POST['conditions']) && $_POST['id'] ){
    $db->action('UPDATE noc_import SET conditions = ? where id = ?', $_POST['conditions'], $NOC['id']);
    //print_r($_POST);
    header('Location: ' . $_SERVER['REQUEST_URI']);
	exit;
}
if (!empty(@$_POST)) {
	 
    //  if($NOC['status'] ==='1000_signed_document' && $NOC['qr_code'] ===''){
	// 	include THIS_A_FILE_LOCATION. '../api/util/qr_code_genarator.php';
	// 	qr_code_genator($NOC);
    //  }
    admin_note_post($NOC);
    update_next_status($NOC);
}

 add_js(['assets/js/modal.js','assets/js/list_of_nocs.js']);
//  add_js(['assets/js/modal.js','assets/js/list_of_nocs.js']);
pg_header();
show_banner($NOC['sub_of_noc'], 'Application Details');
pg_topnavbar();
pg_navbar2();
breadcrumbs(' > ');

?>

<div class="container-xl "><br>
	<div class="card table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<?php
				$subOfNOC = $NOC['sub_of_noc'];
				$category = $NOC['category'];
				$memoID = $NOC['memo_id'];
				$applicationDate = $NOC['application_date'];
				$application_type = $NOC['noc_type'];
				generateheaderimport($application_type, $subOfNOC, $category, $memoID, $applicationDate);
			?>
			</div>
			<div>
			<?php generateTableContentimport($NOC, $aplicant); ?></div>
			<?php
			
			$current_role = auth()['role'];
			$current_status = $NOC['status'];
			$current_role_numeric = role_cutter($current_role);
			if (in_array($NOC['status'], ['900_payment_confirmed', '1000_signed_document', '1050_inspection_document'])) {
				view_approved_animal_list($species_on_this_noc, $NOC);
			} else {
				if ($current_role_numeric >= 20) {
					admin_content_table($NOC, $species_on_this_noc);
				} else {
					view_species_table_v2($NOC, $species_on_this_noc, $edit = true);
				}
			}
			echo file_show($NOC, $aplicant,true);
			echo '<br>'; 
			show_admin_notes($NOC);
			
			
			
	

			if ($current_role_numeric > 10) {
				echo ' <a href="#collapseExample" class="btn btn-success" data-bs-toggle="collapse"  
  					role="button" aria-expanded="false"    aria-controls="collapseExample" >Change Conditions</a> <br/> <br/>';
			// if ($NOC['status'] === '1000_signed_document' || $NOC['status'] == '950_waiting_for_printing') {
				echo '<div style="text-align:left; margin-left:20px" id="collapseExample" class="collapse" > 
					<p style="font-size:18px; font-weight:bold;display: inline;margin-top:20px;">
					<u>Conditions:</u></p> 
					<li>Imported birds must be kept in cages, so that they could not come in contact with any other animals.</li> 
					<li>Imported cage birds cannot be released in nature.</li> 
					<li>Dead birds must be buried deep in the ground.</li> 
					<li>After import, rings must be worn on the legs of imported birds within 7(seven) days and inform the licensing authority.</li> 
					<li>This NOC is not transferable and the import of wild birds is strictly prohibited.</li> 
					<li>This NOC is issued for one consignment only.</li>';

				if (!empty($NOC['conditions'])) {
					$conditions = explode("\n", $NOC['conditions']);
					foreach ($conditions as $condition) {
						echo '<li>' , $condition , '</li>';
					}
				}

				echo '<div style="display: inline-block; margin-left: 10px;" id="toggle-conditions" ><i class="fas fa-pen" > </i>Add More</div>'; 
				echo '</div><br>';			
			//}
			// foreach ($status_change_plan as $status => $details) {
			// 	if ($details['ROLE'] == $current_role && $NOC['status'] != "99_rejected" && $NOC['status'] != "950_waiting_for_printing" && $NOC['status'] != "1000_signed_document") {
					
						
			// 			break;
			// 		}
			// 	}
			
				echo '<div id="conditions-box" style="display: none;"><form style="background-color:white !important;" class="card-body" method="POST"> 
				<label for="conditions" class="form-label"><h5><b>Enter Terms & Conditions</b></h5></label><span style="color:red;">*</span>';
				echo '<input type="hidden" name="id" id="id" value="' . $NOC['id'] . '" />'; 
				echo '<textarea style="height:261px !important; font-size: 14px;" class="form-control" name="conditions" required></textarea><br>'; 
				echo '<button class="btn btn-primary" type="submit">Submit</button>'; 
				echo '</form></div>';
			}
			// if ($NOC['status'] !== '99_rejected') {
			// 	echo '<div class="" style="font-size:0;">
            //     <div class="" style="margin-left: 650px;font-size:15px;margin-right: 30px"><br>
            //         <img style=" max-width: 180px;height: 100px;" src="', auth()['sign'], '"><br>
            //             ', auth()['name'], '
            //              <br>Phone:',auth()['phone'],'<br>
            //              Email: ', auth()['email'], '<br>
            //             <br>
            //         </div></div><br>';
			// }
			?>
			<?php
				echo'<div class=""><br>';
				show_next_status_button($NOC);
			    echo'</div>';
			?>
			<br>
		</div>
	</div>
	
	<script>
    document.getElementById('toggle-conditions').addEventListener('click', function() {
        var conditionsBox = document.getElementById('conditions-box');
        if (conditionsBox.style.display === 'none') {
            conditionsBox.style.display = 'block';
        } else {
            conditionsBox.style.display = 'none';
        }
    });
</script>


<?php 
include THIS_A_FILE_LOCATION . 'views/page-view/modal.php';
pg_footer();