<?php
    //Conectar base de datos
    include '../classes/conexion.php';
    session_start();
    if(isset($_POST['usuarios'])){
    	$id=$_POST['usuarios'];
    	if ($id) {
    		$sp="call sp_usuarios(2,'$id',2,null,null,null,null,null,null,null,null,null)";
        	mysqli_query($conexion,$sp) or die("Datos Incorrectos".mysqli_error($conexion));
  			$_SESSION['exito']='Se eliminó el usuario ';
            include '../classes/conexion.php';
            $id1=$_SESSION['usuario'];
            $sp="call sp_log_usuarios('$id1', '$id', 3)";
            mysqli_query($conexion,$sp) or die($_SESSION['error']='Error al ingresar log. ');
        	mysqli_close($conexion);
        	header("location: ../perfil-empleado.php");
    	}else{
    		$_SESSION['error']='Error: No se seleccionó un usuario.';
    		header("location: ../perfil-empleado.php");
    	}
        
        
}else{
    $_SESSION['error']='Error: No se pudo eliminar usuario';
    header("location: ../perfil-empleado.php");
}
?>
