$("#nuevo-torneo").click(function(){
    var nombre = $('#nombreTorneo').val();
    console.log(nombre);
    if(nombre = ''){
        console.log("vacio");
    }else{
    jQuery.ajax({
        url: 'classes/nuevo_torneo.php',
        type: 'POST',
        dataType: 'json',
        data:  'parametro='+$('#nombreTorneo').val()
    })
    .done(function (respuesta) { 
        console.log(respuesta);
        
     })
     .fail(function (resp) { 
         console.log(resp.responseText);
      })
      .always(function () {
          console.log("complete");
        });
    }   
    $("#exito").modal();
});


$("#btnCambiar").click(function(){
    if(nombre = ''){
        console.log("vacio");
    }else{
    jQuery.ajax({
        url: 'classes/cambiar_gallos.php',
        type: 'POST',
        dataType: 'json',
        data:  'parametro='+$('#numero-gallos').val()
    })
    .done(function (respuesta) { 
        console.log(respuesta);
        
     })
     .fail(function (resp) { 
         console.log(resp.responseText);
      })
      .always(function () {
          console.log("complete");
        });
    }   
    $("#exito1").modal();
});