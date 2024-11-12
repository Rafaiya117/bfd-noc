<?php 

require_once _A_API_FILE_LOCATION. '../lib/dompdf/autoload.inc.php'; 
require _A_API_FILE_LOCATION. '../lib/dompdf/vendor/autoload.php';

use Dompdf\Dompdf;

function pdf_downloader($file_name, $html) {
  $options = new \Dompdf\Options();
  $options->set('isRemoteEnabled', true);
  $dompdf = new Dompdf($options);
  $dompdf->loadHtml($html);
  $dompdf->setPaper('A4', 'landscape');
  // $dompdf->
  $dompdf->render();
  $dompdf->stream($file_name);
}


function pdf_store($file_name, $html) {
    $options = new \Dompdf\Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    // $dompdf->stream($file_name);
    $output = $dompdf->output();
    file_put_contents(IMG_PATH.'//noc_pdf/'.$file_name, $output);
    return '//noc_pdf/'.$file_name;

  }



// pdf_downloader('Action.pdf', print_r($NOC, true));

// pdf_store('action.pdf', print_r($NOC, true));



$pdf_gen = false;
function pdf_gen($NOC){

    // $html = file_get_contents(BASEURL . 'f2/admin/pdf_viewer.php?id=' . $NOC['id']);
    // echo $html;
    ob_start();
    // $_GET['id'] = $NOC['id'];
    global $db, $css_libs,$css_sites, $pdf_gen;
    $pdf_gen = true;
    include THIS_A_FILE_LOCATION. 'pdf_viewer.php';
    $html = ob_get_clean();

    return [
        'pdf_location' => pdf_store($NOC['memo_id'].'.pdf', $html), 
            'html'=>$html];

    // file_put_contents(IMG_PATH.'//noc_pdf/'.$NOC['id'].'.html', $html);
    // echo $html;
    // pre($NOC, "PDF GEN!!");
}


//