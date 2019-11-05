
var numeroGallos;
$(document).ready(function(){
  $.ajax({
    url:"classes/obtener_configuracion.php",
    method:"POST",
    dataType:"json"
}).done(function (respuesta){
    console.log(respuesta);
    numeroGallos = respuesta.valorConfiguracion;
    for(i = 1; i <= numeroGallos; i++){
        $("#numero-gallos").append(`
        <h2 class="text-center">Gallo #${i}</h2>
        <div class="row">
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"> 
       <div class="form-group">
           <label class="labels prueba">Chapa:</label>
           <input  class="form-control" id="chapa-gallo-${i}" type="text" name="name"  placeholder="Chapa" required/>
       </div>
       </div>

       <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
       <div class="form-group">
           <label class="labels">Peso:</label>
           <input  class="form-control" id="peso-gallo-${i}" type="text" name="lastname"  placeholder="Peso" required/>
       </div>
       </div>
       </div>

       <div class="form-group">
           <label class="labels">Descripción:</label>
           <input  class="form-control" id="descripcion-gallo-${i}" type="text" name="email"  placeholder="Descripción" required/>
       </div><br><br>
       <div class="form-group">
       </div>  
        
        `);
    }
}).fail(function (respuesta) { 
    console.log(respuesta);
 })
 .always(function () {
     console.log("complete");
   });
  

  });






$("#btnGuardar").click(function(){
    var nombre = $('#nombreEquipo').val();
    var enmachamado = $("#enmachamado").val();
    var c = 0;
    console.log(nombre);
    if(nombre == ''){
        c = c + 1;
    }
    for(i = 1; i <= numeroGallos; i++){
        var chapa = $(`#chapa-gallo-${i}`).val();
        var peso = $(`#peso-gallo-${i}`).val();
        var descripcion = $(`#descripcion-gallo-${i}`).val();
        if(chapa == '' || peso == '' || descripcion == ''){
            c = c + 1;
        }
    }
    if(c != 0){
        $("#campos-vacios").modal();
    }else{
    jQuery.ajax({
        url: 'classes/guardar_equipo.php',
        type: 'POST',
        dataType: 'json',
        data:  'nombre='+nombre + "&" + 'enmachamado='+enmachamado 
    })
    .done(function (respuesta) { 
        for(i = 1; i <= numeroGallos; i++){
            var chapa = $(`#chapa-gallo-${i}`).val();
            var peso = $(`#peso-gallo-${i}`).val();
            var descripcion = $(`#descripcion-gallo-${i}`).val();
            var numerEquipo = respuesta;
            jQuery.ajax({
                url: 'classes/guardar_gallos.php',
                type: 'POST',
                dataType: 'json',
                data:  'chapa='+chapa + "&" +'peso='+peso + "&" + 'descripcion='+descripcion + "&" +"numeroEquipo="+numerEquipo
            });
        }
        $("#exito").modal();
        
     })
     .fail(function (resp) { 
         console.log(resp.responseText);
      })
      .always(function () {
          console.log("complete");
        });}
});



$("#cerrar-info").click(function(){location.reload();});
/*
function PrintElem(elem) {
    Popup($(elem).html());
}

function Popup(data) {
    var myWindow = window.open('', 'my div');
    myWindow.document.write('<html><head><title>Torneo Gallos</title>');
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
}
*/

function printDiv(nombreDiv) {
    var contenido= document.getElementById(nombreDiv).innerHTML;
    var contenidoOriginal= document.body.innerHTML;

    document.body.innerHTML = contenido;

    window.print();

    document.body.innerHTML = contenidoOriginal;
}