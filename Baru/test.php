<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<body>
<script>
$(document).ready(function(){

	$('#main').hide();

	$("button#0").click(function(){
        var url = 'akinator.php?command=9';
        $.getJSON(url, function(data) {
            x = data;
            document.getElementById("tanya").innerHTML = x[1];
        });
        $("#main").show();
        $('button#0').hide();
        $('button#9').hide();
    });

})

function jawab(cmd){
    var url = 'akinator.php?command=' + cmd;
    $.getJSON(url, function(data) {
        var x = data;
        document.getElementById("tanya").innerHTML = x[1];
        if (x[0] == 1){
            $("#leader").load("leaderboard.php");
            $('#tombol').hide();
            $('button#9').show();
        }
    });
    if (cmd == 9){
        $('#tombol').show();
        $('button#9').hide();
    }
}

</script>
<button id="0">Mulai</button>
<div id="main">
	<div id="tanya"></div>
	<div id="tombol">
		<button id="1" onclick="jawab(1)">YA</button>
		<button id="2" onclick="jawab(0)">TIDAK</button>
        <button id="3" onclick="jawab(2)">GA TAU</button>
	</div>
	<button id="9" onclick="jawab(9)">Restart</button>
</div>
<div id="leader"></div>
</body>
</html>