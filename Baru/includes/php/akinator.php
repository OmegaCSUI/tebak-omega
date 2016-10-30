<?php    
    session_start();

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != 1) {
    	die('["not logged in"]');
    }

    $N = 353;  //Banyak Orang
    $M = 50;   //Banyak Pertanyaan
    $ret = array("", 0,0);
    $jaw = 0;

    $host = "localhost";
    $username = "root";
    $password = "";
    $db_name = "anakomeg_games";
    $tbl_name = "pertanyaanz";
    $link = mysqli_connect("$host", "$username", "$password", "$db_name");

    if (isset($_GET['command'])){
        if ($_GET['command'] == 9){
            session_unset();
            $_SESSION['logged_in'] = 1;
            
            $orang = array_fill(0, $N+1, 0);
            $quest = array_fill(0, $M, 1);
            for ($i = 0; $i < $M; $i++) $quest[$i] = $i+1;
            shuffle($quest);

            $orang[0] = 0;

            // Siapa aja yang udah isi data
            $tbl_name2 = "dataz";
            $link2 = mysqli_connect("$host", "$username", "$password", "$db_name");

            $sql = "SELECT id FROM $tbl_name2";
            $result = mysqli_query($link2, $sql);
            while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                $orang[$rows['id']] = 1;
            }

            $_SESSION['VALID'] = $orang;
            $_SESSION['TANYA'] = $quest;
            $_SESSION['IDX'] = 0;
            mysqli_close($link2);

        }
        else if ($_GET['command'] == 2){
            array_push($_SESSION['TANYA'], $_SESSION['TANYA'][$_SESSION['IDX']-1]);
        }
        else{
            if ($_GET['command'] == 1)  //1 untuk Ya 0 untuk tidak
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
                }
            }
        }
    }
    $ret[1] = array_sum($_SESSION['VALID']);
    if ($ret[1] == 1){
        //Update Leaderboard

        $tbl_name2 = "dataz";
        $link2 = mysqli_connect("$host", "$username", "$password", "$db_name");

        $sql = "SELECT Nama,counter FROM $tbl_name2 WHERE id = $jaw";
        $result = mysqli_query($link2, $sql);
        $rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $nama = $rows['Nama'];
        $ret[2] = $nama;

        echo json_encode($ret);

        $tmp = $rows['counter']+1;

        $sql = "UPDATE dataz SET counter=$tmp WHERE id=$jaw";
        $result = mysqli_query($link2, $sql);
        mysqli_close($link2);

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
        $ret[2] = $rows['tanya'];
        echo json_encode($ret);
        $_SESSION['JAWABAN'] = $rows;
    }
    mysqli_close($link);
?>