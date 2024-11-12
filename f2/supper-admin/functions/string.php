<?PHP

$noc_status_str = [
    'draft' => 'Draft',
    'waiting' => 'Waiting',

    'waiting for sign' => 'Waiting for Signature',
    'waiting for payment' => 'Waiting for Payment',
    'payment_check' => 'Payment Check',
    'for payment' => 'For Payment',
    'waiting for approval2' => 'Waiting for Deputy Ranger Sign NOC',
    'waiting for approval3' => 'Waiting for Conservator of Forests Sign NOC',
    'waiting for approval' => 'Waiting for Conservator of Forests Sign NOC',

    'approved' => 'Approved',
    'rejected' => 'Rejected',
];


// document verification 
// 



$status_to_headx =[
	'draft' => 'List of Draft NOC',
	'waiting' => 'List of Waiting NOC',
	'waiting for payment' => 'List of Waiting for Payment NOC',
	'for payment' => 'List of Waiting for Payment NOC',
	'for sign' => 'List of Waiting for Conservator of Forests Sign NOC',
	'waiting for sign' => 'List of Waiting for Conservator of Forests Sign NOC',
	'waiting for approval' => 'List of Waiting for Conservator of Forests Sign NOC',
	'payment_check' => 'Payment Done NOCs',
	'approved' => 'List of Approved NOC',
	'rejected' => 'List of Rejected NOC',
	'waiting for approval2' => 'List of Waiting for Deputy Ranger Sign NOC',
	'waiting for approval3' => 'List of Waiting for Conservator of Forests Sign NOC',
];



// status follow right now

// 100_draft
// 200_vendor_submitted
// 300_pending_document_verification_initial
// 400_pending_verification_deskofficer
// 500_pending_verification_DCF
// 600_pending_verification_CF
// 700_pending_approval_CCF
// 800_waiting_for_vendor_payment
// 900_payment_confirmed
// 1000_final_signed_by_CF





$noc_status_str = [
    '100_draft' => 'Draft Application',
    '200_vendor_submitted' => 'Application Submitted by Applicant',

    '300_initial_document_verification' => 'In Progress NOC Application (Initial Document validation)',
    '400_deskofficer_verification' => 'In Progress NOC Application (Deskofficer Verification)',

    '500_pending_verification_DCF' => 'In Progress NOC Application (DCF Signed for Approval)',
    '600_pending_verification_CF' => 'In Progress NOC Application (DCF Signed for Approval)',
    '700_pending_approval_CCF' => 'Waiting for Deputy Ranger Sign NOC',
    '800_waiting_for_vendor_payment' => 'Waiting for Conservator of Forests Sign NOC',
    '900_payment_confirmed' => 'Waiting for Conservator of Forests Sign NOC',

    '1000_final_signed_by_CF' => 'Approved',
    
];