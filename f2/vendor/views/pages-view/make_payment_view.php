<?php
  pg_header();
  show_banner('cites_non_cites');
  pg_topnavbar();
  breadcrumbs();
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
        <div>
        <?php
            generateTableContentimport($NOC,$aplicant);
        ?>
    </div>
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
                padding-left: 20px;"><h4><b>Applicant have to pay 150 Taka per head (15% vat will be added automatically)</b></h4></div>';
            }
            if ($NOC['status'] == 'Done') {
        echo ' <table class="table table-striped table-hover card-body">
            <h4><b>Requested Animal List by Applicant:</b></h4>
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>English Name</th>
                    <th>Scientific Name</th>
                    <th>CITES Appendix Status</th>
                    <th>IUCN</th>
                    <th>Quantity</th>
                    <th>Unit Price in BDT</th>
                    <th>Total Price in BDT</th>
                    <th>Unit Price in USD</th>
                    <th>Total Price in USD</th>
                </tr>
            </thead>
        <tbody>';
            $k = 1;
                for ($i = 0, $ilen = sizeof($species_on_this_noc_duplicate); $i < $ilen; $i += 1, $k += 1) {
                    $row = $species_on_this_noc_duplicate[$i];

                    echo '<tr>';
                        echo '<td>', $k, '</td>
                            <td>', $row['species_english_name'], '</td>
                            <td><i style="font-size:16px!important;">', $row['species_scientific_name'], '</i></td>
                            <td>', $row['CITES'], '<p></td>
                            <td>', $row['IUCN'], '</td>
                            <td>', $row['quantity'], '</td>
                            <td>', $row['price_bdt'], '</td>
                            <td>', $row['price_bdt'] *  $row['quantity'], '</td>
                            <td>', $row['price_usd'], '</td>
                            <td>', $row['price_usd'] *  $row['quantity'], '</td>';
                        echo '</tr>';
                    }
                echo '</tbody>
            </table>';
        }
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
                        echo '<h4 style="padding-top: 13px;"><b>Approved Animal List:</b></h4>';
                    } else {

                        // end
                        echo '<h4 style="padding-top: 13px;"><b>Approved Animal List (edited list):</b></h4>';
                    }
                    echo '<table class="table table-striped table-hover card-body" style="margin-top: -42px !important;">';
                    echo '<thead>
						<tr>
							<th>Serial No.</th>
							<th>English Name</th>
							<th>Scientific Name</th>
							<th>CITES Appendix Status</th>
							<th>IUCN</th>
							<th>Schedule</th>
							<th>Quantity</th>
                            <th>Unit Price in BDT</th>
							<th>Total Price in BDT</th>
                            <th>Unit Price in USD</th>
							<th>Total Price in USD</th>
							
						</tr>
				    </thead><tbody>';
                }
                echo '<tr>
						<td>', $j, '</td>
						<td>', $animal['species_english_name'], '</td>
						<td><i style="font-size:16px!important;">', $animal['species_scientific_name'], '</i></td>
						<td>', $animal['CITES'], '<p></td>
						<td>', $animal['IUCN'], '</td>
                        <td>', $animal['schedule'], '</td>
						<td>', $animal['quantity'], '</td>
						<td>', $animal['price_bdt'], '</td>
                        <td>', $animal['price_bdt'] * $animal['quantity'], '</td>			
					</tr>';
                }

            echo '<tr><td colspan="7"><strong>Total amount:</td>';
            if ($NOC['sub_of_noc'] === 'NON-CITES') {
                echo '<td colspan="5"> ', $NOC['headcount'] * 20, '</td></tr>';
            } else {
                echo '<td colspan="5"> ', $NOC['headcount'] * 150, '</td></tr>';
            }


            echo '<br><tr><td colspan="7"><strong>15% vat:</td>';
            if ($NOC['sub_of_noc'] === 'NON-CITES') {
                echo '<td colspan="5"> ', 20 * $NOC['headcount'] * 0.15, '</td></tr>';
            } else {
                echo '<td colspan="5"> ', 150 * $NOC['headcount'] * 0.15, '</td></tr>';
            }


            echo '<br><tr><td colspan="7"><strong>Total amount including 15% vat:</td>';
            if ($NOC['sub_of_noc'] === 'NON-CITES') {
                echo '<td colspan="5"> ', (20 * $NOC['headcount']) + (20 * $NOC['headcount'] * 0.15), '</td></tr>';
            } else {
                echo '<td colspan="5"> ', (150 * $NOC['headcount']) + (150 * $NOC['headcount'] * 0.15), '</td></tr>';
            }

            echo '<br><tr><td colspan="7"><strong>Total fee paid by applicant :</td>';
            if ($NOC['sub_of_noc'] === 'NON-CITES') {
                echo '<td colspan="5"> ', (20 * $NOC['headcount']) + (20 * $NOC['headcount'] * 0.15), '</td></tr>';
            } else {
                echo '<td colspan="5"> ', (150 * $NOC['headcount']) + (150 * $NOC['headcount'] * 0.15), '</td></tr>';
            }
            echo '</tbody></table>';
            ?><br>
            <?php  
            file_show($NOC,$aplicant);
            ?><br>
           
            <?php
              echo show_next_status_button($NOC);
            ?>
        </div>
    </div>
    <?php pg_footer(); ?>
	