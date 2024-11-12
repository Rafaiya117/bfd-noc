<?PHP
include dirname(__FILE__).'/curl_utils.php';
include dirname(__FILE__).'/../util/_a.php';
Define('CITES_API_ENDPOINT', 'https://api.speciesplus.net/api/v1/');

// taxon_concepts.json?name=



class CITES_API{
    public $result_obj, $result_json_obj, $processed_obj, $speices_name, $base_uri = 'taxon_concepts.json?name=';
    
    public function process_update(){
        if(empty($this->result_obj)){
            $this->processed_obj = [];
            return [];
        }
        if($this->result_obj->pagination->total_entries === 0){
            $this->processed_obj = [];
            return [];
        }

        
        // print_r($this->result_obj);
        $cities_info = $this->result_obj->taxon_concepts[0];
        $cities_listing = @$this->result_obj->taxon_concepts[0]->cites_listings[0];


        if(empty($cities_listing)){
            $cities_listing = new stdClass;
            $cities_listing->appendix = 'NOT LISTED';
            $cities_listing->annotation = '';
            $cities_listing->effective_at = '0000-00-00';
            $cities_listing->id = NULL;
        }
        
        $common_names = '';
        $english_name = '';
        if(!empty($cities_info->common_names)){

            $ilen = sizeof($cities_info->common_names);
            for($i=0;$i<$ilen;$i+=1){
                if($cities_info->common_names[$i]->language === 'EN'){
                    
                    $common_names .= $cities_info->common_names[$i]->name . ', ';
                    if($english_name === ''){
                        $english_name = $cities_info->common_names[$i]->name;
                    }
                }
            }
            if($ilen > 0){
                $common_names = rtrim($common_names, ', ');
            }
        }
        


        // print_r($cities_listing);

        // print_r($cities_info);
        
       
        
            $this->processed_obj = [
                'cities_id' =>  $cities_listing->id,
                'common_names' =>@$common_names,
                'english_name'=>@$english_name,

                'scientific_name'=>@$cities_info->full_name,
                    'alt_scientific_name'=>@$cities_info->synonyms[0]->full_name,
                    'alt_scientific_name_2'=>@$cities_info->synonyms[1]->full_name,

                'cites_appendix'    => @$cities_listing->appendix,
                    'annotation'    => @$cities_listing->annotation,
                    'effective_at'  => @$cities_listing->effective_at,
                
                    'kingdom'   => @$cities_info->higher_taxa->kingdom,
                    'phylum'    => @$cities_info->higher_taxa->phylum,
                    'class'     => @$cities_info->higher_taxa->class,
                    'order'     => @$cities_info->higher_taxa->order,
                    'family'    => @$cities_info->higher_taxa->family,

            ];
        
        // echo '---------------------------------------------XX---------------------------------------------------------';
        // print_r($this->processed_obj);
        // die();
    }
    public function save_in_db(){
        global $db;
        if(empty($this->processed_obj)){
            $db->action('REPLACE into not_found_in_cites (scientific_name) values (?) ', $this->speices_name);
            return;
        }

        $db->action('REPLACE into cites_species  
                     (cities_id, common_names, english_name, 
                            scientific_name, alt_scientific_name, alt_scientific_name_2, 
                            cites_appendix, annotation, effective_at, 
                            kingdom, phylum, `class`, `order`, `family`
                              ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, 
                              ?,?,?,?,?
                              )  ', 
                              $this->processed_obj['cities_id'], $this->processed_obj['common_names'], $this->processed_obj['english_name'], 
                              $this->processed_obj['scientific_name'], $this->processed_obj['alt_scientific_name'], $this->processed_obj['alt_scientific_name_2'], 
                              $this->processed_obj['cites_appendix'], $this->processed_obj['annotation'], $this->processed_obj['effective_at'],
                              $this->processed_obj['kingdom'], $this->processed_obj['phylum'], $this->processed_obj['class'],  $this->processed_obj['order'], $this->processed_obj['family']
        );

    }

    public function __construct(){
        
    }

    public function action($speices_name){
        $this->speices_name = $speices_name;
        $this->result_json_obj = curl_call_cites_api($this->base_uri . htmlentities($speices_name));
        $this->result_obj = json_decode($this->result_json_obj);
        
        // print_r($this->result_obj);
        $this->process_update();
        
        // print_r($this->processed_obj);
        $this->save_in_db();
        return  $this->processed_obj;

    }
}


// echo 


$cities = new CITES_API;
// $p = $cities->action('Indotestudo elongata');

// $p = $cities->action('Vipera berus'); // not found
// Leatherback Sea Turtle
// $p = $cities->action('Dermochelys coriacea');
// // $p = $cities->action('Psittaciformes');
// $p = $cities->action('Parrots');
// // Psittaciformes
// print_r($p);