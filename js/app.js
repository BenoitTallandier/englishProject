var fini = false;
var myTour = false;
var session = -1;

$(window).load(function(){
	session = $('#session').html();
});

$(window).ready(function(){
	$('#word').keypress(function(event){
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
							charge(session);
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
	});
});



function time(duree){
	var compteur=document.getElementById('compteur'+session);
	s=duree;
	if(s<0){
		fini = true;
		$.ajax({
					type: 'GET',
					url: 'checkWord.php',
					data: "timeOut=true"
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
		compteur.innerHTML=s;
		duree=duree-1;
		window.setTimeout("time("+duree+");",999);
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
				if(!myTour && parseInt(data.tour)==parseInt(session)){
					myTour = true;
					fini = false;
					
					$('#word').prop('disabled', false
					time(100);
				}
				else if(parseInt(data.tour)!=parseInt(session)){
					//alert("data : "+parseInt(data.tour)+", session :"+parseInt(session));
				}
				$('.user').css("border-color","black");

				$('#user'+data.tour).css("border-color","red");
				$('#model').html(data.model);
                $('#proposition'+data.tour).html(data.proposition);
			}
        });
        charger();
    }, 100);
}


charger();




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