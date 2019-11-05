<?php
include '../classes/conexion.php';

$nombre = $_POST['nombre'];
$clav = $_POST['pass'];
//$clave=md5($clav);
$sp="call sp_consulta_login('$nombre','$clav')";

$usuarios = mysqli_query($conexion, $sp) or die("Error al consultar: " . mysqli_error($conexion));
$num_filas=mysqli_num_rows($usuarios);
if($usuarios->num_rows == 1){
	$datos=mysqli_fetch_array($usuarios,MYSQLI_ASSOC);
    session_start();
    
    $id=$_SESSION['usuario'] = $datos['idUsuario'];
    
    $_SESSION['nombre'] = $datos['nombreUsuario'];
    echo $id .' '. $_SESSION['nombre'] .' ';
    include '../classes/conexion.php';
    /*$sp="CALL sp_log_acceso(".$id.")";
    $log=mysqli_query($conexion,$sp) or die("Error: ". mysqli_error());
    $arreglo = array('error' => false, 'tipo' => $datos['idTipoUsuario'] );    
    echo json_encode($arreglo, JSON_FORCE_OBJECT);
    if ($_SESSION['tipo_usuario']==1) {
			header("location: ../importar.php");
		}else if ($_SESSION['tipo_usuario']==2) {
			
        }*/
    header("location: ../añadir-equipos.php");

}else{
	session_start();
	$_SESSION['mensaje']='No se pudo iniciar sesión: Usuario o Contraseña incorrecta. Inténtalo de nuevo.';
	header("location: ../index.php");

}
    

?>