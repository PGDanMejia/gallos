<?php
require 'conexion.php';

$equipo = $_POST['numeroEquipo'];
$chapa = $_POST['chapa'];
$peso = $_POST['peso'];
$descripcion = $_POST['descripcion'];

$guardarGallo = mysqli_query($conexion, "INSERT INTO gallos(idEquipos, chapa, peso, descripcion) VALUES($equipo, '$chapa', $peso, '$descripcion')");
?>