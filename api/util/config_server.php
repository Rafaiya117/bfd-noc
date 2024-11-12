<?PHP
// $config['clientId'] = 'V1:368042:LW9K:AA';
// $config['clientSecret'] = 'TP02989'; 
function setup_database(){
    
    global $config;
    $config = [];
   
    $config['cities_api_token'] = 'X-Authentication-Token:0fg9aiigpeqbvaQQJFMUogtt';
    $config['db_host'] = 'localhost';
    $config['db_username'] = 'root';
    $config['db_pass'] = '##lolita56##BAN';
    $config['db_name'] = 'cities_noc';

}



define('SITEURL', 'https://wcs.softlh.com/bfd-noc/f2/');
define('BASEURL', 'https://wcs.softlh.com/bfd-noc/');
define('IMG_URL', 'https://wcs.softlh.com/bfd-noc/file_upload');
define('IMG_PATH', dirname(__FILE__).'/../../file_upload');