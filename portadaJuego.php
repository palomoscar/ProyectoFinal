<!DOCTYPE html>
<html>
  <head>
  
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Reglas del Juego</title>
		<link rel='stylesheet' type='text/css' href='estilos/style.css' />
		<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide4.css' />
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
	<?php session_start(); include("./conexionbd.php");
		if( !isset($_SESSION['user'] ) ){
			echo "<span class='right'><a href='registro.php'>Registrarse </a></span>";
      		echo "<span class='right'><a href='login.php'> Login</a></span>";
		}else{
			
			echo "<span class='right'><a href='Logout.php'>Logout</a></span>";
		}
	?>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
	
		<?php
				
				if( !isset($_SESSION['user'] )){
			
					$usertype = "anonimo";
			
					echo "<span><a href='layout.php'>Inicio</a></span>";
					
					echo "<span><a href='ModificarContrasenya.php'>Modificar Contrase&ntildea</a></span>";
					
				}else{
					
					if( $_SESSION['user'] == "web000@ehu.es"){
						
						$usertype = "profesor";
						
						echo "<span><a href='RevisarPreguntas.php'>RevisarPreguntas</a></span>";
						
						echo "<span><a href='GestionCuentas.php'>Gestion de Cuentas</a></span>";
						
					}else{
						
						$usertype = "alumno";
						
						echo "<span><a href='GestionPreguntas.php'>Gestionar Preguntas</a></span>";
						
					}
					
				}
				?>
		<span><a href='creditos.html'>Creditos</a></span>
	</nav>
    <section class="main" id="s1">
	
	<?php 
		if($usertype == "anonimo"){
			
			echo "<h3>Estas logeado como : ANONIMO</h3>";
			
		}else {
			
			echo "<h3>Estas logeado como : ".$_SESSION['user']."</h3>";
			
		}
		?>
    
	<div>
		Bienvenido a Quiz : El juego de las preguntas. Si quieres jugar con un pseud&otildenimo rellena el campo
		<br></br>
		de esta manera podr&atildes	acumular puntos en la sesión de juego y competir con otros jugadores.
		<br></br>
		En caso de que escribas ANONIMO podrás probar a pasar un buen rato resolviendo las preguntas ingresadas
		<br></br> 
		por los alumnos de Sistemas Web, pero no recibirás puntos con tus aciertos.
		<br></br>
		¡A JUGAR!
		<br></br>
		<form id = "nombreJugador" name = "nombreJugador" method = "POST">
			<tr>
				<td>Introduce tu nick: </td> <td> <input type="text" id = "nick" name="nick" ></td>
			</tr>
			<br></br>
			<tr>
				<input type="submit" name="jugar"  class = "boton" value="Comenzar" onSubmit= "portadaJuego.php" >
			</tr>
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

	if( isset( $_POST['nick'] ) ){ 
	
		if( $_POST['nick'] != "ANONIMO" ||  $_POST['nick'] != "anonimo" ){
			
			$_SESSION['jugador'] = $_POST['nick'] ; 
		
			$_SESSION['pts'] = 0;
			
			$_SESSION['fallos'] = 0;
		
		
		}
		
		header("location: Jugar.php"); 
	
	}

?>
