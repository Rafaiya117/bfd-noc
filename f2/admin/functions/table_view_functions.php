<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function display_animal_table($species_on_this_noc, $NOC, $edit = false, $show_challan = true) {
    if($edit){
        add_js(['assets/js/admin_cities_check.js']);
    }
    add_js(['assets/js/tk_calulation.js']);
    echo '<table class="table table-striped table-hover card-body animal">';
    echo '<thead>
            <tr>
                <th>Serial No.</th>
                <th>English Name</th>
                <th>Scientific Name</th>
                <th>CITES Appendix Status <hr> Source Code</th>
                <th>IUCN</th>
                <th>Schedule</th>
                <th>Quantity</th>
                <th>Unit Price </th>
                <th>Total Price</th>
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
        echo '<td class="btntd">';
        
        if ($edit) {
            echo '<button class="btn btn-primary btn-small check_cites tb_btm_btn" data-scientific_name="',$animal['species_scientific_name'],'" >CITES</button> <hr>';

        }
        echo  $animal['CITES'];
        echo '<hr> ', source_code($animal['source']), ' - ' ,strtoupper($animal['source']);
        echo '</td>';
        
        echo '<td class="btntd">'; 
        if ($edit) {
            echo '<a class="btn btn-danger tb_btm_btn" style="color:white;" target="_blank"  href="https://www.iucnredlist.org/search?searchType=species&query=',$animal['species_scientific_name'],'"> IUCN </a><hr>'; 
        }
        // 
        echo $animal['IUCN'];
        echo '</td>';
        echo '<td>', $animal['schedule'], '</td>';
        echo '<td>';
        if($edit && $animal['vendor_quantity'] !== $animal['quantity']){
            echo '<strike class="vendor_quantity"> &nbsp;', $animal['vendor_quantity'], '&nbsp; </strike><br>';
        }
        echo '<span class="db_quantity">', $animal['quantity'], '</span>';
        
        if ($edit) {
            echo '<div id="quantityEdit" class="quantityEdit" style="display:none">
                    <input type="number" class="form-control col-lg-12 quantity" name="quantity"/>
                    <br>
                    <button data-id="', $animal['id'], '" data-noc_id="', $animal['noc_id'], '"  class="btn btn-info change_quantity">Submit</button>
                    <br>
                  </div>';
            echo '<button class="btn edit-quantity" data-id="', $animal['id'], '"><i class="fas fa-edit"></i></button>';
        }
        
        echo '</td>';
        
        echo '<td class="tk">', $animal['price_bdt'], '</td>';
        echo '<td class="tk">', $animal['price_bdt'] * $animal['quantity'], '</td>';    
        echo '<td>';
        echo $animal['ring_number'], '<br>';
        if (!empty($animal['species_images'])) {
            echo '<a href="',IMG_URL,'/', $animal['species_images'] ,'" ><img src="' ,IMG_URL,'/', $animal['species_images'] , '"/></a>';
        } else {
            echo '<small style="color:#cacaca">No Image Found</small>';
        }
        echo '</td>';
        echo '</tr>';

        // Calculate total prices
        $total_bdt += $animal['price_bdt'] * $animal['quantity'];
    }

    // Add total head count row
    echo '<tr>';
    echo '<td colspan="6"><strong>Total Head Count:</strong></td>';
    echo '<td>', $NOC['headcount'], '</td>';
    echo '<td colspan="4"></td>';
    echo '</tr>';

    if($show_challan){
   
        $vat_rate = ($NOC['noc_type'] === 'NON-CITES' )? BFD_FEE_VAT_NON_CITES : BFD_FEE_VAT_CITES;
        $total_fee = $NOC['headcount'] * BFD_FEE_PER_HEADCOUNT_BDT;
        $total_with_vat = $NOC['headcount'] * BFD_FEE_PER_HEADCOUNT_BDT *  (1 + $vat_rate);

    // echo '<tr><td colspan="8"><strong>Total Headcount:</strong></td>';
    // echo '<td>', $NOC['headcount'], '</td>';
    // echo '<td colspan="2"></td></tr>';
        
        echo '<tr><td colspan="10"></td></tr>';
        echo '<tr><td colspan="8"><strong>Amount (BDT)</strong></td>';
        echo '<td colspan="3" style="text-align: right;" class="tk" >', $total_fee , '</td></tr>';

        echo '<tr><td colspan="8"><strong>VAT ', $vat_rate * 100 ,'% </strong></td>';
        echo '<td colspan="3" style="text-align: right;" class="tk">', $total_fee * $vat_rate , '</td></tr>';

        echo '<tr><td colspan="8"><strong>Amount with VAT</strong></td>';
        echo '<td colspan="3" style="text-align: right;" class="tk" >', $total_with_vat, '</td></tr>';
    }

    echo '</tbody></table>';
}
function view_approved_animal_list($species_on_this_noc, $NOC) {
    display_animal_table($species_on_this_noc, $NOC, false, true);
}

function admin_content_table($NOC, $species_on_this_noc) {
    display_animal_table($species_on_this_noc, $NOC, true);
}

function view_species_table_v2($NOC, $species_on_this_noc, $edit = true) {
    display_animal_table($species_on_this_noc, $NOC, $edit);
}