<?php

require 'conexion.php';

$idUltimoTorneo = mysqli_query($conexion, "SELECT MAX(idTorneo) as UltimoTorneo from torneos");
$datos = $idUltimoTorneo->fetch_assoc();
$idTorneoActual = $datos['UltimoTorneo'];
$sp = "SELECT a.idGallos, a.idEquipos, a.peso, a.disponibilidad, b.idTorneo, b.enmachamado FROM gallos a Left join equipos b ON a.idEquipos = b.idEquipos WHERE b.idTorneo = $idTorneoActual";
$resultado = mysqli_query($conexion, $sp);
$cantidadGallos = $resultado->num_rows;
$mensaje =  '';
$c = 0;
$rival = array();
while($resultados = mysqli_fetch_array($resultado)) {
    
    $c++;
    $idGallos = $resultados['idGallos'];
    $idEquipos = $resultados['idEquipos'];
    $peso = $resultados['peso'];
    $idTorneo = $resultados['idTorneo'];
    $enmachamado = $resultados['enmachamado'];
    $consulta1 = mysqli_query($conexion, "SELECT disponibilidad FROM gallos WHERE idGallos = $idGallos");
    $datos = $consulta1->fetch_assoc();
    $disponibilidad	 = $datos["disponibilidad"];
    if($disponibilidad != 1){
        
        $resultado2 = mysqli_query($conexion, $sp);
        while($resultados2 = mysqli_fetch_array($resultado2)){
            
            $idGallos2 = $resultados2['idGallos'];
            $idEquipos2 = $resultados2['idEquipos'];
            $peso2 = $resultados2['peso'];
            $idTorneo2 = $resultados2['idTorneo'];
            $enmachamado2 = $resultados2['enmachamado'];
            $consulta1 = mysqli_query($conexion, "SELECT disponibilidad FROM gallos WHERE idGallos = $idGallos2");
            $datos = $consulta1->fetch_assoc();
            $disponibilidad2	 = $datos["disponibilidad"];
            if($disponibilidad2 == 0){
                $diferencia = abs($peso - $peso2);
                if( $diferencia == 0 && $idEquipos != $idEquipos2 && $idEquipos2 != $enmachamado){
                    array_push($rival, $idGallos2);
                    
                }
            }   
            
        }
        $rivales = count($rival);

        if ($rivales > 0){
            $rivalElegido = $rival[ mt_rand ( 0, $rivales - 1)];
            
            $sql = "INSERT INTO rondas (idTorneo, idGallos, idGallos1) VALUES($idTorneoActual, $idGallos, $rivalElegido)";
            $insertar = mysqli_query($conexion, $sql);
            
            $sql2 = "UPDATE gallos SET disponibilidad=1 WHERE idGallos=$idGallos";
            $insertar = mysqli_query($conexion, $sql2);
            
            $sql3 = "UPDATE gallos SET disponibilidad=1 WHERE idGallos=$rivalElegido";
            $insertar = mysqli_query($conexion, $sql3);
            
        }else{
            
            $resultado3 = mysqli_query($conexion, $sp);
            while($resultados2 = mysqli_fetch_array($resultado3)){
                $idGallos2 = $resultados2['idGallos'];
                $idEquipos2 = $resultados2['idEquipos'];
                $peso2 = $resultados2['peso'];
                $disponibilidad2 = $resultados2['disponibilidad'];
                $idTorneo2 = $resultados2['idTorneo'];
                $enmachamado2 = $resultados2['enmachamado'];
                $consulta1 = mysqli_query($conexion, "SELECT disponibilidad FROM gallos WHERE idGallos = $idGallos2");
                $datos = $consulta1->fetch_assoc();
                $disponibilidad2	 = $datos["disponibilidad"];
                if($disponibilidad2 == 0){
                    $diferencia = abs($peso - $peso2);
                    if( $diferencia == 0.1 && $idEquipos != $idEquipos2 && $idEquipos2 != $enmachamado){
                        array_push($rival, $idGallos2);
                    }
                }   
            }
            $rivales = count($rival);
            if ($rivales > 0){
                $rivalElegido = $rival[ mt_rand ( 0, $rivales - 1)];
                
                $sql = "INSERT INTO rondas (idTorneo, idGallos, idGallos1) VALUES($idTorneoActual, $idGallos, $rivalElegido)";
                $insertar = mysqli_query($conexion, $sql);
                
                $sql2 = "UPDATE gallos SET disponibilidad=1 WHERE idGallos=$idGallos";
                $insertar = mysqli_query($conexion, $sql2);
                
                $sql3 = "UPDATE gallos SET disponibilidad=1 WHERE idGallos=$rivalElegido";
                $insertar = mysqli_query($conexion, $sql3);
                
            }else{
                $resultado4 = mysqli_query($conexion, $sp);
                while($resultados2 = mysqli_fetch_array($resultado4)){
                    $idGallos2 = $resultados2['idGallos'];
                    $idEquipos2 = $resultados2['idEquipos'];
                    $peso2 = $resultados2['peso'];
                    $disponibilidad2 = $resultados2['disponibilidad'];
                    $idTorneo2 = $resultados2['idTorneo'];
                    $enmachamado2 = $resultados2['enmachamado'];
                    $consulta1 = mysqli_query($conexion, "SELECT disponibilidad FROM gallos WHERE idGallos = $idGallos2");
                    $datos = $consulta1->fetch_assoc();
                    $disponibilidad2	 = $datos["disponibilidad"];
                    if($disponibilidad2 == 0){
                        $diferencia = abs($peso - $peso2);
                        if( $diferencia == 0.2 && $idEquipos != $idEquipos2 && $idEquipos2 != $enmachamado){
                            array_push($rival, $idGallos2);
                        }
                    }   
                }
                $rivales = count($rival);
                if ($rivales > 0){
                    
                    $rivalElegido = $rival[ mt_rand ( 0, $rivales - 1)];
                    $sql = "INSERT INTO rondas (idTorneo, idGallos, idGallos1) VALUES($idTorneoActual, $idGallos, $rivalElegido)";
                    $insertar = mysqli_query($conexion, $sql);
                    
                    $sql2 = "UPDATE gallos SET disponibilidad=1 WHERE idGallos=$idGallos";
                    $insertar = mysqli_query($conexion, $sql2);
                    
                    $sql3 = "UPDATE gallos SET disponibilidad=1 WHERE idGallos=$rivalElegido";
                    $insertar = mysqli_query($conexion, $sql3);
                    
                }else{
                    $resultado5 = mysqli_query($conexion, $sp);
                while($resultados2 = mysqli_fetch_array($resultado5)){
                    $idGallos2 = $resultados2['idGallos'];
                    $idEquipos2 = $resultados2['idEquipos'];
                    $peso2 = $resultados2['peso'];
                    $disponibilidad2 = $resultados2['disponibilidad'];
                    $idTorneo2 = $resultados2['idTorneo'];
                    $enmachamado2 = $resultados2['enmachamado'];
                    $consulta1 = mysqli_query($conexion, "SELECT disponibilidad FROM gallos WHERE idGallos = $idGallos2");
                    $datos = $consulta1->fetch_assoc();
                    $disponibilidad2	 = $datos["disponibilidad"];
                    if($disponibilidad2 == 0){
                        $diferencia = abs($peso - $peso2);
                        if($idEquipos != $idEquipos2 && $idEquipos2 != $enmachamado){
                            array_push($rival, $idGallos2);
                        }
                    }   
                }
                $rivales = count($rival);
                if ($rivales > 0){
                    
                    $rivalElegido = $rival[ mt_rand ( 0, $rivales - 1)];
                    $sql = "INSERT INTO rondas (idTorneo, idGallos, idGallos1) VALUES($idTorneoActual, $idGallos, $rivalElegido)";
                    $insertar = mysqli_query($conexion, $sql);
                    
                    $sql2 = "UPDATE gallos SET disponibilidad=1 WHERE idGallos=$idGallos";
                    $insertar = mysqli_query($conexion, $sql2);
                    
                    $sql3 = "UPDATE gallos SET disponibilidad=1 WHERE idGallos=$rivalElegido";
                    $insertar = mysqli_query($conexion, $sql3);
                    
                }else{
                    if($disponibilidad != 1){
                        
                        $sql = "INSERT INTO rondas (idTorneo, idGallos, idGallos1) VALUES($idTorneoActual, $idGallos, 55)";
                        $insertar = mysqli_query($conexion, $sql);
                        
                        $sql2 = "UPDATE gallos SET disponibilidad=1 WHERE idGallos=$idGallos";
                        $insertar = mysqli_query($conexion, $sql2);
                    }
                  }  
                } 
            }

        }
        $rivales = 0;
        $rival = array();
    }
    
    
};

