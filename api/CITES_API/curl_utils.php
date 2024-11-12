<?PHP 

function curl_call_cites_api($uri){
    global $config;

    $headers = [
        // 'accept: application/json',
        // 'Content-Type: application/json',
        $config['cities_api_token'] 
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, CITES_API_ENDPOINT.$uri);

    // echo  $config['apiEndPoint'].$uri;

    // curl_setopt($ch, CURLOPT_POST, 1);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));  
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    
    $server_output = curl_exec($ch);
    if($server_output === false)
    {
        echo 'Curl error: ' . curl_error($ch);
    }
    curl_close($ch);
    
    return $server_output;
}  