<?php 


function _auth_login_call(){
    set_message("Kindly log in to access this page.", $type='primary');
    header('location:'.APP_URL.'login.php');
    exit();
}



function must_login($level = 0){
    if(empty(@$_SESSION[APPNAME])){
        _auth_login_call();
    }
    
    if (!isset($_SESSION[APPNAME]) &&  !isset($_SESSION[APPNAME]['email'])) {
        _auth_login_call();
    }
    // if($level > 0){
    //     if($_SESSION['level'] < $level){
    //         header("login.php");
    //         exit();
    //     }
}


function auth_set($user){
    $_SESSION[APPNAME] = $user;
    $_SESSION[APPNAME]['time'] = time();
}

function auth(){
    return @$_SESSION[APPNAME];
}

function auth_logout(){
    unset($_SESSION[APPNAME]);
    $_SESSION[APPNAME] = [];
    // session_destroy();
}


// function login_check() {
  
//     if(empty($_SESSION['email'])) {
        
//         echo "<p>You are not logged in. Please <a href='../login.php'>login</a> to continue.</p>";
//         exit();
//     }
// }

// function login_check_home() {
  
//     if(empty($_SESSION['email'])) {
        
//         echo "<p>You are not logged in. Please <a href='login.php'>login</a> to continue.</p>";
//         exit();
//     }
// }

// pre($_SESSION, 'k');