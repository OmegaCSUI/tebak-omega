<?php
    $GLOBALS['db_host']  = 'localhost';    
    $GLOBALS['base_url'] = 'http://localhost'; 
    $GLOBALS['cas_path'] = $_SERVER['DOCUMENT_ROOT']."/phpcas/CAS.php";
    $GLOBALS['sso_path'] = $_SERVER['DOCUMENT_ROOT']."/SSO/SSO.php";    
    $GLOBALS['db_username'] = "root";
    $GLOBALS['db_password'] = "";
    $GLOBALS['db_name'] = "anakomeg_games";    

    function show_msg($error_msg) {
        //TODO: TAMBAHIN PAGE ERROR
        die($error_msg);
    }

    function show_error($method_name, $error_code) {
        //TODO: TAMBAHIN PAGE ERROR
        die('error occured on '.$method_name.' : '.$error_code);
    }    
?>