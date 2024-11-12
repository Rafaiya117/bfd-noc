<?php

check_signature_and_licence_validity();



if(@$_GET['noc_type']){
  $noc_type = $_GET['noc_type'];
}
  else{
   $noc_type = "import";
  }

  if($noc_type === 'import'){
    $noun = "Exporting ";
    $verb = "Exporter";
  }
  else if($noc_type === 'export'){
    $noun = "Importing ";
    $verb = "Importer";
  }









  if (!empty($_POST)) {


    
  //   if ($_POST['sub_of_noc'] === 'CITES') {
  //     $contact_cites = $_POST['contact_cites'];
  // } else {
  //     $contact_cites = null;
  // }
  $aplicant = auth();

  $id = $db->action(
      'INSERT into noc_import 
      (application_date, 
        sub_of_noc,
        noc_type,
        purpose,
        user_id,
        applicant_name,
        applicant_address,
        company_name,
        exporting_country_name,ex_name,ex_company_name,
        ex_email,ex_address,ex_phone,ex_cites_permit_no,ex_cites_email,category,user_mail) 
        values (now(), 
      ?,?,?,?,?,
      ?,?,?,?,
      ?,?,?,?,
      ?,?,?,?)',
      // $_POST['application_date'], 
      $_POST['sub_of_noc'],
      $noc_type,
      $aplicant['purpose'],
      auth()['id'],
      $aplicant['name'],
      $aplicant['address'] . ', ' . $aplicant['permanent_address'],
      $aplicant['company_name'],
      
      
      $_POST['exporting_country_name'],
      $_POST['ex_name'],
      $_POST['ex_company_name'],
      $_POST['ex_email'],
      $_POST['ex_address'],
      $_POST['ex_phone'],
      $_POST['ex_cites_permit_no'],
      $_POST['ex_cites_email'],
      
      $_POST['category'],
      $aplicant['email']
  );
  // if ($id) {
  //     $db->action('INSERT into noc_import_species (noc_id, species_name, quantity, unit, purpose, source, country, district, upazila, date) values (?,?,?,?,?,?,?,?,?,?,?)',
  //         $id,
  //         $_POST['species_name'],
  //         $_POST['quantity'],
  //         $_POST['unit'],
  //         $_POST['purpose'],
  //         $_POST['source'],
  //         $_POST['country'],
  //         $_POST['district'],
  //         $_POST['upazila'],
  //         $_POST['date']
  //     );
  // }
  // die('id: ' . $id);
  if(!$id){
    exit();
  }

   header('Location:add_species_on_nocs.php?noc-id='. $id);
   exit();
}

$rows = $db->select('SELECT `name` from districts');
$rows2 = $db->select('SELECT `name` from upazilas');

add_js([ 'assets/js/date_format.js', 'assets/js/pages/create_new_noc_view.js']); // 'assets/js/pages/add_speceis_page.js', 'assets/js/dropdown.js',






  pg_header();
  show_banner('cites_non_cites');
  pg_topnavbar();
  breadcrumbs();
?>

<div class="container">
  <form class="card-body" method="POST" style="padding: 2.25rem !important;">
    <h3 class="table-title1">New Application for NOC (Import)</h3>
      <div class=" container" style="background-color:#e8e8e8">
        <div class="cites"style="width: 15%; height: 50%;  float:left;">
          <label for="sub_of_noc"> <b>Subject:</b></label>
           <select name="sub_of_noc" id="sub_of_noc">
              <option value="CITES">CITES</option>
              <option value="NON-CITES">Non-CITES</option>

      </select>
    </div>
    <div class="sub"style="width: 85%; height: 50%;">
      <label for="category" style="color: #e8e8e8;"></label>
      <select name="category" id="category">
        <option value="Cage-Birds">No Objection Certificate (NOC) for Importing  Cage Birds</option>
        <option value="Plants">No Objection Certificate (NOC) for Importing Plants</option>
        <option value="Animals">No Objection Certificate (NOC) for Importing Animals</option>

      </select><br>
    </div><br>
       <!-- ----- -->
       <!-- tabular info of applicant  -->
       <!-- ------- -->
    
    <!-- <div class="form-group">
      <label for="application_date">Application date</label>
      <input type="date" class="form-control" id="application_date" name="application_date" required />
    </div> -->
    <!-- <section>
    <div class="d-none">
      <label>Entity Type:</label>
      <input type="radio" id="owner" name="entity_type" value="Owner"> Owner
      <input type="radio" id="representative" name="entity_type" value="Representative"> Representative
    </div>
    <div class="form-group d-none" id="representative-detail " >
    <h4>Representative Detail (If applicable)</h4>
  <div class="container" style="background-color:#e8e8e8">
    <label for="representative_name">Representative name</label>
    <input type="text" class="form-control" id="representative_name" name="representative_name" />

    <label for="rep_designation">Designation</label>
    <input type="text" class="form-control" id="rep_designation" name="rep_designation" />

    <label for="rep_address">Address</label>
    <input type="text" class="form-control" id="rep_address" name="rep_address" placeholder="Enter Address" />

    <label for="rep_mobile_number">Phone number</label>
    <input type="text" maxlength="11"class="form-control" id="rep_mobile_number" name="rep_mobile_number" placeholder="Enter phone number" />

    <label for="afflication_w_importing_co">Affliation with the importing company</label>
    <input type="text" class="form-control" id="afflication_w_importing_co" name="afflication_w_importing_co" />

    <br>
  </div><br>
    </div>
</section> -->

    <div class="form-group">
      <h4><?=$noun?> Country & <?= $verb ?> Detail</h4>
      <div class=" container" style="background-color:#e8e8e8">
        <div>
          <label for="exporting_country_name"><?=$noun?> country name<i style="color:red"> *</i></label>
          <input type="text" class="form-control" id="exporting_country_name" name="exporting_country_name" required/>
          
          <label for="ex_name"><?= $verb ?> name</label>
          <input type="text" class="form-control" id="ex_name" name="ex_name" />

          <label for="ex_company_name"><?= $verb ?> company name<i style="color:red"> *</i></label>
          <input type="text" class="form-control" id="ex_company_name" name="ex_company_name" required/>

          <label for="ex_email"><?= $verb ?> email address </label>
          <input type="text" class="form-control" id="ex_email" name="ex_email" />

          <label for="ex_address">Address<i style="color:red"> *</i></label>
          <textarea type="text" class="form-control" id="ex_address" name="ex_address" required></textarea>
          
          <label for="ex_phone"><?= $verb ?> phone number<i style="color:red"> *</i> </label>
          <input type="tel"  class="form-control" id="ex_phone" name="ex_phone" required/>

          <div id="cites-fields">
            <label for="ex_cites_permit_no"> CITES management authority permit number<i style="color:red"> *</i></label>
            <input type="text" class="form-control cites-fields" id="ex_cites_permit_no" name="ex_cites_permit_no" required/>
            <label for="ex_cites_email">Email ID of CITES management authority of the <?=$noun?> country</label>
            <input type="text" class="form-control cites-fields" id="ex_cites_email" name="ex_cites_email" />
          </div>
        </div><br>
      </div><br>
      <button type="submit" name="submit" value="Upload" class="btn btn-primary"><i class="fas fa-save"></i> Save </button>
  </form>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 

  // $(document).ready(function() {
  //   $('input[name="entity_type"]').on('change', function() {
  //     if ($(this).val() === 'Representative') {
  //       $('#representative-detail').show();
  //     } else {
  //       $('#representative-detail').hide();
  //     }
  //   });
  // });
</script>

<?php pg_footer(); ?>
	


  