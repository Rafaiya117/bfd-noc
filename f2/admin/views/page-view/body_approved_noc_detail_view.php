<?php

function _image_endcore($img){
    global $pdf_gen;
    
    
    
    if($pdf_gen){
        $re =  base64_encode(file_get_contents( IMG_PATH.$img ));
        echo 'data:image/jpg;base64,',$re ;
    }else{
        echo IMG_URL,$img;
    }
    
    

}

function _inwords($number){
    $number = (int)$number;
    $words = [
        'zero',
        'one',
        'two',
        'three',
        'four',
        'five',
        'six',
        'seven',
        'eight',
        'nine',
        'ten',
        'eleven',
        'twelve',
        'thirteen',
        'fourteen',
        'fifteen',
        'sixteen',
        'seventeen',
        'eighteen',
        'nineteen',
        'twenty',
        30 => 'thirty',
        40 => 'forty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'eighty',
        90 => 'ninety'
    ];
    if ($number < 21) {
        return $words[$number];
    }
    if ($number < 100) {
        $tens = (int)($number / 10) * 10;
        $units = $number % 10;
        return $words[$tens] . ($units ? '-' . $words[$units] : '');
    }
    if ($number < 1000) {
        return $words[(int)($number / 100)] . ' hundred' . ($number % 100 ? ' ' . _inwords($number % 100) : '');
    }
    return $words[(int)($number / 1000)] . ' thousand' . ($number % 1000 ? ' ' . _inwords($number % 1000) : '');
}
function _noc_head($noc){ ?>

    
    <div class="row">
        <div class="col-2" style="float:left;">
            
                <p>1.Original NOC No. BD/EXP-001/2023</p>
                <p>2.Valid Until:&nbsp; 
                    <?php echo bd_date_format($noc['validity_date']); ?> 
                </p>
            
        </div>
        
        <div class="col-6" style="text-align:center; float:left;">
            
                <p>Government of the People's Republic of Bangladesh</p>
                <p>Office of the Chief Conservator of Forests</p>
                <p>Bangladesh Forest Department</p>
                <p>Ban Bhaban, Agargaon, Dhaka</p>
                <p>www.bforest.gov.bd</p>
            
        </div>
    </div>
    <div class="clear"></div>
    
    
    
<?php }
function _noc_memo_date($noc){ ?>
    <div class="row">
        <div class="col-7" style="text-align:left;float:left;">
            <p>Record Number: <?php echo $noc['memo_id'];?></p>
        </div>
        <div class="col-4" style="text-align:right;float:left;">
            <p>Date: <?php echo bd_date_format($noc['approved_date']);?> </p>
        </div>

    </div>
    <div class="clear"></div>
<?php
}

function _noc_subject($noc){?>
<div class="row">
        <div class="col-md-12" style="text-align:left;">
            <p>Subject: <b>No Objection Certificate (NOC) for 
                <?php 
                    echo $noc['noc_type'],'ing ' , $noc['sub_of_noc'],  ' ', strtolower($noc['category']), ' from ', $noc['exporting_country_name'], ' to Bangladesh. ';
                
                ?> </b></p>
        </div>

</div>
<?php } 


