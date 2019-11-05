<?php
	//Conectar base de datos
	include '../classes/conexion.php';
	session_start();
	
	
	  if(isset($_POST['name']) && isset($_POST['lastname'])  && isset($_POST['email'])){
								$email=$_POST['email'];
								$sql1 = "select * from usuario where correoInstitucional='$email';"; 
								$consulta123 = mysqli_query($conexion,$sql1);
								$fila =mysqli_num_rows($consulta123);
								 if($fila==0){
										$nombre=ucwords(strtolower($_POST['name']));
										$apellido=ucwords(strtolower($_POST['lastname']));
										$correo=strtolower($_POST['email']);
										$sp="call sp_empleados(1,null,1,1,'$nombre','$apellido','$correo',null,null,null,null,null,null)";
										$id_empleado = mysqli_query($conexion,$sp) or die("Datos Incorrectos".mysqli_error($conexion));
										$num_filas=mysqli_num_rows($id_empleado);
											if($id_empleado->num_rows == 1){
												$datos=mysqli_fetch_row($id_empleado);
												$id_empleado=$datos[0];
   											}
										$_SESSION['exito']='Se agregó el usuario '.$nombre.' '.$apellido;
										//include '../classes/conexion.php';
										$nombre_foto = $id_empleado.'_'.$nombre.'_'.$apellido;
										$rawData = $_POST['foto'];
										$filteredData = explode(',', $rawData);
										$unencoded = base64_decode($filteredData[1]);
										//Crear imagen
										echo getcwd();
										
										mkdir("../img/fotos-perfil/".$nombre.' '.$apellido, 0700);
										$urlImagen2 = 'img/fotos-perfil/'.$nombre.' '.$apellido.'/'.$nombre_foto.'1'.'.png';
										for ($i = 1; $i <= 5; $i++) {
											$urlImagen = '../img/fotos-perfil/'.$nombre.' '.$apellido.'/'.$nombre_foto.$i.'.png';
											$fp = fopen($urlImagen, 'w');
											fwrite($fp, $unencoded);
											fclose($fp);
										}
										
										
										include '../classes/conexion.php';
										$sp="call sp_empleados(2,'$id_empleado',null,null,null,null,null,null,null,null,null,null,'$urlImagen2')";
										mysqli_query($conexion,$sp) or die("Datos Incorrectos".mysqli_error($conexion));
										include '../classes/conexion.php';
										$id1=$_SESSION['usuario'];
										echo 'ID del usuario:'.''.$id1;   
										echo 'ID del empleado:'.''.$id_empleado;  
										$sp="call sp_log_usuarios('$id1', '$id_empleado', 1)";
            							mysqli_query($conexion,$sp) or die($_SESSION['error']='Error al ingresar log. ');
										mysqli_close($conexion);
											header("location: ../agregar-empleado.php");
										}else{
										 $_SESSION['error']='Error: No se pudo agregar usuario, introduzca otro correo';
										 	header("location: ../agregar-empleado.php");
									 }
	
}else{

}
?>
