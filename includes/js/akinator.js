$(document).ready(function(){
    skor();
    $('#main').hide();
    $(".btn#0").click(function(){
        var url = 'includes/php/akinator.php?command=9';                
        $.getJSON(url, function(data) {            
            if (data[0] != "") return;
            document.getElementById("soal").innerHTML = data[2];
        });
        $("#main").show();
        $('#init').hide();
        $('.btn#0').hide();
        $('.btn#9').hide();
    });

    $( ".select2-single" ).select2({
        placeholder: "test",
        theme: "bootstrap",
        maximumSelectionSize: 6,
        display: "block",
        width: "100%"
    });

});

function tolol(){
    alert("haha tolol");
}

function skor(){
    $.getJSON('includes/php/leaderboard.php', function(data){            
        var cnt = 0;
        for (x in data){            
            cnt++;            
            document.getElementById(cnt + 'a').innerHTML = x;            
            document.getElementById(cnt + 'b').innerHTML = data[x];
        }
    });
}

function jawab(cmd){
    var url = 'includes/php/akinator.php?command=' + cmd;
    $.getJSON(url, function(data) {                
        if (data[0] != "") return;
        
        document.getElementById("soal").innerHTML = data[2];
        if (data[1] == 1){
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