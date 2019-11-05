<?php
require 'conexion.php';

$nombre = $_POST['nombre'];
$enmachamado = $_POST['enmachamado'];

$idUltimoTorneo = mysqli_query($conexion, "SELECT MAX(idTorneo) as UltimoTorneo from torneos");
$datos = $idUltimoTorneo->fetch_assoc();
$idTorneoActual = $datos['UltimoTorneo'];

$guardarEquipo = mysqli_query($conexion, "INSERT INTO equipos(idTorneo, nombreEquipo, enmachamado) VALUES($idTorneoActual, '$nombre', $enmachamado)");

$idUltimoEquipo = mysqli_query($conexion, "SELECT MAX(idEquipos) as UltimoEquipo from equipos");
$datos = $idUltimoEquipo->fetch_assoc();
echo $datos['UltimoEquipo'];
?>