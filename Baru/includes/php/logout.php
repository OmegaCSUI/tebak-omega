<?php
	require_once "environment.php";
	require_once "portal.php";

	portal_logout_sso();
	header("Location: ".$GLOBALS['base_url']."/tebak-repo/baru");
?>