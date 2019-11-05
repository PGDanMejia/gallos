<?php

require 'conexion.php';


$configuracion = $conexion->query("SELECT valorConfiguracion from configuracion WHERE idConfiguracion = 1");


    $datos = $configuracion->fetch_assoc();
    
    $arreglo = array('error' => false,'valorConfiguracion' => $datos['valorConfiguracion']);    
    echo json_encode($arreglo, JSON_FORCE_OBJECT);

?>