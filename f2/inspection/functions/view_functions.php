<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function view_species_table_v2($NOC, $species_on_this_noc, $edit = false)
{
    if (sizeof($species_on_this_noc) === 0) {
        return;
    }
    echo '<table class="table table-striped table-hover card-body">
    <thead>
      <tr>
        <th>#</th>
        <th>General Name</th>
        <th>Scientific Name</th>
        <th>Appendix</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Ring Number & Species Image</th>';

    if ($edit) {
        echo '<th></th>';
    }
    echo '</tr>
    </thead>
<tbody>';

    for ($i = 0, $ilen = sizeof($species_on_this_noc); $i < $ilen; $i += 1) {
        $one_s = $species_on_this_noc[$i];

        echo '<tr>
            <td>', $i + 1, '</td>
            <td>', $one_s['species_english_name'], '<br></td>
            <td> <i style="font-size:16px!important;">', $one_s['species_scientific_name'], '</i><br></td>';

        // Appendix
        echo '<td class="td-wp-table">';
        echo '<table class="inner-table">';

        echo '<tr><th class="inner-th"> CITES </th><td class="inner-td"> ', $one_s['CITES'], ' </td></tr>';
        echo '<tr><th class="inner-th"> IUCN </th><td class="inner-td"> ', $one_s['IUCN'], ' </td></tr>';
        echo '<tr><th class="inner-th"> Wildlife Act Schedule# </th><td class="inner-td"> ', $one_s['schedule'], ' </td></tr>';

        echo '</table>';
        echo '</td>';

        // Quantity

        echo '
            <td><span class="db_quantity">', $one_s['quantity'], '</span> 
                <div  id="quantityEdit" class="quantityEdit" style="display:none">
                    <input type="number" class="form-control col-lg-12 quantity" name="quantity"/><br>
                    <button data-id="', $one_s['id'], '"  class="btn btn-info change_quantity"   >Submit </button>
                <br>
            </div>';
        echo '</td>';

        // Price
        echo '<td class="td-wp-table">';
        echo '<table class="inner-table">';
        echo '<tr><th>Currency</th><th>Unit</th><th>Total</th></tr>';
        echo '<tr><td> BDT </td><td> ', $one_s['price_bdt'], ' </td><td> ', $one_s['price_bdt'] *  $one_s['quantity'], ' </td></tr>';
        echo '<tr><td> USD </td><td> ', $one_s['price_usd'], ' </td><td> ', $one_s['price_usd'] *  $one_s['quantity'], ' </td></tr>';


        echo '</table>';
        echo '</td>';

        // Ring Number & Species Image
        echo '<td>', $one_s['ring_number'], '<br>', $one_s['coloration'], '<br>';
        if (!empty($one_s['species_images'])) {
            echo '<img src="', IMG_URL,$one_s['species_images'], '"/>';
            
        } else {
            echo '<small style="color:#cacaca">No Image Found</small>';
        }
        echo '</td>';
        if ($edit) {
            echo '<td><a href="delete_spices.php?id=', $one_s['id'], '"&noc_id=', $one_s['noc_id'], ' class="btn" onclick="return confirm(\'Are you sure you want to delete this?\')" >
            <i class="fas fa-close"></i></a></td>';
        }
        echo '</tr>';
    }

    echo '<tr>
      <td colspan="3"></td>
      <td colspan="1">Total Head</td>
      <td>', $NOC['headcount'], '</td>';

    echo '<td class="td-wp-table">';
    echo '<table class="inner-table">';
    echo '<tr><th>Currency</th><th></th><th>Total Price</th></tr>';
    echo '<tr><td> BDT </td><td>  </td><td> ', $NOC['total_price_bdt'], ' </td></tr>';
    echo '<tr><td> USD </td><td>  </td><td> ', $NOC['total_price_usd'], ' </td></tr>';

    echo '</table>';
    echo '</td>';

    echo '<td></td>';

    if ($edit) {
        echo '<td></td>';
    }
    echo '</tr>
</table>';
}

