$(document).ready(function() {

	$('#contrasena').keyup(function() {

		var pass2 = $('#contrasena').val();

		if ( pass2.length>=8 ) {
			document.getElementById("error3").style.color = "green";
			$('#error3').text("Contraseña valida");
			 var btn = document.getElementById('btnRegistrar');
             btn.disabled=false;
		} else {
			document.getElementById("error3").style.color = "red";
			$('#error3').text("Contraseña incorrecta, minimo 8 caracteres");
			 var btn = document.getElementById('btnRegistrar');
             btn.disabled=true;
		}

	});

});