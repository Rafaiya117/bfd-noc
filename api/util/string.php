<?PHP

$noc_status_str = [
    '100_draft' => 'Draft Application',
    '200_vendor_submitted' => 'Application Submitted by Applicant' ,
    
    '201_vendor_application_incomplete'=>'Application Incomplete',

    //'300_initial_document_verification' => 'In Progress NOC Application (Initial Document validation)' ,
    '400_deskofficer_verification' => 'In Progress NOC Application (Desk Officer Verification)',
    '401_deskofficer_verification_incomplete'=>'Incomplete NOC Application for Desk Officer Verification',
    
    '500_DCF_verification' => 'In Progress NOC Application (DCF Verification)' ,
    '501_DCF_verification_incomplete'=>'Incomplete NOC Application for DCF Verification',

    '600_CF_verification' => 'In Progress NOC Application (CF Verification)' ,
    '601_CF_verification_incomplete'=>'Incomplete NOC Application for CF Verification',

    '700_CCF_verification' => 'In Progress NOC Application (CCF Verification)' ,
    '701_CCF_verification_incomplete'=>'Incomplete NOC Application for CCF Verification',

    '800_waiting_for_vendor_payment' => 'Waiting for applicant payment' ,
    '801_vendor_payment_inappropiate'=>' Inappropiate Payment NOC Application',
    // payment_check
    '850_payment_check' => 'In Progress NOC Application (Payment Verification)',
    '900_payment_confirmed' => 'In Progress NOC Application (NOC approve and final sign)',
    //'950_waiting_for_printing'=>'Final signature done waiting for last activity',
    // Possible onemore level CCF check... 
    '1000_signed_document' => 'Download Signed NOC',
    '1050_inspection_document'=>'Used NOC',
    
    '99_rejected' => 'REJECTED',
    
];

$application_purpose_code = [
    'Commercial' => 'T <small class="code">Trade</small>',
    'Institution' => 'R <small class="code">Research</small>',
    'Research' => 'R <small class="code">Research</small>',
    'Zoo' => 'Z <small class="code">Zoo</small>',
    'Personal' => 'P <small class="code">Personal</small>',
    'Others' => 'O <small class="code">Others</small>',
];



// document verification 
// 
// echo '<pre>';
// print_r($noc_status_str );
// die();

$status_to_headx = [
    '100_draft' => 'List of Draft NOC',
    
    '200_vendor_submitted' => 'Application Submitted by Applicant' ,
    '201_vendor_application_incomplete'=>'Application Incomplete',
    //'300_initial_document_verification' => 'List of NOC Application for Initial Document validation' ,

    '400_deskofficer_verification' => 'List of NOC Application for Desk Officer Verification',
    '401_deskofficer_verification_incomplete'=>'List of Incomplete NOC Application for Desk Officer Verification',

    '500_DCF_verification' => 'List of NOC Application for DCF Verification' ,
    '501_DCF_verification_incomplete'=>'List of Incomplete NOC Application for DCF Verification', 

    '600_CF_verification' => 'List of NOC Application for CF Verification' ,
    '601_CF_verification_incomplete'=>'List of Incomplete NOC Application for CF Verification',

    '700_CCF_verification' => 'List of NOC Application for CCF Verification' ,
    '701_CCF_verification_incomplete'=>'List of Incomplete NOC Application for CCF Verification',
     // payment_check
    '800_waiting_for_vendor_payment' => 'List of NOC Application for Waiting for applicant payment' ,
    '801_vendor_payment_inappropiate'=>'List of Inappropiate Payment NOC Application',
    '850_payment_check' => 'List of NOC Application for Payment Verification',

    '900_payment_confirmed' => 'List of NOC Application for NOC approve and final sign',
    //'950_waiting_for_printing'=>'List of NOC Application Waiting for last activity',

    '1000_signed_document' => 'List of Approved NOC Application',
    '1050_inspection_document'=>'List of Used NOC',
    '99_rejected' => 'REJECTED',

];

/**
 * 
 Permit approval authority list -
 Admin 1: Office Assistant (CITES/Non-CITES)
 Admin 2: Desk Officer (CITES/Non-CITES)
 Admin 3: Deputy Conservator of Forests (DCF)
 Admin 4: Conservator of Forests (CF)
 Admin 5: Chief Conservator of Forests (CCF)
 * * */
$role_admin = [
'0_Vendor' => 'Applicant',
'10_Assistant' => 'Office Assistant',
'20_Officer' => 'Desk Officer',
'30_DCF' => 'Deputy Conservator of Forests (DCF)',
'40_CF' => 'Conservator of Forests (CF)',
'50_CCF' => 'Chief Conservator of Forests (CCF)',
'60_IO' => 'Inspection Officer',
];



define('ROLE', 'ROLE');
define('NEXT', 'NEXT');
define('BACKWARD','BACKWARD');

$status_change_plan = [
    '100_draft' => [ROLE => '0_Vendor', NEXT => '200_vendor_submitted', BACKWARD => ['10_Assistant']],
    '200_vendor_submitted' => [ROLE => '10_Assistant', NEXT => '400_deskofficer_verification', BACKWARD => ['0_Vendor']],
    '201_vendor_application_incomplete'=> [ROLE => '0_Vendor', NEXT => '200_vendor_submitted', BACKWARD => ['10_Assistant']],
    '400_deskofficer_verification' => [ROLE => '20_Officer', NEXT => '500_DCF_verification', BACKWARD => ['10_Assistant']],
    '401_deskofficer_verification_incomplete' => [ROLE => '20_Officer', NEXT => '500_DCF_verification', BACKWARD => ['10_Assistant']],
    '500_DCF_verification' => [ROLE => '30_DCF', NEXT => '600_CF_verification', BACKWARD => ['20_Officer']],
    '501_DCF_verification_incomplete' => [ROLE => '30_DCF', NEXT => '600_CF_verification', BACKWARD => ['20_Officer']],
    '600_CF_verification' => [ROLE => '40_CF', NEXT => '700_CCF_verification', BACKWARD => ['30_DCF']],
    '601_CF_verification_incomplete' => [ROLE => '40_CF', NEXT => '700_CCF_verification', BACKWARD => ['30_DCF']],
    '700_CCF_verification' => [ROLE => '50_CCF', NEXT => '800_waiting_for_vendor_payment', BACKWARD => ['40_CF']],
    '701_CCF_verification_incomplete' => [ROLE => '50_CCF', NEXT => '800_waiting_for_vendor_payment', BACKWARD => ['40_CF']],
    '800_waiting_for_vendor_payment' => [ROLE => '0_Vendor', NEXT => '850_payment_check', BACKWARD => ['50_CCF']],
    '801_vendor_payment_inappropiate' => [ROLE => '0_Vendor', NEXT => '850_payment_check', BACKWARD => ['50_CCF']],
    '850_payment_check' => [ROLE => '10_Assistant', NEXT => '900_payment_confirmed', BACKWARD => ['0_Vendor']],
    '900_payment_confirmed' => [ROLE => '40_CF', NEXT => '1000_signed_document', BACKWARD => ['30_DCF']],
    '1000_signed_document' => [ROLE => '40_CF', NEXT => '1050_inspection_document', BACKWARD => ['20_Officer']],
    '1050_inspection_document' => [ROLE => '10_Assistant', NEXT => 'Used', BACKWARD => ['60_IO']],
    '99_rejected' => [ROLE => ['10_Assistant', '20_Officer'],NEXT => 'REJECTED',BACKWARD => []],
];



