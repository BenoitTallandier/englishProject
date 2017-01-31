$(window).load(function(){
	var timer = 20;
	while(true){		
		setTimeout( function(){       
				$('#timer').html=(parseInt($('#timer').val())-1);
		}, 1000);
	}
});