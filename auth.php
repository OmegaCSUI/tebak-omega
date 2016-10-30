<?php	
	require_once "includes/php/environment.php";
	require_once "includes/php/sso.php";

	sso_init();
	sso_login();
	header("Location: ".$GLOBALS['base_url']);
?>