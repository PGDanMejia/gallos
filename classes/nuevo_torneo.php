<?php
require 'conexion.php';

$nombre = $_POST['parametro'];

$nuevoTorneo = mysqli_query($conexion, "INSERT INTO torneos(nombreTorneo) VALUES('$nombre')");

?>