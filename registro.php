<?php


	//conexion remota
	$conexion = mysqli_connect("mysql.hostinger.es","u204349316_root","gabriel3","u204349316_users") or die( mysql_error() );
		
	//conexion local
	 //$conexion = mysqli_connect("localhost","root",'',"usuario") or die( mysql_error() );
		
 
	if(!$conexion){
		
		echo "Fallo al conectar con MySQL : " . $conexion->connect_error;
		
	}
	
	//extraemos los valores introducidos y los guardamos en variables para trabajar mas facil
	
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];
		$nick = $_POST['nick'];
		$pass = $_POST['pass'];
		$mail = $_POST['mail'];
		$telf = $_POST['telf'];
		$sexo = $_POST['sexo'];
		$esp = $_POST['esp'];
	
	//AHORA ESCRIBIREMOS LAS FUNCIONES QUE SE UTILIZARAN PARA VALIDAR LOS DATOS POR PARTE DEL SERVIDOR//
	
	//A MEDIDA QUE VAYAN FUNCIONANDO SE AÑADIRAN MAS VALIDACIONES//
	
		function comprobarDatos(){
		
			$patron_mail = '/^[a-zA-Z]+[0-9]{3}@ikasle.ehu.(es|eus)$/';	
		
			$patron_telf = '/^[0-9]{9}$/';
		
			$patron_apellidos = '/^([a-zA-Z][a-zA-Z]*) ([a-zA-Z][a-zA-Z]*)$/';
		
			return preg_match( $patron_mail, $_POST['mail'] );
		
		}
		
		function comprobarPass(){
			
			$okay = true;
		
			if(strlen($_POST['pass']) < 6 || $_POST['pass'] != $_POST['pass2'] ){
			
				$okay = false;
			
				echo "<p><a id='parUsers'>Revisa las contraseñas, tu contraseña debe tener al menos 6 caracteres</a> ";	
			
			}
		
			return $okay;
		}
		
		
		//AHORA SEGUIREMOS CON LAS LINEAS QUE SE EJECUTAN PARA REALIZAR LAS VALIDACIONES
		
		if( !comprobarDatos() ){ // EN CASO DE ERRORES
		
			echo "El correo utilizado no es valido";
		
			echo "<p> <a href='formulario.html'> Volver al registro </a>";
			
			die('Se ha aortad oa ejecucion de programa' );
		
		}if( !comprobarPass()){
			
			echo "La contraseña utilizada no es valida";
		
			echo "<p> <a href='formulario.html'> Volver al registro </a>";
			
			die('Se ha aortad oa ejecucion de programa' );
			
			
		}else{ //EN CASO DE QUE TODO HAYA IDO BIEN
			
			 $sql = "INSERT INTO usuario(Nombre,Apellidos,Nickname,Clave,Email,Telefono,Especialidad) VALUES('$nombre','$apellidos','$nick','$pass','$mail',$telf,'$esp')";
	
			if(!mysqli_query($conexion ,$sql)){
		
				die('Error al escribir en la Base de Datos: ' . mysql_error());
				
			}
	
			echo "¡Usuario registrado con exito!";
		
			echo "<p> <a href='VerUsuarios.php'> VER USUARIOS </a>";
		
			mysqli_close($conexion);
		
		}	
?>