<!DOCTYPE html>
<html>
  <head>
  
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
	<?php session_start(); include("./conexionbd.php");
		if( !isset($_SESSION['user'] ) ){
			echo "<span class='right'><a href='registro.php'>Registrarse</a></span>";
      		echo "<span class='right'><a href='login.php'>Login</a></span>";
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
			
					echo "<span><a href='portadaJuego.php'>¿Cuanto sabes?Pruebame</a></span>";
					
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
	Bienvenidos a QUIZ, el juego de las preguntas.
	<br></br>
	Si solo quieres visualizar las preguntas no es necesario que te registres.
	<br></br>
	Para ingresarlas debes ser un alumno matriculado en la asignatura de Sistemas Web
	<br></br>
	debes haberte registrado previamente.
	<br></br>
	Te invitamos a que nos conozcas pinchando sobre los "Creditos". ¡Un saludo!
	
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
