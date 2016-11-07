<?php    
    require_once "environment.php";    

    session_start();

    //pastiin dia sudah login sso
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != 1)
    	die('["not logged in"]');        


    $N = 353;  //Banyak Orang
    $M = 50;   //Banyak Pertanyaan
    $returnValue = array("", 0,0,0);
    $jawaban = 0;

    $host     = $GLOBALS['db_host'];
    $username = $GLOBALS['db_username'];
    $password = $GLOBALS['db_password'];
    $db_name  = $GLOBALS['db_name'];

    $link = mysqli_connect("$host", "$username", "$password", "$db_name");

    if (!isset($_GET['command']))
        show_msg("ngapain mas disini? wkwkwk");

    if ($_GET['command'] == 9){
        session_unset();
        $_SESSION['logged_in'] = 1;
        
        $orang = array_fill(0, $N+1, 0);
        $quest = array_fill(0, $M, 1);
        for ($i = 0; $i < $M; $i++) $quest[$i] = $i+1;
        shuffle($quest);

        $orang[0] = 0;

        // Siapa aja yang udah isi data
        $sql = "SELECT id FROM dataz";
        $result = mysqli_query($link, $sql);
        if (!$result) show_msg("Gagal query data");

        while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC))
            $orang[$rows['id']] = 1;
        

        $_SESSION['VALID'] = $orang;
        $_SESSION['TANYA'] = $quest;
        $_SESSION['IDX'] = 0;
        $_SESSION['HISTORY'] = array();
        $_SESSION['ORANG'] = 0;  //Orang yang ditebak siapa

    }
    else if ($_GET['command'] == 2){
        array_push($_SESSION['TANYA'], $_SESSION['JAWABAN']['id']);
    }
    else{
        array_push($_SESSION['HISTORY'], $_SESSION['JAWABAN']['id']);
        $a = $_GET['command'] != 1;
        
        for ($x = 1; $x <= $N; $x++){
            if ($_SESSION['VALID'][$x] == 0) continue;

            if ($_SESSION['JAWABAN'][$x] == $a)
                $_SESSION['VALID'][$x] = 0;
            else
                $jawaban = $x;            
        }
    }

    $returnValue[1] = array_sum($_SESSION['VALID']);

    if ($returnValue[1] == 1){ // Kalau udah ketemu jawaban

        $sql = "SELECT Nama,counter,photourl FROM dataz WHERE id = $jawaban";
        $result = mysqli_query($link, $sql);
        if (!$result) show_msg("Gagal cari nama orang");

        $rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $returnValue[2] = $rows['Nama'];
        $returnValue[3] = $rows['photourl'];
        $_SESSION['ORANG'] = $jawaban;

        $tmp = $rows['counter']+1;

        $sql = "UPDATE dataz SET counter=$tmp WHERE id=$jawaban";
        $result = mysqli_query($link, $sql);
        if (!$result) show_msg("Gagal update leaderboard");

        echo json_encode($returnValue);
    }
    else if ($returnValue[1] > 1){
        $ok = 0;
        while($ok == 0){    //Ngambil pertanyaan yang valid
            $soal = $_SESSION['TANYA'][$_SESSION['IDX']];
            $_SESSION['IDX']++;

            $sql = "SELECT * FROM pertanyaanz WHERE id = $soal";
            $result = mysqli_query($link, $sql);
            if (!$result) show_msg("Gagal nyari soal");

            $rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
            
            $total = 0;

            for ($i = 1; $i <= $N; $i++)
                if ($_SESSION['VALID'][$i] == 1)
                    if ($rows[$i] == 1) $total++;
                
            if($total != array_sum($_SESSION['VALID']) && $total != 0)
                $ok = 1;
            
        }

        $returnValue[2] = $rows['tanya'];
        echo json_encode($returnValue);
        $_SESSION['JAWABAN'] = $rows;
    }
    mysqli_close($link);
?>