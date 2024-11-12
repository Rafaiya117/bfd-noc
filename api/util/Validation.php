<?php
/*

  $fields = [
    'name'=> ['type'=>'string', 'required'=>true, 'length'=> 5],
    'address'=> ['required'=> true, 'length'=> 10],
    'email'=> ['type'=>'email', 'required'=>true],
    'age'=> ['type'=>'int', 'required'=>true],
    'time'=> ['required'=>true]    
  ];

  $validationErrors = Validation::user_input_rq($fields);
if($validationErrors == ''){
    echo 'No Errors';
} else {
    echo 'Errors Found';
};

*/


class Validation {
    public static function sanitizeInput($data, $dataType = 'string') {
        $sanitized = filter_var($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

        if ($dataType == 'int') {
            $sanitized = filter_var($sanitized, FILTER_SANITIZE_NUMBER_INT);
            $sanitized = (int) $sanitized;
        } else if ($dataType == 'email') {
            $sanitized = filter_var($sanitized, FILTER_VALIDATE_EMAIL);    
        } else if ($dataType == 'url') {
            $sanitized = filter_var($sanitized, FILTER_VALIDATE_URL);
        }

        return $sanitized;
    }

    public static function user_input_rq($meta_fields){
        $errors = '';
        $required_array = [];
        $keys = array_keys($_POST);
        for($i=0, $ilen = count($keys); $i< $ilen; $i++){
            $key = $keys[$i];
            $data_type = 'string';
            if (isset($meta_fields[$key])) {
                if (isset($meta_fields[$key]['type'])) {
                    $data_type = $meta_fields[$key]['type'];
                }
            } 
            $_POST[$key] = self::sanitizeInput($_POST[$key], $data_type);
        }

        $keys = array_keys($meta_fields);
        for($i=0, $ilen = count($keys); $i< $ilen; $i++){
            $key = $keys[$i];
            $field = $meta_fields[$key];
            
            if (isset($field['required']) && $field['required']) {
                if(empty(@$_POST[$key]) ){
                    $errors .= 'Required Field Empty : '. $key . ' <br> '. PHP_EOL;
                    continue;
                }
            }
            if (isset($field['length']) && strlen(@$_POST[$key]) < $field['length']) {
                $errors .= 'Field Length should be more then '. $field['length'] 
                                .'  : '. $key . ' <br> '. PHP_EOL;
            }
        }

        if (!empty($errors)) {
            
            return $errors;
        }
        return '';
    }
}


