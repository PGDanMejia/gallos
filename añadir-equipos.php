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

<head>
<title>Torneo de gallos</title>

<!-- For - Mobile - Apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Credit Card Style Payment Widget A Flat Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, 
Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Webdesign" />
<script type="application/x-javascript"> addEventListener("load"), function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //For - Mobile - Apps -->

<!-- Style --> <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href=" css/print.css" media="print" />


</head>



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



<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<input id="report-title-dim" type="hidden">

<div class="separator-top"></div>

<div class="container-fluid">
<div id="carnet-imprimir1" style="display: none;">
        <div class="container">

            <div class="paymentbox">
                
            <img id="empresa" src="images/company1.png" alt="">
                <div>
            <img id="perfil" src="images/foto.jpg" alt="">
            </div>
                
                <div id="datos" >
                        <p id="encabezado" class="encabezado">Nombre del empleado</p>
                        <p id="nombre-carnet"></p>
                        <p id="encabezado">Correo institucional</p>
                        <p id="correo-carnet"></p>
                        <p id="encabezado">Cargo laboral</p>
                        <p id="infor">Auxiliar de Recursos Humanos</p>
                </div>
        
                
                
        
            </div>
        
        </div>
	
        <div class="container2">
        
                <div class="paymentbox">
            
                <img id="empresa" src="images/company1.png" alt="">
                    
                <img id="barras" src="images/barras.png" alt="">
                    
                    <div id="datos2" >
                            
                            <p id="nombre-carnet-2"></p>
                            
                            <p id="correo-carnet-2"></p>
                            
                    </div>
            
                    
                    
            
                </div>
		
		</div>
</div>


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
                        <h2 class="text-center">Añadir equipos</h2>
                        <br>
                        <?php 
                                if(isset($_SESSION['error']) ){
                                        $message = $_SESSION['error'];
                                    ?>
                                          <div class="alert alert-danger alert-dismissible">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <?php echo $message;?>
                                        </div>
                                    <?php 
                                  }else if(isset($_SESSION['exito']) ){
                                        $message = $_SESSION['exito'];
                                    ?>
                                          <div class="alert alert-success alert-dismissible">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <?php echo $message;?>
                                        </div>
                                    <?php }
                                    unset($_SESSION['exito']);
                                    unset($_SESSION['error']);
                            ?>
                        <label class="labels prueba">Nombre de equipo:</label>            
                        <input class="form-control" id="nombreEquipo" type="text" name="name"  placeholder="Nombre de equipo" required/>

                                    
                        <label class="labels prueba">Enmachamado:</label>      
                                          <?php
                                                $conexion = new mysqli("localhost","root","","gallos");
                                                $idUltimoTorneo = mysqli_query($conexion, "SELECT MAX(idTorneo) as UltimoTorneo from torneos");
                                                $datos = $idUltimoTorneo->fetch_assoc();
                                                $idTorneoActual = $datos['UltimoTorneo'];
                                                $result = mysqli_query($conexion, "SELECT idEquipos, nombreEquipo FROM equipos WHERE idTorneo = $idTorneoActual");
                                                echo "<select id='enmachamado' class='form-control'>";
                                                echo "<option value='0'>No</option>";
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<option value='" . $row['idEquipos'] . "'>" . $row['nombreEquipo'] . "</option>";
                                                }
                                                echo "</select>";
                                        ?>
                                  
                        <br>
                        <br>
       
                         <div class="row">
                         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"> 
                         
                         <div>
                                     

                                <div id="numero-gallos">     
                                      
                                </div>

                                    <div class="row">
                                    
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                            <input class="btn imprimir" id="btnImprimir" type="submit" onclick="javascript:window.print()" value="Imprimir inscripción" />
                                        </div>    
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                        <form action="<?php echo DIR; ?>validaciones/eliminar_usuario.php" method="post">
                                                <input type="hidden" name="usuarios" id="codigo-empleado">
                                                <!--input class="btn Eliminar" id="btnEliminar" type="submit" onclick="" value="Eliminar" /-->
                                        </form>        
                                        </div> 
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">    
                                            <input class="btn Modificar" id="btnGuardar" type="submit"  value="Guardar" />
                                        </div>      <br><br><br>
                                    <!--input class="btn imprimir" id="btnGuardar" type="submit"  value="Guardar" style="display:none;"/-->
                                    </div>
                                    <br><br>
                                <!--/form-->
                                    
    

                            </div>
                            </div>
                            </div> 




                            




                    </main>
                    

                    <!-- Modal -->
<div class="modal fade" id="campos-vacios" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">¡Espacios vacios!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="body-modal" class="modal-body">
        ¡Cuidado! Es importante que todos los datos esten llenos antes de continuar.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



                    <!-- Modal -->
<div class="modal fade" id="exito" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">¡Información guardada!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="body-modal" class="modal-body">
        Se ha guardado con exito la información.
      </div>
      <div class="modal-footer">
        <button id="cerrar-info" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>




                    
                </div>
            </div>
            <div class="separator-bot"></div>

        </div>
    </div>

</div>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>js/jquery-3.3.1.min.js'></script>
<script type="text/javascript" language="javascript" src='<?php echo DIR; ?>js/equipos.js'></script>
<?php require('layout/footer.php'); ?>
        