$verRondas = "SELECT c.nombreEquipo as nombreEquipo1, b.chapa as chapa1, b.descripcion as descripcion1, b.peso as peso1, e.nombreEquipo as nombreEquipo2, d.chapa as chapa2, d.descripcion as descripcion2, d.peso as peso2   FROM rondas a
              LEFT JOIN gallos b on a.idGallos = b.idGallos
              LEFT JOIN equipos c on b.idEquipos = c.idEquipos
              LEFT JOIN gallos d on a.idGallos1 = d.idGallos
              LEFT JOIN equipos e on d.idEquipos = e.idEquipos
              WHERE a.idTorneo = $idTorneoActual";
$verRondas2 = mysqli_query($conexion, $verRondas);
$mensaje = "";
$h = 0;
while($tabla = mysqli_fetch_array($verRondas2)){
    $h++;
    $mensaje .="<tr><th scope='row'>".$h."</th><td>Equipo: ". $tabla["nombreEquipo1"] . " Gallo chapa: ". $tabla["chapa1"] ." Descripcion: ". $tabla["descripcion1"] ." Peso: ".$tabla["peso1"]."</td><td>Equipo: ". $tabla["nombreEquipo2"] . " Gallo chapa: ". $tabla["chapa2"] ." Descripcion: ".$tabla["descripcion2"]." Peso: ".$tabla["peso2"]."</td></tr>";
};

echo $mensaje;
?>