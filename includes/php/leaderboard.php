<?php
	require_once "environment.php";    

	session_start();

    //pastiin dia sudah login sso
    // if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != 1)
    // 	die('["not logged in"]');        

    $host     = $GLOBALS['db_host'];
    $username = $GLOBALS['db_username'];
    $password = $GLOBALS['db_password'];
    $db_name  = $GLOBALS['db_name'];
	$tbl_name = "dataz";

	$link = mysqli_connect("$host", "$username", "$password", "$db_name");
	$sql = "SELECT * FROM $tbl_name ORDER BY `counter` DESC LIMIT 5";
	$result = mysqli_query($link, $sql);
	
	while ($rows = mysqli_fetch_array($result,MYSQLI_ASSOC))
		$arr[$rows['Nama']] = $rows['counter'];	

	echo json_encode($arr);
	mysqli_close($link);
?>