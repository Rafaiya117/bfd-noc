<?php

if (!empty(@$_GET['id'])) {
  $noc_id = $_GET['id'];
} elseif (!empty(@$_GET['noc-id'])) {
  $noc_id = $_GET['noc-id'];
} else {
  echo 'id not found!';
  exit();
}

$row = $db->select('SELECT * FROM noc_import WHERE id = ? LIMIT 1', $noc_id);
$NOC = $row[0];

$aplicant_id = $NOC['user_id'];
$aplicant = $db->select('SELECT * FROM member WHERE id = ?', $aplicant_id)[0];

$species_on_this_noc = $db->select('SELECT * FROM imp_noc_species_duplicate WHERE noc_id = ? ORDER BY `status`', $noc_id);

if (!empty($_FILES)) {
  if (!empty($_FILES['health_certificate_img'])) {
      $image_show = handleFileUpload('health_certificate_img', 'certificate'); // 1MB limit
      if ($image_show) {
          $db->action('UPDATE noc_import SET `health_certificate_img` = ? WHERE `id` = ?', $image_show, $noc_id);
          header('Location: noc_details.php?noc-id=' . $noc_id); 
          exit;
      } else {
          $_SESSION['error'] = $_SESSION['error'] ?? 'File upload failed'; 
          unset($_SESSION['error']);
      }
  } else if (!empty($_FILES['permit'])) {
      $image_show = handleFileUpload('permit', 'wild'); // 1MB limit
      if ($image_show) {
          $db->action('UPDATE noc_import SET `permit` = ? WHERE `id` = ?', $image_show, $noc_id);
          header('Location: noc_details.php?noc-id=' . $noc_id);
          exit;
      } else {
          $_SESSION['error'] = $_SESSION['error'] ?? 'File upload failed'; 
          unset($_SESSION['error']);
      }
  } else if (!empty($_FILES['invoice'])) {
      $image_show = handleFileUpload('invoice', 'invoice'); // 1MB limit
      if ($image_show) {
          $db->action('UPDATE noc_import SET `invoice` = ? WHERE `id` = ?', $image_show, $noc_id);
          header('Location: noc_details.php?noc-id=' . $noc_id); 
          exit;
      } else {
          $_SESSION['error'] = $_SESSION['error'] ?? 'File upload failed'; 
          unset($_SESSION['error']);
      }
  }
}


    $randomNumber = rand(1, 9999);
    $currentDateTime = date('Y');
    $memo = '22.01.0000.101.23.' . auth()['id'] . '.' . $currentDateTime . '.' . $randomNumber;

  if(isset($_POST['status_change']) && (@$_POST['agree'])){
    // pre($NOC, 'lock ssss');

      if($NOC['headcount'] == 0){
        set_message('Please add species to the application. Without species, application can not applied.', 'danger');
        header('Location:'.$_SERVER['REQUEST_URI']);
        exit;
      }
      if($NOC['sub_of_noc']=='CITES' && $NOC['permit']== ''){
        set_message('Please upload copy of CITES permit copy. Without CITES Permit, application can not applied.', 'danger');
        header('Location:'.$_SERVER['REQUEST_URI']);
        exit;
      }

      if( $NOC['invoice']== ''){
        set_message('Please upload the Invoice. Without Invoice, application can not applied.', 'danger');
        header('Location:'.$_SERVER['REQUEST_URI']);
        exit;
      }
    // $noc = $db();
    // print_r($_POST);
    // die();
    if (isset($_GET['id'])) {
      $sql = $db->action('UPDATE noc_import SET `memo_id` = ?, `status` = ? WHERE id = ?', $memo, "200_vendor_submitted", $_GET['id']);
      $noc_details = $db->select('SELECT * FROM noc_import WHERE id = ?', $_GET['id']);
      $asistant =$db->select('SELECT `email` from users where `designation` = "Office Assistant"')[0];
      $recipientEmail = $asistant['email'];
      $subject = "NOC Status Update: Application Submitted (ID: " . $_GET['id'] . ")";
      $body = "An NOC application has been submitted by the vendor and requires review by the Assistant (role 10).";

      if ($noc_details) {
      $body .= "\n\nHere are some details about the NOC application:\n";
     }

    $email_result = sendEmail($recipientEmail, $subject, $body);

    if ($email_result === 'Message has been sent.') {
      echo 'NOC status updated and email sent successfully.';
      header('Location:'.$_SERVER['REQUEST_URI']);
    } else {
      echo 'NOC status updated, but email sending failed: ' . $email_result;
    }
    } else {
      echo 'NOC status updated, but email sending failed: ' . $email_result;
    }
  }

update_next_status($NOC);
add_js(['../assets/js/vendor/underscore-umd-min.js', '../assets/js/pages/add_speceis_page.js', '../assets/js/cites_appendix.js', '../assets/js/change_status.js', '../assets/js/uploader.js', '../assets/js/insert_condition.js', '../assets/js/pages/import_details.js', '../assets/js/full_details.js', '../assets/js/price.js']);

pg_header();
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
          generateheaderimport( $application_type, $subOfNOC, $category, $memoID, $applicationDate);
        ?>
      </div>
      <div> 
        <?php generateTableContentimport($NOC, $aplicant); ?>
      </div>    
      <div>
        <?php if ($NOC['status'] === '100_draft') {view_species_table_v2($NOC, $species_on_this_noc, $edit = true);}else{view_species_table_v2($NOC, $species_on_this_noc, $edit = false);} ?>
        <br>
        <?php
          if ($NOC['status'] === '100_draft' || $NOC['status'] === '201_vendor_application_incomplete') {
            // echo '<p style="padding-left:20px;"><b><i>Note: File/Image size should not be more than 1 MB</i></b></p>';
            Uploader_div($noc_id, 'health_certificate_img', 'Health/Quarantine Certificate', $NOC, false);
            if ($NOC['sub_of_noc'] == "CITES") {
              Uploader_div($noc_id, 'permit', 'CITES permit copy', $NOC, true);
            }
            Uploader_div($noc_id, 'invoice', 'Invoice', $NOC, true);
            echo '</div>';
          }
          else{
            echo file_show($NOC, $aplicant);
          }
          echo '<div style="padding-left: 20px;padding-top: 52px;">
              <h5>Signature of ', $NOC['applicant_name'], '</h5>
              <div class=""><div class=""><img style="width:15%;" src="',IMG_URL, $aplicant['signature'],'" ></div></div>
            </div><br>';
          show_next_status_button($NOC);
        ?>
      </div>
    </div>
  </div>
</div>


<?php pg_footer(); 


