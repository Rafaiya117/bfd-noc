<?php
function view_species_table($NOC, $species_on_this_noc, $edit = false){
    if (sizeof($species_on_this_noc) === 0) {
        return;
    }
    echo '
    
    <table class="table table-striped table-hover card-body">
    
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
        <th>Total Price in USD</th>';
        if($edit){echo '<th></th>';}
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
        //  <a class="btn btn-primary" style="color:white;" target="_blank"  href="https://en.wikipedia.org/wiki/Special:Search?go=Go&ns0=1&search=', $one_s['species_scientific_name'], '" > Wikipedia </a>';
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
        if($edit){
            echo '<button class="btn edit-quantity" id="btn" data-id="', $one_s['id'], '', $one_s['noc_id'], '"><i class="fas fa-edit"></i> </button>';
        }
      echo '</td>


     
      <td><span class="db_price">', $one_s['price_bdt'], '</span> 
                  
                  <div  id="priceEdit" class="priceEdit" style="display:none">
                      <input type="number" class="form-control col-lg-12 price_bdt" name="price_bdt"/><br>
                      <button data-id="', $one_s['id'], '"  class="btn btn-info change_price_bdt"   >Submit </button>
                  <br>
                  
                  </div>';
            if($edit){
          
            echo '<button class="btn edit-price_bdt" id="btn" data-id="', $one_s['id'], '', $one_s['noc_id'], '"><i class="fas fa-edit"></i> </button>';
        }
      echo '</td>
      <td>', $one_s['price_bdt'] *  $one_s['quantity'], '</td>
      <td>', $one_s['price_usd'], '</td>
      <td>', $one_s['price_usd'] *  $one_s['quantity'], '</td>
      
      ';
        if($edit){
            echo '<td><a href="delete_spices.php?id=', $one_s['id'], '"&noc_id=', $one_s['noc_id'], ' class="btn" onclick="return confirm(\'Are you sure you want to delete this?\')" >
              <i class="fas fa-close"></i></a>
            </td>';
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
      if($edit){
        echo '<td></td>';
      }
    echo '</tr>
</table>';
}






function show_noc_list($rows, $item_link = './full_details.php?id='){
    
    if(sizeof($rows) == 0){
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

            $goto_link = ' <a href="'.$item_link. $noc['id']. '"> ';
            echo '<tr>';
        
            echo'<td>
           ', $goto_link , $noc['id'], '</a></td>';
        
        if(empty($noc['memo_id'])) {
                echo'<td>', $goto_link ,'N/A</a></td>';
            } else {
                echo'<td >', $goto_link , $noc['memo_id'], '</a></td>';
            }
            
            echo'
            
            
            <td>', $goto_link ,date('d/m/Y', strtotime($noc['application_date'])), '</a></td>';
            if(empty($noc['company_name'] || $noc['applicant_name'] )) {
                echo'<td>', $goto_link ,'-</a></td>';
            } 
            elseif(!empty($noc['company_name'])) {
                
                    echo'<td>', $goto_link ,'Company name: ', $noc['company_name'], '</a><br>';
                    echo'', $goto_link ,'', $noc['applicant_name'], '</a></td>';


                }
                else{
                echo'<td>', $goto_link ,' ', $noc['applicant_name'], '</a></td>';
            
            }

            
            if(empty($noc['approved_date'])) {
                echo'<td>', $goto_link ,'N/A </a></td>';
            } else {
                echo'<td>', $goto_link , date('d/m/Y', strtotime($noc['approved_date'])), '</a></td>';
            }
            if($noc['exporting_country_name'] == NULL){
                echo'<td>', $goto_link ,'N/A</a></td>';

            }
            else{
                echo'<td>', $goto_link , $noc['exporting_country_name'], '</a></td>';

            }
            
            echo'<td>', $goto_link , $noc['headcount'], '</a></td>';
            

            $noc_status_str = [
                '100_draft' => 'Draft Application',
                '200_vendor_submitted' => 'Application Submitted by Applicant' ,
                
                '250_deskofficer_verification_incomplete'=>'Application Incomplete',
            
                //'300_initial_document_verification' => 'In Progress NOC Application (Initial Document validation)' ,
                '400_deskofficer_verification' => 'In Progress NOC Application (Deskofficer Verification)',
            
                '500_DCF_verification' => 'In Progress NOC Application (DCF Verification)' ,
                '600_CF_verification' => 'In Progress NOC Application (CF Verification)' ,
            
                '700_CCF_verification' => 'In Progress NOC Application (CCF Verification)' ,
            
                '800_waiting_for_vendor_payment' => 'Waiting for applicant payment' ,
                // payment_check
                '850_payment_check' => 'In Progress NOC Application (Payment Verification)',
                '900_payment_confirmed' => 'In Progress NOC Application (NOC approve and final sign)',
                '950_waiting _to_add_conditions'=>'Final signature done waiting for last activity',
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

            echo '<td>', $goto_link , $noc_status_str[$noc['status']], '</a></td>';

           
            
            echo'</tr>';
        }
        
    echo '</tbody>		
        </table>';
}


function file_show($NOC, $animal){

if ($NOC['licence_copy'] != Null) {
    displayFile($NOC['licence_copy'], 'Company licence certificate');
} 

 if ($NOC['health_certificate_img'] != Null) {
    displayFile($NOC['health_certificate_img'], 'Health certificate');
}

if ($animal['captive1'] != Null) {
    displayFile($animal['captive1'], 'Legal captive breeding facilities Copy');
}
if ($animal['captive2'] != Null) {
    displayFile($animal['captive2'], 'Exporter captive breeding permit Copy');
}
if ($animal['wild1'] != Null) {
    displayFile($animal['wild1'], 'Legal wild breeding facilities Copy');
}
if ($animal['wild2'] != Null) {
    displayFile($animal['wild2'], 'Exporter wild breeding permit Copy');
}
if ($animal['invoice'] != Null) {
    displayFile($animal['invoice'], 'Invoice Copy');
}
if ($animal['cites_permit'] != Null) {
    $filePaths = $animal['cites_permit'];
    if (!empty($filePaths)) {
        $filePathsArray = explode(',', $filePaths);
        foreach ($filePathsArray as $filePath) {
            displayFile($filePath, 'CITES permit Copy');
        }
    }
}
}