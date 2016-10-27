<?php
	require_once "environment.php";

	function portal_init() {
		require "SSO/SSO.php";
		SSO\SSO::setCASPath($GLOBALS['cas_path']); 
	}

	function portal_is_logged_in() {
		return SSO\SSO::check();
	}

	function portal_get_sso_info() {
		if (!portal_is_logged_in())
			SSO\SSO::authenticate();
		else
			return SSO\SSO::getUser();    
	}

	function portal_logout_sso() {
		require "SSO/SSO.php";

		SSO\SSO::setCASPath($GLOBALS['cas_path']);
		SSO\SSO::logout();
	}

	function portal_is_authorized($user) {
		return ($user->faculty == 'ILMU KOMPUTER' && substr($user->npm, 0, 2) == '16');
	}

	//konek ke db
	function portal_connect_db() {		
		$mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
		
		if ($mysqli->connect_errno)			
			show_error('portal_connect_db()', $mysqli->connect_errno);		

		return $mysqli;		
	}

	function portal_is_registered($npm) {
		$mysqli = portal_connect_db();
		$sql = $mysqli->prepare("SELECT COUNT(*),`password` FROM `users` WHERE `username` = (?)");
		$sql->bind_param("i", $npm);
		
		if ($sql->execute() == false) 
			show_error('portal_is_registered()', 'cant execute prepared statement');
		
		$res = $sql->get_result();
		$row = $res->fetch_assoc();
		$sql->close();

		return $row['COUNT(*)'] == 1;
	}

	function portal_is_registered_wiki($npm) {
		$mysqli = portal_connect_db();
		$sql = $mysqli->prepare("SELECT `created` FROM `users` WHERE `username` = (?)");
		$sql->bind_param("i", $npm);

		if ($sql->execute() == false) 
			show_error('portal_is_registered_wiki()', 'cant execute prepared statement');

		$res = $sql->get_result();
		$row = $res->fetch_assoc();
		$sql->close();

		return $row['created'];
	}

	function portal_set_registered_wiki($npm) {
		$mysqli = portal_connect_db();
		$sql = $mysqli->prepare("UPDATE `users` SET `created`=1 WHERE `username` = (?)");
		$sql->bind_param("i", $npm);
		
		if ($sql->execute() == false)
			show_error('portal_set_registered_wiki()', 'cant execute prepared statement');				

		$sql->close();		
	}

	function portal_register_user($npm) {
		$mysqli = portal_connect_db();
		$sql = $mysqli->prepare("INSERT INTO `users`(`username`) VALUES(?)");
		$sql->bind_param("i", $npm);		

		if ($sql->execute() == false)
			show_error('portal_register_user()', 'cant execute prepared statement');				

		$sql->close();
	}
?>
