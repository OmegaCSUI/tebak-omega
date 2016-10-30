<?php session_start(); ?>
<?php
    require_once "includes/php/environment.php";
    require_once "includes/php/portal.php";

    portal_init();
    $logged_in = portal_is_logged_in();
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

    <!-- Game core JS -->
    <script src="includes/js/akinator.js" type="text/javascript"></script>

  </head>

  <body>

    <div class="container">
      <!-- Kita gabutuh navbar kan -->
      <!-- <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="#">Home</a></li>
            <li role="presentation"><a href="#">About</a></li>
            <li role="presentation"><a href="#">Contact</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Project name</h3>
      </div> -->

      <div class="jumbotron">
        <div class="play-init" id="init">
          <h1>Tebak Omega!</h1>
          <br>
          <p class="lead">
          Pikirin satu orang di kepala kamu. 
          <br>Terus jawab YA atau TIDAK berdasarkan ciri-ciri orang itu. 
          <br>Nanti kita bakal tebak siapa yang kamu pikirin.
          </p>
        </div>
        <?php
          if($logged_in){
              echo '<p><a class="btn btn-lg btn-success btn-block" role="button" id="0">Play</a></p>';
          }else{
              echo '<p><a class="btn btn-lg btn-danger btn-block disabled" role="button" id="0">You need to log in first</a></p>';
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
          <p><a class="btn btn-lg btn-success btn-block" role="button" id="9" onclick="jawab(9)">Restart</a></p>
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
                    $user = portal_get_sso_info();
                    echo '<p>Halo '.$user->name.'!</p>';
                    echo '<br>';
                    echo '<p><a href="logout.php" class="btn btn-lg btn-danger btn-block">Logout</a></p>';
                }else{
                    echo '<p>Halo Guest!</p>';
                    echo '<br>';
                    echo '<p><a href="auth.php" class="btn btn-lg btn-success btn-block">Login SSO</a></p>';
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
        <p>&copy; Omega 2016</p>
      </footer>

    </div> <!-- /container -->


  </body>
</html>