function _noc_importer_exporter_name($noc){
?>
<br>
 <div class="row">
        <div class="col-md-12" style="text-align:left;">
            <p>
            <?php 
                echo 'With reference to the above mention subject, 
                        the undersigned is directed to issues No Objection Certificate (NOC) for ';
                
                echo '';
                echo $noc['noc_type'],'ing ';
                 if($noc['sub_of_noc'] === 'CITES'){
                    echo 'CITES-listed ';
                 }else{
                    echo 'Non-CITES ';
                 }
                 echo ' ', strtolower($noc['category']), ' from ', $noc['exporting_country_name'], ' to Bangladesh for ', strtolower($noc['purpose']), ' purpose. ';
                
            ?> 
            </p>
        </div>

    </div>
<div class="row">
    <table class="table">
        <tr>
            <th></th>
            <th> <?php echo ucfirst($noc['noc_type']), 'er '; ?> </th>
            <th> <?php 
                        if($noc['noc_type']==='import'){
                            echo 'Exporter/Re-exporter';
                        }else{
                            echo 'Importer';
                        }

            
            ?> </th>
        </tr>
        <tr>
            <th> Name</th>
            <td> <?php 
                if($noc['purpose'] === 'Commercial'){
                    echo $noc['applicant']['company_name'];
                    echo '<br>BFD License No # ', $noc['applicant']['company_licence_num'];
                }else{
                    echo $noc['applicant']['name'];
                }
            ?> </td>
            <td>
            <?php               
                echo $noc['ex_company_name'];
               
            ?> 
        </td>
        </tr>
        <tr>
            <th> Address</th>
            <td> <?php 
            
                echo $noc['applicant']['address'], '.<br>Phone # ', $noc['applicant']['phone'], '<br>Email # ', $noc['applicant']['email'];
            ?> </td>
            <td>
            <?php               
                echo $noc['ex_address'], '.<br>Phone # ', $noc['ex_phone'], '<br>Email # ', $noc['ex_email'];
               
            ?> 
        </td>
        </tr>
    </table>


    </div>
   
    <br>

<?php }

// function _noc_body($noc){};
function _noc_animals($noc){?>
    <div class="row">
        <div class="col-md-12" style="text-align:left;">

            <table class="table" >
                <tr>
                    <th>SL No.</th>
                    <th>Country</th>
                    <th>Common Name</th>
                    <th>Scientific Name </th>
                    <th>Appendix</th>
                    <th>Quantity</th>
                    <th>Ring ID / Image</th>
                </tr>
                <?php 
                    $i = 1;
                    // $len = count($noc['species']);
                    foreach($noc['species'] as $species){
                        echo '<tr>';
                        echo '<td>',$i,'</td>';
                        echo '<td>',$noc['exporting_country_name'],'</td>';
                        echo '<td>',$species['species_english_name'],'</td>';
                        echo '<td>',$species['species_scientific_name'],'</td>';
                        echo '<td>',$noc['sub_of_noc'],'</td>';
                        echo '<td>',$species['quantity'], ' ('
                                ,_inwords($species['quantity']) 
                                ,') heads</td>';
                        echo '<td>'; 
                        if(!empty($species['ring_number'])){
                            echo $species['ring_number'], '<br>';
                        }
                        if(!empty($species['species_images'])){
                            
                             echo '<img src="',_image_endcore($species['species_images']),'" style="max-width: 50px; max-height: 50px;">';
                        }
                        echo '</td>';
                        echo '</tr>';
                        $i++;
                    }
                ?>
            <tr>
                <td colspan="4"></td>
                <td>Total</td>
                <td><?php echo $noc['headcount'] ,' ('
                                ,_inwords($noc['headcount']) 
                                ,') heads'; ?></td>
                <td></td>
            </tr>
            </table>
        </div>
    </div>
    <br>
<?php }
function _noc_conditions($noc){
    echo ' <div class="row">
        <div class="col-md-12" style="text-align:left;">';
    echo '<div style="text-align:left;">
				<u>Conditions:</u>';
                
				echo '<ol class="ol-num" style="margin-left:20px; list-style-type:auto;">
                <li>Imported birds must be kept in cages, so that they could not come in contact with any other animals.</li>
                <li>Imported cage birds cannot be released in nature.</li>
                <li>Dead birds must be buried deep in the ground. </li>
                <li>After import, rings must be worn on the legs of imported birds within 7(seven) days and inform the licensing authority.</li>
                <li>This NOC is not transferable and the import of wild birds is strictly prohibited.</li>
                <li>This NOC is issued for one consignment only. </li>';
                if (!empty($noc['conditions'])) {
                    $conditions = explode("\n", $noc['conditions']);
                    
                    foreach ($conditions as $condition) {
                        //echo '<li>' . trim($condition) . '</li>';
                        echo '<li>' , trim($condition) , '</li>';
                    }
                }
				echo '</ol>';
				echo '</div><br>';
    echo '</div></div>';
};
function _noc_signatory_qr_code($noc){?>
    <div class="row">
        <div class="col-md-3" style="text-align:center;float:left">
            <?php if($noc['qr_code']){ 
            echo  '<img src="', _image_endcore($noc['qr_code']), '" style="max-width: 100px; max-height: 100px;" > <br>';

            } ?>
            
        </div>
        <div class="col-md-4"  style="float:left;" >    </div>
        <div class="col-md-4 sign" style="float:left; text-align:center;" >
            

            <?php 
                
                if($noc['signatory']['id']){ 
                    
                
                echo  '<p><img src="', _image_endcore('/admin_sign/'.$noc['signatory']['id'].'.jpg'), '" style="max-width: 100px; max-height: 100px;" ></p>';
                echo '<p>', bd_date_format($noc['approved_date']),'</p>';
                echo '<p>',$noc['signatory']['name'],'</p>';
                echo '<p>',$noc['signatory']['designation'],'</p>';
                echo '<p>Phone: ',$noc['signatory']['phone'],'</p>';
                echo '<p>Email: ',$noc['signatory']['email'],'</p>';

            } ?>

            
        </div>
    </div>
    <div class="clear"></div>
<?php };
function _noc_signatory_small($noc){ ?>
    <div class="row">
    <div class="col-md-4" style="text-align:left; float:left;">
        
        <!-- <br><br>
        Chief Controller, CCI&E -->
    </div>
    <div class="col-md-3" style=" float:left;">    </div>
    <div class="col-md-4 sign" style="text-align:center; float:left;">
        
        <?php 
        if($noc['signatory']['id']){ 
            echo  '<p><img src="', _image_endcore('/admin_sign/'.$noc['signatory']['id'].'.jpg'), '" style="max-width: 100px; max-height: 100px;" ></p>';
            echo '<p>', bd_date_format($noc['approved_date']),'</p>';
            echo '<p>',$noc['signatory']['name'],'</p>';
            echo '<p>',$noc['signatory']['designation'],'</p>';
        
        } 
        ?>

        
    </div>
    </div>
    <div class="clear"></div>
<?php };
function _noc_footer($noc){};