function view_species_table($NOC, $species_on_this_noc, $edit = false)
{
    if (sizeof($species_on_this_noc) === 0) {
        return;
    }

    echo '<table class="table table-striped table-hover card-body">
    <thead>
      <tr>
        <th>#</th>
        <th>Scientific Name</th>
        <th>General Name</th>
        <th>CITES Appendix Status</th>
        <th>IUCN Status</th>
        <th>Wildlife Act Schedule#</th>
        <th>Quantity</th>
        <th>Unit Price in BDT</th>
        <th>Total Price in BDT</th>
        <th>Unit Price in USD</th>
        <th>Total Price in USD</th>
        <th>Ring Number</th>
        <th>Species Image</th>';
    if ($edit) {
        echo '<th></th>';
    }
    echo '</tr>
    </thead>
    <tbody>';

    for ($i = 0, $ilen = sizeof($species_on_this_noc); $i < $ilen; $i += 1) {
        $one_s = $species_on_this_noc[$i];

        echo '<tr>
            <td>', $i + 1, '</td>
            <td> <i style="font-size:16px!important;">', $one_s['species_scientific_name'], '</i><br></td>
            <td>', $one_s['species_english_name'], '<br></td>';
        echo '<td>', $one_s['CITES'], ' <br/> <span  style="color:red;font-size:.75em;">', $one_s['system_note'], ' </span>';
        if ($one_s['species_id'] === 0) {
            //   echo '<a class="btn main-btn" target="_blank"  href="http://www.google.com/search?q=', $one_s['species_scientific_name'], '"> Google </a> 
            //   <a class="btn btn-primary" style="color:white;" target="_blank"  href="https://en.wikipedia.org/wiki/Special:Search?go=Go&ns0=1&search=', $one_s['species_scientific_name'], '" > Wikipedia </a>';
        }

        echo '</td>
            <td>', $one_s['IUCN'], '<br/><span style="color:red;font-size:.75em;"></span> </td>
            <td>', $one_s['schedule'], '<br/><span style="color:red;font-size:.75em;"></span> </td>
            <td><span class="db_quantity">', $one_s['quantity'], '</span> 
                <div  id="quantityEdit" class="quantityEdit" style="display:none">
                    <input type="number" class="form-control col-lg-12 quantity" name="quantity"/><br>
                    <button data-id="', $one_s['id'], '"  class="btn btn-info change_quantity"   >Submit </button>
                <br>
            </div>';
        if ($edit) {
            echo '<button class="btn edit-quantity" id="btn" data-id="', $one_s['id'], '', $one_s['noc_id'], '"><i class="fas fa-edit"></i> </button>';
        }
        echo '</td>
      <td><span class="db_price">', $one_s['price_bdt'], '</span>  
            <div  id="priceEdit" class="priceEdit" style="display:none">
                <input type="number" class="form-control col-lg-12 price_bdt" name="price_bdt"/><br>
                <button data-id="', $one_s['id'], '"  class="btn btn-info change_price_bdt"   >Submit </button>
            <br></div>';
        if ($edit) {
            echo '<button class="btn edit-price_bdt" id="btn" data-id="', $one_s['id'], '', $one_s['noc_id'], '"><i class="fas fa-edit"></i> </button>';
        }
        echo '</td>
      <td>', $one_s['price_bdt'] *  $one_s['quantity'], '</td>
      <td>', $one_s['price_usd'], '</td>
      <td>', $one_s['price_usd'] *  $one_s['quantity'], '</td>
      <td>', $one_s['ring_number'], '</td>
      <td>';
        if (!empty($one_s['species_imags'])) {
            echo '<img src="' . $one_s['species_images'] . '"/>';
        }
        echo '</td>';
        //<img src="',$one_s['species_images'],'"/>
        if ($edit) {
            echo '<td><a href="delete_spices.php?id=', $one_s['id'], '"&noc_id=', $one_s['noc_id'], ' class="btn" onclick="return confirm(\'Are you sure you want to delete this?\')" >
              <i class="fas fa-close"></i></a></td>';
        }
        echo '</tr>';
    }

    echo '<tr>
      <td colspan="4"></td>
      <td colspan="2">Total Head</td>
      <td >', $NOC['headcount'], '</td>
      <td></td>
      <td>', $NOC['total_price_bdt'], '</td>
      <td>  </td>
      <td> ', $NOC['total_price_usd'], '  </td>';
    if ($edit) {
        echo '<td></td>';
    }
    echo '</tr>
</table>';
}


