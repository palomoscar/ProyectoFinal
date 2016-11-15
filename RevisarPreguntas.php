

<script language="javascript">
function mostarAjax(){
    
 xmlhttp = new XMLHttpRequest();
 xmlhttp.onreadystatechange=function()
 {
 if (xmlhttp.readyState==4 && xmlhttp.status==200)
 {document.getElementById("mostrarform").innerHTML=xmlhttp.responseText; }
 }

 xmlhttp.open("GET","RevisarAjax.html?oldpregunta="+document.getElementById('desplegable').value,true); 
 xmlhttp.send();
 
 
 
}
</script>

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
		
		/*
		
		$usuario = $_SESSION['user'];
		
		$profesor = strcmp( $_SESSION['user'] ,"web000@ehu.es");
		
		if( !empty($usuario) && $profesor == 0 ){*/
			
	?>
	
  <div id='page-wrap'>
	<header class='main' id='h1'>
      		<span class="right"><a href="Logout.php">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
		<p>Bienvenido de nuevo <?php $_SESSION['user'] ?></p>
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
		<form name= "preguntas" id = "preguntas" >
		
		Selecciona una pregunta para editar: <select name= "desplegable" id = "desplegable" size="1">
		<?php

		while( $lista = mysqli_fetch_array($query) ){
			
			echo "<option  value='".$lista['Pregunta']."'>".$lista["Pregunta"]."</option>"; 
		}

		?>
		</select>	
		<br></br>
		<p><input type="button" onClick=" mostarAjax()" class = "boton" value="Editar" ></input></p>
		<br></br>
		<div id = "mostrarform" name="mostrarform">
		
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
	
		/*}else{
			
			if( empty($usuario) ){
				
				header("location : login.php");
				
			}else{
				
				header("location : GestionPreguntas.php");
				
			}
			
		}*/
	
	?>
	
</body>
</html>
