<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function view_species_table_v2($NOC, $species_on_this_noc, $edit=false){
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
        
        echo '<tr><th class="inner-th"> CITES </th><td class="inner-td"> ',$one_s['CITES'],' </td></tr>';
        echo '<tr><th class="inner-th"> IUCN </th><td class="inner-td"> ',$one_s['IUCN'],' </td></tr>';
        echo '<tr><th class="inner-th"> Wildlife Act Schedule# </th><td class="inner-td"> ',$one_s['schedule'],' </td></tr>';
        echo '<tr><th class="inner-th"> Source </th><td class="inner-td"> ',$one_s['source'],' </td></tr>';
        
        echo '</table>';
        echo '</td>';
        // Quantity
        echo '<td><span class="db_quantity">', $one_s['quantity'], '</span> 
            <div  id="quantityEdit" class="quantityEdit" style="display:none">
                <input type="number" class="form-control col-lg-12 quantity" name="quantity"/><br>
                <button data-id="', $one_s['id'], '"  class="btn btn-info change_quantity">Submit </button><br>
            </div>';
        // if($edit){
        //     echo '<button class="btn edit-quantity" id="btn" data-id="', $one_s['id'], '', $one_s['noc_id'], '"><i class="fas fa-edit"></i> </button>';
        // }
        // else{
        //     echo '<td></td>';
        // } 
      echo '</td>';

      // Price
      echo '<td class="td-wp-table">'; 
        echo '<table class="inner-table">';
        echo '<tr><th>Currency</th><th>Unit</th><th>Total</th></tr>';
        echo '<tr><td> BDT </td><td> ',$one_s['price_bdt'],' </td><td> ',$one_s['price_bdt']*  $one_s['quantity'],' </td></tr>';
        echo '</table>';
        echo '</td>';

        // Ring Number & Species Image
        echo '<td>',$one_s['ring_number'], '<br>';
            if ($one_s['species_images'] != '') {
            echo '<img src="', IMG_URL,$one_s['species_images'], '"/>';
        } else {
        echo '<small style="color:#cacaca">No Image Found</small>';
        }
        echo '</td>';

      //<img src="',$one_s['species_images'],'"/>
       if($edit){
            echo '<td><a href="delete_spices.php?id=', $one_s['id'], '"&noc_id=', $one_s['noc_id'], ' class="btn" onclick="return confirm(\'Are you sure you want to delete this?\')" >
              <i class="fas fa-close"></i></a></td>';
        } 
        else{
            echo '<td></td>';
        }  
            echo '</tr>';
      }

      echo '<tr>
      <td colspan="3"></td>
      <td colspan="1">Total Head</td>
      <td >', $NOC['headcount'], '</td>';
      echo '<td class="td-wp-table">'; 
      echo '<table class="inner-table">';
    //   echo '<tr><th>Currency</th><th></th><th>Total Price</th></tr>';
    //   echo '<tr><td> BDT </td><td>  </td><td> ',$NOC['total_price_bdt'],' </td></tr>';
      echo '</table>';
      echo '</td>';
      echo '<td></td>';
    echo '</tr>
</table>';
}

// 
function mdl_st($id, $modal_title = ''){
    
    echo '

<div id=',$id,' class="modal  fade " tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        '; 
        
}
function mdl_ed()
{
      echo '


         </div>
       </div>
     </div>
   ';
}

function mdl_bnta($id){
    echo ' data-toggle="modal" data-target="#',$id,'" ';
}


// .img-thumbnail{padding:.25rem;background-color:#fff;border:1px solid #dee2e6;border-radius:.25rem;max-width:100%;height:auto}

function file_show($NOC, $aplicant){

    if ($aplicant['licence_copy'] != Null) {
        displayFile($aplicant['licence_copy'], 'Company licence certificate');
    } 

    if ($NOC['health_certificate_img'] != Null) {
        displayFile($NOC['health_certificate_img'], 'Health certificate');
    }
    if ($NOC['wild_breeding_facilities'] != Null) {
        displayFile($NOC['wild_breeding_facilities'], 'Legal wild breeding facilities Copy');
    }
    if ($NOC['permit'] != Null) {
        displayFile($NOC['permit'], 'CITES permit Copy');
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
    if ($NOC['chalan_copy'] != Null) {
        displayFile($NOC['chalan_copy'], 'Chalan Copy');
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




