<?php
	include("./conexionbd.php");
	
	require_once('lib/nusoap.php');
	
	require_once('lib/class.wsdlcache.php');

	session_start();

?>
<html>
  <head>
  <script>
	
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			
			document.getElementById("passAjax").innerHTML = xmlhttp.responseText;
			
		}
	}
		function validar(str){
			
			if(str == ""){
				document.getElementById("passAjax").innerHTML="";
				return;
			}
			xmlhttp.open("GET","loginAJAX.php?mail="+str,true);
			xmlhttp.send();
		}
	
</script>
  </script>
  
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Login</title>
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
  <div id='page-wrap'>
	<header class='main' id='h1'>
		
		<span class="right">¿Aun sin cuenta? <a href="registro.php">Registrate</a></span>

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
	
		<h1>Acceso para Usuarios</h1>

		<form  id = "login" name "login"  method="post" >

	
		<label>Email :</label><br>
	
		<input name="username" type="text" id="username" onchange= "validar(this.value)" required>
		<br></br>
		
		<div id = "passAjax">
		</div>

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

