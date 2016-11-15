
<!DOCTYPE html>

<html>
  <head>
  
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Revisar Preguntas</title>
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
  </head>
  <body>
	<?php
	
		include("./conexionbd.php");
		
		session_start();
		
		if( (!empty( $_SESSION['user'] ) ) && (strcmp( $_SESSION['user'] ,"web000@ehu.es") == 0) ){
			
	?>
	
  <div id='page-wrap'>
	<header class='main' id='h1'>
      		<span class="right"><a href="Logout.php">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
		<p>Bienvenido de nuevo <?php echo $_SESSION['user']; ?></p>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Inicio</a></span>
		<span><a href='VerPreguntas.php'>Preguntas</a></span>
		<span><a href='creditos.html'>Creditos</a></span>
	</nav>
    <section class="main" id="s1">
    
	<div>

	<?php 
	
		$dat="SELECT * FROM preguntas";
		
		$query= mysqli_query($mysqli,$dat);
		
		?>
		<form name= "preguntas" id = "preguntas" action = "RevisarPreguntas2.php" >
		
		Selecciona una pregunta para editar: <select name= "desplegable" id = "desplegable" size="1">
		<?php

		while( $lista = mysqli_fetch_array($query) ){
			
			echo "<option  value='".$lista['Pregunta']."'>".$lista["Pregunta"]."</option>"; 
		}

		?>
		</select>	
		<br></br>
		<center>
		<table>
		<tr>
		<td>Nueva Pregunta : </td> <td> <TEXTAREA rows="3" cols="30" maxlength="50" id = "pregunta" name="pregunta" required ></TEXTAREA></td>
		</tr>
		<td></td><td></td>
		<tr>
		<td>Nueva Respuesta: </td> <td> <input type="text" id = "respuesta" name="respuesta" required></td>
		</tr>
		<td></td><td></td>
		<tr>
		<td>Nuevo Tema: </td> <td> <input type="text" id = "tema" name="tema" required></td>
		</tr>
		<td></td><td></td>
		<tr>
		<td>Nuevo Grado de Dificultad : </td> <td> 
		<select name="dificultad" id = "dificultad" size="1" required>
							<option value="0">Seleccione dificultad</option>
						  	<option value="1">1</option>
						    <option value="2">2</option>
						    <option value="3">3</option>
						    <option value="4">4</option>
						    <option value="5">5</option>
		</select></td>
		</tr>
		</table>
		<br></br>		
		<input type="submit" name="insertar"  class = "boton" value="Modificar" ></input>
		
		</div>
		</form>
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>

	<?php
		 //hacer un query nuevo, asignar a estas variablles y actualizar en los ifs
		 
		$seleccion = $_POST['desplegable'];
		 
		$str = " SELECT * FROM preguntas WHERE Pregunta = '$seleccion' ";
		
		$query2= mysqli_query($mysqli,$str);
		
		$lista2 = mysqli_fetch_array($query2);
 
		$question = $lista2['Pregunta'];
		
		$answer = $lista2['Respuesta'];
		
		$topic = $lista2['Tema'];
		
		$dificulty = $lista2['Dificultad'];
		
		if(!empty($_POST['pregunta'])){
			
			$newquestion = $_POST['pregunta']; //--> no sobreescribimos $question, la usaremos como indice en el query para apuntar a la 
											  //pregunta que queremos modificar
			
		}if(!empty($_POST['respuesta'])){
			
			$answer = $_POST['respuesta'];
			
		}if(!empty($_POST['tema'])){
			
			$topic = $_POST['tema'];
			
		}if(!empty($_POST['dificultad'])){
			
			$dificulty = $_POST['dificultad'];
			
		}
		
		$str3 = "UPDATE preguntas SET Pregunta='$newquestion', Respuesta='$answer', Dificultad='$dificulty', Tema='$topic'  WHERE Pregunta='$question'";
		
		$query3 = mysqli_query($mysqli,$str3);
		
		if( $query3 === TRUE){
			
			echo "Pregunta modificada con exito";
			
		}else{
			
			echo "No se ha podido modificar la pregunta";
		}
		

		}else{ //EN CASO DE QUE NO SEA EL PROFESOR
			
			if( empty($usuario) ){
				
				header("location : login.php"); //ANONIMO
				
			}else{ //IKASLE
				
				header("location : GestionPreguntas.php");
				
			}
			
		}
	
	?>
	
</body>
</html>
