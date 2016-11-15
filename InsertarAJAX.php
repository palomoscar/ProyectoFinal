<?php

session_start();
	
if( !empty($_SESSION['user']) ){ //en caso de que tengamos algo ahi guardado todo va bien

//miraremos en la BD y si no esta ahi pues se insertara

        include ("conexionbd.php");
	
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
			
			echo($pregunta+""+$respuesta+" "+$user);
			
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
	}
	
		
		
