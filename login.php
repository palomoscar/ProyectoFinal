<!DOCTYPE html>
	 
<html>

	<head>
	 <title>Login</title>
	 <style type="text/css">
		body {
		color: #3c464f;
		background-color: #8bbcea; }
		.boton{
        font-size:10px;    
        font-weight:bold;
        color:white;
        background:#638cb5;
        border:0px;
        width:80px;
        height:25px;
       }
	</style>
	 <meta charset = "utf-8">
	</head>
	
	<body>
	
	<center>
	
	<h1>Acceso para Usuarios</h1>
	
	<hr/>

	<form  id = "login" name "login" action="login.php" method="post" >

	
	<label>Nombre  de Usuario o Email :</label><br>
	
	<input name="username" type="text" id="username" required>
	
	
	<br><br>

	<label>Password:</label><br>

	<input name="pass" type="password" id="pass" required>

	<br><br>

	<input type="submit" name="Submit" class = "boton" value="LOGIN">
	
	</center>

	</form>

</html>

<?php

	//PRIMERO ESTABLECEREMOS LAS CONEXIONES	
	
	//En local
	
	$host = "localhost";
	$user = "root";
	$password = "";
	$dbname = "usuario";
	
	
	//En hostinger
	/*$host = "mysql.hostinger.es";
	$user = "";
	$password = "";
	$dbname = "";
	*/
	
	$mysqli = mysqli_connect($host, $user, $password, $dbname);
	
	if ($mysqli->connect_errno)
	{
		die ( 'Error al conectar con la Base de Datos' . mysqli_connect_error() . PHP_EOL);
		
	}
	
		session_start();//PARA CUANDO HAGAMOS LA OPCINAL Y LE METAMOS TIMERS Y ESO
		
		//comprobaciones en el lado servidor

		if(empty($_POST['username'])){
		
		die( '' );
		
		}if(empty($_POST['pass'])){
			
		die('Inserte una contraseña');
	
		}
			
		if(empty($_POST['username']) && empty($_POST['pass'])){
			
		die('Inserte una dirección de correo y una contraseña');
		
		}
		
		function comprobarMail(){
	
		$patron_mail = '/^[a-zA-Z]+[0-9]{3}@ikasle.ehu.(es|eus)$/';	
		
		return preg_match( $patron_mail, $_POST['username'] );
		
		}
		
	
		//parametros que tomamos del login
	
		//si no concuerda con la expresion regular es que el usuario intenta logearse con el nickname y no con el mail
		
		$password = $_POST['pass'];
	
		if( !comprobarMail() ){ //FALTA IMPLEMENTAR BIEN, EL QUERY NO NOS EXTRAE BIEN EL CAMPO MAIL ASOCIADO AL NICK
			
			$nick = $_POST['username'];//si entramos aqui es que hemos logueado con el nick
			
			//$usuarios = mysqli_query($mysqli, "select Email from usuario WHERE Nickname  ='$nick' " );
			
			$query= mysqli_query( $mysqli, "SELECT Email FROM usuario WHERE Nickname  ='$nick' AND Clave = '$password'" ) ; //guardamos el mail asociado a ese nick 
			
			//CREO QUE $email TENDRIA EL BOOLEANO CORRESPONDIENTE A LA EJECUCION --> USAR METODO PARA EXTRAER EL MAIL ASOCIADO
			
			$email = mysqli_fetch_array($query); // aqui email es un array != string
			
			$flag = true;
			
		}if( comprobarMail() ){
			
			$email =  $_POST['username'];
			$query = mysqli_query($mysqli, "SELECT * FROM usuario WHERE Email  ='$email' AND Clave = '$password' ");
			
			$flag = false;
		
		}
		
		
		
		//hacer con asterisco y luego extraer el mail del row asociado !!!
		
		if( mysqli_num_rows($query) > 0){
			
			if( $flag ){ // en caso de que hayamos usado el fetch array 
				
				$_SESSION['user']= serialize($email); //convertir el array a string; ---> PROBLEMA: escribe basura, entre la cual esta el email asociado (vamos mejorando)
				
			}else{
				
				$_SESSION['user']=$email;
			}
			
			$_SESSION['pass']=$password;
			
			header("location: InsertarPregunta.php");//redireccionamos
			
			
		}else{
			
			echo "<center>";
			
			echo "<p> <a href='layout.html'> INICIO </a>";
			
			echo "<br></br>";	
			
			die("Error de identificacion, revisa los datos introducidos");//seria mejor con js...
			
		
		}
		
		mysqli_close($mysqli);
		
		
			
?>