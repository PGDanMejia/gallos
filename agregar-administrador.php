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
                                <h5>Agregar Administrador</h5>

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

                                <div class="w3ls-form">
                                    <form action="<?php echo DIR; ?>validaciones/ingresar_usuario.php" accept-charset="UTF-8" method="post">
                                        <div class="form-group">
                                            <label class="labels">Nombre:</label>
                                            <input class="form-control" id="nombre" type="text" name="name"  placeholder="Nombre" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="labels">Apellido:</label>
                                            <input class="form-control" id="apellido" type="text" name="lastname"  placeholder="Apellido" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="labels">Correo institucional:</label>
                                            <input class="form-control" id="correo" type="text" name="email"  placeholder="correo@ejemplo.com" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="labels">Contraseña:</label>
                                            <input class="form-control" id="contrasena" type="password" name="password" required />
                                        </div>
                                        <div class="form-group">
                                            <div id="error3"></div>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn registrar" id="btnRegistrar" type="submit" onclick="" value="Agregar usuario" />
                                        </div>
                                  </form>
                              </div>
                              
                                
                          </main>
                
                </div>
            </div>
            <div class="separator-bot"></div>
                          
        </div>
    </div>
</div>
                
<?php require('layout/footer.php');