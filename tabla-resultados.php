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
                        <h2 class="text-center">Tabla de posiciones</h2>
                        <br>
                        <div id="visor-reportes">

                            <table id="log-table" class="table table-striped table-bordered display " style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nombre de equipo</th>
                                        <th>puntos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                            
                                    $data = $functions->listarPosiciones();

                                    foreach ($data as $value) {
                                      echo '<tr>';
                                        echo '<td>'.$value['nombreEquipo'].'</td>';
                                        echo '<td>'.$value['puntos'].'</td>';
                                      echo '</tr>';
                                    }
                             
                                  ?>
                                </tbody>
                            </table>
                        </div>  

                     </main>
                
                </div>
            </div>
            <div class="separator-bot"></div>
                          
        </div>
    </div>
</div>


<!-- Modal  Fotografia-->
<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="modalFoto" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id=""></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center><video id="video" style="display: block;"></video></center>
        <canvas id="canvas" style="display: none;"></canvas>
        <br>
        <br>
        <br>
        <center><input class="btn primary" id="startbutton" type="submit" Style= "width:50%; background-image: url(img/camera.png);"value="Capturar"  data-dismiss="modal"></center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>js/jquery-3.3.1.min.js'></script>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>js/registrar_resultado.js'></script>
                                        
<?php require('layout/footer.php');