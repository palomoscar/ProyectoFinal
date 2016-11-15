<!DOCTYPE html>
<html>
  <head>
  
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide2.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class="right"><a href="registro.php">Registrarse</a></span>
      		<span class="right"><a href="login.php">Login</a></span>
                
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
	<?php

        include("./conexionbd.php");

		if (!$mysqli) {
	 
			echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;

		}

	$usuarios = mysqli_query($mysqli, "select * from usuario" ) or die( mysql_error() );

		echo '<table border=1> <tr> 
		<th> Nombre </th>
		<th> Apellidos </th>
		<th> Nickname </th>
		<th> Email </th>		
		<th> Telefono </th>
		<th> Especialidad </th>
		</tr>';

			
		while( $row = mysqli_fetch_array($usuarios) ){
			echo '<tr>
					  <td>'.$row['Nombre'].'</td>
					  <td>'.$row['Apellidos'].'</td>
					  <td>'.$row['Nickname'].'</td>
					  <td>'.$row['Email'].'</td>
					  <td>'.$row['Telefono'].'</td>
					  <td>'.$row['Especialidad'].'</td>
				 </tr>';
			
		}
		echo '</table>';

		mysqli_close( $mysqli );
	
	?>
	</center>
	</div>
    </section>
		<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>

</div>
</body>
</html>


