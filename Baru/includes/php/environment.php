<?php
	$GLOBALS['db_host']	  = 'localhost';
	$GLOBALS['db_username']   = 'anakomeg_root';
	$GLOBALS['mediawiki_url'] = 'wiki';
	$GLOBALS['db_password']   = 'omega!2016!';
	$GLOBALS['db_name'] 	  = 'anakomeg_portal';
	$GLOBALS['base_url']	  = 'http://localhost';	
	$GLOBALS['bot_username']  = "omegabot";
	$GLOBALS['bot_password']  = "isthisreallifeoritisjustafantasy";
	$GLOBALS['cas_path']	  = "phpcas/CAS.php";

	function show_msg($error_msg) {
		//TODO: TAMBAHIN PAGE ERROR
		die($error_msg);
	}

	function show_error($method_name, $error_code) {
		//TODO: TAMBAHIN PAGE ERROR
		die('error occured on '.$method_name.' : '.$error_code);
	}

    function encode_as_url($arr) {
        $res = "";
        foreach ($arr as $key=>$value)
            $res = $res . $key . '=' . urlencode($value) . '&';                        
        return rtrim($res, '&');
    }

    function redirect($url) {
    	header('Location: '.$url);
    }
?>