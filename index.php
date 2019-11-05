<?php 
    require('layout/header.php'); 

    if (isset($_SESSION['usuario']) && $_SESSION['tipo_usuario']==1){
        header("Location: importar.php");
        exit;
    } else if(isset($_SESSION['usuario']) && $_SESSION['tipo_usuario']==2){
        header("Location: perfil-empleado.php");
        exit;
    }

?>

<div id="top" class="header">
    <div class="error">
        <span class="mensaje_error">Datos ingresados no válidos, inténtalo de nuevo.</span>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 col-md-3 col-sm-2"></div>
        <div class="col-lg-4 col-md-6 col-sm-8 text-center">
            <div class="wrapper-login">
                <img src="img/login_logo.png" style="width: 50%;" >
                <div class="form-login row">
                    <?php if(isset($_SESSION['mensaje']) ){ $message = $_SESSION['mensaje']; ?>
                        <div class="alert alert-danger alert-dismissible">
                            <?php echo $message;?>
                        </div>
                    <?php } session_unset(); session_destroy(); ?>
                    <form action="<?php echo DIR; ?>validaciones/login.php" method="post" id="formlogs">
                        <div class="col-12 form-group">
                            <label>Usuario</label>
                            <input type="input" name="nombre" class="form-control" required/>
                        </div>
                        <div class="col-12 form-group">
                            <label>Contraseña</label>
                            <input type="password" name="pass" class="form-control" required />
                        </div>
                        <div class="col-12 form-group text-center">
                            <button type="submit" class="btn btn-login">Ingresar</button>
                        </div>
                        <br><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>

<?php require('layout/footer.php'); ?>