$links_to_detail_page = [
    '100_draft' => './application_detail.php?id=',
    '10_Assistant' => './application_detail.php?id=',
    '20_officer' => './application_detail.php?id=',
    '30_DCF' => './application_detail.php?id=',
    '40_CF' => './application_detail.php?id=',
    '50_CCF' => './application_detail.php?id=',
    '800_waiting_for_vendor_payment' => './application_detail.php?id=',
    '1000_signed_document' => './approved_noc_detail.php?id=',
    '99_rejected' => './application_detail.php?id=',
];

function role_cutter($string){
    // pre($string, 'role_cutter');
    if(is_array($string)){
        $role = explode('_', $string[0]);
        return (int)$role[0];
    }


    $role = explode('_', $string);
    return (int)$role[0];

}

// echo '<pre>';
// print_r(auth());
// die();

function admin_note_post($NOC){
    global  $db;
    
        
        if(!empty(@$_POST['admin_note'])){    
         $_POST['admin_note'] = trim($_POST['admin_note']);   
         $user_designation = auth()['designation'];
         $user_name = auth()['username'];
         $sign = auth()['sign']; 
         $db->action('INSERT into `digital_info` (noc_id,`status`, 
                                    type_note , 
                                    admin_designation, admin_note, 
                                    sign, 
                                    admin_name ) values (?,?, "admin_note",?,?,?,?) ',
          $NOC['id'], $NOC['status'],auth()['designation'], $_POST['admin_note'],auth()['sign'],auth()['name']);
          header('Location: ' . $_SERVER['REQUEST_URI']);
       }
    
}


function admin_note_form($NOC){
    echo '<div class=""> 
            <form style="background-color:white !important;" class="card-body" method="POST">
                <label for="admin_note" class="form-label"><h5><b>Note </b></h5></label>
                <div style="display: flex; grid-column-gap: 5px;">
                <textarea style="border-radius:2px;" class="form-control" id="admin_note" name="admin_note" maxlength="100"></textarea>
                <input name="id" id="id" value="' , $NOC['id'] , '" type="hidden" />
                
                <button class="btn btn-primary">Post Comment</button> 
                </div> 
            </form><br> 
        </div>';
}

function show_admin_notes($NOC){  
    if(APPNAME !== 'admin'){
        return;
    }  
    global $db;
    $digital_info = $db->select('SELECT * from digital_info where noc_id = ?', $NOC['id']);
    // echo '<div class="card" style="padding:10px;" >';
    
    echo '<section style="background-color: #eee;"></section>
    <div class="container my-5 py-5">
      <div class="row d-flex justify-content-center">
        <div class="col-md-12 col-lg-10 col-xl-8">
        <h4>Notes</h4>
          <div class="comments-list">';
          
    for($i=0,$ilen=count($digital_info);$i<$ilen;$i+=1){
        // echo '<div class="row">';
        // echo '<div class="col-3"> ';
        //     echo '<h6>',$digital_info[$i]['admin_name'],'</h6>'; 
    
        // echo ' </div class="col-3">';
        //  echo '<div class="col-5"> ';
        // echo '<p> ',$digital_info[$i]['admin_note'] ,'</p>';
        // echo '</div>';
        // echo '</div class="row">';
    

   

    
          echo '<div class="row comment-body ">';
          echo '<div class="card-body ">
            <div class="d-flex flex-start align-items-center" >
              <p style="padding:15px;"><i class="fa-solid fa-user" style="font-size:45px; color:#cacaca;"> </i></p>
              <div class="padding:0 15px;">
                <h6 class="fw-bold text-primary mb-1">',$digital_info[$i]['admin_name'],'</h6>
                <span class=" text-secondary mb-0" >',$digital_info[$i]['admin_designation'],'</span>
                <p class="text-muted small mb-0">
                  ',$digital_info[$i]['created_on'],'
                </p>
              </div>
            </div>
            <div class=" " >
            <p class="mt-3 mb-4 pb-2">
            ', $digital_info[$i]['admin_note'],'
             
            </p></div>

            
          </div>';
          echo '</div>';
          
          

    }

    echo '<div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
    <div class="d-flex flex-start w-100" >
      <p style="padding: 5px;"><i class="fa-solid fa-user" style="font-size:35px; color:#cacaca;"> </i></p>
      <div data-mdb-input-init class="form-outline w-100">
      <form method="POST" >
      <label class="form-label" for="textAreaExample">Note</label>
      <input name="id" id="id" value="' , $NOC['id'] , '" type="hidden" />
        <textarea class="form-control" name="admin_note" id="textAreaExample" rows="4"
          style="background: #fff;"></textarea>
        
      </div>
    </div>
    <div class="float-end mt-2 pt-1">
      <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-sm">Post comment</button>',
      // <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary btn-sm">Cancel</button>
    '</div>
    </form>
  </div>
</div>
</div>
</div>
</div>
</section>';
    // admin_note_form($NOC);
    // echo '</div>';
    

    // pre($digital_info);
    
}

function source_code($source){
    return strtoupper(substr($source, 0, 1));
}

