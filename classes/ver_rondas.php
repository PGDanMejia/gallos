<?php
require 'conexion.php';
$idUltimoTorneo = mysqli_query($conexion, "SELECT MAX(idTorneo) as UltimoTorneo from torneos");
$datos = $idUltimoTorneo->fetch_assoc();
$idTorneoActual = $datos['UltimoTorneo'];
$verRondas = "SELECT c.nombreEquipo as nombreEquipo1, b.chapa as chapa1, b.descripcion as descripcion1 , e.nombreEquipo as nombreEquipo2, d.chapa as chapa2, d.descripcion as descripcion2   FROM rondas a
              LEFT JOIN gallos b on a.idGallos = b.idGallos
              LEFT JOIN equipos c on b.idEquipos = c.idEquipos
              LEFT JOIN gallos d on a.idGallos1 = d.idGallos
              LEFT JOIN equipos e on d.idEquipos = e.idEquipos
              WHERE c.idTorneo = $idTorneoActual";
$verRondas2 = mysqli_query($conexion, $verRondas);
$mensaje = "";
$h = 0;
while($tabla = mysqli_fetch_array($verRondas2)){
    $h++;
    $mensaje .="<tr><th scope='row'>".$h."</th><td>Equipo: ". $tabla["nombreEquipo1"] . " Gallo chapa: ". $tabla["chapa1"] ."Descripcion: ". $tabla["descripcion1"] ."</td><td>Equipo: ". $tabla["nombreEquipo2"] . " Gallo chapa: ". $tabla["chapa2"] ."Descripcion: ".$tabla["descripcion2"]."</td></tr>";
};

echo $mensaje;
?>