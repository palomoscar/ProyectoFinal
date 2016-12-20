
<?php

include("./conexionbd.php");

session_start(); 

	
	if( isset( $_SESSION['user'] ) ){ //no queremos que el profesor o los alumnos jueguen estando logueados
		
		header("location: layout.php");
		
	}
	
/************************************************************************************************************************************************/

$preg1 = mysqli_query($mysqli, "SELECT * FROM preguntas WHERE Dificultad = '1' ") or die('ERROR 1 : No se han podido leer los datos de la BD ');

$preg2 = mysqli_query($mysqli, "SELECT * FROM preguntas WHERE Dificultad = '2' ") or die('ERROR 2 : No se han podido leer los datos de la BD');

$preg3 = mysqli_query($mysqli, "SELECT * FROM preguntas WHERE Dificultad = '3' ") or die('ERROR 3 : No se han podido leer los datos de la BD');

$preg4 = mysqli_query($mysqli, "SELECT * FROM preguntas WHERE Dificultad = '4' ") or die('ERROR 4 : No se han podido leer los datos de la BD');

$preg5 = mysqli_query($mysqli, "SELECT * FROM preguntas WHERE Dificultad = '5' ") or die('ERROR 5 : No se han podido leer los datos de la BD');

//CARGAMOS LAS PREGUNTAS EN ARRAYS DE SESSION PARA FACILITAR EL ACCESO DESDE LOS DIFERENTES ARCHIVOS 
/************************************************************************************************************************************************/

$_SESSION['p1'] = array(); $_SESSION['p2'] = array(); $_SESSION['p3'] = array(); $_SESSION['p4'] = array(); $_SESSION['p5'] = array();

$_SESSION['r1'] = array();$_SESSION['r2'] = array();$_SESSION['r3'] = array();$_SESSION['r4'] = array();$_SESSION['r5'] = array();

$_SESSION['id1'] = 0; $_SESSION['id2'] = 0; $_SESSION['id3'] = 0; $_SESSION['id4'] = 0; $_SESSION['id5'] = 0; //crearemos un id para iterar los arrays de manera independiente

		while( $row = mysqli_fetch_array($preg1) ){
			
			array_push($_SESSION['p1'], $row['Pregunta'] ); 
	
			array_push($_SESSION['r1'], $row['Respuesta']);
					
		}
		while( $row = mysqli_fetch_array($preg2) ){
			
			array_push($_SESSION['p2'], $row['Pregunta'] ); 
	
			array_push($_SESSION['r2'], $row['Respuesta']);
					
		}
		while( $row = mysqli_fetch_array($preg3) ){
			
			array_push($_SESSION['p3'], $row['Pregunta'] ); 
	
			array_push($_SESSION['r3'], $row['Respuesta']);
					
		}		
		while( $row = mysqli_fetch_array($preg4) ){
			
			array_push($_SESSION['p4'], $row['Pregunta'] ); 
	
			array_push($_SESSION['r4'], $row['Respuesta']);
					
		}		
		while( $row = mysqli_fetch_array($preg5) ){
			
			array_push($_SESSION['p5'], $row['Pregunta'] ); 
	
			array_push($_SESSION['r5'], $row['Respuesta']);
					
		}

/************************************************************************************************************************************************/


?>

<html>
  <head>
  
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wideJugar.css' />
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
		
		function mostrarAJAX(lvl){
				
			<?php $_SESSION['id'] = 0 ; ?>
				
			xmlhttp = new XMLHttpRequest();
				
			xmlhttp.onreadystatechange=function(){
					
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
						
					document.getElementById("preguntas").innerHTML=xmlhttp.responseText;
				}
			}
				xmlhttp.open("GET","JugarAJAX.php?nivel="+lvl,true); 
				xmlhttp.send();
			}
			
	</script>
	
	<!--SEPARAMOS LOS DOS SCRIPTS PARA EL CONTROL DE ERRORES-->
	
	<script language="javascript">
			
		function check(){ //NOS LLAMA AL SCRIPT QUE COMPRUEBA NUESTRA RESPUESTA
		
			var elem = document.getElementById('answer');
				
			var elem2 =  document.getElementById('resp') ;		
		
			var xmlhttp = new XMLHttpRequest();
		
			xmlhttp.onreadystatechange=function(){
					
				if (xmlhttp.readyState == 4 && xmlhttp.status==200){
						
						alert(xmlhttp.responseText);
						
					}
			}
				
		if( elem.value == '' || elem.value != elem2.value ){ //fallo
		
			alert("RESPUESTA INCORRECTA");
					
			xmlhttp.open("GET","scriptFallo.php?valor=0",true); 
			
			xmlhttp.send();
			
		}else{ //acierto
		
			xmlhttp.open("GET","scriptFallo.php?valor=1",true); 
			
			xmlhttp.send();

		}//recargar la parte de ajax --> ya hemos dejado las variables preparadas antes
		
		mostrarAJAX(document.getElementById("lvl").value);

	}
	</script>
	
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
	<?php 

		echo "<span class='right'><a href='Logout.php'>Finalizar Sesion</a></span>";
		
	?>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
	<span><a href='layout.php'>Inicio</a></span>
	
		<?php
				
				if( !isset($_SESSION['jugador'] )){
				
					echo "<span><a href='portadaJuego.php'>Juega y suma puntos</a></span>";
					
				}
				
		?>
		
		<span><a href='creditos.html'>Creditos</a></span>
	</nav>
    <section class="main" id="s1">
	
	<?php 
		if( !isset($_SESSION['jugador']) ){
			
			echo "<h3>Estas jugando como : ANONIMO</h3>";
			
		}else {
			
			echo "<h3>Estas jugando como : ".$_SESSION['jugador']."</h3>";
			
		}
		
		?>
    <!--PRIMERO LA PARTE QUE NO ES DE AJAX       TIEMPO -->
	<!--
	<p>
		<span id="segundos">0</span>
	</p>
	
	<input type="button" onclick="detenerse()" value="deternse"/>
	-->
	<br></br>
	Selecciona un nivel de dificultad : <select name="lvl" id = "lvl" size="1"   >
											<option value = "1" selected>Nivel = pts. por acierto</option> <!--Si no selecciona nada -> lvl 1 por defecto-->
											<option value = "1">1</option>
											<option value = "2">2</option>
											<option value = "3">3</option>
											<option value = "4">4</option>
											<option value = "5">5</option>
										</select>
	
	<input type = "button" value = "Seleccionar" class = "boton" id = "seleccionar" name = "seleccionar" onClick= "mostrarAJAX(document.getElementById('lvl').value)" ></input> 
	
	
	<!--quiero que cuando seleccione un nivel se despliegue el ajax-->
	<div> <!--AQUI VEREMOS LAS PREGUNTAS_____ primero pedir el nivel-->
		
	<div id = "preguntas"></div> <!--AQUI SE MUESTRA LA PAGINA AJAX-->

	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
