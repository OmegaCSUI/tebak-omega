<?php
	session_start();
  	if(!isset($_SESSION['VALID'])){
		$orang = array(0, 1, 1, 1, 1);
		$udah = array(0,0,0);
		$_SESSION['VALID'] = $orang;
		$_SESSION['SUDAH'] = $udah;
  	}

	$sum = 0;
	$jaw = 0;

	$host = "localhost";
	$username = "apakaden";
	$password = "apakaden";
	$db_name = "learnphp";
	$tbl_name = "pertanyaan";
	$link = mysqli_connect("$host", "$username", "$password", "$db_name");


  	if (isset($_GET['ya'])){
  		if ($_GET['ya'] == 1)
  			$a = 0;
  		
  		else
  			$a = 1;
  		
		for ($x = 1; $x <= 4; $x++){
			if ($_SESSION['VALID'][$x] == 0)
				continue;
			if ($_SESSION['JAWABAN'][$x] == $a)
				$_SESSION['VALID'][$x] = 0;
			else{
				$jaw = $x-1;
				$sum++;
			}
		}
  	}

	if ($sum == 1){
		echo $jaw;
		session_unset();
		session_destroy();
		echo "<a href='a.php'>Restart</a>";
	}
	else{
		$soal = 0;
		for ($x = 1; $x <= 2; $x++){
			if ($_SESSION['SUDAH'][$x] == 0)
				$soal = $x;
		}
		$_SESSION['SUDAH'][$soal] = 1;
		$sql = "SELECT * FROM $tbl_name WHERE id = $soal";
		$result = mysqli_query($link, $sql);
		$rows = mysqli_fetch_array($result,MYSQLI_NUM);
		echo $rows[5];
		echo "<br>";
		$_SESSION['JAWABAN'] = $rows;
	}
?>