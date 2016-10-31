<?php
    session_start();
    require_once "environment.php";

    $host     = $GLOBALS['db_host'];
    $username = $GLOBALS['db_username'];
    $password = $GLOBALS['db_password'];
    $db_name  = $GLOBALS['db_name'];
    $tbl_name = "pertanyaanz";

    $link = mysqli_connect("$host", "$username", "$password", "$db_name");

	if (!isset($_GET['harusnya']))
		die('Siapa yang mau diprotes pak?');

    foreach($_SESSION['HISTORY'] as $value){
        $sql = "SELECT * FROM $tbl_name WHERE id=$value";
        $result = mysqli_query($link, $sql);

        $rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
        if ($rows[$_SESSION['ORANG']] != $rows[$_GET['harusnya']]){
            echo $rows['tanya'] . " " . $rows[$_SESSION['ORANG']] . " " . $rows[$_GET['harusnya']] . "<br>";
        }
    }
?>