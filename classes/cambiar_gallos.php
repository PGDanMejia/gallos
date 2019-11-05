<?php
require 'conexion.php';

$nombre = $_POST['parametro'];

$nuevoTorneo = mysqli_query($conexion, "UPDATE configuracion SET valorConfiguracion=$nombre WHERE idConfiguracion=1");

echo $nuevoTorneo;
?>