<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<body>
<script>
$(document).ready(function(){
	$('#tanya').load('akinator.php?ya=9');

	$("button#1").click(function(){
        $("#tanya").load("akinator.php?ya=1");
    });

    $("button#2").click(function(){
        $("#tanya").load("akinator.php?ya=0");
    });

    $("button#3").click(function(){
        $("#tanya").load("akinator.php?ya=2");
    });
})
</script>
<div id="tanya"></div>
<div id="tombol">
	<button id="1">YA</button>
	<button id="2">TIDAK</button>
	<button id="3">GAK TAU</button>
</div>
</body>
</html>