<?php

// use FontLib\Table\Type\head;

$is_iucn_red_list_required = false;


  if(empty(@$_GET['noc-id'])){
    header('Location:home.php');
    exit();
  }


  $row = $db->select('SELECT * from noc_import where id = ? and user_id = ? limit 1', $_GET['noc-id'], auth()['id']);
  if(empty($row)){
    header('Location:home.php');
    exit();
  }
  $NOC = $row[0];
  $aplicant = auth();

  $noc_type = $NOC['noc_type'];
  if($noc_type === 'import'){
    $noun = "Exporting ";
    $verb = "Exporter";
  }
  else if($noc_type === 'export'){
    $noun = "Importing ";
    $verb = "Importer";
  }

  
  $error_message = '';
  if (!empty($_POST)) {

    if(empty($_POST['species_IUCN']) && $is_iucn_red_list_required){
      $error_message .= 'IUCN Redlist Status is required.<br>';
    }
    if(empty($_POST['species_IUCN'] && !$is_iucn_red_list_required)){
      $_POST['species_IUCN'] = 'Not Provided By Applicant';
    }
    
    // pre($_POST, 'lock');

    if (!empty($_POST['species_id'])) {
      $row = $db->select('SELECT * from species where id = ? ', $_POST['species_id']);
      $specie = $row[0];
    }
    if (empty($specie) || empty($_POST['id'])) {
      $specie = [
        'CITES' => 'Data Not Found',
        'IUCN' => 'Data Not Found',
        'schedule' => 'Data Not Found',
        'system_note' => 'Scientific Name does not match. Please check on Google / wikipedia',
        'id' => 0
      ];
    }
    
    $noc_id = (int)$_POST['noc_id'];
    
    
  
      if ($noc_type === 'CITES' && strpos(trim($_POST['cites_appendix']), 'CITES Appendix') === false) {
        $error_message .= 'You are trying to add a "CITES not listed species" to a CITES NOC.<br>';
    } else if ($noc_type === 'NON-CITES' && strpos(trim($_POST['cites_appendix']), 'CITES Appendix') !== false) {
        $error_message .= 'You are trying to add a "CITES listed species" to a NON-CITES NOC.<br>';
    }
    
    
    
    
      if(empty(@$_POST['source'])){
        $_POST['source'] = 'unknown';
      }
    
      if(empty(@$_POST['hidden_ring_numbers'])){
        $_POST['hidden_ring_numbers'] = '';
      }
  

  
  
  
  
  
  
  
    // $_SESSION['error'] = $error_message;
    
    if ($error_message === '') {
      
      $spc_image_url  = '';
      if(!empty($_FILES) && !empty(@$_FILES['species_images']) && !@$_FILES['species_images']['error'] && @$_FILES['species_images']['size'] > 0){
          $spc_image_url = handleFileUpload('species_images', 'images');
        }
      
     
  
      $id = $db->action(
        'INSERT into imp_noc_species_duplicate (noc_id, species_id, species_scientific_name, species_english_name, vendor_quantity, quantity, price_bdt, 
        price_usd, CITES, IUCN, schedule, system_note, source, ring_number, species_images, muted)
        values (?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        $noc_id,
        $specie['id'],
        $_POST['species_scientific_name'],
        $_POST['species_english_name'],
        $_POST['quantity'],
        $_POST['quantity'],
        $_POST['price_bdt'],
        $_POST['price_usd'],
        $_POST['cites_appendix'],
        $_POST['species_IUCN'],
        $specie['schedule'],
        $_POST['cites_annotation'],
        $_POST['source'],
        $_POST['hidden_ring_numbers'],
        $spc_image_url,
     
        $_POST['muted']
      );
      
  
      if($_POST['source'] === 'wild'){
        $db->action('UPDATE imp_noc_species_duplicate SET wild_exporter_breading_permit = ? where id = ?',
          //$_POST['wild_breading_country'],
          $_POST['wild_exporter_breading_permit'],
          $id);
      }else if($_POST['source'] === 'captive'){
        $db->action('UPDATE imp_noc_species_duplicate SET  captive_exporter_breading_permit = ? where id = ?',
         // $_POST['captive_breading_country'],
          $_POST['captive_exporter_breading_permit'],
          $id);
        }      
      
  
    $db->action('UPDATE noc_import SET
      headcount = (
        SELECT sum(quantity)
        FROM imp_noc_species_duplicate
        WHERE noc_id = noc_import.id
      ),
      total_price_bdt = (
        SELECT sum(price_bdt * quantity)
        FROM imp_noc_species_duplicate
        WHERE noc_id = noc_import.id
      ),
      total_price_usd = (
        SELECT sum(price_usd * quantity) 
        FROM imp_noc_species_duplicate
        WHERE noc_id = noc_import.id
      )
    WHERE noc_import.id = ?; ', $noc_id);
  
    
    }else{
      set_message($error_message, 'danger');
    }
    
    
    // pre($_POST);
    // pre($id, '---->. .>>>!!!');
  
    header('Location:add_species_on_nocs.php?noc-id=' . $noc_id);
    exit();
  }
  if (!empty(@$_GET['noc-id'])) {
      
  
      $aplicant_id = $NOC['user_id'];
      
    //  print_r($aplicant);
  
      $species_on_this_noc = $db->select('SELECT * from imp_noc_species_duplicate where noc_id = ? ', $_GET['noc-id']);
    } else {
      exit();
    }
    $get_all_spices = $db->select('SELECT id, scientific_name, english_name, schedule from species ');
  
 
  
  // 'assets/js/vendor/underscore-umd-min.js',
  
  

  add_js([ 'assets/js/pages/add_speceis_page.js', 'assets/js/cites_appendix.js', 'assets/js/full_details.js', 'assets/js/price.js']);      

  pg_header();
  echo '<script>
        let species_all = ', json_encode($get_all_spices), ';
        let this_noc = ', json_encode($NOC), ';
        let is_iucn_red_list_required = ', ($is_iucn_red_list_required)?'true':'false', ';

        </script>';
        
  show_banner('cites_non_cites');
  pg_topnavbar();
  breadcrumbs();
  
?>

<div class="container">
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
        generateTableContentimport($NOC, $aplicant); ?>
      </div>
      <?php
      if(!empty($species_on_this_noc)){
        echo '<h3>Species List  </h3>';
        view_species_table_v2($NOC, $species_on_this_noc, true);
    }
      ?>
      <form id="form_to_add_species" class="card-body" method="POST" enctype="multipart/form-data">
        <h4><b>Add Species (Verify Species with CITES)</b></h4>
        <div class="float-container">
          <div class="autocomplete">
            <div class="form-group ">
              <label for="species_scientific_name">Scientific name <small class="text-danger">*</small></label>
              <input id="species_scientific_name" type="text" name="species_scientific_name" value="<?php echo @$_POST['species_scientific_name'];?>" class="form-control col-lg-12" required />
            </div>
            <input id="species_id" type="hidden" name="species_id" class="form-control col-lg-12" value="<?php echo @$_POST['species_id'];?>" />
            <input id="noc_id" type="hidden" name="noc_id" class="form-control col-lg-12" value="<?php echo $NOC['id']; ?>" />
            <input id="cites_appendix" name="cites_appendix" type="hidden" value="<?php echo @$_POST['species_id'];?>" />
            <input id="cites_annotation" name="cites_annotation" type="hidden" value="<?php echo @$_POST['species_id'];?>" />
            <input id="cites_appendix_code" name="cites_appendix_code" type="hidden" value="<?php echo @$_POST['species_id'];?>" />
          </div>
          <a class="btn btn-primary" id="btn_check_cites" style="color:white"> Search CITES API </a>
          <div class="loader-cities d-none spinner-border" role="status">
            <span class="sr-only">Loading ...</span>
          </div>
        </div>
        <div>
          <table id="cites_data_table" class="d-none table table-striped table-hover table-sm ">
            <thead>
              <tr>
                <th>Scientific name</th>
                <th>General name</th>
                <th>CITES Appendix Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> <i id="cites_scintific_name"> </i><br></td>
                <td>
                  <span id="cites_spices_name"></span><br>
                </td>
                <td><span id="cites_appendix">Not listed </span><br> <span id="cites_annotation" style="color:red;font-size:.75em;"> </span></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="form-group" style="margin-top: 2.5rem;">
          <label for="species_IUCN">IUCN Redlist Status <?php 
          if($is_iucn_red_list_required){
            echo '<small class="text-danger">*</small>';
          }
          
          ?>
          </label>
          <div class="d-flex">
            <select class="form-control col-lg-8" id="species_IUCN" name="species_IUCN" data-value="<?php echo @$_POST['species_IUCN'];?>" required >
              <option value="" disabled selected>Choose option</option>
              <option value="LC">LC - Least Concern</option>
              <option value="NT">NT - Near Threatened</option>
              <option value="VU">VU - Vulnerable</option>
              <option value="EN">EN - Endangered</option>
              <option value="CR">CR - Critically Endangered</option>
              <option value="EW">EW - Extinct in the Wild</option>
              <option value="EX">EX - Extinct</option>
              <option value="DD">DD - Data Deficient</option>
            </select>
            <div class="col-lg-4 "><a id="search_IUCN" onclick="open_IUCN();"  href="#species_IUCN" class="btn btn-danger"> Search IUCN Redlist </a></div>

            <?php // <a class="btn btn-danger" style="color:white;" target="_blank" href="https://www.iucnredlist.org/search?searchType=species&amp;query=Naja bnx"> IUCN Redlist </a> ?>
          </div>
        </div>
        <div class="form-group" style="margin-top: 2.5rem;">
          <label for="species_english_name">General english name</label>
          <input type="text" class="form-control col-lg-12" id="species_english_name" name="species_english_name" value="<?php echo @$_POST['species_english_name'];?>" />
        </div>
        <!-- <div>
        <label for="source"> Source</label><br>
        <select  id="source" name="source" multiple>
              <option value="" disabled selected>Choose option</option>
              <option value="captive">Captive</option>
              <option value="wild">Wild</option>

            </select>
        </div><br> -->
        <br>
        <div class="form-group">
          <label for="quantity">Quantity <small class="text-danger">*</small></label>
          <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo @$_POST['quantity'];?>" required />
        </div><br>
        <div class="form-group">
          <label for="price_bdt">Unit price (BDT) <small class="text-danger">*</small> </label>
          <input type="number" class="form-control" id="price_bdt" name="price_bdt" value="<?php echo @$_POST['price_bdt'];?>" required />
        </div><br>
        <div class="">
        <div class="form-group ">
            <label for="price_usd">Unit price (USD)</label>
            <input type="number" class="form-control" id="price_usd" name="price_usd" value="<?php echo @$_POST['price_usd'];?>" />
          </div>
          
        </div><br>
          <?php
          if ($NOC['sub_of_noc'] == "CITES") { ?>
            <div class="form-group">
          <label for="ring_number">Ring Number / Chip ID / RFID</label>
          <input type="text" class="form-control" id="ring_number" name="ring_number" value="<?php echo @$_POST['ring_number'];?>" /><br>
          <div id="ring-number-list"></div>
          <button type="button" class="btn btn-success" onclick="addRingNumber()"><i class="fas fa-plus"></i>Add more ring number</button>
          <input type="hidden" id="hidden_ring_numbers" name="hidden_ring_numbers" value="<?php echo @$_POST['hidden_ring_numbers'];?>" />
        </div>
        <br> 
        
        <div class="form-group">
          <label for="source">Select source of specimen <small class="text-danger">*</small></label>
          <div class="form-check">
            <input class="form-check-input source" type="radio" name="source" id="source_captive" value="captive">
            <label class="form-check-label" for="source_captive">
              Captive
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input source" type="radio" name="source" id="source_wild" value="wild">
            <label class="form-check-label" for="source_wild">
              Wild
            </label>
          </div>
          
          <div id="show_wild_section" class="d-none both-yes">
            <div class="form-group check_magic">
              <div class="d-none message">
                <div class="yes">You have to submit appropriate documents for the country legal wild breeding facilities.</div>
                <div class="no">Sorry, You can not bring an spices from a country where there is no legal breeding facilities.</div>
              </div>
              <div class="info"></div>
            </div><br>
              <div class="form-group check_magic">
            <div class="d-none message">
              <div class="yes">You have to submit appropriate documents for the country legal wild breeding facilities.</div>
              <div class="no">Sorry, You can not bring this spices from this country.</div>
            </div>
            <label for="legal_breading"> <?php echo 'Does the ', $verb, ' have cites export permit?'; ?></label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="wild_exporter_breading_permit" id="exporter_breading_permit_yes" value="yes">
                <label class="form-check-label" for="exporter_breading_permit_yes">
                  Yes
                </label>
              </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="wild_exporter_breading_permit" id="exporter_breading_permit_no" value="no">
              <label class="form-check-label" for="exporter_breading_permit_no">
                No
              </label>
            </div>
          <div class="info"></div>
        </div><br>
      </div end-id="show_wild_section">
        <div id="show_captive_section" class="d-none both-yes">
          <div class="form-group check_magic">
            <div class="d-none message">
              <div class="yes">You have to submit appropriate documents for the country legal wild breeding facilities.</div>
              <div class="no">Sorry, You can not bring this spices from this country.</div>
            </div>
            <div class="info"></div></div>
        <div class="form-group check_magic">
          <div class="d-none message">
            <div class="yes">You have to submit appropriate documents for the country legal wild breeding facilities.</div>
            <div class="no">Sorry, You can not bring this spices from this country.</div>
          </div>
          <label for="legal_breading">  <?php echo 'Does the ', $verb, ' have a cites export permit?'; ?></label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="captive_exporter_breading_permit" id="captive_exporter_breading_permit_yes" value="yes">
            <label class="form-check-label" for="captive_exporter_breading_permit_yes">
              Yes
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="captive_exporter_breading_permit" id="captive_exporter_breading_permit_no" value="no">
            <label class="form-check-label" for="captive_exporter_breading_permit_no">
              No
            </label>
          </div>
          <div class="info"></div>
        </div>
      </div end-id="show_captive_section">
         <?php } //only CITIES  ?>
          <div>
            <!-- <div id="adiv"></div><br> -->
             <br>
            <div class="form-group">
              <label>Is the species mutated ?</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="muted_yes" name="muted" value="yes">
                <label class="form-check-label" for="muted_yes">Yes</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="muted_no" name="muted" value="no">
                <label class="form-check-label" for="muted_no">No</label>
              </div>
            </div>
            <div class="container card-body">
              <p><i>Image size should be 100 x 40 </i></p>
              <h3 class="table-title1">Upload Species Image</h3>
              File : <input type="file" id="species_images" name="species_images" /><br><br>
              <!-- <br><button type="submit" name="submit" value="Upload" class="btn btn-primary">Save & add more </button> -->
            </div>
            <!-- <div class="form-group">
              <label for="coloration">Coloration</label>
              <input type="text" class="form-control" id="coloration" name="coloration" />
              <small>Specify the Species color</small>
            </div> -->
            <div id="problems" class="d-none alert alert-danger msg"></div>
            <input name="noc-id" id="noc-id" value="<?php echo $_GET['noc-id']; ?>" type="hidden" />
            <a class="btn btn-primary" style="color:white;" name="submit" id="save_sp"><i class="fa fa-plus"></i> Save & add more</a>
            <a id="save" type="submit" style="float: right;" name="go_next" class="btn btn-info" href="noc_details.php?noc-id=<?php echo $_GET['noc-id']; ?>">Done adding all Species, next <i class="fas fa-arrow-right"></i></a>
      </form>
    </div>
  </div>

  <?PHP /*
  <script>
  $(document).ready(function() {
    $('#price_usd, #unit_type').on('change', function() {
      var unitAmount = parseFloat($('#price_usd').val());
      var unitType = $('#unit_type').val();
      
      if (unitType === 'USD') {
        $('#price_usd').val(unitAmount);
      } else if (unitType === 'Cent') {
        $('#price_usd').val(unitAmount / 100);
      }
    });
  });
</script>
/** */
?>

<?php pg_footer(); ?>