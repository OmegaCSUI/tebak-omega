<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<body>
<script>
$(document).ready(function(){

	$('#main').hide();

	$("button#0").click(function(){
        $.getJSON('akinator.php?command=9', function(data) {
            x = data;
            document.getElementById("tanya").innerHTML = x[1];
        });
        $("#main").show();
        $('button#0').hide();
        $('button#9').hide();
    });

    $("button#1").click(function(){
        $.getJSON('akinator.php?command=1', function(data) {
            x = data;
            document.getElementById("tanya").innerHTML = x[1];

            if (x[0] == 1){
                $("#leader").load("leaderboard.php");
                $('#tombol').hide();
                $('button#9').show();
            }
        });
    });

    $("button#2").click(function(){
        $.getJSON('akinator.php?command=0', function(data) {
            x = data;
            document.getElementById("tanya").innerHTML = x[1];

            if (x[0] == 1){
                $("#leader").load("leaderboard.php");
                $('#tombol').hide();
                $('button#9').show();
            }
        });
    });

    $("button#3").click(function(){
        $.getJSON('akinator.php?command=2', function(data) {
            x = data;
            document.getElementById("tanya").innerHTML = x[1];

            if (x[0] == 1){
                $("#leader").load("leaderboard.php");
                $('#tombol').hide();
                $('button#9').show();
            }
        });
    });

    $("button#9").click(function(){
        $.getJSON('akinator.php?command=9', function(data) {
            x = data;
            document.getElementById("tanya").innerHTML = x[1];
        });
        $('#tombol').show();
        $('button#9').hide();
    });


})
</script>
<button id="0">Mulai</button>
<div id="main">
	<div id="tanya"></div>
	<div id="tombol">
		<button id="1">YA</button>
		<button id="2">TIDAK</button>
        <button id="3">GA TAU</button>
	</div>
	<button id="9">Restart</button>
</div>
<div id="leader"></div>
</body>
</html>