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
		<span class="right"><a href="formulario.html">Registrarse</a></span>
      		<span class="right"><a href="login.php">Login</a></span>
      		<span class="right" style="display:none;"><a href="/logout">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
		<br></br>
		<p><a href= "GestionPreguntas.php" target="_blank">Ingresa otra pregunta</a></p>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Inicio</a></span>
		<span><a href='creditos.html'>Creditos</a></span>
	</nav>
    <section class="main" id="s1">
    
	<div>
	<center>
	
	<?php

    include("./conexionbd.php");

	$preguntas = mysqli_query($mysqli, "select * from preguntas" ) or die( mysql_error() );

		echo '<table border=1> <tr> 
		<th> Email </th>
		<th> Pregunta </th>
		<th> Dificultad </th>
		</tr>';
		
		while( $row = mysqli_fetch_array($preguntas) ){
			echo '<tr>
					  <td>'.$row['Email'].'</td>
					  <td>'.$row['Pregunta'].'</td>
					  <td>'.$row['Dificultad'].'</td>
				 </tr>';
			
		}
		echo '</table>';
		
		echo "<br></br>";
		
		echo "<center>";
		
		
		
		mysqli_close( $mysqli );
	
?>
	<br></br><br></br>
	
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
