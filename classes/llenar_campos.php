<?php
require 'conexion.php';

$nombre = $_POST['nombre'];

$usuarios = $conexion->query("SELECT idUsuario, nombre, apellido, correoInstitucional,urlImagen from usuario WHERE (concat_ws(' ', nombre, apellido) like '%$nombre%' OR  correoInstitucional = '$nombre') AND idEstado = 1 AND idTipoUsuario = 1");


    $datos = $usuarios->fetch_assoc();
    
    $arreglo = array('error' => false,'idUsuario' => $datos['idUsuario'], 'nombre' => $datos['nombre'], 'apellido' => $datos['apellido'], 'correoInstitucional' => $datos['correoInstitucional'],'urlImagen' => $datos['urlImagen']);    
    echo json_encode($arreglo, JSON_FORCE_OBJECT);

?>