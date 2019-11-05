function ganador(idGanador, idRonda){
    jQuery.ajax({
        url: 'classes/registrar_ganador.php',
        type: 'POST',
        dataType: 'HTML',
        data: 'idGanador='+idGanador
    })
    .done(function (respuesta) { 
        console.log(respuesta);
        $(`#boton${idRonda}1`).attr("disabled", true);
        $(`#boton${idRonda}2`).attr("disabled", true);
        $(`#boton${idRonda}3`).attr("disabled", true);

     })
     .fail(function (resp) { 
         console.log(resp.responseText);
      })
      .always(function () {
          console.log("complete");
        });
};



function empate(idParticipante1, idParticipante2, idRonda){
    jQuery.ajax({
        url: 'classes/registrar_empate.php',
        type: 'POST',
        dataType: 'HTML',
        data: 'idParticipante1='+idParticipante1 +"&"+'idParticipante2='+idParticipante2
    })
    .done(function (respuesta) { 
        console.log(respuesta);
        $(`#boton${idRonda}1`).attr("disabled", true);
        $(`#boton${idRonda}2`).attr("disabled", true);
        $(`#boton${idRonda}3`).attr("disabled", true);

     })
     .fail(function (resp) { 
         console.log(resp.responseText);
      })
      .always(function () {
          console.log("complete");
        });
};