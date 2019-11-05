<?php
require('layout/header.php');
    
    if (isset($_SESSION['usuario']) ) {
        $usuario = $_SESSION['usuario'];
    } else{
        session_unset();
        session_destroy();
        header("location: index.php");
        die();
    }
?>

<script type="text/javascript">
    var formatoReporte = '0';
    var tipoReporte = '0';
    var mesReporte = '0';
    var mesInicial = '0';
    var mesFinal = '0';
    var anioReporte = '0';
    var tipo = '0';
    var formato = '0';
</script>

<input id="report-title-dim" type="hidden">

<div class="separator-top"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10 text-center">

            <div id="contenido">
                <div class="row main-cont">

                    <?php
                     require('layout/menu.php');
                ?>
                  
                    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                        <br>
                        <h2 class="text-center">Configuración</h2>
                        <br>

                            
                                <div class="w3ls-form">
                                        <div class="form-group">
                                            <label class="labels">Nombre Torneo:</label>
                                            <input class="form-control" id="nombreTorneo" type="text" name="name"  placeholder="Nombre" required/>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn registrar" id="nuevo-torneo" type="submit" onclick="" value="Nuevo Torneo" />
                                        </div>
                                        <div class="form-group">
                                            <label class="labels">Numero de gallos:</label>
                                            <select name='idEquipo' id='numero-gallos' class='form-control'>
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>
                                                <option value='4'>4</option>
                                                <option value='5'>5</option>
                                                <option value='6'>6</option>
                                                <option value='7'>7</option>
                                                <option value='8'>8</option>
                                                <option value='9'>9</option>
                                                <option value='10'>10</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn registrar" id="btnCambiar" type="submit" onclick="" value="Cambiar numero de gallos" />
                                        </div>
                                       
                                        
                                  
                              </div>
                              

                                                  <!-- Modal -->
<div class="modal fade" id="exito" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">¡Nuevo torneo creado!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="body-modal" class="modal-body">
        Se ha creado un nuevo torneo exitosamente.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

                                                  <!-- Modal -->
                                                  <div class="modal fade" id="exito1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Número de gallos modificado!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="body-modal" class="modal-body">
        El numero de gallos por equipo ha sido modificado para este torneo.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


                                
                          </main>
                
                </div>
            </div>
            <div class="separator-bot"></div>
                          
        </div>
    </div>
</div>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>js/jquery-3.3.1.min.js'></script>
<script type="text/javascript" language="javascript" src='js/configuracion.js'></script>
<?php require('layout/footer.php');