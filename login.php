
<!DOCTYPE html>
<html>
  <head>
  
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>LOGIN</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
		   
	<style type="text/css">

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
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		
		<span class="right">¿Aun sin cuenta? <a href="registro.php">Registrate</a></span>

		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Inicio</a></span>
		<span><a href='VerPreguntas.php'>Preguntas</a></span>
		<span><a href='creditos.html'>Creditos</a></span>
	</nav>
    <section class="main" id="s1">
    
	<div>

		<center>
	
		<h1>Acceso para Usuarios</h1>
	
	
		<form  id = "login" name "login" action="login.php" method="post" >

	
		<label>Email :</label><br>
	
		<input name="username" type="text" id="username" required>
	
	
		<br><br>

		<label>Password:</label><br>

		<input name="pass" type="password" id="pass" required>

		<br><br>

		<input type="submit" name="Submit" class = "boton" value="LOGIN">
	
		</center>

		</form>
	
	</div>
	
    </section>
	<footer class='main' id='f1'>
	
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
		
	</footer>
	
	</div>
	</body>
</html>


<?php

	//PRIMERO ESTABLECEREMOS LAS CONEXIONES	
	
		include("./conexionbd.php");

		session_start();

		if( empty($_POST['username']) || empty($_POST['pass']) ){
		
		die( '' );
		
		}
		
		
		
		function comprobarMail(){
	
		$patron_mail = '/^[a-zA-Z]+[0-9]{3}@ikasle.ehu.(es|eus)$/';	
		
		return preg_match( $patron_mail, $_POST['username'] );
		
		}
		
	
		if( strcmp($_POST['username'], "web000@ehu.es") != 0 && !comprobarMail()  ){
			
			die("Error de identificacion, revisa los datos que has introducido");
		
		}	
			$email =  $_POST['username'];
			
			$pass = $_POST['pass'];
			
			$result = mysqli_query($mysqli, "SELECT * FROM usuario WHERE Email = '$email' AND Clave = '$pass'" );
			
			$cont = mysqli_num_rows($result);
				
		if(  $cont > 0 ){ //si hay una o mas lineas que coincidan --> esta en la BD --> acierto
				
				$_SESSION['user'] = $email;
			
				$_SESSION['pass'] = $password;
				
				if( strcmp($email, "web000@ehu.es") == 0){
					header("location: RevisarPreguntas2.php");
				}else{
					header("location: GestionPreguntas.php");
				}
				
		}else{
			
			echo "<center>";
			
			echo "<p> <a href='layout.html'> INICIO </a>";
			
			echo "<br></br>";	
			
			die("Error de identificacion, revisa los datos introducidos");
			
			echo "</center>";
			
		
		}
		
		mysqli_close($mysqli);
			
?>
