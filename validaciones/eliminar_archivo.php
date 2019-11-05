<?php
    //Conectar base de datos
    include '../classes/conexion.php';
    session_start();
    if(isset($_POST['archivos'])){
    	$id=$_POST['archivos'];
    	if ($id) {
    		$sp="UPDATE usuario_ingreso SET estado = 1 WHERE (idArchivo='$id'); ";
        	mysqli_query($conexion,$sp) or die("Datos Incorrectos".mysqli_error($conexion));
  			$_SESSION['exito']='Se eliminó el archivo ';
			
			  include '../classes/conexion.php';  
			$insertar = "INSERT INTO log_eliminar (idArchivo) VALUES ($id)";
			mysqli_query($conexion,$insertar);

        	mysqli_close($conexion);
        	header("location: ../eliminar-archivo.php");
    	}else{
    		$_SESSION['error']='Error: No se seleccionó un archivo.';
    		header("location: ../eliminar-archivo.php");
    	}
        
        
}else{
    $_SESSION['error']='Error: No se pudo eliminar el archivo';
    header("location: ../eliminar-archivo.php");
}
?>
