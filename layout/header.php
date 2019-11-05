<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//include config
require_once('./includes/config.php');

if(!session_id()) {
    session_start();
}

$full_name = $_SERVER[ 'PHP_SELF' ];
$name_array = explode( '/', $full_name );
$count = count( $name_array );
$page_name = $name_array[$count-1];

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>
    <meta Content-Type="text/html" charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Torneo de gallos</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">

    <link rel="icon" type="image/png" href="<?php echo DIR; ?>img/icono.png" />
    <link rel="shortcut icon" href="<?php echo DIR; ?>img/icono.png" type="image/png"/>

    <link href="<?php echo DIR; ?>img/icono.png" rel="apple-touch-icon" />
    <link href="<?php echo DIR; ?>img/icono.png" rel="apple-touch-icon" sizes="152x152" />
    <link href="<?php echo DIR; ?>img/icono.png" rel="apple-touch-icon" sizes="167x167" />
    <link href="<?php echo DIR; ?>img/icono.png" rel="apple-touch-icon" sizes="180x180" />
    <link href="<?php echo DIR; ?>img/icono.png" rel="icon" sizes="192x192" />
    <link href="<?php echo DIR; ?>img/icono.png" rel="icon" sizes="128x128" />

    <link rel="stylesheet" type="text/css" href="<?php echo DIR; ?>vendor/bootstrap-4.1.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href='<?php echo DIR; ?>vendor/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css'>
    <link rel="stylesheet" type="text/css" href='<?php echo DIR; ?>vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css'>
    <link rel="stylesheet" type="text/css" href='<?php echo DIR; ?>vendor/DataTables/Buttons-1.5.2/css/buttons.dataTables.min.css'>
    
    <!-- CSS Personalizado -->
    <link rel="stylesheet" type="text/css" href="<?php echo DIR; ?>css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo DIR; ?>css/modal.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo DIR; ?>css/superusuario.css" />

</head>

<body id="login">
    <div class="container-fluid header">
        <div id="barra-superior" class="header-cont row">
            <div class="col-lg-4 col-md-3 col-sm-2"></div>
            <div class="col-lg-4 col-md-6 col-sm-8 text-center">
                    <h2>Programa para derby de Gallos Zona Centro</h2>
            </div>
        </div>
        <?php if (isset($_SESSION['usuario'])): ?>
            <div id="dv-cerrar">
                <a id="cierre" title="Cerrar Sesión" href="<?php echo DIR; ?>cerrar_sesion.php" class="w-inline-block" width="150px; ">
                     <img src="<?php echo DIR; ?>img/cerrar_sesion.png" id="cerrar" width="364">
                </a>
                <p id="lb-cerrar">Cerrar Sesión</p>
            </div>
        <?php endif; ?>
        
            <?php if($page_name=='agregar-administrador.php'): ?>
                <div id="dv-info">
                    <a title="Ayuda" data-toggle="modal" data-target="#ayudaReportes" alt="Información">
                        <img src="<?php echo DIR; ?>img/info.png"  width="50px" id="info" style="margin-left: 24%;">
                        <p id="lb-cerrar">Información</p>
                    </a>
                </div>
            <?php elseif($page_name=='reporte-anual.php'): ?>
                <div id="dv-info">
                    <a title="Ayuda" data-toggle="modal" data-target="#ayudaReportes" alt="Información">
                        <img src="<?php echo DIR; ?>img/info.png"  width="50px" id="info" style="margin-left: 24%;">
                        <p id="lb-cerrar">Información</p>
                    </a>
                </div>
            <?php elseif($page_name=='agregar-usuario.php'): ?>
                <div id="dv-info">
                    <a title="Ayuda" data-toggle="modal" data-target="#ayudaAgregarUsuario" alt="Información">
                        <img src="<?php echo DIR; ?>img/info.png"  width="50px" id="info" style="margin-left: 24%;">
                        <p id="lb-cerrar">Información</p>
                    </a>
                </div>
            <?php elseif($page_name=='eliminar-usuario.php'): ?>
                <div id="dv-info">
                    <a title="Ayuda" data-toggle="modal" data-target="#ayudaEliminarUsuario" alt="Información">
                        <img src="<?php echo DIR; ?>img/info.png"  width="50px" id="info" style="margin-left: 24%;">
                        <p id="lb-cerrar">Información</p>
                    </a>
                </div>
            <?php elseif($page_name=='modificar-usuario.php'): ?>
                <div id="dv-info">
                    <a title="Ayuda" data-toggle="modal" data-target="#ayudaModificarUsuario" alt="Información">
                        <img src="<?php echo DIR; ?>img/info.png"  width="50px" id="info" style="margin-left: 24%;">
                        <p id="lb-cerrar">Información</p>
                    </a>
                </div>
            <?php elseif($page_name=='eliminar-archivo.php'): ?>
                <div id="dv-info">
                    <a title="Ayuda" data-toggle="modal" data-target="#ayudaEliminarArchivo" alt="Información">
                        <img src="<?php echo DIR; ?>img/info.png"  width="50px" id="info" style="margin-left: 24%;">
                        <p id="lb-cerrar">Información</p>
                    </a>
                </div>
            <?php endif; ?>
    </div>



