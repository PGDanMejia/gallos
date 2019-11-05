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
                        <h2 class="text-center">Revisión de equipos</h2>
                        <br>
                        <div id="visor-reportes">
                                <form id="datos" class="form-inline" role="form" method="post" action="" autocomplete="off">
                                  <?php
                                  //check for any errors
                                  if(isset($error)){
                                  foreach($error as $error){
                                    echo '<p class="bg-danger">'.$error.'</p>';
                                   }
                                  }
                                  ?>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                    <?php
                                                $conexion = new mysqli("localhost","root","","gallos");
                                                $idUltimoTorneo = mysqli_query($conexion, "SELECT MAX(idTorneo) as UltimoTorneo from torneos");
                                                $datos = $idUltimoTorneo->fetch_assoc();
                                                $idTorneoActual = $datos['UltimoTorneo'];
                                                $result = mysqli_query($conexion, "SELECT idEquipos, nombreEquipo FROM equipos WHERE idTorneo = $idTorneoActual");
                                                echo "<select name='idEquipo' id='idEquipo' class='form-control'>";
                                                echo "<option value='0'>Mostrar equipos...</option>";
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<option value='" . $row['idEquipos'] . "'>" . $row['nombreEquipo'] . "</option>";
                                                }
                                                echo "</select>";
                                        ?>
                                  </div>
                                
                                  <div class="col-lg-3 col-md-6 col-sm-12">
                                    <input type="submit" name="submit" value="Mostrar" class="btn btn-generar">
                                    <br>
                                   
                                  </div>
                                  </form>
                                  
                                             
                              <table id="log-table" class="table table-striped table-bordered display " style="width:100%">
                              <thead class="thead-dark">
                                  <tr>
                                      <th>Equipo</th>
                                      <th>Chapa</th>
                                      <th>Peso</th>
                                      <th>Descripción</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                if(isset($_POST['submit'])){
                                  $data = $functions->listarGallosEquipo($_POST['idEquipo']);

                                  foreach ($data as $value) {
                                    echo '<tr>';
                                      echo '<td>'.$value['nombreEquipo'].'</td>';
                                      echo '<td>'.$value['chapa'].'</td>';
                                      echo '<td>'.$value['peso'].'</td>';
                                      echo '<td>'.$value['descripcion'].'</td>';
                                    echo '</tr>';
                                  }
                                }
                                ?>
                              </tbody>
                              </table>
                              <input id="eliminar" type="submit" name="" value="Eliminar" class="btn btn-generar">
                        </div>
                    </main>
                
                </div>
            </div>
            <div class="separator-bot"></div>
                          
        </div>
    </div>
</div>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>js/jquery-3.3.1.min.js'></script>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>js/eliminar_equipo.js'></script>                
<?php require('layout/footer.php');