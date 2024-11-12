<?php
  pg_header();
  show_banner('cites_non_cites');
  pg_topnavbar();
  breadcrumbs();
  add_js(['assets/js/tk_calulation.js']);
?>
<div class="container-xl ">
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
			<div> <?php generateTableContentimport($NOC,$aplicant);?> </div>
			<?php
			if ($NOC['sub_of_noc'] === 'NON-CITES') {
				echo '<div style="background-color: #f1eeee;
                margin-top: 30px;
                padding-top: 30px;
                padding-bottom: 20px;
                padding-left: 20px;"><h4><b>Applicant have to pay 20 Taka per head (15% vat will be added automatically)</b></h4></div>';
			} else {
				echo '<div style="background-color: #f1eeee;
                margin-top: 30px;
                padding-top: 30px;
                padding-bottom: 20px;
                padding-left: 20px;"><h4><b>Applicant have to pay 20 Taka per head (15% vat will be added automatically)</b></h4></div>';
			}
			echo '<br>';
			
			$last_status = '';
			$j = 1;
			for ($i = 0, $ilen = sizeof($species_on_this_noc); $i < $ilen; $i += 1, $j += 1) {

				$animal = $species_on_this_noc[$i];

				if ($animal['status'] !== $last_status) {
					$last_status = $animal['status'];
					if ($i != 0) {
						echo '</tbody></table tb="endthis">';
					}
					$j = 1;

					echo ' <br>';
					if ($last_status == 'New') {
						echo '<h4 style="padding-top: 90px;"><b>Approved animal list:</b></h4>';
					} else {
						echo '<h4 style="padding-top: 90px;"><b>Approved animal list (Edited list):</b></h4>';
					}
					echo '<table class="table table-striped table-hover card-body">';
					echo '<thead>
							<tr>
							    <th>Serial No.</th>
							    <th>English Name</th>
							    <th>Scientific Name</th>
							    <th>CITES Appendix Status</th>
							    <th>IUCN</th>
							    <th>Quantity</th>
                                <th>Unit Price in BDT</th>
							    <th>Total Price in BDT</th>
                                
							</tr>
						</thead><tbody>';
				    }
				    echo '<tr>
						<td>', $j, '</td>
						<td>', $animal['species_english_name'], '</td>
						<td><i style="font-size:16px!important;">', $animal['species_scientific_name'], '</i></td>
						<td>', $animal['CITES'], '<p></td>
						<td>', $animal['IUCN'], '</td>
						<td>', $animal['quantity'], '</td>
						<td class="tk">', $animal['price_bdt'], '</td>
                        <td class="tk">', $animal['price_bdt'] * $animal['quantity'], '</td>			
					</tr>';
			    }

			echo '<tr><td colspan="5"><strong>Total amount:</td>';
			if ($NOC['sub_of_noc'] === 'NON-CITES') {
				echo '<td colspan="5" class="tk"> ', $NOC['headcount'] * 20, '</td></tr>';
			} else {
				echo '<td colspan="5" class="tk"> ', $NOC['headcount'] * 20, '</td></tr>';
			}
			echo '<br><tr><td colspan="5"><strong>15% vat:</td>';
			if ($NOC['sub_of_noc'] === 'NON-CITES') {
				echo '<td colspan="5" class="tk"> ', 20 * $NOC['headcount'] * 0.15, '</td></tr>';
			} else {
				echo '<td colspan="5" class="tk"> ', 150 * $NOC['headcount'] * 0.15, '</td></tr>';
			}
			echo '<br><tr><td colspan="5"><strong>Total amount including 15% vat:</td>';
			if ($NOC['sub_of_noc'] === 'NON-CITES') {
				echo '<td colspan="5" class="tk"> ', (20 * $NOC['headcount']) + (20 * $NOC['headcount'] * 0.15), '</td></tr>';
			} else {
				echo '<td colspan="5" class="tk"> ', (150 * $NOC['headcount']) + (150 * $NOC['headcount'] * 0.15), '</td></tr>';
			}
			// echo '<br><tr><td colspan="5"><strong>Total fee paid by applicant :</td>';
			// if ($NOC['sub_of_noc'] === 'NON-CITES') {
			// 	echo '<td colspan="5" class="tk"> ', (20 * $NOC['headcount']) + (20 * $NOC['headcount'] * 0.15), '</td></tr>';
			// } else {
			// 	echo '<td colspan="5" class="tk"> ', (150 * $NOC['headcount']) + (150 * $NOC['headcount'] * 0.15), '</td></tr>';
			// }
			echo '</tbody></table>'; ?><br>
            <?php Uploader_div($NOC['id'],'chalan_copy','Submit pdf or scanned copy of your chalan form',$NOC) ?>
		   <br>
			
			<a href="list_of_nocs.php?status=850_payment_check" type="submit" class="btn btn-info"  id="id">Submit</a><br><br>


		</div>
	</div>
	<?php pg_footer(); ?>