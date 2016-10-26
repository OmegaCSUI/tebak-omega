<?php
	session_start();

	$N = 8;
	$M = 6;
	$ret = array(0,0);
	$GLOBALS['sum'] = 0;
	$jaw = 0;

	$host = "localhost";
	$username = "apakaden";
	$password = "apakaden";
	$db_name = "learnphp";
	$tbl_name = "pertanyaan";
	$link = mysqli_connect("$host", "$username", "$password", "$db_name");

  	if (isset($_GET['command'])){
  		if ($_GET['command'] == 9){
			session_unset();
			// session_destroy();
			$orang = array_fill(0, $N+1, 1);
			$quest = array_fill(0, $M, 1);
			for ($i = 0; $i < $M; $i++) $quest[$i] = $i+1;
			shuffle($quest);

			$orang[0] = 0;

			$_SESSION['VALID'] = $orang;
			$_SESSION['TANYA'] = $quest;
			$_SESSION['IDX'] = 0;
  		}
  		else if ($_GET['command'] == 2){
  			array_push($_SESSION['TANYA'], $_SESSION['TANYA'][$_SESSION['IDX']-1]);
  		}
  		else{
	  		if ($_GET['command'] == 1)
	  			$a = 0;
	  		
	  		else
	  			$a = 1;
	  		
			for ($x = 1; $x <= $N; $x++){
				if ($_SESSION['VALID'][$x] == 0)
					continue;
				if ($_SESSION['JAWABAN'][$x] == $a)
					$_SESSION['VALID'][$x] = 0;
				else{
					$jaw = $x;
					$GLOBALS['sum']++;
				}
			}
	  	}
	}
	$ret[0] = array_sum($_SESSION['VALID']);
	if ($GLOBALS['sum'] == 1){
		$ret[1] = $jaw;
		echo json_encode($ret);
	}
	else{
		$ok = 0;
		while($ok == 0){
			$soal = $_SESSION['TANYA'][$_SESSION['IDX']];
			$_SESSION['IDX']++;
			$sql = "SELECT * FROM $tbl_name WHERE id = $soal";
			$result = mysqli_query($link, $sql);
			$rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$tot = 0;
			for ($i = 1; $i <= $N; $i++){
				if ($_SESSION['VALID'][$i] == 1){
					if ($rows[$i] == 1) $tot++;
				}
			}
			if($tot != array_sum($_SESSION['VALID']) && $tot != 0){
				$ok = 1;
			}
		}
		$ret[1] = $rows['tanya'];
		echo json_encode($ret);
		$_SESSION['JAWABAN'] = $rows;
	}
?>