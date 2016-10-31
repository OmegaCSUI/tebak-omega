<?php   
  require_once "includes/php/sso.php";
  require_once "includes/php/environment.php";

  session_start();

  sso_init();
  $logged_in = sso_is_logged_in();
  if ($logged_in)
    if (sso_is_authorized()) {
      $_SESSION['logged_in']=1;
    }
    else
      show_msg("unauthorized access. hanya untuk omega 2016, fakultas elit dan nomor 1 ui");
?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="includes/images/favicon.ico">

    <title>Tebak Omega!</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/css/custom.css" rel="stylesheet">
    
    <!-- JQuery core JS -->
    <script src="includes/js/jquery.min.js"></script>

    <!-- Bootstrap core JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Game core JS -->
    <script src="includes/js/akinator.v2.js" type="text/javascript"></script>

    <!-- LavaLamp -->
    <script type="text/javascript" src="includes/js/jquery.lavalamp.min.js"></script>
    <link type="text/css" href="includes/css/jquery.lavalamp.css" rel="stylesheet" media="screen" />

    <!-- Select2 -->
    <link rel="stylesheet" href="includes/css/select2.css">
    <link rel="stylesheet" href="includes/css/select2-bootstrap.css">
    <script src="includes/js/select2.min.js"></script>
  
  </head>

  <body>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right fata" id="setonclick">
            <li role="presentation" id="home"><a href="#">Home</a></li>
            <li role="presentation" id="contact"><a href="#">About</a></li>
            <li role="presentation" id="about"><a href="http://anak-omega.com/wiki">Wiki</a></li>
            <li role="presentation" id="contact"><a href="http://anak-omega.com/blog">Blog</a></li>
            <li role="presentation" id="contact"><a style="color:red" href="logout.php">Logout</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Tebak Omega!</h3>
      </div>

      <div class="jumbotron">
        <div class="play-init" id="init">
          <h1>How to Play:</h1>
          <br>
          <p class="lead">
          Pikirin satu orang di kepala kamu. 
          <br>Terus jawab YA atau TIDAK berdasarkan ciri-ciri orang itu. 
          <br>Nanti kita bakal tebak siapa yang kamu pikirin.
          </p>
        </div>
        <?php
          if($logged_in){
              echo '<p><a class="btn btn-lg btn-success btn-block" role="button" id="0">Play</a></p>'.PHP_EOL;              
          }else{
              echo '<p><a class="btn btn-lg btn-danger btn-block disabled" role="button">You need to log in first</a></p>'.PHP_EOL;
          }
        ?>
        <div id="main">
          <p><h1 class="content" id="soal"></h1></p>
          <div class="container" id="tombol">
            <div class="row">
              <div class="col-lg-4">
                <a class="btn btn-lg btn-primary btn-block" role="button" id="0" onclick="jawab(1)">YA</a>
              </div>
              <div class="col-lg-4">
                <a class="btn btn-lg btn-danger btn-block" role="button" id="1" onclick="jawab(0)">TIDAK</a>
              </div>
              <div class="col-lg-4">
                <a class="btn btn-lg btn-warning btn-block" role="button" id="2" onclick="jawab(2)">GAK TAU</a>
              </div>
            </div>
          </div>
          <p><a class="btn btn-lg btn-warning btn-block" role="button" data-toggle="modal" data-target="#myModal" id="8">Bukan ini kocak</a></p>
          <p><a class="btn btn-lg btn-success btn-block" role="button" id="9" onclick="jawab(9)">Play Again</a></p>
        </div>
      </div>
      <div class="row marketing">
        <div class="col-lg-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Dashboard</h3>
            </div>
            <div class="panel-body panel-height">
              <?php
                if($logged_in){

                    $user = sso_get_info();
                    echo '<p>Halo '.$user->name.'!</p>'.PHP_EOL;
                    echo '<br>'.PHP_EOL;
                    echo '<p><a href="logout.php" class="btn btn-lg btn-danger btn-block">Logout</a></p>'.PHP_EOL;
                }else{
                    echo '<p>Halo Guest!</p>'.PHP_EOL;
                    echo '<br>'.PHP_EOL;
                    echo '<p><a href="auth.php" class="btn btn-lg btn-success btn-block">Login SSO</a></p>'.PHP_EOL;
                }
              ?>
              <p><a href="http://anak-omega.com/wiki" class="btn btn-lg btn-info btn-block" role="button">Wiki</a></p>
              <p><a href="http://anak-omega.com/blog" class="btn btn-lg btn-warning btn-block" role="button">Blog</a></p>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Leaderboard</h3>
            </div>
            <div class="panel-body panel-height">
              <div id="leader">
              <table class="table">
                <thead>
                  <tr>
                    <th>Paling sering ditebak</th>
                    <th class="text-center">#</th>
                  </tr>
                </thead>
                <tbody>
                    <tr><td id="1a"></td><td class="text-center" id="1b"></td></tr>
                    <tr><td id="2a"></td><td class="text-center" id="2b"></td></tr>
                    <tr><td id="3a"></td><td class="text-center" id="3b"></td></tr>
                    <tr><td id="4a"></td><td class="text-center" id="4b"></td></tr>
                    <tr><td id="5a"></td><td class="text-center" id="5b"></td></tr>
                </tbody>
              </table>
          </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer">
        <p>&copy; Omega 2016<a href="#" data-toggle="modal" data-target="#myModal">.</a></p>
      </footer>

      <!-- Protes Modal -->
      <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
            <script type="text/javascript">
            $(document).ready(function() {
              $(".select2-bootstrap").select2({
                  theme: "bootstrap"
              });
            });
            </script>

            <select class="select2-choice select2-default width-full">
              <option value="AL">Alabama</option>
              <option value="WY">Wyoming</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

        </div>
      </div>
    </div> <!-- /container -->

  <a href = "includes/php/protes.php?harusnya=238"> Protes </a>
  </body>
</html>

<!-- pending credits: lavalamp, jumbotron -->
