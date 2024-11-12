<?php 


// die("lcok");


function check_signature_and_licence_validity(){
    // print_r(auth());
    global $db;
    $user_id = auth()['id'];
    $user =  $db->select('SELECT * from vendor where id = ?', $user_id);

    $aplicant = $user[0];
    if(empty($aplicant['signature']) && empty($aplicant['nid_copy'])){
        set_message('Please upload your signature and NID copy first, before you create new NOC.', 'info');
        header('Location:../vendor_signature.php'); 
        exit();
    }
    if($aplicant['purpose'] === "Commercial"){
        $validityDate = $aplicant['company_licence_validity'];
        
        $currentDate = date('m/d/Y'); 
        if (strtotime($validityDate) >= strtotime($currentDate)) {
            //header('Location: ');
        } else {
            set_message('Validity is expired', 'info');
            header('Location:../login.php');
            //echo "Validity is expired";
        }
    }
}

function licence_validity_check(){


}