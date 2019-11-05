<?php
    $conexion = new mysqli("localhost","root","","gallos");

        if(mysqli_connect_errno()){
        echo 'Conexion Fallida:', mysqli_connect_error();
        exit();
    }
    mysqli_set_charset($conexion,'utf8');



?>