function _noc_copy_forward($noc){
    

    echo '<div style="padding-left:20px;"> 
                <p>Copy forworded for information and necessary action:</p>
                <li>Commissioner of Customs, Customs House, Hazrat Shahjalal International Airport, Dhaka.</li>
                <li>Executive Director, Bangladesh Civil Aviation Authority. Hazrat Shahjalal International Airport, Dhaka.</li>
                <li>Director, Wildlife Crime Control Unit, Bana Bhaban, Agargaon, Dhaka. </li>
                <li>Deputy Conservator of Forest, RIMS Unit, Ban Bhaban, Agargaon, Dhaka. Please publish this NOC in Forest Departments website.</li>
                <li>Divisional Forest Officer, Wildlife Management and Nature Conservation Division, Dhaka.</li>
                <li>Deputy Conservator of Forest, Wildlife and Nature Conservation Circle, Ban Bhaban, Agargaon, Dhaka.</li>
                <li>Assistant Director, Livestock Quarantine Station, Terminal-1, Hazrat Shahjalal International Airport, Dhaka</li>
                <li>Ms. Fa-Tu-Zo Khaleque Mila/Ms. Shakila Nargis, Wildlife & Biodiversity Conservation Officer, Ban Bhaban, Agargaon, Dhaka-1207. </li>
                <li>'; 
                
                if($noc['purpose'] === 'Commercial'){
                    echo $noc['applicant']['company_name'];
                }else{
                    echo $noc['applicant']['name'];
                }
                
                echo  ', ', $noc['applicant']['address'], '.</li>
                </div>';
};





