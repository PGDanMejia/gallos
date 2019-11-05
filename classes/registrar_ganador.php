<?php
require 'conexion.php';

$idGanador = $_POST['idGanador'];

$puntosGanador = mysqli_query($conexion, "SELECT puntos FROM equipos WHERE idEquipos = $idGanador");
$datos = $puntosGanador->fetch_assoc();
$puntosActuales = $datos['puntos'];
$puntosNuevos = $puntosActuales + 1;

$sql2 = "UPDATE equipos SET puntos=$puntosNuevos WHERE idEquipos=$idGanador";
$insertar = mysqli_query($conexion, $sql2);
?>