<?php
    require('layout/header.php');
    
    if (isset($_SESSION['usuario']) && $_SESSION['tipo_usuario']==2) {
        $usuario = $_SESSION['usuario'];
    } else if(isset($_SESSION['usuario']) && $_SESSION['tipo_usuario']==1) {
        header("Location: importar.php");
        exit;    
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
                        <h2 class="text-center">Administración General</h2>
                        <br>
                                <h5>Agregar Empleado</h5>
                                <input type="hidden" id="btnGuardarFoto" name="" value="">


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

                                 <div class="row">
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
 							
                            <img src="img/default-profile.jpg"  style="width: 70%;" alt="" id="photo" alt="Foto de Perfil">
                            <br> <br>
                             <br><br>
                             <!-- Button trigger modal -->
                            <input class="btn imprimir" id="btn-modal" type="submit" value="Tomar Fotografía" data-toggle="modal" data-target="#modalFoto">
							</div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"> 
                       <div class="w3ls-form">
                                <form action="<?php echo DIR; ?>validaciones/ingresar_empleado.php" accept-charset="UTF-8" method="post">
                                    <div class="form-group">
                                        <label class="labels">Nombre:</label>
                                        <input  class="form-control" id="nombre" type="text" name="name"  placeholder="Nombre" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="labels">Apellido:</label>
                                        <input  class="form-control" id="apellido" type="text" name="lastname"  placeholder="Apellido" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="labels">Correo institucional:</label>
                                        <input  class="form-control" id="correo" type="text" name="email"  placeholder="correo@ejemplo.com" required/>
                                    </div>
                                    <!--div class="form-group">
                                        <label class="labels">Contraseña:</label>
                                        <input disabled class="form-control" id="contrasena" type="password" value="holaxd" name="password" required />
                                    </div-->
        
                                   <div class="form-group">
                                            <input type="hidden" id="foto" name="foto"> 

                                            
                                            <input class="btn registrar" id="btnRegistrar" type="submit" onclick="" value="Agregar Empleado" />

                                        </div>
                                    <br><br>
                                </form>
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

<?php
$my_server_img = 'http://images.askmen.com/galleries/cobie-smulders/picture-1-134686094208.jpg';
$img = imagecreatefromjpeg($my_server_img);
$path = 'img/';
imagejpeg($img, $path);
?>
<script src="js/jquery.min.js"></script>
<script src="js/controlador-camara.js" ></script>
<script src="js/bootstrap.min.js"></script>
                                        
<?php require('layout/footer.php');