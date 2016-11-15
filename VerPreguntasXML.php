<!DOCTYPE html>
<html>
  <head>
  
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>VerPreguntasXML</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide3.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class="right"><a href="registro.php">Registrarse</a></span>
                <span class="right"><a href="Logout.php">Logout</a></span>
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
			
	$preguntas = simplexml_load_file("preguntas.xml");

	echo '<table border=1> <tr> 
		<th> Tematica </th>
		<th> Enunciado </th>
		<th> Complejidad </th>
		</tr>';
	foreach($preguntas as $pregunta){
      echo '<tr>
		<th>'. $pregunta['subject'] . '</th>
		<th>' . $pregunta->itemBody->p . '</th>
		<th>' . $pregunta['complexity'] . '</th>
		</tr>';
	}
   
	?>
	
	</center>

	</div>
    </section>
	
</div>
</body>
</html>
