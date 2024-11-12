<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function view_species_table($NOC, $species_on_this_noc, $edit = false){
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
        if($edit){
            echo '<button class="btn edit-quantity" id="btn" data-id="', $one_s['id'], '', $one_s['noc_id'], '"><i class="fas fa-edit"></i> </button>';
        }
      echo '</td>
      <td><span class="db_price">', $one_s['price_bdt'], '</span>  
            <div  id="priceEdit" class="priceEdit" style="display:none">
                <input type="number" class="form-control col-lg-12 price_bdt" name="price_bdt"/><br>
                <button data-id="', $one_s['id'], '"  class="btn btn-info change_price_bdt"   >Submit </button>
            <br></div>';
        if($edit){  
            echo '<button class="btn edit-price_bdt" id="btn" data-id="', $one_s['id'], '', $one_s['noc_id'], '"><i class="fas fa-edit"></i> </button>';
        }
      echo '</td>
      <td>', $one_s['price_bdt'] *  $one_s['quantity'], '</td>
      <td>', $one_s['price_usd'], '</td>
      <td>', $one_s['price_usd'] *  $one_s['quantity'], '</td>';
       if($edit){
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
      if($edit){
        echo '<td></td>';
      }
    echo '</tr>
</table>';
}


function file_show($NOC, $animal){

if ($NOC['licence_copy'] != Null) {
    displayFile($NOC['licence_copy'], 'Company licence certificate');
} 

 if ($NOC['health_certificate_img'] != Null) {
    displayFile($NOC['health_certificate_img'], 'Health certificate');
}
if ($NOC['wild_breeding_facilities'] != Null) {
    displayFile($NOC['wild_breeding_facilities'], 'Legal wild breeding facilities Copy');
}
if ($NOC['wild_breeding_permit'] != Null) {
    displayFile($NOC['wild_breeding_permit'], 'Exporter wild breeding permit Copy');
}
if ($NOC['captive_breeding_facilities'] != Null) {
    displayFile($NOC['captive_breeding_facilities'], 'Legal captive breeding facilities Copy');
}
if ($NOC['capting_breeding_permit'] != Null) {
    displayFile($NOC['capting_breeding_permit'], 'Exporter captive breeding permit Copy');
}


if ($NOC['invoice'] != Null) {
    displayFile($NOC['invoice'], 'Invoice Copy');
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




function generateUniqueToken() {
    return bin2hex(random_bytes(16));
}