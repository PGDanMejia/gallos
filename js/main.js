$(document).ready(function() {

    var DIR = location.protocol + '//' + location.host;
    var fechaFinalReporte = '0';

    if(formatoReporte == 1) { formato = 'por Fracción Arancelaria'; }
    else if(formatoReporte == 2) { formato = 'por País'; }
    else if(formatoReporte == 3) { formato = 'sin Agrupar'; }

    if(tipoReporte == 1) { tipo = 'Exportaciones'; }
    else if(tipoReporte == 2) { tipo = 'Importaciones'; }

    if(isEmpty(mesReporte) == true) { mesReporte = '00'; }
    if(isEmpty(mesInicial) == true) { mesInicial = '00'; }
    if(isEmpty(mesFinal) == true) { mesFinal = '00'; }
    if(isEmpty(anioReporte) == true) { anioReporte = '0000'; }

    if(isEmpty(formatoReporte) == true) { formato = '00'; }
    if(isEmpty(tipoReporte) == true) { tipo = '00'; }

    fechaReporte = 'Fecha(mes/año): '+ mesReporte +'/'+ anioReporte +'.';
    rangoReporte = 'Rango de fecha(mes/año): '+ mesInicial +'/'+ anioReporte +' al '+ mesFinal +'/'+ anioReporte +'.';

    if(mesReporte != "00" && anioReporte != "00") {
        fechaFinalReporte = fechaReporte;
        document.getElementById('report-title-dim').innerHTML += '<div class="col text-center"><h2>Reporte de '+ tipo + ' ' + formato +' en base a permisos de SENASA.</h2>' +
        '<h4>'+ fechaFinalReporte +'</h4></div>';
    }

    if(mesInicial != "00" && anioReporte != "00" && mesFinal != "00") {
        fechaFinalReporte = rangoReporte;
        document.getElementById('report-title-dim').innerHTML += '<div class="col text-center"><h2>Reporte de '+ tipo + ' ' + formato +' en base a permisos de SENASA.</h2>' +
        '<h4>'+ fechaFinalReporte +'</h4></div>';
    }

    // SUM PLUGIN
    jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
        return this.flatten().reduce( function ( a, b ) {
            if ( typeof a === 'string' ) {
                a = a.replace(/[^\d.-]/g, '') * 1;
            }
            if ( typeof b === 'string' ) {
                b = b.replace(/[^\d.-]/g, '') * 1;
            }

            return a + b;
        }, 0 );
    } );

    $('#log-table').DataTable({
        responsive: false,
        ordering: true,
        bSort: false,
        aaSorting: [],
        info: true,
        language: {
            search: 'Buscar',
            zeroRecords: 'No se encontraron registros para mostrar.',
            info: 'Mostrando página _PAGE_ de _PAGES_',
            infoEmpty: 'No hay registros disponibles.',
            infoFiltered: '(filtrado de _MAX_ registros totales)',
            emptyTable: 'No hay registros en la base de datos.',
            lengthMenu: 'Mostrar _MENU_ registros',
            paginate: {
                first:      "Primer",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "&Uacute;ltimo"
            }
        }
    });

    $('#main-table').DataTable({
        responsive: false,
        paging: true,
    	ordering: true,
        bSort: false,
        aaSorting: [],
    	info: true,
    	language: {
    		search: 'Buscar',
    		zeroRecords: 'No se encontraron registros para mostrar.',
    		info: 'Mostrando página _PAGE_ de _PAGES_',
    		infoEmpty: 'No hay registros disponibles.',
    		infoFiltered: '(filtrado de _MAX_ registros totales)',
    		emptyTable: 'No hay registros en la base de datos.',
    		lengthMenu: 'Mostrar _MENU_ registros',
    		paginate: {
	            first:      "Primer",
	            previous:   "Anterior",
	            next:       "Siguiente",
	            last:       "&Uacute;ltimo"
        	},
            decimal: '.',
            thousands: ','
    	},
        dom: 'Bfrtip',
        buttons: [
            { 
                extend: 'excel',
                title: '',
                text: 'Excel',
                messageTop: 'Reporte de '+ tipo + ' ' + formato +' en base a permisos de SENASA. ' + fechaFinalReporte,
                messageBottom: 'Elaborado por el sistema SAG-Infoagro.'
            },
            { 
                extend: 'print',
                title: '',
                text: 'Imprimir',
                customize: function ( win ) {
                    $(win.document.body)
                        .prepend(
                            '<div class="row">' +
                                '<div class="col-6 text-left">' +
                                    '<img src="'+ DIR +'/infoagro/img/infoagro_logo_texto.png" width="300px" style="position:relative; top:0;">' +
                                '</div>' +
                                '<div class="col-6 text-right">' +
                                    '<img src="'+ DIR +'/infoagro/img/logo_sag_horizontal.png" width="300px" style="position:relative; top:0;">' +
                                '</div>' +
                            '</div>' +
                            '<hr style="height: 3px; background: #5182bb;">'
                        );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                },
                messageTop: '<div class="col text-center"><h2>Reporte de '+ tipo + ' ' + formato +' en base a permisos de SENASA.</h2><br>' +
                '<h4>'+ fechaFinalReporte +'</h4>' +
                '</div><br>',
                messageBottom: '<br><h3>Elaborado por el sistema SAG-Infoagro.</h3>'
            }, 
        ],
        "footerCallback": function (row, data, start, end, display) {
            var api = this.api(),
                columns = [2, 3]; // Add columns here

            for (var i = 0; i < columns.length; i++) {
                $('tfoot th').eq(columns[i]).html( api.column(columns[i], {filter: 'applied'}).data().sum() );
                //$('tfoot th').eq(columns[i]).append('Page: ' + api.column(columns[i], { filter: 'applied', page: 'current' }).data().sum());
            }
        }

    });

});

function isEmpty(val){
    return (val === undefined || val == null || val.length <= 0) ? true : false;
}

