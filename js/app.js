var fini = false;
var myTour = false;
var session = -1;


$(window).load(function(){
	session = $('#session').html();
	$('.startRow').show();
	$('.playRow').hide();
	$("#closeAlert").click();
});

$(window).ready(function(){
	$('.startRow').show();
	$('.playRow').hide();
	$('#buttonReady').click(function(){
		$.ajax({
			type : "GET",
			url : "ready.php",
			data : "ready=true&pseudo="+$('#inputPseudo').val(),
		});
		$('.startRow').hide();
		$('.playRow').show();
		$('#myModal').modal('toggle');
	});

	$('#inputPseudo').keyup(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
			$.ajax({
				type : "GET",
				url : "ready.php",
				data : "ready=true&pseudo="+$('#inputPseudo').val(),
			});
			$('.startRow').hide();
			$('.playRow').show();
			$('#myModal').modal('toggle');
		}
	});
	$('#word').keyup(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
			if( fini==false ){
				$.ajax({
					type: 'GET',
					url: 'checkWord.php',
					data: "word="+$('#word').val(),
					success: function(data) {
						if(data == "yes"){
							$('#word').css("border-color","green");
							$('#word').css("color","green");
							//$('#compteur').hide();
							fini = true;
							myTour = false;
							$('#word').val('');
							$('#word').prop('disabled', true);
							//charge(session);
							$(".progress-bar").css("width", 0 + "%");
						}
						else{
							$('#word').animate({"margin-left":20},20,"swing");
							$('#word').animate({"margin-left":0},20,"swing");
							$('#word').animate({"margin-left":20},20,"swing");
							$('#word').animate({"margin-left":0},20,"swing");
							$('#word').css("border-color","red");
							$('#word').css("color","red");
						}
					}
				});
			}
		}
		/*else{
			$.ajax({
				type: 'GET',
				url: 'checkWord.php',
				data: "wordW="+$('#word').val()
			});
		}*/
	});
});



function time(duree){
	var compteur=document.getElementById('compteur'+session);
	s=duree;
	var base = 200;
	if(myTour){
		if(s<0){
			fini = true;
			$.ajax({
						type: 'GET',
						url: 'checkWord.php',
						data: "timeOut=true",
						success : function(data){
							if(data=="out"){
								$('#loose').modal('toggle');
								session=-1;
							}
						}

			});
			fini = true;
			myTour = false;
			$('#word').animate({"margin-left":20},20,"swing");
			$('#word').animate({"margin-left":0},20,"swing");
			$('#word').animate({"margin-left":20},20,"swing");
			$('#word').animate({"margin-left":0},20,"swing");
			$('#word').css("border-color","red");
			$('#word').css("color","red");

		}
		else if(fini == false){
			//compteur.innerHTML=Math.floor(s);
			duree=duree-5;
			if(duree >= 0.5*base){
				if( ! $(".progress-bar").hasClass("progress-bar-succes") ){
					$(".progress-bar").addClass("progress-bar-success");
					$(".progress-bar").removeClass("progress-bar-danger");
					$(".progress-bar").removeClass("progress-bar-warning");
					$(".progress-bar").removeClass("progress-bar-infos");
				}
			}
			else if(duree>=0.2*base){
				if( ! $(".progress-bar").hasClass("progress-bar-warning") ){
					$(".progress-bar").removeClass("progress-bar-success");
					$(".progress-bar").removeClass("progress-bar-danger");
					$(".progress-bar").addClass("progress-bar-warning");
					$(".progress-bar").removeClass("progress-bar-infos");
				}
			}
			else if(duree >= 0){
				if( ! $(".progress-bar").hasClass("progress-bar-danger") ){
					$(".progress-bar").removeClass("progress-bar-success");
					$(".progress-bar").addClass("progress-bar-danger");
					$(".progress-bar").removeClass("progress-bar-warning");
					$(".progress-bar").removeClass("progress-bar-infos");
				}
			}
			 $(".progress-bar").css("width", duree/2 + "%");
			 $.ajax({
				 type : 'GET',
				 url : 'setTime.php',
				 data : 'time='+duree
			 });
			if(session != -1){
				window.setTimeout("time("+duree+");",499);
			}
		}
	}
}

/*function charge(x){
	$.ajax({
		url : "charge.php", // on passe l'id le plus récent au fichier de chargement
		type : 'GET',
		data : "id="+x,
		success : function(data){
			if(!myTour && data.tour==session){
				myTour = true;
				fini = false;
				$.ajax({
					url : "model.php", // on passe l'id le plus récent au fichier de chargement
					type : 'GET'
				});
				time(100);
			}
			$('.user').css("border-color","black");

			$('#user'+data.tour).css("border-color","red");
			$('#proposition'+data.tour).html(data.proposition);
		}
	});

}*/
function charger(){

    setTimeout( function(){
        // on récupère l'id le plus récent
		$.ajax({
            url : "charge.php", // on passe l'id le plus récent au fichier de chargement
            type : 'GET',
            success : function(data){
				if(!myTour && parseInt(data.tour)==parseInt(session) && session!=-1){
					myTour = true;
					fini = false;
					$.ajax({
						url : "model.php",
						type : "GET"
					})
					$('#word').prop('disabled', false);
					$.ajax({
						type: 'GET',
						url: 'checkWord.php',
						data: "wordW="
					});
					time(200);
				}
				else if(parseInt(data.tour)!=parseInt(session)){
					if( ! $(".progress-bar").hasClass("progress-bar-infos") ){
						$(".progress-bar").removeClass("progress-bar-success");
						$(".progress-bar").removeClass("progress-bar-danger");
						$(".progress-bar").removeClass("progress-bar-warning");
						$(".progress-bar").addClass("progress-bar-infos");
					}
					$(".progress-bar").css("width", data.time/2 + "%");
				}
				$('#model').html(data.model);
			}
        });
        $.ajax({
        	url : "chargeUser.php",
        	type : "GET",
        	success : function(data){
        		if(data != $('#blockUser').html()){
        			$('#blockUser').html(data);
        		}
        	}
        });
        charger();
    }, 500);
}

function pret(){
	var p=false;
	var x="aze";
    setTimeout( function(){
    	$.ajax({
            url : "ready.php", // on passe l'id le plus récent au fichier de chargement
            type : 'GET',
            success : function(data){
				if(data == "true"){
					charger();
				}
				else{
					pret();
				}
			}
		});
		$.ajax({
			url : "chargeUser.php",
			type : "GET"
		});
	},500);
}

pret();




/*
function bomb(){
		var timer= 20000;
	var stop = $.now()+timer;
	var time = 300 + ( stop - $.now() )/40;
	while(time>300){
		time = 300 + ( stop - $.now() )/40;
		$('#timer').html(time);
		$('#bomb').animate({width:200},50,"swing");
		$('#bomb').animate({width:170},time,"swing");
	}
}
function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}*/

$(window).bind("beforeunload", function(){
		$(window).load("checkWord.php?timeOut=true");
		$(window).load("dec.php");
});
