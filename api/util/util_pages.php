<?php 


// include "./light/vendor/login.php";
/**
 * Generates an HTML snippet for a Bootstrap 5 alert message.
 *
 * @param string $message The content of the alert message. This can be any HTML content, including headings, paragraphs, and links.
 * @param string $type (optional) The type of alert message. This corresponds to the Bootstrap alert class and determines the visual style of the alert. Valid values are:
 *     - 'primary' (blue)
 *     - 'secondary' (light gray)
 *     - 'success' (green)
 *     - 'danger' (red, default)
 *     - 'warning' (yellow)
 *     - 'info' (light blue)
 *     - 'light' (very light gray background)
 *     - 'dark' (dark gray background)
 * @throws InvalidArgumentException If an invalid alert type is provided.
 * @return string The HTML code for the Bootstrap 5 alert message.
 */
function set_message($message, $type='danger'){
    if(!is_array(@$_SESSION['message'])){
        $_SESSION['message'] = [];
    }
    array_push($_SESSION['message'],  [
        'text' => $message,
        'alert' => $type
    ]);
}






function show_message(){
    if(!empty(@$_SESSION['message'])){

        echo '<section class="alert-area">';

        for($i=0, $ilen = sizeof($_SESSION['message']); $i<$ilen; $i+=1){
            echo '<div class="alert alert-', $_SESSION['message'][$i]['alert'],' msg">',
                $_SESSION['message'][$i]['text'];
            echo '
            </div>
            ';
        }
        
        echo '<script>
        (function() {
            // removing the message 3 seconds after the page load
            setTimeout(function() {
                document.querySelector(\'.msg\').remove();
            }, 15000)
        })();
        </script>
        
        </section>
        ';
        ;
        
        // $_SESSION['message']['text'] = null;
        // $_SESSION['message']['alert'] = null;
        $_SESSION['message'] = [];
        
    }

}


function page_blocking_message($title, $body){
    echo '<div style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
    <div style="margin: 10px auto; border: 1px dotted #dacaca;padding:20px; font-size:1.7em">
    <h1>',$title,'</h1>
    <p>',$body,'</p></div></div>';
}



function pre($data, $died = null){
    echo '<pre>';
    print_r($data);
    
    echo '</pre>';
    if($died !== null){
        page_blocking_message('Died Pre Killed', $died);

        die();
    }
}

function post_data(){

}



function write_css($css_list = [], $base_asset_url = ''){
    // global $js_add_footer;
   
    for($i=0,$ilen=sizeof($css_list);$i<$ilen; $i+=1){

        echo '<link rel="stylesheet" href="',$base_asset_url,$css_list[$i],'" >',PHP_EOL;
    }
}


$js_add_footer = [];
function add_js($array_js){
    
    global $js_add_footer;
    $js_add_footer = array_merge($js_add_footer, $array_js);
}



function write_js($js_array, $app_base_url){
    for($i=0,$ilen=sizeof($js_array);$i<$ilen; $i+=1){
        echo '<script src="',$app_base_url, $js_array[$i],'" data-jsindex=',$i,'></script>',PHP_EOL;
    }

}
function footer_add_extra_js($app_base_url = ''){
    global $js_add_footer;
    write_js($js_add_footer, $app_base_url);
}
$js_libs = []; // decleader in _a.php
function head_add_js($app_base_url = ''){
    global $js_libs;

    write_js($js_libs, $app_base_url);
}

function json_send($data) {

	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($data);
	exit();
}
