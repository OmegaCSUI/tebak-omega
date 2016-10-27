$(document).ready(function(){
    skor();
    $('#main').hide();
    $(".btn#0").click(function(){
        var url = 'includes/php/akinator.php?command=9';
        $.getJSON(url, function(data) {
            x = data;
            document.getElementById("soal").innerHTML = x[1];
        });
        $("#main").show();
        $('#init').hide();
        $('.btn#0').hide();
        $('.btn#9').hide();
    });

});

function tolol(){
    alert("haha tolol");
}

function skor(){
    $.getJSON('includes/php/leaderboard.php', function(data){
        var arr = data;
        var cnt = 0;
        for (x in arr){
            if (cnt == 5) break;
            cnt++;
            var idd = cnt + 'a';
            document.getElementById(idd).innerHTML = x;
            idd = cnt + 'b';
            document.getElementById(idd).innerHTML = arr[x];
        }
    });
}

function jawab(cmd){
    var url = 'includes/php/akinator.php?command=' + cmd;
    $.getJSON(url, function(data) {
        var x = data;
        document.getElementById("soal").innerHTML = x[1];
        if (x[0] == 1){
            skor();
            $('#tombol').hide();
            $('.btn#9').show();
        }
    });
    if (cmd == 9){
        $('#tombol').show();
        $('.btn#9').hide();
    }
}