function admin_status_bar($noc){
    if(APPNAME !== 'admin'){ return;}


    $table_head = 
        [
            'current_status' => 'Application Status',
            '200_vendor_submitted'=> 'Applicant Submission',
            '300_Assistant_verification'=> 'Office Assistant',
            '400_deskofficer_verification'=> 'Desk Officer',
            '500_DCF_verification'=> 'DCF',
            '600_CF_verification'=> 'CF',
            '700_CCF_verification'=> 'CCF',
            // '800_waiting_for_vendor_payment'=> 'Applicant Payment',
            '900_payment_confirmed'=> 'Payment Confirmed',
            '1000_signed_document'=> 'Signed Document',
    ];

    $keys = [

        '300_Assistant_verification',
        '400_deskofficer_verification',
        '500_DCF_verification',
        '600_CF_verification',
        '700_CCF_verification',
        // '800_waiting_for_vendor_payment',
        '900_payment_confirmed',
        '1000_signed_document',
        ];
        
    $data_updated = [
        '300_Assistant_verification'=> 'Office Assistant',
        '400_deskofficer_verification'=> 'Desk Officer',
        '500_DCF_verification'=> 'DCF',
        '600_CF_verification'=> 'CF',
        '700_CCF_verification'=> 'CCF',
        // '800_waiting_for_vendor_payment'=> 'Applicant Payment',
        '900_payment_confirmed'=> 'Payment Confirmed',
        '1000_signed_document'=> 'Signed Document',
    ];
    global $noc_status_str;

    echo '<table class="table" style="font-size:10px;" >
    <thead>
    <tr>';
    echo '<th> ', $table_head['current_status'],'</th>';
    echo '<th> ', $table_head['200_vendor_submitted'],'</th>';

    for($i=0,$ilen=sizeof( $keys ); $i < $ilen; $i+=1){
     
    echo '<th> ', $table_head[$keys[$i]],'</th>';
    }


    echo '</tr>
    <thead>';


    echo '<tr>';
    echo '<td>',$noc_status_str[$noc['status']] ,'</td>';
    echo '<td>';
    show_sign_small($noc['user_id'], 'vendor_sign');
    echo '</td>';

    $table = json_decode($noc['admin_bar_status'], true);

    //  pre($table);
     if($table){
     foreach($table as $key => $value){
        if($value['id'] === -1){
            echo '<td>','</td>';
        }else{
            echo '<td>';
            // echo $value['id'];
            show_sign_small($value['id'], 'admin_sign');
            echo '</td>';
        }
         
        }
    }


    echo '</tr><tr>';
    echo '<td> Name </td>';
    echo '<td>';
    if($noc['purpose'] === 'Commercial'){
        echo $noc['company_name'];
    }else{
        echo $noc['applicant_name'];
    }
    
    echo '</td>';

    
     if($table){
     foreach($table as $key => $value){
        if($value['id'] === -1){
            echo '<td>  ','</td>';
        }else{
            echo '<td>';
            // echo $value['id'];
            echo $value['name'];
            echo '</td>';
        }
         
        }
    }
    echo '</tr><tr>';
    echo '<td>Date Time</td>';
    echo '<td>', bd_date_format($noc['application_date']) ,'</td>';
    // if($NOC['purpose'] === 'Commercial'){
    //     echo strtok($noc['company_name'], );
    // }
    // show_sign_small($noc['user_id'], 'vendor_sign');
    

    
    
     if($table){
     foreach($table as $key => $value){
        if($value['id'] === -1){
            echo '<td>','</td>';
        }else{
            echo '<td>';
            // echo $value['id'];
            echo $value['time'];
            echo '</td>';
        }
         
        }
    }
    echo '</tr></table>';
    

}

// $user_type = 'admin_sign' , vendor_sign
function show_sign_small($user_id, $user_type = 'admin_sign' ){
    
    // echo IMG_URL,'/',$user_type,'/'.$user_id.'.jpg';
    
    echo '<img src="',IMG_URL,'/',$user_type,'/'.$user_id.'.jpg" alt="',$user_type,'" style="max-width: 45px; max-height: 30px;" />';
}


function show_next_status_button($noc) {
    
    global $status_change_plan;
    global $role_admin;
    $next_status = $status_change_plan[$noc['status']]['NEXT'] ?? null;
    $rq_role = $status_change_plan[$noc['status']]['ROLE'] ?? null;
    if(APPNAME !== 'vendor'){   
        admin_status_bar($noc);
    }

    if (!isset($status_change_plan[$next_status])) {
        return; // If no next status defined, return
    }

    $action_role_required = role_cutter($rq_role);
    $login_user_role = role_cutter(auth()['role']);
   

     if ($action_role_required == 0 && $action_role_required != $login_user_role) {
        echo 'Applicant needs pay the fee and upload the chalan copy.'; 
        return;
    }
   
    
   

    

    // Vendor-specific steps
    if ($noc['status'] == '100_draft' && $action_role_required == 0) {
        $type = $noc['noc_type']; 
        $species_link = '';

        if ($type == 'import') {
            $species_link = APP_URL.'/import/add_species_on_nocs.php?noc-id=' . $noc['id'];
        } else if ($type == 'export') {
            $species_link = APP_URL.'/export/add_species_on_nocs.php?noc-id=' . $noc['id'];
        }
        echo '<form method="POST" action="noc_details.php?id=',$noc['id'],'" style="background-color:transparent;">'; 
        echo' <input type="hidden" name="id" value="' , $noc['id'] , '" />';// Start form
        echo'<h5>Terms and Conditions:</h5>
            <p style="color: black;">If found guilty for any reason here, BFD will pursue all necessary legal actions to uphold justice and maintain the integrity of the law.</p>
            <input type="checkbox" id="agree" name="agree" value="yes" required>
            <label for="agree">I agree to the terms and conditions</label><br>';
        echo '<button type="submit" name="status_change" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Request for approval</button>';
        echo '<a href="' , $species_link , '" class="btn btn-danger add-species-btn" style="float:inline-end"><i class="fa fa-download" aria-hidden="true"></i>Add New Species</a>';
        echo '</form>'; // End form
    } else if ($noc['status'] == '201_vendor_application_incomplete' && $action_role_required == 0) {
        echo '<form method="POST" action="">'; // Start form
        echo' <input type="hidden" name="noc_id" value="' , $noc['id'] , '" />';// Start form
        echo '<input type="hidden" name="done" >';
        echo '<input type="hidden" name="agree" >';
        echo '<button type="submit" name="status_change" class="btn btn-warning resubmit-application-btn">Apply for Resubmit</button>';
        echo '</form>'; // End form
    } else if ($noc['status'] == '800_waiting_for_vendor_payment' && $action_role_required == 0) {
        // echo '<form method="POST" action="">'; // Start form
        // echo' <input type="hidden" name="id" value="' , $noc['id'] , '" />';// Start form
        // echo '</form>'; 
        echo '<a href="chalan_submit.php?id=', $noc['id'],'" type="submit" class="btn btn-info" id="id">Submit Payment Copy</a>';
        // End form
    }

    if($noc['status'] === '1000_signed_document' &&  (
            APPNAME === 'admin' || 
            (APPNAME === 'vendor' && $noc['user_id'] === auth()['id'])
        ) 
    ){
        echo '<div class="container card-body"> <a href="',IMG_URL,'/noc_pdf/', $noc['memo_id'],'.pdf" class="btn btn-success" >Download NOC</a></div>';
        return;
    }

    if(APPNAME !== 'admin'){
        return;
    }
    // Admin-specific buttons
    if ($action_role_required <= $login_user_role && $action_role_required > 0) {
        echo '<div>';
        echo '<form method="POST" style="display: inline-flex; column-gap: 10px;">';
        echo '<input type="hidden" name="noc_id" value="' , $noc['id'] , '" />';
        echo '<input type="hidden" name="current_status" value="' , $noc['status'] , '" />';
        echo '<input type="hidden" name="next_status" value="' , $next_status , '" />';
        echo '<input type="hidden" name="role" value="' , $rq_role , '" />';
        echo '<button type="button" class="btn btn-success accept-btn">Accept and Forward </button>';
        if($login_user_role > 10){
       
            echo '<button type="button" class="btn btn-danger deny-btn">Reject or Resubmit </button>';
            echo '<button type="button" class="btn btn-warning send-back-btn">Send back </button>';
        }
        // For roles 10 and 20
        // if (in_array($login_user_role, [10, 20])) {
            
           
        // }

        // For role 30
        // if ($login_user_role == 30) {
            
            
        // }

        // // For roles 40 and 50
        // if (in_array($login_user_role, [40, 50])) {
            
        //     // echo '<button type="button" class="btn btn-warning send-back-btn">Send back this Application</button>';
        //     // echo '<button type="button" class="btn btn-danger deny-btn">Deny this Application</button>';
        // }

        echo '</form>';
        echo '</div><br><br>';
    } else {

        echo 'You have to be ' , $role_admin[$rq_role] , ' or above to approve this NOC.';
    }
}
$db_admin_bar_status = 
        [
            
            '300_Assistant_verification'=> ['id'=>-1, 'act'=> -2],
            '400_deskofficer_verification'=> ['id'=>-1, 'act'=> -2],
            '500_DCF_verification'=> ['id'=>-1, 'act'=> -2],
            '600_CF_verification'=> ['id'=>-1, 'act'=> -2],
            '700_CCF_verification'=> ['id'=>-1, 'act'=> -2],
            // '800_waiting_for_vendor_payment'=> ['id'=>-1, 'act'=> -2],
            '900_payment_confirmed'=> ['id'=>-1, 'act'=> -2],
            '1000_signed_document'=> ['id'=>-1, 'act'=> -2],
    ];

