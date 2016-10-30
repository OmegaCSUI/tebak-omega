<?php
	require_once "environment.php";

	//note: panggil sekali di atas source biar ngga error
	//sama sama -fata
	function sso_init() {
		require $GLOBALS['sso_path'];
		SSO\SSO::setCASPath($GLOBALS['cas_path']); 		
	}

	function sso_is_logged_in() {		
		return SSO\SSO::check();
	}

	function sso_get_info() {		
		return SSO\SSO::getUser();    
	}

	function sso_logout() {		
		SSO\SSO::logout();
	}

	function sso_login() {		
		SSO\SSO::authenticate();
	}

	function sso_is_authorized() {		
		$user = sso_get_info();
		return $user->faculty == 'ILMU KOMPUTER' && substr($user->npm, 0, 2) == '16';
	}	
?>
