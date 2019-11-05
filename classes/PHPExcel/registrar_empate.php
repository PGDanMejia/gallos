<?php
require 'conexion.php';

$idParticipante1 = $_POST['idParticipante1'];
$idParticipante2 = $_POST['idParticipante2'];

$puntosParticipante1 = mysqli_query($conexion, "SELECT puntos FROM equipos WHERE idEquipos = $idParticipante1");
$datos = $puntosParticipante1->fetch_assoc();
$puntosActuales = $datos['puntos'];
$puntosNuevos = $puntosActuales + 0.5;

$sql2 = "UPDATE equipos SET puntos=$puntosNuevos WHERE idEquipos=$idGanador";
$insertar = mysqli_query($conexion, $sql2);

$puntosParticipante2 = mysqli_query($conexion, "SELECT puntos FROM equipos WHERE idEquipos = $idParticipante2");
$datos = $puntosParticipante2->fetch_assoc();
$puntosActuales2 = $datos['puntos'];
$puntosNuevos2 = $puntosActuales + 0.5;

$sql2 = "UPDATE equipos SET puntos=$puntosNuevos WHERE idEquipos=$idGanador";
$insertar = mysqli_query($conexion, $sql2);
?>