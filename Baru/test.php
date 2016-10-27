<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<body>
<script>
$(document).ready(function(){
    skor();
	$('#main').hide();

	$("button#0").click(function(){
        var url = 'akinator.php?command=9';
        $.getJSON(url, function(data) {
            x = data;
            document.getElementById("tanya").innerHTML = x[1];

            // var s;
            // s = '<tr><td>' + x[1] + '</td>';
            // $('#history').append(s);
        });

        $("#main").show();
        $('button#0').hide();
        $('button#9').hide();
    });

})

function skor(){
    $.getJSON('leaderboard.php', function(data){
        var arr = data;
        var cnt = 0;
        for (x in arr){
            if (cnt == 5) break;
            cnt++;
            // var s = '<tr><td>' + x + '</td><td>' + arr[x] + '</td></tr>';
            // $('#leader').append(s);
            var idd = cnt + 'a';
            document.getElementById(idd).innerHTML = x;
            idd = cnt + 'b';
            document.getElementById(idd).innerHTML = arr[x];
        }
    });
}

function jawab(cmd){
    var url = 'akinator.php?command=' + cmd;
    $.getJSON(url, function(data) {
        var x = data;
        document.getElementById("tanya").innerHTML = x[1];

        if (x[0] == 1){
            skor();
            $('#tombol').hide();
            $('button#9').show();
        }

        // var s;
        // if (cmd == 1) s = ' Ya';
        // else if (cmd == 0) s = 'Tidak';
        // else if (cmd == 2) s = 'Ga tau';
        // s = '<td>' + s + '</td></tr>';
        // $('#history').append(s);

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
<div>
    <table id="leader">
        <tr><td id="1a"></td><td id="1b"></td></tr>
        <tr><td id="2a"></td><td id="2b"></td></tr>
        <tr><td id="3a"></td><td id="3b"></td></tr>
        <tr><td id="4a"></td><td id="4b"></td></tr>
        <tr><td id="5a"></td><td id="5b"></td></tr>
    </table>
</div>
<div>
    <table id="history">
        
    </table>
</div>
</body>
</html>