var dapetJawaban = 0;

$(document).on({
    ajaxStart: function() { 
        $('#load').show();
        $('#ya').addClass("disabled");
        $('#tidak').addClass("disabled");
        $('#gaktau').addClass("disabled");
        $('#protes').addClass("disabled");
        $('#restart').addClass("disabled");      
    },
    ajaxComplete: function() { 
        if(dapetJawaban != 1){
	        $('#load').finish().hide(); 
	        $('#ya').removeClass("disabled");
	        $('#tidak').removeClass("disabled");
	        $('#gaktau').removeClass("disabled");
	        $('#protes').removeClass("disabled");
	        $('#restart').removeClass("disabled");  
        }
    }    
});

$(document).ready(function(){
    // Tampilin leaderboard
    skor();

    // Ngilangin area main dan tombol-tombol
    hilangkan();

    // kalo ngeklik tombol mulai
    $(".btn#mulai").click(function(){
        var url = 'includes/php/akinator.php?command=9';                
        $.getJSON(url, function(data) {            
            if (data[0] != "") return;
            document.getElementById("soal").innerHTML = data[2];
        });
        $('#containerSoal').show();
        $('#soal').fadeIn("fast");
        $("#tombol").fadeIn("fast");
        $('#init').hide();

        $("#nama-select").val("").trigger('change');
    });

    // Lavalamp
    $('#default').lavalamp({ easing: 'easeOutBack' }); 
    $('#margins').lavalamp({ easing: 'easeOutBack', margins:true });
    $('#setonclick').lavalamp({ easing: 'easeOutBack', setOnClick:true });
    $('#setactive').lavalamp({ easing: 'easeOutBack' });
    $('#delay').lavalamp({ easing: 'easeOutBack', delayOn: 500, delayOff: 1000 });
    $('#focus').lavalamp({ easing: 'easeOutBack', enableFocus: true });  
    $('#focus-deep').lavalamp({ easing: 'easeOutBack', deepFocus: true });
    $('#setactive-links').change(function() { 
        var v = $(this).val(); 
        var a = $('#setactive').children('.lavalamp-item').eq(v); 
        $('#setactive').data('lavalampActive',a).lavalamp('update'); 
    });
    $( ".select2-single" ).select2({
        placeholder: "Emang kamu mikirin siapa?",
        theme: "bootstrap",
        maximumSelectionSize: 6,
        display: "block",
        width: "100%"
    });
    // !Lavalamp

    // Select2
    $('#nama-select').change(function(){ protes($("#nama-select").val()); });

});

function jawab(cmd){
    var url = 'includes/php/akinator.php?command=' + cmd;

    $.getJSON(url, function(data) {                
        if (data[0] != "") return;
        document.getElementById("soal").innerHTML = data[2];
        if (data[1] == 1){
		    dapetJawaban = 1;   
	        $( "#foto" )
		    .error(function() {
		    $( this ).attr( "src", "includes/images/no_photos.jpg" );
		    })
		    .attr( "src", data[3] );
	            
	        $('#foto').fadeIn();
	                
	        $('#foto').load(function(){
		        $('#load').finish().hide(); 
		        $('#ya').removeClass("disabled");
		        $('#tidak').removeClass("disabled");
		        $('#gaktau').removeClass("disabled");
		        $('#protes').removeClass("disabled");
		        $('#restart').removeClass("disabled");
		        dapetJawaban = 0;
		    });
	            
	        skor();
	        $('#tombol').hide();
	        $('#protes').fadeIn("fast");
	        $('#restart').fadeIn("fast");
        }
    });
    $('#soal').finish().hide().fadeIn("fast");
    if (cmd == 9){
        $('#foto').removeAttr("src");
        $('#containerSoal').show();
        $('#soal').fadeIn("fast");
        $('#tombol').fadeIn("fast");
        $('#protes').hide();
        $('#restart').hide();
        $('#finished').hide();
        $('#foto').hide();
        $("#nama-select").val("").trigger('change');
    }
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

function pindah(){
    $('#containerSoal').hide();
    $('#foto').hide();
    $('.btn#protes').hide();
    $('#soal').hide();
    $('#finished').fadeIn("fast");
}

function protes(cmd){
    $( "#hasil" ).load( "includes/php/protes.php?harusnya=" + cmd);
}

function hilangkan(){
    $('#foto').removeAttr("src");
    $('#foto').hide();
    $('#finished').hide();
    $('#protes').hide();
    $('#restart').hide();
    $('#soal').hide();
    $('#tombol').hide();
    $('#load').hide();
    $('#nama-select').hide();
    $('#containerSoal').hide();
}

function showAbout(){
    $('#about').fadeIn("fast");
    $('#init').hide();
    hilangkan();
}

function showHome(){
    $('#init').fadeIn("fast");
    $('#about').hide();
    hilangkan();
}