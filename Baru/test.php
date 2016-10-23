<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<body>
<script>
$(document).ready(function(){

	$('#main').hide();
	$('#tanya').load('akinator.php?ya=9');

	$("button#0").click(function(){
        $("#main").show();
        $('button#0').hide();
        $('button#3').hide();
    });

	$("button#1").click(function(){
        $("#tanya").load("akinator.php?ya=1");
    });

    $("button#2").click(function(){
        $("#tanya").load("akinator.php?ya=0");
    });

    $("button#3").click(function(){
        $('#tanya').load('akinator.php?ya=9');
        $('#tombol').show();
        $('button#3').hide();
    });

})
</script>
<button id="0">Mulai</button>
<div id="main">
	<div id="tanya"></div>
	<div id="tombol">
		<button id="1">YA</button>
		<button id="2">TIDAK</button>
	</div>
	<button id="3">Restart</button>
</div>
</body>
</html>