	
	/*Tekstikentän selite*/
	
	$( "input" ).focus(function() {
		$(this).parent().next('.notification').fadeIn(400, function() {
			$( this ).css( "display", "inline" );
		});
	});
	$( "input" ).focusout(function() {
		$( ".notification" ).css( "display", "none" );
	});
	
	/*Käyttäjätunnus*/
	
	$( ".reg-username" ).on('input', function() {
		var value = $( this ).val();
		if ( value.length < 5 || value.length > 30) {
			$( ".icon-usr" ).css( "background-image", "url(layout/icon_deny.png)" );
			error = true;
		}
		else {
			$( ".icon-usr" ).css( "background-image", "url(layout/icon_accept.png)" );
		}
	});
	
	/*Salasana*/
	
	$( ".reg-passwd" ).on('input', function() {
		var value = $( this ).val();
		if ( value.length < 5 || value.length > 30) {
			$( ".icon-passwd" ).css( "background-image", "url(layout/icon_deny.png)" );
		}
		else {
			$( ".icon-passwd" ).css( "background-image", "url(layout/icon_accept.png)" );
		}
	});
	
	/*Vahvistus*/
	
	$( ".reg-confirm" ).on('input', function() {
		var passwrd = $( ".reg-passwd" ).val();
		var value = $( this ).val();
		if ( value == passwrd && value.length >= 5) {
			$( ".icon-confirm" ).css( "background-image", "url(layout/icon_accept.png)" );
		}
		else {
			$( ".icon-confirm" ).css( "background-image", "url(layout/icon_deny.png)" );
		}
	});
	
	/*Sähköposti*/
	
	/*sähköpostiosoitteen tarkistus*/
	function validateEmail($email) {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if( !emailReg.test( $email ) ) {
			return false;
		} 
		else {
			return true;
		}
	}
	
	$( ".reg-email" ).on('input', function() {
		var value = $( this ).val();
		if ( value.length < 5 || value.length > 50) {
			$( ".icon-email" ).css( "background-image", "url(layout/icon_deny.png)" );
		}
		else {
			if( validateEmail(value)) {
			$( ".icon-email" ).css( "background-image", "url(layout/icon_accept.png)" );
			}
			else {
			$( ".icon-email" ).css( "background-image", "url(layout/icon_deny.png)" );
			}
		}
	});
	
	/*Lomakkeen lähetys*/
	
	$('#registerationForm').submit(function(ex){
	
		$(".noti").empty();
		var error = false;
		
		/*käyttäjätunnuksen tarkastus*/
		var ktunnus = $( ".reg-username" ).val();
		if( ktunnus.length < 5 || ktunnus.length > 30) {
			error = true;
		}
		/*salasanan tarkastus*/
		var salasana = $( ".reg-passwd" ).val();
		if( salasana.length < 5 || salasana.length > 30) {
			error = true;
		}
		/*salasanan vahvistus*/
		var varmistus = $( ".reg-confirm" ).val();
		if( varmistus != salasana) {
			error = true;
		}
		/*sähköpostin tarkastus*/
		var sposti = $( ".reg-email" ).val();
		if( sposti.length < 5 || sposti.length > 50) {
			error = true;
		}
		else if (!validateEmail(sposti)) {
			error = true;
		} 
		/*käyttöehtojen tarkastus*/
		if ($('input#checkboxRegister').is(':checked')) {
			error = false;
		} else {
			error = true;
		}
		
		/*Virheen sattuessa näytetään virheilmoitus*/
		if (error) {
			$("#notification").css("display", "inline").hide().fadeIn(200);
			$(".noti").append("Tarkista, että olet täyttänyt kaikki kohdat ja hyväksynyt käyttöehdot.");
			ex.preventDefault(ex);
			
			setTimeout(function() {
				$('#notification').fadeOut('slow');
			}, 4000);
		}
	   
	});
	
	/*Piilotetaan virheilmoitus, kun valinta häviää*/
	$('.reg-submit').focusout(function(){
		$("#notification").css("display", "none");
	});