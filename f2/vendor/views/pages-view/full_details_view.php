<?php
  pg_header();
  show_banner('cites_non_cites');
  pg_topnavbar();
  breadcrumbs();
?>
<div class="container-xl ">
	<div class="card table-responsive">
		<div class="table-wrapper">
		    <div class="table-title" style="background-color: <?php echo ($NOC['status'] === "1000_signed_document") ? 'whitesmoke' : '#435d7d'; ?> !important;">
                <?php  
                    $subOfNOC = $NOC['sub_of_noc'];
					$category = $NOC['category'];
					$memoID = $NOC['memo_id'];
					$validity_date = $NOC['validity_date'];
					$applicationDate = $NOC['application_date'];
					$application_type = $NOC['noc_type'];
					if($NOC['status']==="1000_signed_document"){
					 headerAll($subOfNOC, $category, $memoID, $applicationDate,$validity_date);
				}
				else{
					generateheaderimport($application_type, $subOfNOC, $category, $memoID, $applicationDate);
				}
                ?>
			</div>
		<div> <?php generateTableContentimport($NOC,$aplicant); ?> </div>
       <?php
	   echo  view_species_table_v2($NOC, $species_on_this_noc, $edit = false); 
	    file_show($NOC,$aplicant);
		  if ($NOC['status'] === '1000_signed_document') {
				//view_approved_animal_list($species_on_this_noc, $NOC);
            	echo '<div style="text-align:left; margin-left:20px">
			     <p style="font-size:18px; font-weight:bold;display: inline;margin-top:20px;"><u>Conditions:</u></p>
			    <li>Imported birdsmust be kept in cages, so that they could not come in contact with any other animals.</li>
                <li>Imported cage birds cannot be released in nature.</li>
                <li>Dead birds must be buried deep in the ground</li>
                <li>After import, rings must be worn on the legs of imported birds within 7(seven) days and inform the licensing authority.</li>
                <li>This NOC is not transferable and the import of wild birds is strictly prohibited</li>
                <li>This NOC is issued for one consignment only</li>';
			
				$conditions = explode("\n", $NOC['conditions']);
			
				foreach ($conditions as $condition) {
					//echo '<li>' . trim($condition) . '</li>';
					echo '<li>' . $condition . '</li>';
				}
				echo '</div><br>';

			echo '<div style="margin-left: 70%">
			    <img src="', $user['sign'], '" style="margin-left: -15px;"><br>
			    <p>', $user['name'], '</p> 
				<p>Conservator of Forest</p>
				<p>Wildlife and Nature Conservation Circle</p>
				<p>Ban Bhaban, Agargaon, Dhaka, Bangladesh</p>';
				echo !empty($user['phone']) ? '<p>Tell: ' . $user['phone'] . '</p>' : '';
				echo'<p>e-mail: cfwildlifefd@gmail.com</p></div>';
					echo '<div style="padding-left:20px;">
					<p>Chief Controller, CCI&E</p> 
					<p>Copy forworded for information and necessary action:</p>
					<li>Commissioner of Customs, Customs House, Hazrat Shahjalal International Airport, Dhaka.</li>
					<li>Executive Director, Bangladesh Civil Aviation Authority. Hazrat Shahjalal International Airport, Dhaka.</li>
					<li>Director, Wildlife Crime Control Unit, Bana Bhaban, Agargaon, Dhaka. </li>
					<li>Deputy Conservator of Forest, RIMS Unit, Ban Bhaban, Agargaon, Dhaka. Please publish this NOC in Forest Departments website.</li>
					<li>Divisional Forest Officer, Wildlife Management and Nature Conservation Division, Dhaka.</li>
					<li>Deputy Conservator of Forest, Wildlife and Nature Conservation Circle, Ban Bhaban, Agargaon, Dhaka.</li>
					<li>Assistant Director, Livestock Quarantine Station, Terminal-1, Hazrat Shahjalal International Airport, Dhaka</li>
					<li> Ms. Fa-Tu-Zo Khaleque Mila/Ms. Shakila Nargis, Wildlife & Biodiversity Conservation Officer, Ban Bhaban, Agargaon, Dhaka-1207. </li>
					<li>M/S. I.S. Entertainment Pvt. Ltd. Sel Trident Tower, 57, Purana Paltan Lane, Dhaka-1000.</li>
		        </div>';
				echo '<div style="text-align:left; margin-left:20px;">
				<img src=', $NOC['qr_code'], '></div>
				<p style="font-size:18px;text-align:right; margin-right:20px;">';
		    echo '<br>';
		    echo '<form styele="background:transparent;"><input type="hidden" name="id" value="', $NOC['id'],'"/>
		        <a class="btn btn-info" href="pdf.php?id=',$NOC['id'],'" target="_blank"><i class="fa fa-download"></i> NOC Download</a></form>';
		    }  
			
			// else if($NOC['status']==="900_payment_confirmed"){
			// 	view_approved_animal_list($species_on_this_noc, $NOC);
	        // }
	    ?>
    </div>
</div>
</div>
<?php pg_footer(); ?>