<?PHP


function update_headcount_all(){
    global $db;
    $db->action('UPDATE noc_import 
            set headcount = IFNULL((SELECT sum(quantity)
                    FROM `imp_noc_species_duplicate` where `noc_id` = noc_import.id ),0) where  `status`="1000_signed_document"');
}


function update_headcount($noc){
    global $db;
    $db->action('UPDATE noc_import 
            set headcount = IFNULL((SELECT sum(quantity)
                    FROM `imp_noc_species_duplicate` where `noc_id` = ? ),0) where  id = ? limit 1;',
     $noc['id'], $noc['id']
    );
}



// update_headcount(['id'=>672]);


// pre(
    
//     $db->select('SELECT sum(quantity) as headcount
// FROM `imp_noc_species_duplicate` where `noc_id` = 672')[0], );

// update_headcount(['id'=>672]);

// pre($db->select('SELECT id, headcount FROM noc_import WHERE id = 672')[0], 'headcount');