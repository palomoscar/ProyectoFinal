
<!DOCTYPE html>

<?php
	include("./conexionbd.php");

	session_start();

?>
<html>
  <head>
  
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Login</title>
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
		<span><a href='layout.php'>Inicio</a></span>
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

	if( isset( $_POST['username']) && isset( $_POST['pass'] ) ){
			
	
		function comprobarMail(){
	
		$patron_mail = '/^[a-zA-Z]+[0-9]{3}@ikasle.ehu.(es|eus)$/';	
		
		return preg_match( $patron_mail, $_POST['username'] );
		
		}
		
		//primero mirar si cumple la expresion 
		
		if( comprobarMail() || $_POST['username'] == "web000@ehu.es"){
			
			$email = $_POST['username'];
			
			$queryMail =  mysqli_query($mysqli, "SELECT * FROM usuario WHERE Email = '$email' ");
			
			$resultMail = mysqli_num_rows($queryMail);
			
			if( $resultMail > 0 ){ //miramos si esta en la BD
			
				//mirar si la pass coincide con la de la BD
				
				//si es profesor la clave no esta encriptada, si es usuario si
				
				$pass =  $_POST['pass'];
				
				if($_POST['username'] != "web000@ehu.es"){
					
					$pass = sha1( $_POST['pass'] );
					
				}
				
				//hacer los querys
				
				$queryBloqueado = mysqli_query( $mysqli, "SELECT * FROM blocked WHERE Email = '$email' ");

				$resultBloqueado  = mysqli_num_rows($queryBloqueado);
							
				if( $resultBloqueado > 0){//si esta en la BD de bloqueados die
					
					die('Su cuenta se encuentra bloqueada, pongase en contacto con el profesor');
					
				}
				
				$queryPass = mysqli_query($mysqli, "SELECT * FROM usuario WHERE Email = '$email' AND Clave = '$pass'" ); ;
				
				$resultPass = mysqli_num_rows($queryPass);
				
				if( $resultPass > 0 ){ //login correcto
				
					//iniciar la sesion y restablecer los intentos de la BD y finalmente redirigir
					
					$_SESSION['user'] = $email;
					
					$intentos = 0;
					
					$decrementar = mysqli_query($mysqli, "UPDATE usuario SET Intentos='$intentos' WHERE Email='$email'") or die('No se ha podido resetear los fallos en la BD');

					if( $email == "web000@ehu.es" ){
						
						header("location: RevisarPreguntas.php");
						
					}else{
						
						header("location: GestionPreguntas.php");
						
					}			
					
				}else{ //le restamos un intento, si se queda en  0 bloquear+avisar
							
					$queryIntentos = mysqli_query($mysqli, "SELECT Intentos from usuario WHERE Email = '$email' " );
					
					$row = $queryIntentos ->fetch_row();					
					
					if( $row[0] < 4 ){ //fallamos la pass pero  aun nos quedan intentos <mal
				
						$intentos = $row[0]+1;
			
						$incrementar = mysqli_query($mysqli, "UPDATE usuario SET Intentos='$intentos' WHERE Email='$email'") or die('No se ha podido incrementar los fallos en la BD');
					
						$restantes = 3 - $intentos;
					
						echo "<center> $email , te quedan $restantes intentos </center>";
					
						if($restantes == 0){ //en caso de que alcancemos el tope de intentos
				
							$bloquear = "INSERT INTO blocked(Email, Indeseado) VALUES('$email', 'No') ";
		
							$queryBloquear = mysqli_query($mysqli, $bloquear);
						
							echo "<center>El email ha sido bloqueado hasta que el profesor lo decida. Motivo : Demasiados intentos fallidos</center>";
		
							die('');
					
						}
					
					die(''); //aunque queden intentos matamos para que vuelva a intentarlo
					
					}
				}
				
				
			}else{
				
				die('Debes estar registrado para poder entrar');
			}
			
		}else{
			
			die('El email introducido no corresponde a la UPV');
		}
	}
		
			
?>
