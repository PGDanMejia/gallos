<footer class="footer">
    <div class="col">
        <div class="text-center footer-copy">
            <p>&copy; Administración de torneo de gallos <?php echo date('Y'); ?>.</p>
        </div>
    </div>
</footer>

<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>js/jquery-3.3.1.min.js'></script>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>vendor/bootstrap-4.1.2-dist/js/bootstrap.min.js'></script>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>vendor/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js'></script>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>vendor/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js'></script>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>vendor/DataTables/Buttons-1.5.2/js/dataTables.buttons.min.js'></script>

<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>vendor/DataTables/Buttons-1.5.2/js/buttons.flash.min.js'></script>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>vendor/DataTables/jszip-3.1.3/jszip.min.js'></script>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js'></script>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>vendor/DataTables/pdfmake-0.1.36/vfs_fonts.js'></script>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>vendor/DataTables/Buttons-1.5.2/js/buttons.html5.min.js'></script>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>vendor/DataTables/Buttons-1.5.2/js/buttons.print.min.js'></script>

<!-- JS Personalizado -->
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>js/main.js'></script>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>js/login.js'></script>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>js/importar.js'></script>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>script.js'></script>



</body>
</html>

<!-- Modal de ayuda para reportes público -->
<div class="modal fade" id="ayudaReportes" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title info-importar" id="ModalLabel">Cómo generar reportes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>El <b>generador de reportes</b> es una herramienta que le permite consultar información acerca de los
                productos que entran y salen del país en un determinado mes. Dichos reportes contienen la siguiente información:
                <span>Fracción arancelaria y nombre del producto, cantidad(kg) exportada/importada, valor monetario(USD)
                y país origen/destino. En el caso de los reportes por país solo se muestran el código y nombre del país, la cantidad (Kg)
                y el valor monetario (USD). También existe la opción de mostrar el contenido sin agrupar.
                </span><br><br>
                Los pasos para generar un reporte son los siguientes:
                </p>
                <span><b>1.Indicar los datos del reporte que se desea generar</b></span><br>
                <p>Tales como tipo(Importación o Exportación), fecha y año.</p>
                <img src="<?php echo DIR; ?>img/reportes-1.png" alt="paso1"width="90%"class="info-imagenes">
                <br>
                <span><b>2.Haga click en el boton Generar Reporte</b></span><br>
                <p>A continuación se mostrará una tabla con la información solicitada</p>
                <img src="<?php echo DIR; ?>img/reportes-2.png" alt="paso2"width="90%" class="info-imagenes">
                <br>
                <span><b>4.Realice una búsqueda más específica</b></span><br>
                <p>Si lo desea, puede buscar un dato en específico en el reporte generado.</p>
                <img src="<?php echo DIR; ?>img/reportes-3.png" alt="paso3"width="90%" class="info-imagenes">
                <br>
                <span><b>4.Exporte el archivo generado</b></span><br>
                <p>Puede descargar el reporte generado en un documento Excel y mandarlo a imprimir en PDF o
                utilizando una impresora.</p>
                <img src="<?php echo DIR; ?>img/reportes-4.png" alt="paso4"width="90%" class="info-imagenes">
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" type="button" class="btn btn-primary entendido">Entendido</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de ayuda para agregar usuario -->
 <div class="modal fade" id="ayudaAgregarUsuario" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title info-importar" id="ModalLabel">Cómo agregar usuarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <!--MODIFICAR ESTE CONTENIDO -->
                <p>Para <b>agregar usuarios</b> nuevos al sistema, usted debe llenar los campos presentados en el
                formulario y luego darle click en el botón <span> Agregar usuario</span>.<br>
                <img src="<?php echo DIR; ?>img/agregar-usuario.png" alt="agregar"width="90%"class="info-imagenes">
                </p>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" type="button" class="btn btn-primary entendido">Entendido</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de ayuda para eliminar usuarios -->
 <div class="modal fade" id="ayudaEliminarUsuario" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title info-importar" id="ModalLabel">Cómo eliminar usuarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <!--MODIFICAR ESTE CONTENIDO -->
                <p>Para <b>eliminar usuarios</b> en el sistema, usted primero debe seleccionar un usuario a eliminar, esto mediante
                el botón desplegable. Luego debe darle click en el botón <span> Eliminar usuario</span>.<br>
                <img src="<?php echo DIR; ?>img/eliminar-usuario.png" alt="modificarr"width="90%"class="info-imagenes">
                </p>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" type="button" class="btn btn-primary entendido">Entendido</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de ayuda para modificar usuario -->
 <div class="modal fade" id="ayudaModificarUsuario" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title info-importar" id="ModalLabel">Cómo modificar usuarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <!--MODIFICAR ESTE CONTENIDO -->
                <p>Para <b>modificar usuarios</b> en el sistema, usted primero debe seleccionar un usuario a modificar, esto mediante
                el siguiente botón desplegable:
                <img src="img/modificar-usuario-1.png" alt="modificar"width="90%"class="info-imagenes">
                Luego, debe llenar los campos presentados en el formulario y darle click en el botón <span> Modificar usuario</span>.<br>
                <img src="img/modificar-usuario-2.png" alt="modificarr"width="90%"class="info-imagenes">
                </p>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" type="button" class="btn btn-primary entendido">Entendido</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de ayuda para eliminar archivos -->
 <div class="modal fade" id="ayudaEliminarArchivo" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title info-importar" id="ModalLabel">Cómo eliminar archivos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <!--MODIFICAR ESTE CONTENIDO -->
                <p>Para <b>eliminar archivos</b> en el sistema, usted primero debe seleccionar un archivo a eliminar, esto mediante
                el botón desplegable. Luego debe darle click en el botón <span> Eliminar archivo</span>.<br>
                <img src="<?php echo DIR; ?>img/eliminar-archivo.png" alt="modificarr"width="90%"class="info-imagenes">
                </p>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" type="button" class="btn btn-primary entendido">Entendido</button>
            </div>
        </div>
    </div>
</div>








