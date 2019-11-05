$("#eliminar").click(function(){
    console.log("hola");
    jQuery.ajax({
        url: 'classes/eliminar_equipo.php',
        type: 'POST',
        dataType: 'json',
        data: 'idEquipo='+$("#idEquipo").val()
    })
    .done(function (respuesta) { 
        console.log($("#idEquipo").val());
        console.log(respuesta);
     })
     .fail(function (resp) { 
         console.log(resp.responseText);
      })
      .always(function () {
          console.log("complete");
        });
});

