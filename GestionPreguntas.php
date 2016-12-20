<!DOCTYPE html>

<html>

  <head>
  
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Gesti�n Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide3.css' />
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
			
	<script language="javascript">
  
	function mostrarDatos(){
    
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("visualizacion").innerHTML=xmlhttp.responseText; 
			}
	}
	xmlhttp.open("GET","PreguntasXMLAJAX.php",true); 
	xmlhttp.send();
	}
   
     
	function insertarDatos(){
    
	var email = "<? echo $_SESSION['usuario'] ?>";
	var pregunta = document.getElementById("pregunta").value;
	var respuesta = document.getElementById("respuesta").value;
	var dificultad = document.getElementById("dificultad").value;
	var tema = document.getElementById("tema").value;
	var parametros= "email="+email+"&pregunta="+pregunta+"&respuesta="+respuesta+"&dificultad="+dificultad+"&tema="+tema;
        
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById('insercion').innerHTML=xmlhttp.responseText; 
		}
	}
	xmlhttp.open("POST","InsertarAJAX.php",true);
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
	xmlhttp.send(parametros);
 
	}
	</script>
			
  </head>
  
  
  <body>
  
  <?php
	
	session_start();
	
	include("./conexionbd.php");
	
	$profusr = "web000@ehu.es" ;
	
	$cmp = strcmp($_SESSION['user'], $profusr ) ;
	
	if( isset( $_SESSION['user'] ) && $cmp != 0 ){

  
	?>
	
  
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class="right"><a href="registro.php">Registrarse</a></span>	
      		<span class="right"><a href="Logout.php">Logout</a></span>
		<br></br>
		<p>
		<?php
		echo "Has iniciado sesion como: " ;
		if( !empty($_SESSION['user']) ){
			echo  $_SESSION['user'];
		}else{
			echo " ANONIMO";
			header("location : login.php");
		}
		
		?>
		</p>
		<br></br>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Inicio</a></span>
		<span><a href='VerPreguntas.php'>Preguntas</a></span>
		<span><a href='creditos.html'>Creditos</a></span>
	</nav>
    <section class="main" id="s1">
    
	<div>
	<form id = "form_pregunta" name = "form_pregunta" action = "InsertarAJAX.php" method="post">
	
	<legend><h3>A&ntildeade tu pregunta</h3></legend>
	<br></br>
	
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
	
	</table>
		<br></br>
		
		<input type="button" name="insertar"  class = "boton" value="Insertar" onClick=" insertarDatos()">
		<input type="button" name="visualizar" class = "boton" value="Preguntas XML" onClick="mostrarDatos()">
		
	</form>
	
	</div>
	
	<form>
	
		<?php
		echo "<br></br>" ;
		$logeduser = $_SESSION['user'];
		$preguntas = mysqli_query($mysqli, "SELECT * FROM preguntas WHERE Email = '$logeduser' " ) or die('No se ha podido conectar a la BD');
		
		echo "<center>";
		echo "<h3>Tus Preguntas</h3>";
		echo "<br></br>";
		echo '<table border=1> <tr> 
		<th> Email </th>
		<th> Pregunta </th>
		<th> Respuesta </th>
		<th> Dificultad </th>
		</tr>';
		
		while( $row = mysqli_fetch_array($preguntas) ){
			echo '<tr>
					  <td>'.$row['Email'].'</td>
					  <td>'.$row['Pregunta'].'</td>
					  <td>'.$row['Respuesta'].'</td>
					  <td>'.$row['Dificultad'].'</td>
				 </tr>';
			
		}
		echo '</table>';
		
		echo "<br></br>";
		
		echo " </hr> " ;
		
		echo "</center>";

		mysqli_close( $mysqli );
	?>
		
	<div id = "insercion"></div> <!-- EN ESTE TROZO DEBERIA APARECER LO DE AJAX-->
	<center><div id = "visualizacion" ></div></center>
	
	</form>
    </section>




	<?php
	//en caso de que no hayamos establecido una session nos viene aqui
	
	}else{
		 if( $cmp == 0){
			 
			 header("location: ./RevisarPreguntas.php"); 
			 
		 }else{
			 
			 header("location: ./login.php");
		 }
		
		
	}
	
	?>
</body>

</html>
