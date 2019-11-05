/*
$(document).ready(function(){
			$('#usuario-eliminar').on('change', function(){
			var id = $('#usuario-eliminar').val();
			var url = 'Classes/llenar_campos.php';
			$.ajax({
				type:'POST',
				url:url,
				data:'id='+id,
				success: function(data){
					console.log(data);
					$('#formulario-modificar').append(data);
				}
			});
			return false;
		});
		
	});
*/


jQuery(document).on('keyup','#buscar', function(event){
    var nombre = $('#buscar').val();
    if(nombre == ''){
        $('#nombre').val('');
        $('#apellido').val('');
        $('#correo').val('')
    }
    event.preventDefault();
    
    jQuery.ajax({
        url: 'classes/llenar_campos.php',
        type: 'POST',
        dataType: 'json',
        data:  'nombre='+nombre , 
        beforeSend: function(){
            $('.boton').val('Verificando...');
        }
    })
    .done(function (respuesta) { 
        
        console.log(respuesta);
        if(!respuesta.error){
           /* if(respuesta.tipo == "2"){
              location.href = 'superusuario.php';
            }else if(respuesta.tipo == "1"){
               location.href = 'importar.html';
            }*/
            var nombreCompleto = respuesta.nombre + " " + respuesta.apellido;
           	$('#nombre').val(respuesta.nombre);
           	$('#apellido').val(respuesta.apellido);
            $('#correo').val(respuesta.correoInstitucional);
            $('#codigo-empleado').val(respuesta.idUsuario);
            $('#nombre-carnet').html(nombreCompleto);
            $('#correo-carnet').html(respuesta.correoInstitucional);
            $('#nombre-carnet-2').html(nombreCompleto);
            $('#correo-carnet-2').html(respuesta.correoInstitucional);
            $('#imagen').attr("src",respuesta.urlImagen);
            $('#perfil').attr("src",respuesta.urlImagen)
        }else {
            /*$('.error').slideDown('slow');
            setTimeout(function(){
                $('.error').slideUp('slow');
            },3000);
            $('.boton').val('Ingresar');*/

        }
     })
     .fail(function (resp) { 
         console.log(resp.responseText);
      })
      .always(function () {
          console.log("complete");
        });
});



$("#btnModificar").click(function(){
    $("#btnGuardar").css("display", "inline");
    $("#nombre").removeAttr("disabled").focus();
    $("#apellido").removeAttr("disabled");
    $("#correo").removeAttr("disabled");
});
/*

jQuery(document).on('click','#btnGuardar', function(event){
        console.log("hola");
        event.preventDefault();
    if($("#correo").val() == '' || $("#nombre").val() == '' || $("#apellido").val() == '' || $("#codigo-empleado").val()== ''){
        $("#usuario-modificado").modal();
    }else{
        $.ajax({
            url:"validaciones/modificar_usuario.php",
            data:"email="+$("#correo").val()+"&name="+$("#nombre").val()+"&lastname="+$("#apellido").val()+"&usuarios="+$("#codigo-empleado").val(),
            method:"POST",
            dataType:"json"
        }).done(function (respuesta){
            console.log(respuesta);
            location.reload();
        }).fail(function (respuesta) { 
            console.log(respuesta);
         })
         .always(function () {
             console.log("complete");
           });
    }
        
    
});
*/
/*
function PrintElem(elem) {
    Popup($(elem).html());
}

function Popup(data) {
    var myWindow = window.open('', 'my div');
    myWindow.document.write('<html><head><title>Torneo Gallos</title>');
    myWindow.document.write('<link rel="stylesheet" href="css/print.css" type="text/css" />');
    myWindow.document.write('<link rel="stylesheet" href="css/superusuario.css" type="text/css"/>');
    myWindow.document.write('<link rel="stylesheet" href="css/main.css" type="text/css"/>');
    myWindow.document.write('<link rel="stylesheet" href="css/modal.css" type="text/css"/>');
    myWindow.document.write('</head><body >');
    myWindow.document.write(data);
    myWindow.document.write('</body></html>');
    myWindow.document.close(); // necessary for IE >= 10

    myWindow.onload=function(){ // necessary if the div contain images

        myWindow.focus(); // necessary for IE >= 10
        myWindow.print();
        myWindow.close();
    };
}*/

function printDiv(nombreDiv) {
     var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;

     document.body.innerHTML = contenido;

     window.print();

     document.body.innerHTML = contenidoOriginal;
}
