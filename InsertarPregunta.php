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

  
  <?php
	
	session_start();
	
	if( !empty($_SESSION['user']) ){ //en caso de que tengamos algo ahi guardado todo va bien
	
	}
  
	?>
	
  
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class="right"><a href="formulario.html">Registrarse</a></span>	
      		<span class="right"><a href="">Logout</a></span>
		<br></br>
		<p>
		<?php
		echo "Has iniciado sesion como: " ;
		echo $_SESSION['user'];
		?>
		</p>
		<br></br>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Inicio</a></span>
		<span><a href='VerPreguntas.php'>Preguntas Clasico</a></span>
		<span><a href='GestionPreguntas.php'>Gestion Preguntas (AJAX)</a></span>
		<span><a href='creditos.html'>Creditos</a></span>
	</nav>
    <section class="main" id="s1">
    
	<div>
	<form id = "form_pregunta" name = "form_pregunta" action = "InsertarPregunta.php" method="post" onsubmit= "comprobar()" >
	<legend><h3>A&ntildeade tu pregunta</h3></legend>
	<fieldset>
	<center>
	<table>
	
		<tr>
		<td>Pregunta : </td> <td> <TEXTAREA rows="3" cols="30" maxlength="50" id = "pregunta" name="pregunta" required ></TEXTAREA></td>
		</tr>
		<td></td><td></td>
		<tr>
		<td>Respuesta: </td> <td> <input type="text" id = "respuesta" name="respuesta" required></td>
		</tr>
		<td></td><td></td>
		<tr>
		<td>Tema: </td> <td> <input type="text" id = "tema" name="tema" required></td>
		</tr>
		<td></td><td></td>
		<tr>
		<td>Elige un grado de dificultad : </td> <td> 
		<select name="dificultad" id = "dificultad" size="1" required>
							<option value="0">Seleccione dificultad</option>
						  	<option value="1">1</option>
						    <option value="2">2</option>
						    <option value="3">3</option>
						    <option value="4">4</option>
						    <option value="5">5</option>
		</select></td>
		</tr>
		<td></td><td> </td><td> </td>
		<tr>
		<td>                            </td><td><input type="submit" name="añadir"  class= "boton" value="Añadir"></td>
		</tr>
		</center>
		
	</table>
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



//miraremos en la BD y si no esta ahi pues se insertara

	require ("./conexionbd.php");
	
	$email = $_SESSION['user'];
	
	//comprobamos los datos introducidos por el usuario
	
	if(empty($_POST['pregunta'])){
		
		die( '' );
		
	}if(empty($_POST['respuesta'])){
			
		die('');
	
	}
			
	if(empty($_POST['dificultad']) || $_POST['dificultad'] == 0 ){
		
		echo "<center>";
			
		die('Selecciona un grado de dificultad para tu pregunta');
		
		echo "</center>";
		
	}
	
			if( empty($_SESSION['user'])){
				
				die("Por favor inicie sesion para poder insertar preguntas");
				
			}
			
			$pregunta = $_POST['pregunta'];
			$respuesta = $_POST['respuesta'];
			$dificultad = $_POST['dificultad'];
			$tema=$_POST['tema'];
	
			$sql = "INSERT INTO preguntas(Email, Pregunta, Respuesta, Dificultad, Tema) VALUES('$email','$pregunta','$respuesta','$dificultad','$tema')";
			
			$res = mysqli_query($mysqli ,$sql);
	
			echo "<center>";
			echo "¡Pregunta agregada con exito!";
			echo "<br><br>";
			echo "<p> <a href='VerPreguntas.php'> VER PREGUNTAS </a>";
			echo "</center>";
			
			
		//añadir a preguntas xml
		
		$xml = simplexml_load_file('preguntas.xml');
		$pregunta1 = $xml->addChild('assessmentItem');
		$pregunta1->addAttribute('complexity',$dificultad); 
		$pregunta1->addAttribute('subject',$tema); 
		$itemBody = $pregunta1->addChild('itemBody');
		$itemBody->addChild('p',$pregunta); 
		$correctResponse = $pregunta1->addChild('correctResponse');
		$correctResponse->addChild('value',$respuesta); 
		$resultado = $xml->asXML('preguntas.xml');
		if($resultado == true){
		echo '<p>La pregunta se ha insertado correctamente en preguntas.xml</p>';
		echo '<br/><a href="VerPreguntasXML.php"> VER PREGUNTAS DE preguntas.xml </a>';
		}
		else
		echo '</p> Error al insertar pregunta en preguntas.xml</p>';
	
	
		
		



?>