// pre($NOC);
// $id = $_SESSION['pdf-gen-noc-id'];
$noc_id = null;
if(!empty(@$_GET['id'])){
    $noc_id = @$_GET['id'];
}
if(!empty(@$NOC)){
    $noc_id = @$NOC['id'];
}

if(!$noc_id){
    pre('','THIS IS NOT A VALID NOC ID. aaaa'. $noc_id);
}else{

    $row = $db->select('SELECT * from noc_import where id = ? and `status` = "1000_signed_document" limit 1', $noc_id);   
    if (empty($row)) {
        pre('','THIS IS NOT A VALID NOC  ??? ID');
    }
    $noc = $row[0];
    

    $aplicant_id = $noc['user_id'];
    $admin_bar = json_decode($noc['admin_bar_status'], true);
    $signatory_id = $admin_bar['1000_signed_document']['id'];

    $noc['species'] = $db->select('SELECT * from imp_noc_species_duplicate where noc_id = ? order by id ', $noc_id);   
    $noc['applicant'] = $db->select('SELECT * from vendor where id = ?',$aplicant_id)[0];
    $noc['signatory'] = $db->select('SELECT * from users where id = ? limit 1', $signatory_id)[0];

    // pre($noc ,'see this? ');


    

}


// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// 	$condition_array = array_map('trim', explode("\n", $_POST['conditions']));
// }
$css_sites = [
    'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css'
];

// pre($css_libs);


if(@$pdf_gen === true){
    $css_libs = [
    
        'assets/css/all.css',
        'assets/css/default.css',
    
    ];
}else{
    $css_libs = [
        'assets/css/all.css',
        'assets/css/default.css',
        'assets/css/dashboard.css',
        'assets/css/noc.css',
    ];
}

// pre($css_sites);
// pre($css_libs);

?>


<!doctype html>
<html lang="en">
<head>
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--====== Title ======-->
    <title>BFD Online NOC Application System</title>
    <?php 
  
    echo '<!--all CSS!! --->',PHP_EOL;
    write_css($css_sites, ''); 
    write_css($css_libs, VENDOR_URL);
    
    ?>

<style>
        <?php if(@$pdf_gen){ ?>
        @page { margin: 0; 
            size: 21cm 29.7cm; 
            padding: .5cm;

        }
        body{
            /* font-size: 12px; */
             /* padding: .1cm;  */
            
            /* border: 1px red solid; */

            width: 20cm;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            padding: .25cm;
        }
        body > *{
            margin: 0px;
            padding: 0px;
        }
        
        .row{
            /* border: 1px solid limegreen; */
        }
        .row > div{
            /* border: 1px solid skyblue; */
            display: grid;
            
        }
        .row > div > *{
            /* border: 1px solid yellow; */
        }
       
        .row > .sign > p{
            margin: 0;
            padding: 0;
            /* border: 1px solid red; */
        }
        
        <?php } ?>

        table{
            font-size: 0.7em;
        }
        .clear{
            clear:both;
            margin: 10px 0;
        }
        
    </style>
    <!--====== Favicon Icon ======-->
</head>
<body>
    
<div class="container">
    <div class="">
        <div class="">
        
                <?php  
                _noc_head($noc);
                _noc_memo_date($noc);
                _noc_subject($noc);
                _noc_importer_exporter_name($noc);
                _noc_animals($noc);
                _noc_conditions($noc);
                _noc_signatory_qr_code($noc);
                echo '<br>';
                _noc_memo_date($noc);
                _noc_copy_forward($noc);
                _noc_signatory_small($noc);
					    // headerAll($NOC['sub_of_noc'], $NOC['category'], $NOC['memo_id'], $NOC['application_date'],$NOC['validity_date']);
    
				
                ?>
		
        <?php
        if(!@$pdf_gen ){

        
            file_show($noc, $noc['applicant']);
        }
        ?>
    </div>
</div>
    </div>

    
</body>
</html>
