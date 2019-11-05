<?php
    //Conectar base de datos
	include '../classes/conexion.php';
    session_start();   
    if(isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['email'])&& isset($_POST['usuarios'])){
						
							$nombre=utf8_encode(ucwords(strtolower($_POST['name'])));
							$apellido=ucwords(strtolower($_POST['lastname']));
							$correo=strtolower($_POST['email']);
							$id=$_POST['usuarios'];

							if ($id && $nombre && $apellido && $correo) {
								$sp="call sp_usuarios(2,'$id',null,null,'$nombre','$apellido','$correo','h',null,null,null,null)";
								mysqli_query($conexion,$sp) or die($_SESSION['error']='Error al modificar el usuario: Datos Incorrectos. ');
								
								$_SESSION['exito']='Se modificó el usuario '.$nombre.' '.$apellido;
								include '../classes/conexion.php';
								$id1=$_SESSION['usuario'];
							
								$sp="call sp_log_usuarios('$id1', '$id', 2)";
								mysqli_query($conexion,$sp) or die($_SESSION['error']='Error al ingresar log ');
								mysqli_close($conexion);
								
							}else{
								$arreglo = array('error' => true);    
    							echo json_encode($arreglo, JSON_FORCE_OBJECT);
								$_SESSION['error']='Error: Existen campos vacíos.';
								
							}
			
        
	}else{
		$arreglo = array('error' => true);    
    	echo json_encode($arreglo, JSON_FORCE_OBJECT);
    $_SESSION['error']='Error al modificar el usuario: Datos Incorrectos. ';
	}

	$arreglo = array('error' => false);    
    echo json_encode($arreglo, JSON_FORCE_OBJECT);

?>
