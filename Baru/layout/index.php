<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Tebak Omega!</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron-narrow.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
    
    <!-- JQuery core JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Game core JS -->
    <script src="dist/js/akinator.js" type="text/javascript"></script>

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
          <p><h1>Tebak Omega!</h1></p>
          <p class="lead">
          Pikirin satu orang di kepala kamu. 
          <br>Terus jawab YA atau TIDAK berdasarkan ciri-ciri orang itu. 
          <br>Nanti kita bakal ketebak siapa yang kamu pikirin.
          </p>
        </div>
        <p><a class="btn btn-lg btn-success btn-block" role="button" id="0">Play</a></p>
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
              Panel content
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
                    <th>Nama</th>
                    <th class="text-center">Berapa kali ditebak</th>
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
        <p>&copy; 2016 Company, Inc.</p>
      </footer>

    </div> <!-- /container -->


  </body>
</html>
