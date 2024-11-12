<?php
include '../header-footer/header.php';
include '../header-footer/navbar.php';

?>
<div class="container-xl ">
    <div class="card table-responsive">
        <div class="table-wrapper">
            <div class="table-title" style="background-color: <?php echo ($NOC['status'] === "1000_signed_document" || $NOC['status']==="1050_inspection_document") ? 'whitesmoke' : '#435d7d'; ?> !important;">
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
        <div>
            <?php generateTableContentimport($NOC,$aplicant); ?>
        </div>
           <?php
            view_approved_animal_list($species_on_this_noc,$NOC); 
            file_show($NOC, $aplicant);
            if (!empty($NOC['conditions'])) {
				echo '<div style="text-align:left; margin-left:20px">
				<p style="font-size:18px; font-weight:bold;display: inline;margin-top:20px;"><u>Conditions:</u></p>';
				$conditions = explode("\n", $NOC['conditions']);
				echo '<ol class="ol-num">';
				foreach ($conditions as $condition) {
					//echo '<li>' . trim($condition) . '</li>';
					echo '<li>' . $condition . '</li>';
				}
				echo '</ol>';
				echo '</div><br>';
			}
                echo '<div style="padding-left:20px;"> 
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
            echo'<div class="" style="font-size:0;">
                    <div class="" style="margin-left: 650px;font-size:15px;margin-right: 30px"><br>
                        <img style=" max-width: 180px;height: 100px;" src="', $user['sign'],'"><br>
                            ',$user['name'],'
                            <br>',$user['phone'],'<br>
                            Email: ',$user['email'],'<br>
                        <br>
                        
                    </div></div><br>';
                   if($NOC['status']=='1000_signed_document'){
                    if(!empty($NOC['inspec_comment'])){
                      echo'<div class="card">
                            <div class="card-body">
                            <h6 class="card-title">Inspectors Comment</h6>
                            <p class="card-text">'.$NOC['inspec_comment'].'</p>
                            </div>
                        </div><br>';
                    }
                    echo'<div>
                    <label class="container"><h5>Comment</h5></label><br>
                    <form method="POST">
                        <textarea type="text" class="form-control" name="veification_comment"></textarea><br>
                        <button type="submit" class="btn btn-info" name="inspec_comment">Post Comment</button>
                        <input type="hidden" name="noc_id" value="', $NOC['id'],'?>"/>
                    </form>
               </div>
               <br>';
                   
                // view_species_table($NOC, $species_on_this_noc, $edit = false);
                // file_show($NOC, $species_on_this_noc[0]);
                //update_next_status($NOC);
                
                echo'<div style="display: flex; column-gap:7px;">';
                echo'<form method="POST">
                <input type="submit" class="btn btn-primary" name="inspector_verify" value="Verified"/>
                <input type="hidden" name="noc_id" value="', $NOC['id'],'?>"/>
                </form>';
                //show_next_status_button($NOC);
                echo'</div>';
                //show_next_status_button($NOC);
                echo'</div>';
            }
        ?>
    </div>
</div>
    </div>
<?php
    include '../header-footer/footer.php';
?>
