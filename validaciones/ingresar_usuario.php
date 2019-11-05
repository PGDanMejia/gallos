
<?php
	//Conectar base de datos
	include '../classes/conexion.php';
	session_start();
	
	
	  if(isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['password']) && isset($_POST['email'])){
		  
						$password = $_POST["password"];
						$minimo = 8; // Minimo de caracteres
						if (strlen($password) >= $minimo) {
								$email=$_POST['email'];
								$sql1 = "select * from usuario where correoInstitucional='$email';"; 
								$consulta123 = mysqli_query($conexion,$sql1);
								$fila =mysqli_num_rows($consulta123);
								 if($fila==0){
										$nombre=ucwords(strtolower($_POST['name']));
										$apellido=ucwords(strtolower($_POST['lastname']));
										$correo=strtolower($_POST['email']);
										$clave=$_POST['password'];
										$newclave=md5($clave);
										$sp="call sp_usuarios(1,null,1,2,'$nombre','$apellido','$correo','$newclave',null,null,null,null)";
										mysqli_query($conexion,$sp) or die("Datos Incorrectos".mysqli_error($conexion));
										$_SESSION['exito']='Se agregó el usuario '.$nombre.' '.$apellido;

										include '../classes/conexion.php';
										$sp="call sp_consulta_login('$correo','$newclave')";
										$usuarios = mysqli_query($conexion, $sp) or die("Error al consultar: " . mysqli_error($conexion));
											$num_filas=mysqli_num_rows($usuarios);
											if($usuarios->num_rows == 1){
												$datos=mysqli_fetch_array($usuarios,MYSQLI_ASSOC);
												$id=$datos['idUsuario'];
   											}
   										include '../classes/conexion.php';
										$id1=$_SESSION['usuario'];
										echo $id;
										echo $id1;   
										$sp="call sp_log_usuarios('$id1', '$id', 1)";
            							mysqli_query($conexion,$sp) or die($_SESSION['error']='Error al ingresar log. ');
										mysqli_close($conexion);
										header("location: ../agregar-administrador.php");
										}else{
										 $_SESSION['error']='Error: No se pudo agregar usuario, introduzca otro correo';
										 header("location: ../agregar-administrador.php");
									 }
						}else{
							$_SESSION['error']='Error: contraseña invalida, la contraseña debe tener minimo 8 caracteres';
							header("location: ../agregar-administrador.php");
						}
	
}
?>