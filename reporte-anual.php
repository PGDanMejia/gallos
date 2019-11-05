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
    var formatoReporte = '<?php echo $_POST["formato-reporte"]; ?>';
    var tipoReporte = '<?php echo $_POST["tipo-reporte"]; ?>';
    var mesReporte = '<?php echo $_POST["mes-reporte"]; ?>';
    var mesInicial = '<?php echo $_POST["mes-reporte-init"]; ?>';
    var mesFinal = '<?php echo $_POST["mes-reporte-end"]; ?>';
    var anioReporte = '<?php echo $_POST["anio-reporte"]; ?>';
</script>


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
                        
                    </main>
                </div>
            </div>
            <div class="separator-bot"></div>

        </div>
    </div>
</div>

<?php require('layout/footer.php'); ?>