function set_admin_bar_status_for_db($noc){
    
    if(!empty($noc['admin_bar_status']) ){
        return ;
    }

    
    global $db_admin_bar_status;

    

    return json_encode($db_admin_bar_status);

}

function admin_bar_update($noc, $action){
    if(APPNAME !== 'admin'){ 
        return $noc['admin_bar_status'];
    }
    global $status_change_plan;
    $db_table = json_decode($noc['admin_bar_status'], true);
    $status = $noc['status'];
    // $status_change_plan[$noc['status']][NEXT];

    if($action === NEXT){
      

        $assign = [
            'id' => auth()['id'],
            'name' => auth()['name'],
            'time' => date('d M Y H:i'),
            'act' => 10,
        ];

        if($status === '200_vendor_submitted'){
            $db_table['300_Assistant_verification'] = $assign;
        }
        elseif($status === '850_payment_check'){
            $db_table['900_payment_confirmed'] = $assign;

        }elseif($status === '900_payment_confirmed'){
            $db_table['1000_signed_document'] = $assign;

        }
        else{
            $db_table[$status] = $assign;
        }
            
    }
    
    return json_encode($db_table);
}

function final_status_updated_print($NOC, $next){

    global $db;
    $NOC = $db->select('SELECT * from noc_import where id = ? limit 1', $NOC['id'])[0];

    

    if($NOC['status'] === '1000_signed_document' && $next === NEXT){
        

        try{
        // set valitity date
        $approved_date = date('Y-m-d', time());
        $validity_date = date('Y-m-d', strtotime('+90 days', time()));
        $db->action('UPDATE noc_import SET validity_date = ?, 
        approved_date = ?
                 WHERE id = ?', 
                 $validity_date, $approved_date, 
                 $NOC['id']);

        include_once _A_API_FILE_LOCATION. 'qr_code_genarator.php';
        include_once _A_API_FILE_LOCATION. 'pdf_genarator.php';
        // QR CODE 
        qr_code_genator($NOC);

        $NOC = $db->select('SELECT * from noc_import where id = ? limit 1', $NOC['id'])[0];
        $result = pdf_gen($NOC);


        $up = $db->action('REPLACE into noc_final (id, vendor_id, memo_id, validation_date, pdf_location, detail_html, created_by_uid, created_by_name) 
                        values (?,?,?,?,?,?, ?, ?) ',
                         $NOC['id'], $NOC['user_id'], $NOC['memo_id'], $NOC['validity_date'],  $result['pdf_location'], 
                         $result['html'], auth()['id'], auth()['name']);


        }catch(Exception $e){
            page_blocking_message('QR-code and PDF Generation Error
            ', '
            <p>We encountered an issue while creating your PDF. It could be due to one of the following reasons:</p>

    <ul>
        <li><b>QR Code Generation Error:</b> There might be a temporary problem generating the QR code used within the PDF. 
            <br><b>Fix:</b> Please try refreshing the page or waiting a few minutes and try again. If the issue persists, contact SoftLH for further assistance.
        </li>
        <li><b>PDF Creation Error:</b> The system might be experiencing technical difficulties assembling the final PDF document.  
            <br><b>Fix:</b> Refresh the page or try again later. If the problem continues, contact SoftLH for support. 
        </li>
    </ul>

    <p>If refreshing the page or waiting doesn\'t resolve the issue, please contact SoftLH for further assistance. You can reach them at <a href="https://softlh.com">Software Lighthouse</a>.</p>
            ');
            exit;
        }
        // pre($up);
        
        
    }
    
    

}
function update_next_status($NOC)
{
    global $status_change_plan, $db;

    $next_status = $status_change_plan[$NOC['status']][NEXT] ?? null;
    $rq_role = $status_change_plan[$NOC['status']][ROLE] ?? null;
    // echo $NOC['status'];

    // pre( $status_change_plan[$NOC['status']], 'AAAAAAAAAAAAA');
    
    $action_role_required = role_cutter($rq_role);
    $login_user_role = role_cutter(auth()['role']);
    // pre($login_user_role);


   

    if (empty($_POST) || !isset($_POST['noc_id'])) {
        return; 
    }

  
    // pre(auth());
    // pre($next_status);
    // pre($rq_role);
    // pre($_POST, 'POST DATA RESUMIT');

    if (!$next_status || !$rq_role) {
        return; 
    }

 


    if ($action_role_required == 0 && $action_role_required != $login_user_role) {
        // echo ;
        //show_message();
        set_message('Applicant needs to do this step', 'primary');
        return;
    }

    if($NOC['status'] === '1000_signed_document'){
        // echo 'Download NOC from Approved Download Link.';

        return;
    }
    


    


    if ($action_role_required > $login_user_role) {
        echo 'You are not authorized to change this NOC status';
        return;
    }

    if($NOC['status'] === '200_vendor_submitted' && empty($NOC['admin_bar_status']) && $action_role_required < 0){
        $db->action('UPDATE noc_import SET admin_bar_status = ? WHERE id = ?', set_admin_bar_status_for_db($NOC), $NOC['id']);
    }
    

    if (isset($_POST['accept']) || isset($_POST['done'])) {


        $admin_bar_json = admin_bar_update($NOC, NEXT);

        // 850_payment_check
  
    // end 850_payment_check

        // pre($NOX);
        // pre($_POST, 'POST DATA >> CCC ??? ? ' . isset($_POST['accept']));
        
        // pre($admin_bar_json );
        $db->action('UPDATE noc_import SET status = ?, admin_bar_status = ? WHERE id =?', $next_status, $admin_bar_json, $NOC['id']);
        final_status_updated_print($NOC, NEXT);


        // $noc_new =$db->select('SELECT * from noc_import where id = ? limit 1', $NOC['id']);
        // pre([
        //     'condition $action_role_required > $login_user_role' => $action_role_required > $login_user_role,
        //     'current_status' => $NOC['status'],
        //     'next_status' => $next_status,
        //     'rq_role' => $rq_role,
        //     'action_role_required' => $action_role_required,
        //     'login_user_role' => $login_user_role,
    
        //     'auth' => auth()['role'],
        //     'auth_name' => auth()['name'],
        // ]);
        // pre(json_decode($admin_bar_json, true));
        // pre($noc_new,'LOCK Eveyerthing 2');


        header('Location: '. $_SERVER['REQUEST_URI']);
        exit();
    }
    else if (isset($_POST['deny']) && isset($_POST['denyReason'])) {
        if($_POST['deny'] === '201_vendor_application_incomplete'){
            $up_status = '201_vendor_application_incomplete';
        }else{
            $up_status = '99_rejected';
        }
        $db->action('UPDATE noc_import SET `status` = ?, `denyReason` = ? WHERE id = ?', $up_status, trim($_POST['denyReason']), $NOC['id']);
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit();
    }
   
    else if (isset($_POST['back'])) {
        //print_r($_POST);
        $status = $_POST['status'];
        // Update status in database for send back action
        $db->action('UPDATE noc_import SET `status` =? WHERE id =?', $status, $NOC['id']);
        header('Location: '. $_SERVER['REQUEST_URI']);
        exit();
    }
    
  
    // $db->action('UPDATE noc_import SET status = ? WHERE id = ?', $next_status, $NOC['id']);
    // header('Location: ' . $_SERVER['REQUEST_URI']);
    // exit();
}


function bd_date_format($date){
    if(empty($date)) {
       return ''; 
    }
    return date_format(date_create($date),'d M Y');;
}





function type_cites($key){
    $type_of_cities = [
        'CITES' => 'No Objection Certificate (NOC) for Importing CITES Cage Birds',
        'NON-CITES' => 'No Objection Certificate (NOC) for Importing Non-CITES Cage Birds',
    ];
    return $type_of_cities[$key];

}


// for export header

function headerAll($subOfNOC, $category, $memoID, $applicationDate,$validity_date) {
    echo '<div class="">';
    echo '<div class="row">';
    echo '<div class="col-md-6">';
    echo '<div class="card-body">';
    echo '<p style="height: 100px; float: left;">1.Original NOC No. BD/EXP-001/2023<br>2.Valid until:&nbsp;', bd_date_format($validity_date) , '</p>';
    echo '</div>';
    echo '</div>';
    echo '<div class="col-md-6" style="margin-top: 10px;margin-left: -232px; text-align:center;">';
    echo '<p style="line-height: 1.1;" class="ptag">Government of the People\'s Republic of Bangladesh</p>';
    echo '<p style="line-height: 1.1;" class="ptag">Office of the Chief Conservator of Forests</p>';
    echo '<p style="line-height: 1.1;" class="ptag">Bangladesh Forest Department</p>';
    echo '<p style="line-height: 1.1;" class="ptag">Ban Bhaban, Agargaon, Dhaka</p>';
    echo '<p style="line-height: 1.1;" class="ptag">www.bforest.gov.bd</p>';
    echo '</div>';
    echo '</div>';

    // if (!empty($memoID)) {
    //     echo '<p style="margin-bottom: 0rem;"><b>Memo Number: </b>' , $memoID , '</p>';
    // }

    // if (!empty($applicationDate)) {
    //     echo '<p style="margin-bottom: 0rem;"><b>Application Date: </b>' ,  bd_date_format($applicationDate) , '</p>';
    // }

    echo '</div>';

}


function generateheaderimport($application_type,$subOfNOC, $category, $memoID, $applicationDate) {
    echo '<div class="">';
    echo '<p style="color: #ffffff;margin-bottom: 0rem"><b>To,</b> <br></p>';
    echo '<p style="color: #ffffff;  margin-bottom: 0rem">Conservator of Forests<br>';
    echo '<p style="color: #ffffff ;  margin-bottom: 0rem">Wildlife and Nature Conservation Circle<br>';
    echo '<p style="color: #ffffff ;  margin-bottom: 0rem">Bangladesh Forest Department<br>';
    echo '<p style="color: #ffffff ;margin-bottom: 0rem ">Ban Bhaban, Agargon, Dhaka.</p>';
    echo '<p style="color: #ffffff"><b>Subject:</b> No Objection Certificate (NOC) for ', 
            ucfirst($application_type),' ' , $subOfNOC , ' ' , $category , ' </p><br>';

    // if (!empty($memoID)) {
    //     echo '<p style="color: #ffffff;margin-bottom: 0rem"><b>Memo Number: </b>' , $memoID , '</p>';
    // }

    // if (!empty($applicationDate)) {
    //     echo '<p style="color: #ffffff;margin-bottom: 0rem"><b>Application Date: </b>' , 
    //     // date('d/m/Y', strtotime($applicationDate)) 
    //     bd_date_format($applicationDate)
    //     , '</p>';

    // }

    echo '</div>';

    // return $content;
}

function generateTableContentimport($NOC, $aplicant)
{
    global $noc_status_str;

    echo '<table class="table table-striped table-hover card-body gen-noc-tb" >';
    echo  '<tr><td colspan=3> 
    <h6>Memo no </h6> <h5>' ,$NOC['memo_id'], '</h5>
    </td></tr>';

    echo '<tr>';
    
    // Application Status
    echo '<td width="25%">';
    echo '<h6>Application Status </h6>';
    echo '<h5 class="status-', $NOC['status'], '"> ', $noc_status_str[$NOC['status']], '</h5>';
    
    
    // Application Date
    echo '<hr><h6>Application Date</h6><h5> ' ,bd_date_format($NOC['application_date']) , '</h5>';
    
    echo '</td>';

    
    


    // pre($aplicant);

    // Applicant Detail

    echo '<th rowspan=4 width="45%" style="vertical-align: top;" >';
    echo '<h5><strong>Applicant Details</strong></h5>';

    if($aplicant['purpose'] === 'Commercial'){
        echo '<h6>Company </h6><h5><a href="',APP_URL,'applicant_profile.php?id=',$aplicant['id'],'">', $aplicant['company_name'], '</a></h5>';
        echo '<h6>BFD Licence </h6><h5>', $aplicant['company_licence_num'], '</h5>';
        echo '<h6>Licence Validity </h6><h5>', bd_date_format($aplicant['company_licence_validity']), '</h5>';
        echo '<h6>Contact Person </h6><h5>', $aplicant['name'], '</h5>';
        echo '<h6>Phone </h6><h5>', $aplicant['phone'], '</h5>';
        echo '<h6>Email </h6><h5>', $aplicant['email'], '</h5>';
        echo '<h6>Address </h6><h5>',  $NOC['applicant_address'], '</h5>';
        
    }if($aplicant['purpose'] === 'Personal'){
        echo '<h6>Applicant </h6><h5><a href="',APP_URL,'applicant_profile.php?id=',$aplicant['id'],'">', $aplicant['name'], '</a></h5>';
        echo '<h6>Phone </h6><h5>', $aplicant['phone'], '</h5>';
        echo '<h6>Email </h6><h5>', $aplicant['email'], '</h5>';
        echo '<h6>Address </h6><h5>',  $NOC['applicant_address'], '</h5>';


    }if($aplicant['purpose'] === 'Institution'){
        echo '<h6>Institution  </h6><h5><a href="',APP_URL,'applicant_profile.php?id=',$aplicant['id'],'">', $aplicant['company_name'], '</a></h5>';
        echo '<h6>Applicant </h6><h5><a href="',APP_URL,'applicant_profile.php?id=',$aplicant['id'],'">', $aplicant['name'], '</a></h5>';
        
        echo '<h6>Phone </h6><h5>', $aplicant['phone'], '</h5>';
        echo '<h6>Email </h6><h5>', $aplicant['email'], '</h5>';
        echo '<h6>Address </h6><h5>',  $NOC['applicant_address'], '</h5>';


    }

    
    // echo ' ', $NOC['applicant_name'], '</p>';
    // echo '<p><b>Address</b>', $NOC['applicant_address'], ',<br>';
    // echo $aplicant['upazila'], ', ', $aplicant['district'], '</p>';
    
    // if ($NOC['phn_no'] != NULL) {
    //     echo '<p><b>Contact number</b> ', $NOC['phn_no'], '</p>';
    // }
    
    
    echo '</th>';

   

    // Company Details
    // if ($aplicant['company_name'] != NULL) {
    //     echo '<td>';
       
    //     echo '</td>';
    // }

    // Representative Details
    // if ($NOC['representative_name'] != NULL) {
        
    //     echo '<h5>Representative Detail</h5><p>';
    //     echo '<b>Representative name: </b><br>', $NOC['representative_name'], '<br><br>';
    //     echo '<b>Designation: </b><br>', $NOC['rep_designation'], '</p>';
    //     echo '<p><b>Address: </b><br>', $NOC['rep_address'], '</p>';
    //     echo '<p><b>Phone number: </b><br>', $NOC['rep_mobile_number'], '</p>';
    //     echo '</p></strong></h5>';
        
    // } 
    // else {
    //     echo '<p>N/A</p>';
    // }



    global $application_purpose_code;
    $purpose_in_letter = $application_purpose_code[$aplicant['purpose']];
    // pre($application_purpose_code);

    // echo  $purpose_in_letter;


    
    echo '<td><h6>Application Purpose </h6><h5 class="mt-1   bold">',  $purpose_in_letter , '</h5></td>';
    echo '</tr>';

    echo '<tr>';
    // Quantity (Total Head)
        echo '<td>
        <h6>NOC Type </h6><h5>',  ucfirst($NOC['noc_type']) ,' ', $NOC['sub_of_noc'], '</h5>
        
        </td>';
    
    
    // Exporter/Importer Details heading change based on NOC type
    // Exporter/Importer Content (Remains same regardless of the heading change)
    echo '<td rowspan=3 >';
    if ($NOC['noc_type'] === 'import') {
        echo '<h5><strong>Exporter Details</strong></h5>';
    } elseif ($NOC['noc_type'] === 'export') {
        echo '<h5><strong>Importer Details</strong></h5>';
    }
    
    echo '<h6>Country </h6> <h5>' , $NOC['exporting_country_name'] , '</h5>';
    echo '<h6>Company </h6> <h5>' , $NOC['ex_company_name'] , '</h5>';
    
    echo '<h6>Contact Phone Number </h6> <h5>' , $NOC['ex_phone'] , '</h5>';
    
    if($NOC['ex_email']!=''){
        echo '<h6>Email </h6> <h5>' , $NOC['ex_email'] , '</h5>';
    }
    
    if($NOC['ex_cites_permit_no']!=''){
        echo '<hr>';
        echo '<h6><strong>CITES Management Authority </strong></h6> ';
        echo '<h6>CITES permit no </h6> <h5>' , $NOC['ex_cites_permit_no'] , '</h5>';
    }
    if($NOC['ex_cites_email']!=''){
        echo '<h6>CITES Authority Email   </h6> <h5>' , $NOC['ex_cites_email'] , '</h5>';
    }

    

    
    
    
    echo '</td>';
    // END Exporter/Importer Details heading change based on NOC type
    echo '</tr>';
    
    echo '<tr>';
    // Quantity (Total Head)
        echo '<td>';
    echo '<h6>Quantity / Headcount</h6> <h5> ' , $NOC['headcount'] , ' </h5>';
    echo '</td>';

    
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    
    
    if ($NOC['approved_date'] != NULL) {
           
        echo '
                <h6>Approved Date</h6> <h5>' ,bd_date_format($NOC['approved_date']) , '</h5>';
        
        
    }
     // Approved Date
     if ($NOC['validity_date'] != NULL) {
        
        echo '<hr><h6>Validity Date</h6> <h5>' ,bd_date_format($NOC['validity_date']) , '</h5>';
        
    }

    // Validity Date
    
    echo '</td>';
    
   
    echo '</tr>'; 
    
    if((!empty($NOC['denyReason']))){
        echo '<tr> <td colspan=3>';
        echo '<h6>Office Instruction To Applicant about Rejection or Resubmission</h6><br>';
        echo '<p style="color:#f30d00;"> ', str_replace("\n", '<br>', $NOC['denyReason']) ,'</p>';
        echo '</td></tr>';
    }
     
    echo '</table>';
    
}

// for importer details (export)
// function generateExporterDetailsimport($NOC)
// {
//     $importerDetails = '<div style="margin-left: 30px;border: 2px solid #ede5e5; background-color: #f3f3f3;">';
//     $importerDetails .= '<h5><b>Exporting Country & Exporter Detail:</b></h5><br>';
//     $importerDetails .= '<p>Exporting country name: ' . $NOC['exporting_country_name'] . ' <br>';
//     $importerDetails .= 'Exporter name: ' . $NOC['ex_name'] . '<br>';
//     $importerDetails .= 'Exporter company name: ' . $NOC['ex_company_name'] . '<br>';
//     $importerDetails .= '<b>Exporter address :</b><br>';
//     $importerDetails .= 'Address: ' . $_SESSION['address']. '<br>';
//     // $importerDetails .= 'City: ' . $NOC['ex_city'] . '<br> State: ' . $NOC['ex_state'] . '<br>';
//     $importerDetails .= 'Exporter email ID: ' . $NOC['ex_email'] . '<br>';
//     $importerDetails .= 'Contact number of CITES Management Authority of the exporting country: ' . $NOC['contact_cites'] . '<br>';
//     $importerDetails .= 'Email ID of CITES Management Authority of the exporting country: ' . $NOC['email_cites'] . '</p>';
//     $importerDetails .= '</div>';

//     return $importerDetails;
// }
// done here


function Uploader_div($noc_id, $fileupload_id, $title, $noc, $required = false, 
                $instrations = '') {
    $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
    $buttonText = 'Upload';
    if (!empty($noc[$fileupload_id])) {
        $buttonText = 'Update file';
    }
    echo '<div class="container card-body">
      <h3 class="table-title1">', $title, '<sup class="required-icon', ($required ? ' show' : ''), '"></sup></h3>
      <form class="" method="POST" enctype="multipart/form-data">
        <input type="file" id="', $fileupload_id, '" name="', $fileupload_id, '" ', ($required ? 'required' : ''), '>
        <input name="noc-id" id="noc-id" value="', $noc_id, '" type="hidden" />
        
         <button type="submit" name="submit" value="Upload" class="btn btn-primary"><i class="fas fa-file-upload"></i> ', $buttonText, '</button><br />';
         

        if ($instrations !== '') {
            echo '<small class="instructions">', $instrations, '</small>';
        }
        echo '<br><br>
        '; // Add required icon
        if ($error) {
            echo '<div class="error-msg">' , $error , '</div>';
        }
        if (!empty($noc[$fileupload_id])) {
            displayFile($noc[$fileupload_id], 'Preview');
        }
        echo '
        
      </form>
    </div>
    ';
    if ($error) {
        unset($_SESSION['error']);
    }
}
// function uri_displayFile($uri_file, $label = null)
// {
//     if ($uri_file_type != null) {
//         $file_extension = pathinfo($uri_file_type, PATHINFO_EXTENSION);

//         if($label !== null){
//             echo '<br>', $label, ': <br>';
//         }


//          $file = IMG_URL. $uri_file_type . '/'. $file_id;

//         if (strtolower($file_extension) === 'pdf') {
//             echo ' <a href="', $file, '">Download ', $label, ' (PDF)</a><br>';
//         } else {
//             echo ' <a href="', $file, '"> <img  class="img-thumb-nfs" src="', $file, '" /></a><br>';
//         }

//     }    

// }


function displayFile($uri_file, $label = null)
{   

    $file = IMG_URL.'/'. $uri_file;
    // pre($file, 'Boom');
    if ($file != null) {
        $file_extension = pathinfo($file, PATHINFO_EXTENSION);

        if($label !== null){
            echo '<br>', $label, ': <br>';
        }


        if (strtolower($file_extension) === 'pdf') {
            echo ' <a href="', $file, '">Download ', $label, ' (PDF)</a><br>';
        } else {
            echo ' <a href="', $file, '"> <img  class="img-thumb-nfs" src="', $file, '" /></a><br>';
        }
    }
    else{
        
        set_message('Wrong File Display Request. ');
    }
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString; 

}





function filename_genator($inputName, $foldername){
    if(strchr($foldername, '/')){
        return $foldername;
    }
    return $foldername . '/' . generateRandomString(8);
}


function handleFileUpload($inputName, $foldername,  $maxWidth = 1200, $maxHeight = 1200)
{
    $extensions_arr = ['jpg', 'jpeg', 'png', 'pdf'];
    // pre($foldername);
    
    

    // file size check 
    if(($_FILES[$inputName]['size'] - 1048576 * FILE_UPLOADER_MAX_MB) > 0){
        set_message('File size exceeds the maximum limit of '.FILE_UPLOADER_MAX_MB.'MB.');
        header('Refresh:0');
        exit;
    }
    

    $fileType = strtolower(pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION));
    
    if (!in_array($fileType, $extensions_arr)) {
        set_message('You are try to upload a wrong file type. Please upload a file with the following extensions: '. implode(', ', $extensions_arr));
        header('Refresh:0');
        exit;
    }

    if(substr($_FILES[$inputName]['type'], 0, 5) === 'image' ){
        list($uploadedWidth, $uploadedHeight) = getimagesize($_FILES[$inputName]['tmp_name']);
        if ($uploadedWidth > $maxWidth || $uploadedHeight > $maxHeight) {
            set_message('Image dimensions are too large. Please upload an image with a maximum size of width '.
            $maxWidth.'px X height '.$maxHeight .'px.');
            header('Refresh:0');
            exit;
        }

        if($fileType === 'png'){
            // png to jpg conversion
            $image = imagecreatefrompng($_FILES[$inputName]['tmp_name']);
            $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
            imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
            imagealphablending($bg, TRUE);
            imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
            imagedestroy($image);
            $quality = 80; // 0 = worst / smaller file, 100 = better / bigger file
            imagejpeg($bg, $_FILES[$inputName]['tmp_name'], $quality);
            imagedestroy($bg);

        }
        $fileType = 'jpg';

    }

    
    
    
    $file_loc = '/' .  filename_genator($inputName, $foldername).'.'. $fileType;
    $targetFile =  IMG_PATH .  $file_loc;

    move_uploaded_file($_FILES[$inputName]['tmp_name'], $targetFile);
    
    return $file_loc;
    // return IMG_URL . $file_loc;
}

