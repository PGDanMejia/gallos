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
                        <h2 class="text-center">Registrar resultados</h2>
                        <br>
                                
                        
                        <div id="resultados-peleas">    
                        <?php
                            $conexion = new mysqli("localhost","root","","gallos");
                            $idUltimoTorneo = mysqli_query($conexion, "SELECT MAX(idTorneo) as UltimoTorneo from torneos");
                            $datos = $idUltimoTorneo->fetch_assoc();
                            $idTorneoActual = $datos['UltimoTorneo'];
                            $verRondas = "SELECT a.idRonda, c.idEquipos as idEquipo1, c.nombreEquipo as nombreEquipo1, b.chapa as chapa1, b.descripcion as descripcion1 , e.idEquipos as idEquipo2,e.nombreEquipo as nombreEquipo2, d.chapa as chapa2, d.descripcion as descripcion2   FROM rondas a
                            LEFT JOIN gallos b on a.idGallos = b.idGallos
                            LEFT JOIN equipos c on b.idEquipos = c.idEquipos
                            LEFT JOIN gallos d on a.idGallos1 = d.idGallos
                            LEFT JOIN equipos e on d.idEquipos = e.idEquipos
                            WHERE a.idTorneo = $idTorneoActual";
                            $verRondas2 = mysqli_query($conexion, $verRondas);
                            $mensaje = "";
                            $h = 0;
                            while($tabla = mysqli_fetch_array($verRondas2)){
                                $h++;
                                echo "<div class='row'>";
                                echo "<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12'>";
                                echo "<label class='labels prueba'>GANADOR</label>  ";
                                echo "<input class='btn imprimir' id='boton".$tabla["idRonda"]."1' type='submit' onclick='ganador(".$tabla["idEquipo1"].",".$tabla["idRonda"].")' value='Equipo:". $tabla["nombreEquipo1"] . " Gallo chapa: ". $tabla["chapa1"] ."' />";
                                echo "</div> ";

                                echo "<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12'>";
                                echo "<label class='labels prueba'>GANADOR</label>";
                                //echo "<input class='btn Modificar' id='btnGuardar' type='submit'  value='Guardar' />";
                                echo "<input class='btn imprimir' id='boton".$tabla["idRonda"]."2' type='submit' onclick='ganador(".$tabla["idEquipo2"].",".$tabla["idRonda"].")' value='Equipo:". $tabla["nombreEquipo2"] . " Gallo chapa: ". $tabla["chapa2"] ."' />";
                                echo "</div> ";
                                echo "</div>";

                                echo "<div class='row'>";
                                echo "<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'><br>";
                                echo "<input style='width: 50%; margin: auto;' onclick='empate(".$tabla["idEquipo1"].", ".$tabla["idEquipo2"].",".$tabla["idRonda"].")' class='btn Modificar' id='boton".$tabla["idRonda"]."3' type='submit'  value='EMPATE' />";
                                echo "</div> ";
                                echo "</div> ";
                                echo "<br>";
                                echo "<br>";
                                echo "<br>";

                               // $mensaje .="<tr><th scope='row'>".$h."</th><td>Equipo: ". $tabla["nombreEquipo1"] . " Gallo chapa: ". $tabla["chapa1"] ."</td><td>Equipo: ". $tabla["nombreEquipo2"] . " Gallo chapa: ". $tabla["chapa2"] ."</td></tr>";
                            };
                        ?>
                        
                            
                                       
                                
                               
                            
                                    
                                
                                 
                        

                        
                            
                                
                                
                            
                              <br>
                              <br><br>
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