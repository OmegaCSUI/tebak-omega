<?php
	$host = "localhost";
	$username = "apakaden";
	$password = "apakaden";
	$db_name = "anakomeg_games";
	$tbl_name = "data";

	$link = mysqli_connect("$host", "$username", "$password", "$db_name");
	$sql = "SELECT * FROM $tbl_name";
	$result = mysqli_query($link, $sql);

	$arr = array();

	while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		$arr[$rows['nama']] = $rows['counter'];
	}

	arsort($arr);
	echo json_encode($arr);
?>