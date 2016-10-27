<?php
	require_once "includes/php/environment.php";
	require_once "includes/php/portal.php";

	portal_logout_sso();
	header("Location: ".$GLOBALS['base_url']."/tebak-repo/baru");
?>