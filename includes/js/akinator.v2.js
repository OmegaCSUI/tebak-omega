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
        $('.btn#8').hide();
        $('.btn#9').hide();
        $('#formulir').hide();
    });

    $('#default').lavalamp({
      easing: 'easeOutBack'
    });
      
    $('#margins').lavalamp({
      easing: 'easeOutBack',
      margins:true
    });
      
    $('#setonclick').lavalamp({
      easing: 'easeOutBack',
      setOnClick:true
    });
      
    $('#setactive').lavalamp({
      easing: 'easeOutBack'
    });
    $('#setactive-links').change(function() {
      var v = $(this).val();
      var a = $('#setactive').children('.lavalamp-item').eq(v);
       
      $('#setactive').data('lavalampActive',a).lavalamp('update');
    });

    $('#delay').lavalamp({
      easing: 'easeOutBack',
      delayOn: 500,
      delayOff: 1000
    });
      
    $('#focus').lavalamp({
      easing: 'easeOutBack',
      enableFocus: true
    });
      
    $('#focus-deep').lavalamp({
      easing: 'easeOutBack',
      deepFocus: true
    });

    $( ".select2-single" ).select2({
        placeholder: "Emang kamu mikirin siapa?",
        theme: "bootstrap",
        maximumSelectionSize: 6,
        display: "block",
        width: "100%"
    });

    $('#nama-select').change(function(){
      protes($("#nama-select").val());
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
            $('.btn#8').show();
            $('.btn#9').show();
        }
    });
    if (cmd == 9){
        $('#soal').show();
        $('#tombol').show();
        $('.btn#8').hide();
        $('.btn#9').hide();
        $('#formulir').hide();
        $('#hasil').hide();

        $("#nama-select").val("").trigger('change');
    }
}

function pindah(){
  $('.btn#8').hide();
  $('#soal').hide();
  $('#formulir').show();
  $('#hasil').show();
}

function protes(cmd){
  $( "#hasil" ).load( "includes/php/protes.php?harusnya=" + cmd);
}