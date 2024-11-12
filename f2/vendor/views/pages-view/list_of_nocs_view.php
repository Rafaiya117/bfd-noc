<?php



$status = @$_GET['status'];
$goto_link = './noc_details.php?id=';
if($status === ''){
	$status = 'List of NOCs Draft Application';
}
if($status === '100_draft'){
	$headx = 'List of NOCs Draft Application';
}
if($status === '200_vendor_submitted'){
	$headx = 'List of NOCs Application Submitted by';
}
if($status === '300_initial_document_verification'){
	$headx = 'List of NOCs In Progress NOC Application (Initial Document validation)';
}
if($status === '400_deskofficer_verification'){
	$headx = 'List of NOCs In Progress NOC Application (Desk officer Verification)';
}
if($status === '500_DCF_verification'){
	$headx = 'List of NOCs In Progress NOC Application (DCF Signed for Approval)';
}
if($status === '600_CF_verification'){
	$headx = 'List of NOCs In Progress NOC Application (CF Signed for Approval)';
}
if($status === '700_CCF_verification'){
	$headx = 'List of NOCs In Progress NOC Application (CCF Verification)';
}
if($status === '800_waiting_for_vendor_payment'){
	$headx = 'List of NOCs Waiting for Conservator of Forests Sign NOC';
}
if($status === '850_payment_check'){
	$headx = 'List of NOCs In Progress NOC Application (Payment Verification)';
}
if($status === '900_payment_confirmed'){
	$headx = 'List of NOCs Payment Confirmed, Waiting for Conservator of Forests Sign NOC.';
}
if($status === '1000_signed_document'){
	$headx = 'Download Signed NOC';
	$goto_link = APP_URL.'noc_download.php?id=';
}

if($status === '101_plus'){
	$headx = 'List of Submitted NOCs ';
	$rows = $db->select('SELECT * from noc_import  where SUBSTRING_INDEX(status, "_", 1)  != 100 AND noc_type = ? and user_id = ? order by id desc limit 100',  $type_noc, auth()['id'] );
}

if(empty($rows )){
	$rows = $db->select('SELECT * from noc_import  where `status` = ? AND noc_type = ? and  user_id = ?  order by id desc limit 100', $status, $type_noc, auth()['id'] );
}


// $goto_link = './noc_details.php?id=';


  pg_header();
  show_banner('cites_non_cites');
  pg_topnavbar();
  pg_topnavbar2();
  breadcrumbs();
?>


<div class="container">
	<div class="table-responsive">
		<div class="table-wrapper card">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h3 style="color:  #FFFFFF"><?php echo $headx ?></h3>
					</div>
					<div class="col-sm-6"></div>
				</div>
			</div>
			
			<?php
			show_noc_list($rows, $goto_link);
			?>
		</div>
	</div>
</div>

<?php pg_footer();