function file_show($NOC, $aplicant)
{

    if ($aplicant['licence_copy'] != Null) {
        displayFile($aplicant['licence_copy'], 'Company licence certificate');
    }

    if ($NOC['health_certificate_img'] != Null) {
        displayFile($NOC['health_certificate_img'], 'Health certificate');
    }
    // if ($NOC['wild_breeding_facilities'] != Null) {
    //     displayFile($NOC['wild_breeding_facilities'], 'Legal wild breeding facilities Copy');
    // }
    if ($NOC['permit'] != Null) {
        displayFile($NOC['permit'], 'Exporter permit Copy');
    }
    // if ($NOC['captive_breeding_facilities'] != Null) {
    //     displayFile($NOC['captive_breeding_facilities'], 'Legal captive breeding facilities Copy');
    // }
    // if ($NOC['capting_breeding_permit'] != Null) {
    //     displayFile($NOC['capting_breeding_permit'], 'Exporter captive breeding permit Copy');
    // }


    if ($NOC['invoice'] != Null) {
        displayFile($NOC['invoice'], 'Invoice Copy');
    }
    if ($NOC['cites_permit'] != Null) {
        $filePaths = $NOC['cites_permit'];
        if (!empty($filePaths)) {
            $filePathsArray = explode(',', $filePaths);
            foreach ($filePathsArray as $filePath) {
                displayFile($filePath, 'CITES permit Copy');
            }
        }
    }
}

function show_noc_list($rows, $item_link = './full_details.php?id=')
{

    if (sizeof($rows) == 0) {
        echo '<div class="alert alert-warning" role="alert">
                No NOC is available in this category.
            </div>';
        return;
    }

    echo '
    <table class="table  table-striped table-hover" style="font-size: .9em;">
    <thead>
        <tr>
            <th scope="col"style="text-align: center;">Application ID No.</th>
            <th style="text-align: center;">Memo No.</th>
            <th style="text-align: center;">Application Date</th>
            <th style="text-align: center;">Importer Detail<br>(Company/Individual)</th>
            <th style="text-align: center;" >Approval Date</th>
            <th style="text-align: center;">Source/Exporting Country</th>
            <th style="text-align: center;">Total Head</th>
            
            <th>Status</th>
        </tr>
    </thead>

    <tbody>';

    for ($i = 0, $ilen = sizeof($rows); $i < $ilen; $i += 1) {
        $noc = $rows[$i];

        $goto_link = ' <a href="' . $item_link . $noc['id'] . '"> ';
        echo '<tr>';

        echo '<td>
           ', $goto_link, $noc['id'], '</a></td>';

        if (empty($noc['memo_id'])) {
            echo '<td>', $goto_link, '</a></td>';
        } else {
            echo '<td >', $goto_link, $noc['memo_id'], '</a></td>';
        }

        echo '
            
            
            <td>', $goto_link, date('d/m/Y', strtotime($noc['application_date'])), '</a></td>';
        if (empty(@$noc['company_name'] || $noc['applicant_name'])) {
            echo '<td>', $goto_link, 'N/A</a></td>';
        } elseif (!empty(@$noc['company_name'])) {

            echo '<td><small>Company name</small><br> ', $goto_link, $noc['company_name'], '</a><br>';
            echo '', $goto_link, $noc['applicant_name'], '</a></td>';
        } else {
            echo '<td>', $goto_link, $noc['applicant_name'], '</a></td>';
        }


        if (empty($noc['approved_date'])) {
            echo '<td>', $goto_link, 'N/A </a></td>';
        } else {
            echo '<td>', $goto_link, date('d/m/Y', strtotime($noc['approved_date'])), '</a></td>';
        }
        if ($noc['exporting_country_name'] == NULL) {
            echo '<td>', $goto_link, 'N/A</a></td>';
        } else {
            echo '<td>', $goto_link, $noc['exporting_country_name'], '</a></td>';
        }

        echo '<td>', $goto_link, $noc['headcount'], '</a></td>';


        $noc_status_str = [
            '100_draft' => 'Draft Application',
            '200_vendor_submitted' => 'Application Submitted by Applicant ' ,
            
            '250_deskofficer_verification_incomplete'=>'Application Incomplete',
        
            //'300_initial_document_verification' => 'In Progress NOC Application (Initial Document validation)' ,
            '400_deskofficer_verification' => 'In Progress NOC Application (Desk Officer Verification)',
        
            '500_DCF_verification' => 'In Progress NOC Application (DCF Verification)' ,
            '600_CF_verification' => 'In Progress NOC Application (CF Verification)' ,
        
            '700_CCF_verification' => 'In Progress NOC Application (CCF Verification)' ,
        
            '800_waiting_for_vendor_payment' => 'Waiting for applicant payment' ,
            // payment_check
            '850_payment_check' => 'In Progress NOC Application (Payment Verification)',
            '900_payment_confirmed' => 'In Progress NOC Application (NOC approve and final sign)',
            '950_waiting_for_printing'=>'Final signature done waiting for last activity',
            // Possible onemore level CCF check... 
            '1000_signed_document' => 'Download Signed NOC',
            '1050_inspection_document'=>'Used NOC',
            
            '99_rejected' => 'REJECTED',
            
        ];

        // $status_to_headx =[
        //     'draft' => 'List of Draft NOC',
        //     'waiting' => 'List of Waiting NOC',
        //     'waiting for payment' => 'List of Waiting for Payment NOC',
        //     'for payment' => 'List of Waiting for Payment NOC',
        //     'for sign' => 'List of Waiting for Conservator of Forests Sign NOC',
        //     'waiting for sign' => 'List of Waiting for Conservator of Forests Sign NOC',
        //     'waiting for approval' => 'List of Waiting for Conservator of Forests Sign NOC',
        //     'payment_check' => 'Payment Done NOCs',
        //     'approved' => 'List of Approved NOC',
        //     'rejected' => 'List of Rejected NOC',
        //     'waiting for approval2' => 'List of Waiting for Deputy Ranger Sign NOC',
        //     'waiting for approval3' => 'List of Waiting for Conservator of Forests Sign NOC',


        // ];

        echo '<td>', $goto_link, $noc_status_str[$noc['status']], '</a></td>';
        echo '</tr>';
    }

    echo '</tbody>		
</table>';
}

