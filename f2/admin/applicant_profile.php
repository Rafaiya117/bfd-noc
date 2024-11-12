<?php
include '_a.php';

$user_id = $_GET['id'];
// $applicant_data = $db->select('SELECT user_id from noc_import where id = ?', $application_id);
// $user_id = $applicant_data[0]['user_id'];

$user_info = $db->select('SELECT * from vendor where id = ?', $user_id);
if(empty($user_info)){
    set_message('Unknown Applicant ID. ', 'error');
    header('Location: ' .APP_URL. '/dashboard.php');
    exit();
}
$user_info = $user_info[0]; 

$data = $db->select('SELECT * from noc_import where user_id = ? and `status` != "100_draft"', $user_info['id']);


// echo'<pre>';
// print_r($data);
// echo'</pre>';


pg_header();

show_banner('home', 'Applicant\'s Profile :: ' . $user_info['name']);
pg_topnavbar();
// pg_navbar2();
breadcrumbs(' > ');

 
function _lvtb($label, $value){
    echo  
            '<h6 class=profilel >',$label,' </h6>
                 <h5 class=profiled > ',$value,' </h5>';

}

$img_cap = '<br><img class="ih80" src="'. IMG_URL;

$sign = '<small class="error">Signature not Found. </small>';
$nid_copy = '<small class="error">NID is not Uploaded. </small>';
if($user_info['signature'] != ''){ 
   $sign = $img_cap . $user_info['signature']. '" />';
}

if($user_info['nid_copy'] != ''){ 
   $nid_copy = $img_cap . $user_info['nid_copy']. '" />';
}



?> 
<br />

<div class="container">
<h4> Applicant / Company Profile </h4>
</div>
<div class="table-responsive">

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                
                

            <th scope="col">
            <?php 
                    if($user_info['purpose'] === 'Commercial'){
                        _lvtb('Company','<a href="#">' .$user_info['company_name']. '</a>');
                        
                        _lvtb('Address', $user_info['address']);

                        // _lvtb('Phone', $user_info['phone']);
                        _lvtb('Licence No', $user_info['company_licence_num']);
                        _lvtb('Licence Validity', $user_info['company_licence_validity']);
                        

                        
                    }elseif($user_info['purpose'] === 'Institution'){
                        _lvtb('Applicant ', $user_info['name']);
                        _lvtb('Institution ', $user_info['institutional_name']);
                        
                        _lvtb('Address', $user_info['institutional_address']);

                        _lvtb('Phone', $user_info['intitute_email']);
                    }if($user_info['purpose'] === 'Personal'){
                        _lvtb('Name', $user_info['name']);
                        
                        _lvtb('Address', $user_info['address']);

                        // _lvtb('Phone', $user_info['phone']);
                    }
                
                ?>
                </th>
                <th scope="col">
                 <?php _lvtb('Account Type', $user_info['purpose']); 
                 
                //  if($user_info['purpose'] === 'Commercial'){

                //  }
                 ?>
                </th>
            </tr>
                <th scope="col">
                 <?php 
                 _lvtb('Applicant Name', $user_info['name']); 
                  _lvtb('Phone', $user_info['phone']); 
                  _lvtb('NID', $user_info['nid']); 
                  _lvtb('Email', $user_info['email']);
                  
                  ?>
                </th>
                <th scope="col">
                 <?php 
                
                 
                
                 _lvtb('Signature', $sign);
                 _lvtb('NID Copy', $nid_copy); 
                 
                 ?>
        </thead>
        
    </table>
</div>

<?php
// pre($user_info );
// <th style="text-align: center;">Importer Detail<br>(Company/Individual)</th>
//  echo '<td>' , $row['applicant_name'] , ' (' , $row['applicant_address'] , ')</td>';
?>


<div class="container">
<h6> Applicant's NOC List </h6>
</div>

<table class="table  table-striped table-hover" style="font-size: .9em;">
<thead>
    <tr>
        <th scope="col"style="text-align: center;">ID</th>
        <th style="text-align: center;">Memo No. & <br> Application Date</th>
        <th style="text-align: center;"> Type</th>

        
        
        <th style="text-align: center;">Source / Exporting Country</th>
        <th style="text-align: center;">Total Head</th>            
        <th>Status</th>
    </tr>
</thead>

<tbody>
<?php 
// pre();
foreach ($data as $row) {
    // echo'<pre>';
    // print_r($row);
        // pre($row);
        if($row['memo_id']==''){
            $row['memo_id'] = '<small>Memo not issued.</small>';
        }
        echo '<tr>';
        echo '<td>' , $row['id'] , '</td>';
        echo '<td>' , $row['memo_id'],'<br >', $row['application_date'] , '</td>';
        echo '<td>' , $row['sub_of_noc'], ' - ' ,$row['noc_type'] , '</td>';
       
        echo '<td>' , $row['exporting_country_name'] , '</td>';
        echo '<td>' , $row['headcount'] , '</td>';
        echo '<td>' , $status_to_headx[$row['status']] , '</td>';
        echo '</tr>';
    
 }
// noc_type sub_of_noc

if(empty($data)){
    echo '<tr><td colspan="7" style="text-align:center;">No NOC found</td></tr>';
} 

echo '</tbody>		
</table>';

pg_footer();
