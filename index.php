<?php
	require_once "includes/php/sso.php";
	require_once "includes/php/environment.php";

	session_start();

	sso_init();
	$logged_in = sso_is_logged_in();
	if ($logged_in) {
		if (sso_is_authorized()) $_SESSION['logged_in']=1;
		else show_msg("unauthorized access. hanya untuk omega 2016, fakultas elit dan nomor 1 ui");
	}
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
		<link href="includes/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- JQuery core JS -->
		<script src="includes/js/jquery.min.js"></script>

		<!-- Bootstrap core JS -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<!-- LavaLamp -->
		<script type="text/javascript" src="includes/js/jquery.lavalamp.min.js"></script>
		<link type="text/css" href="includes/css/jquery.lavalamp.css" rel="stylesheet" media="screen" />

		<!-- Select2 -->
		<link rel="stylesheet" href="includes/css/select2.min.css">
		<link rel="stylesheet" href="includes/css/select2-bootstrap.min.css">
		<script src="includes/js/select2.min.js"></script>
	

		<!-- Custom styles and core js-->
		<link href="includes/css/custom.min.css" rel="stylesheet">
		<script src="includes/js/akinator.min.js" type="text/javascript"></script>

	</head>

	<body>

		<div class="container">

			<div class="header clearfix">
				<nav>
					<ul class="nav nav-pills pull-right fata" id="setonclick">
						<li role="presentation" id="home" onclick="showHome()"><a href="#">Home</a></li>
						<li role="presentation" id="contact" onclick="showAbout()"><a href="#">About</a></li>
					</ul>
				</nav>
				<h3 class="text-muted">Tebak Omega!</h3>
			</div>

			<div class="jumbotron">

				<!-- Pas baru buka page -->
				<div class="play-init" id="init">
					<div class="content">	
						<p><h1>Cara Main:</h1></p> <br>
						<p class="lead">
						Pikirin satu orang di kepala kamu.<br>
						Terus jawab YA atau TIDAK berdasarkan ciri-ciri orang itu.<br>
						Nanti kita bakal tebak siapa yang kamu pikirin.
						</p>
					</div>
					<?php
						if($logged_in){
							echo '<p><a class="btn btn-lg btn-success btn-block" role="button" id="mulai">Mulai</a></p>'.PHP_EOL;              
						}else{
							echo '<p><a class="btn btn-lg btn-danger btn-block disabled" role="button">Kamu harus login dulu</a></p>'.PHP_EOL;
						}
					?>
				</div>

				<!-- Buat halaman about -->
				<div class="container content" id="about" style="display:none">
					<p><h2>Dibuat oleh mas-mas ganteng ini</h2></p> 
					<br>
					<p><h3>Abi</h3></p>
					<p><h3>Asel</h3></p>
					<p><h3>Fata</h3></p>
					<p><h3>Norman</h3></p>
					<br>
					<p>Dan terimakasih untuk tim 
						<a href="https://select2.github.io/">select2</a>, 
						<a href="http://lavalamp.magicmediamuse.com/">lavalamp</a>, 
						<a href="https://jquery.com/">jquery</a>, dan 
						<a href="http://getbootstrap.com/">bootstrap</a> 
						atas produk gg yang mereka buat</p>
				</div>

				<!-- Animasi Loading -->
				<img class="loader" style="margin: auto; display: block; position: absolute; top: -75px; left: 0; bottom: 0; right: 0;" src="includes/images/gears.svg" id="load">

				<div id="main">


					<div id="hidePasLoadingHueHueHue">
						<div class="content" id="finished">

							<!-- Buat nampilin select2 -->
							<p><select class="form-control input-lg select2-single" id="nama-select" name="harusnya">
								
								<!-- Buat nampilin placeholder -->
								<option></option>
								
								<!-- Buat generate optionnya -->
								<?php
									$host     = $GLOBALS['db_host'];
									$username = $GLOBALS['db_username'];
									$password = $GLOBALS['db_password'];
									$db_name  = $GLOBALS['db_name'];
									$tbl_name = "dataz";

									$link = mysqli_connect("$host", "$username", "$password", "$db_name");
									$sql = "SELECT id, Nama FROM $tbl_name ORDER BY `id`";
									$result = mysqli_query($link, $sql);
									
									while ($rows = mysqli_fetch_array($result,MYSQLI_ASSOC)){
										echo "<option value='".$rows['id']."'>".$rows['Nama']."</option>";
									}
								?>

							</select></p>

							<!-- Buat nampilin yang beda sama yang dimaksud -->
							<table class="table text-left" id="hasil"></table>
						
						</div>

						<!-- Buat nampilin soal -->
						<div class="content" id="containerSoal">
							<p><img class="img-responsive" style="margin: 0 auto;" id="foto"></p>
							<p><h1 id="soal"></h1></p>
						</div>

					<!-- !hidePasLoadingHueHueHue -->
					</div>

				<!-- !main -->
				</div>

				<!-- Tombol YA, TIDAK, GAK TAU -->
				<div class="container" id="tombol">
					
					<div class="row"> 
						<div class="col-lg-4">
							<a class="btn btn-lg btn-primary btn-block" role="button" id="ya" onclick="jawab(1)">YA</a>
						</div>
						<div class="col-lg-4">
							<a class="btn btn-lg btn-danger btn-block" role="button" id="tidak" onclick="jawab(0)">TIDAK</a>
						</div>
						<div class="col-lg-4">
							<a class="btn btn-lg btn-warning btn-block" role="button" id="gaktau" onclick="jawab(2)">GAK TAU</a>
						</div>
					</div>

				</div>
				
				<!-- Tombol protes dan restart -->
				<div class="container" id="tombolFinish">
					<p><a class="btn btn-lg btn-warning btn-block" role="button" id="protes" onclick="pindah()">Bukan ini orangnya</a></p>
					<p><a class="btn btn-lg btn-success btn-block" role="button" id="restart" onclick="jawab(9)">Main lagi</a></p>
				</div>

			<!-- !jumbotron -->
			</div>

			<!-- Buat dashboard dan leaderboard -->
			<div class="row marketing">
				<!-- Dashboard -->
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

				<!-- Leaderboard -->
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
			<!-- !dashboard dan leaderboard -->
			</div>

			<footer class="footer">
				<p>&copy; Omega 2016<a href="#" data-toggle="modal" data-target="#myModal">.</a></p>
			</footer>

			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Modal Header</h4>
						</div>
						<div class="modal-body">
							<h4>Ini easter egg</h4>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

		<!-- !container -->
		</div>
	</body>
</html>