function show_noc_list($rows, $item_link = './admin_details.php?id=', $applicant_link = APP_URL.'/applicant_profile.php?id=') {

    
    if (sizeof($rows) == 0) {
        echo '<div class="alert alert-warning" role="alert"> No NOC is available in this category. </div>';
        return;
    }

    echo '<table class="table table-striped table-hover" style="font-size: .9em;">
    <thead>
        <tr>
            <th scope="col" style="text-align: center;">Application ID No.</th>
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
    // pre($rows[0]);

    for ($i = 0, $ilen = sizeof($rows); $i < $ilen; $i += 1) {
        $noc = $rows[$i];

        if ($noc['status'] == '99_rejected') {
            $item_link = 'full_details.php?id=';
        }

        $goto_link = ' <a href="' . $item_link . $noc['id'] . '"> ';
        $applicant_goto_link = ' <a href="' . $applicant_link . $noc['user_id'] . '"> ';
        echo '<tr>';
        // $noc['noc_type'],
        echo '<td>
           ', $goto_link, $noc['id'], '</a><br>',$goto_link,
            ' ',$noc['sub_of_noc']
           ,'</a></td>';

        if (empty($noc['memo_id'])) {
            echo '<td>', $goto_link, '</a></td>';
        } else {
            echo '<td >', $goto_link, $noc['memo_id'], '</a></td>';
        }

        echo '<td>', $goto_link, bd_date_format($noc['application_date']), '</a></td>';

        



        if($noc['purpose']=== 'Commercial'){
            echo '<td><small>Company </small><br> ', $applicant_goto_link, $noc['company_name'], '</a><br>';
            echo '<small>Applicant </small><br> ', $applicant_goto_link, $noc['applicant_name'], '</a></td>';

        }elseif($noc['purpose']=== 'Personal'){
            echo '<td>', $applicant_goto_link, $noc['applicant_name'], '</a></td>';
        }elseif($noc['purpose']=== 'Institution'){
            echo '<td>', $applicant_goto_link, $noc['applicant_name'], '</a></td>';

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


        // $noc_status_str = [
        //     '100_draft' => 'Draft Application',
        //     '200_vendor_submitted' => 'Application Submitted by Vendor',

        //     '201_vendor_application_incomplete' => 'Application Incomplete',

        //     //'300_initial_document_verification' => 'In Progress NOC Application (Initial Document validation)' ,
        //     '400_deskofficer_verification' => 'In Progress NOC Application (Deskofficer Verification)',
        //     '401_deskofficer_verification_incomplete' => 'Incomplete NOC Application for Deskofficer Verification',

        //     '500_DCF_verification' => 'In Progress NOC Application (DCF Verification)',
        //     '501_DCF_verification_incomplete' => 'Incomplete NOC Application for DCF Verification',

        //     '600_CF_verification' => 'In Progress NOC Application (CF Verification)',
        //     '601_CF_verification_incomplete' => 'Incomplete NOC Application for CF Verification',

        //     '700_CCF_verification' => 'In Progress NOC Application (CCF Verification)',
        //     '701_CCF_verification_incomplete' => 'Incomplete NOC Application for CCF Verification',

        //     '800_waiting_for_vendor_payment' => 'Waiting for applicant payment',
        //     '801_vendor_payment_inappropiate' => ' Inappropiate Payment NOC Application',
        //     // payment_check
            
        //     '850_payment_check' => 'In Progress NOC Application (Payment Verification)',
        //     '900_payment_confirmed' => 'In Progress NOC Application (NOC approve and final sign)',
        //     '950_waiting_for_printing' => 'Final signature done waiting for last activity',
        //     // Possible onemore level CCF check... 
        //     '1000_signed_document' => 'Download Signed NOC',
        //     '1050_inspection_document' => 'Used NOC',

        //     '99_rejected' => 'REJECTED',

        // ];
        global $noc_status_str;

        echo '<td>', $goto_link, $noc_status_str[$noc['status']], '</a></td>';
        echo '</tr>';
    }

    echo '</tbody>		
</table>';
}
function nav_links($key){


    $navLinks = [
            'list_of_nocs.php' => 'All NOCs',
            'home.php' => 'Home',
            'full_details.php' => 'NOC Application Details',
            'user_profile.php' => 'User Profile',
            'admin_details.php' => 'NOC Application Details',
            'applicant_profile.php' => 'Applicant\'s Profile',
            'vendor' => 'Applicant',
            'import' => 'Import',
            'export' => 'Export',
            'cities' => 'CITES',
            'cities_import' => 'CITES Import',
            'cities_export' => 'CITES Export',
            'non_cities_import' => 'NON-CITES Import',
            'non_cities_export' => 'NON-CITES Export',
            'non-cities' => 'NON-CITES',
            'all_list.php' => 'All NOCs',
            'admin' => 'Admin',
            'dashboard.php' => 'Dashboard',
            'create_new_noc.php' => 'New NOC Application',
            'add_species_on_nocs.php' => 'Add New Species',
            'noc_details.php'=>'NOC Details',
            'chalan_submit.php'=>'Submit Chalan Document',
            'all_list.php' => 'All NOCs',
            'list_of_nocs.php?status=100_draft' => 'Drafts',
            'list_of_nocs.php?status=200_vendor_submitted' => 'Submitted NOCs',
            'list_of_nocs.php?status=800_waiting_for_vendor_payment' => 'Waiting for Payment',
            'list_of_nocs.php?status=850_payment_check' => 'Check Payment Status',
            'list_of_nocs.php?status=1000_signed_document' => 'Approved NOCs',
            'list_of_nocs.php?status=99_rejected' => 'Rejected NOCs'
        ];
    
        $send = @$navLinks[$key];
        if(empty($send)){
            $send = ucfirst(strtolower(str_replace(['_', '.php'], ' ', $key)));
        }
    
        return $send;
    
    }

function breadcrumbs($separator = ' > ') { // &raquo; 
    $url = $_SERVER['REQUEST_URI'];
    $url = parse_url($url, PHP_URL_PATH);
    $url = str_replace(APP_URL, '', $url);
    
    $urlParts = explode('/', trim($url, '/'));
    $breadcrumbs = [];
    $crumb = '';
    $exclude = ['bfd-noc', 'f2'];

    // pre($url);
    // pre($urlParts, 'URL PARTS @@@??? ');
    



    
    



    echo '<section class="wp-breadcrumbs"><span class="breadcrumbs">';
    echo '<a href="' , APP_URL , '"> Home </a>';


    $partial_url = APP_URL;
    for($i=0, $ilen = sizeof($urlParts); $i < $ilen ; $i+=1 ){
        $partial_url .= $urlParts[$i] . '/'; 
        $show = nav_links($urlParts[$i]);
        echo $separator, '<a href="' ,  $partial_url , '"> ',$show,' </a>';
    }


    foreach ($urlParts as $part) {
        if (!in_array(strtolower($part), $exclude)) {
            $crumb .= '/' . $part;
            
            $breadcrumbs[] = '<a href="' . $crumb . '">' . nav_links($part) . '</a>';
           
        }
    }

    $breadcrumbs = implode($separator, $breadcrumbs);
    
    
    echo '</span></section>';
    

}