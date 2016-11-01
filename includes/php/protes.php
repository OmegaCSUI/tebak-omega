<?php
    session_start();
    require_once "environment.php";

    $host     = $GLOBALS['db_host'];
    $username = $GLOBALS['db_username'];
    $password = $GLOBALS['db_password'];
    $db_name  = $GLOBALS['db_name'];
    $tbl_name = "pertanyaanz";
    $link = mysqli_connect("$host", "$username", "$password", "$db_name");

    if (!isset($_SESSION['HISTORY']))
        die('main dulu pak baru protes');

	if (!isset($_GET['harusnya']))
		die('Siapa yang mau diprotes pak?');

    echo "<thead><tr><th>Pertanyaan</th><th>Jawaban kamu</th><th>Harusnya</th></tr></thead>";
    echo "<tbody>";
    foreach($_SESSION['HISTORY'] as $value){
        $sql = "SELECT * FROM $tbl_name WHERE id=$value";
        $result = mysqli_query($link, $sql);

        $rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
        if ($rows[$_SESSION['ORANG']] != $rows[$_GET['harusnya']]){
        	if($rows[$_SESSION['ORANG']] == 1) $orang = "YA";
        	else $orang = "TIDAK";
        	if($rows[$_GET['harusnya']] == 1) $harusnya = "YA";
        	else $harusnya = "TIDAK";
            echo "<tr><td>".$rows['tanya'] . "</td><td>" . $orang . "</td><td>" . $harusnya . "</td></tr>";
        }
    }
    echo "</tbody>";
?>

<!-- <table class="table">
    <tbody>
        <tr><td id="1a"></td><td class="text-center" id="1b"></td></tr>
        <tr><td id="2a"></td><td class="text-center" id="2b"></td></tr>
        <tr><td id="3a"></td><td class="text-center" id="3b"></td></tr>
        <tr><td id="4a"></td><td class="text-center" id="4b"></td></tr>
        <tr><td id="5a"></td><td class="text-center" id="5b"></td></tr>
    </tbody>
</table> -->