function admin_content_table($NOC, $species_on_this_noc)
{
    echo '<div style="background-color: #f1eeee;
        margin-top: 30px;
        padding-top: 30px;
        padding-bottom: 20px;
        padding-left: 20px;"><h4><b>';

    if ($NOC['sub_of_noc'] === 'NON-CITES') {
        echo 'Applicant have to pay 20 Taka per head (15% vat will be added automatically)</b></h4>';
    } else {
        echo 'Applicant have to pay 150 Taka per head (15% vat will be added automatically)</b></h4>';
    }

    echo '</div><br>';

    echo '<table class="table table-striped table-hover card-body">
        <h4><b>Requested Animal List by Vendor:</b></h4>
        <thead>
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
        </thead>
    <tbody>';

    $k = 1;
    foreach ($species_on_this_noc as $row) {
        echo '<tr>';
        echo '
            <td>', $k, '</td>
            <td>', $row['species_english_name'], '</td>
            <td><i style="font-size:16px!important;">', $row['species_scientific_name'], '</i></td>
            <td>', $row['CITES'], '<p></td>
            <td>', $row['IUCN'], '</td>
            <td>', $row['schedule'], '</td>
            <td>', $row['quantity'], '</td>
            <td>', $row['price_bdt'], '</td>
            <td>', $row['price_bdt'] *  $row['quantity'], '</td>
            <td>', $row['price_usd'], '</td>
            <td>', $row['price_usd'] *  $row['quantity'], '</td>';
        echo '</tr>';
        $k++;
    }

    echo '</tbody></table>';
    echo '<h4><b>Approved Animal List:</b></h4>';

    $last_status = '';
    $j = 1;
    foreach ($species_on_this_noc as $animal) {
        if ($animal['status'] !== $last_status) {
            $last_status = $animal['status'];
            if ($j != 1) {
                echo '</tbody></table>';
            }
            $j = 1;

            echo '<table class="table table-striped table-hover card-body">';
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
                        <th>Others</th>
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
                <td><span class="db_quantity">', $animal['quantity'], '</span> 

            <div id="quantityEdit" class="quantityEdit" style="display:none">
                <input type="number" class="form-control col-lg-12 quantity" name="quantity"/><br>
                <button data-id="', $animal['id'], '"  class="btn btn-info change_quantity">Submit </button><br>
            </div>
           
            </td>
            <td>', $animal['price_bdt'], '</td>
            <td>', $animal['price_bdt'] *  $animal['quantity'], '</td>
            <td>', $animal['price_usd'], '</td>
            <td>', $animal['price_usd'] *  $animal['quantity'], '</td>
            <td>', 'Ring Number:&nbsp;', $animal['ring_number'], '<br>', 'Image:&nbsp;<img src="' . $animal['species_images'] . '"/>', 'Coloration:&nbsp;', $animal['coloration'], '</td>
            <td>';
        echo '</tr>';
        $j++;
    }

    echo '<tr><td colspan="8"><strong>Total amount:</td>';
    if ($NOC['sub_of_noc'] === 'NON-CITES') {
        echo '<td colspan="5"> ', $NOC['headcount'] * 20, '</td></tr>';
    } else {
        echo '<td colspan="5"> ', $NOC['headcount'] * 150, '</td></tr>';
    }

    echo '<br><tr><td colspan="8"><strong>15% vat:</td>';
    if ($NOC['sub_of_noc'] === 'NON-CITES') {
        echo '<td colspan="5"> ', 20 * $NOC['headcount'] * 0.15, '</td></tr>';
    } else {
        echo '<td colspan="5"> ', 150 * $NOC['headcount'] * 0.15, '</td></tr>';
    }

    echo '<br><tr><td colspan="8"><strong>Total amount including 15% vat:</td>';
    if ($NOC['sub_of_noc'] === 'NON-CITES') {
        echo '<td colspan="5"> ', (20 * $NOC['headcount']) + (20 * $NOC['headcount'] * 0.15), '</td></tr>';
    } else {
        echo '<td colspan="5"> ', (150 * $NOC['headcount']) + (150 * $NOC['headcount'] * 0.15), '</td></tr>';
    }

    echo '<br><tr><td colspan="8"><strong>Total fee paid by applicant :</td>';
    if ($NOC['sub_of_noc'] === 'NON-CITES') {
        echo '<td colspan="5"> ', (20 * $NOC['headcount']) + (20 * $NOC['headcount'] * 0.15), '</td></tr>';
    } else {
        echo '<td colspan="5"> ', (150 * $NOC['headcount']) + (150 * $NOC['headcount'] * 0.15), '</td></tr>';
    }
    echo '</tbody></table>';
}


//$condition_array =['The above mentioned cage birds will have to import through Hazrat Shahjalal International Airport,Dhaka.','Imported birdsmust be kept in cages, so that they could not come in contact with any other animals.'];
// <button class="btn edit-quantity" id="btn" data-id="', $animal['id'], '', $animal['noc_id'], '"><i class="fas fa-edit"></i> </button></td>

function view_approved_animal_list($species_on_this_noc, $NOC)
{
    echo '<h4><b>Approved Animal List:</b></h4>';
    echo '<table class="table table-striped table-hover card-body">';
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
                <th>Coloration</th>
                <th>Ring ID & Species Image</th>
            </tr>
        </thead>
        <tbody>';

    $total_bdt = 0;
    $total_usd = 0;

    foreach ($species_on_this_noc as $key => $animal) {
        echo '<tr>';
        echo '<td>', $key + 1, '</td>';
        echo '<td>', $animal['species_english_name'], '</td>';
        echo '<td><i style="font-size:16px!important;">', $animal['species_scientific_name'], '</i></td>';
        echo '<td>', $animal['CITES'], '</td>';
        echo '<td>', $animal['IUCN'], '</td>';
        echo '<td>', $animal['schedule'], '</td>';
        echo '<td>', $animal['quantity'], '</td>';
        echo '<td>', $animal['price_bdt'], '</td>';
        echo '<td>', $animal['price_bdt'] * $animal['quantity'], '</td>';
        echo '<td>', $animal['price_usd'], '</td>';
        echo '<td>', $animal['price_usd'] * $animal['quantity'], '</td>';
        echo '<td>', $animal['coloration'], '</td>';
        echo '<td>';
        if (!empty($animal['species_images'])) {
            echo  $animal['ring_number'];
            echo '<img src="' . $animal['species_images'] . '"/>';
        } else {
            echo  $animal['ring_number'];
            echo '<small style="color:#cacaca">No Image Found</small>';
        }
        echo '</td>';
        // echo '<td>', $animal['ring_number'], '</td>';
        echo '</tr>';

        // Calculate total prices
        $total_bdt += $animal['price_bdt'] * $animal['quantity'];
        $total_usd += $animal['price_usd'] * $animal['quantity'];
    }

    echo '<tr><td colspan="8"><strong>Total amount:</strong></td>';
    echo '<td colspan="3">', $total_bdt, '</td>';
    echo '<td colspan="3">', $total_usd, '</td>';
    echo '</tr>';

    // Assuming the VAT calculation is as per your example
    echo '<tr><td colspan="8"><strong>Total amount including 15% vat:</strong></td>';
    echo '<td colspan="3">', ($total_bdt + ($total_bdt * 0.15)), '</td>';
    echo '<td colspan="3">', ($total_usd + ($total_usd * 0.15)), '</td>';
    echo '</tr>';

    // Total fee paid by vendor (assuming it's the same as total amount including VAT)
    echo '<tr><td colspan="8"><strong>Total fee paid by applicant:</strong></td>';
    echo '<td colspan="3">', ($total_bdt + ($total_bdt * 0.15)), '</td>';
    echo '<td colspan="3">', ($total_usd + ($total_usd * 0.15)), '</td>';
    echo '</tr>';

    echo '</tbody></table><br><br>';
}
