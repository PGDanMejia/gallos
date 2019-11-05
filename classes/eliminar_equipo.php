<?php
require 'conexion.php';

$idEquipo = $_POST['idEquipo'];

$idUltimoTorneo = mysqli_query($conexion, "SELECT MAX(idTorneo) as UltimoTorneo from torneos");
$datos = $idUltimoTorneo->fetch_assoc();
$idTorneoActual = $datos['UltimoTorneo'];

$guardarEquipo = mysqli_query($conexion, "DELETE FROM rondas WHERE idTorneo = $idTorneoActual");
$guardarEquipo = mysqli_query($conexion, "DELETE FROM equipos WHERE idEquipos = $idEquipo");
$guardarEquipo = mysqli_query($conexion, "UPDATE gallos SET disponibilidad = 0 WHERE idEquipos = $idEquipo");


?>