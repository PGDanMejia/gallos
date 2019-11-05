$("#btnGenerarRondas").click(function(){
    console.log("hola");
    jQuery.ajax({
        url: 'classes/ver_gallos.php',
        type: 'POST',
        dataType: 'HTML'
    })
    .done(function (respuesta) { 
        $("#tabla-rondas").append(respuesta);
        $('#btnGenerarRondas').attr("disabled", true);
        console.log(respuesta);
     })
     .fail(function (resp) { 
         console.log(resp.responseText);
      })
      .always(function () {
          console.log("complete");
        });
});

