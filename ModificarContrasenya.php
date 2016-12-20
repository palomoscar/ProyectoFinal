<!DOCTYPE html>
<html>
  <head>
  
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>ModificarContrasenya</title>
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
		<span class="right"><a href="registro.php">Registrarse</a></span>
      		<span class="right"><a href="login.php">Login</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Inicio</a></span>
		<span><a href='VerPreguntas.php'>Preguntas</a></span>
		<span><a href='creditos.html'>Creditos</a></span>
	</nav>
    <section class="main" id="s1">
    
	<div><!-- CODIGO CORRESPONDIENTE -->
	
		<form id = "cambio" name = "cambio" action = "ModificarContrasenya.php" method="POST" >
			<center>
				<table>
					<tr>
						<td>Correo : </td> <td> <input id = "mail" name = "mail" ></td>
					</tr><br></br>
					
					<tr>
						<td>Vieja contrase&ntildea : </td> <td> <input type = "password" id = "oldpass" name = "oldpass"></td>		 
					</tr>
					
					<tr>
						<td>Nueva contrase&ntildea : </td> <td> <input type = "password" id = "pass1" name = "pass1"></td>		 
					</tr>
					
					<tr>
						<td>Repetir contrase&ntildea : </td> <td> <input type = "password" id = "pass2" name = "pass2" ></td>
					</tr>

				</table>
				<br></br>
					<td><input type="submit" name="modificar"  class = "boton" value="Modificar" ></td>
			</center>
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

//primero hacer el isset

	include("./conexionbd.php");
	
	require_once('lib/nusoap.php');
	
	require_once('lib/class.wsdlcache.php');

	session_start();
	
	//primero comprobar que hemos rellenado los campos
	
	if( isset( $_POST['mail'] ) && isset($_POST['oldpass']) && isset($_POST['pass1']) && isset($_POST['pass2']) ){
		

	//hacer query para saber si el mail esta en la bd --> le pedimos que introduzca la antigua ? si no poca seguridad...
	
		$email = $_POST['mail'];
	
		$query = mysqli_query($mysqli, "SELECT * FROM usuario WHERE Email = '$email' ");
	
		$result = mysqli_num_rows($query);
	
		//ahora comprobar que el mail que introducimos esta en nuestra BD de usuarios
	
		if( $result < 1 ){
		
			echo "<script> alert ('El mail introducido no se encuentra registrado'); </script>";
		
			die('');
		
		}
		//comprobar que ambas contrasenyas coinciden 
		
		$pass = sha1( $_POST['oldpass'] );
		
		$queryPass = mysqli_query($mysqli, "SELECT * FROM usuario WHERE Email = '$email' AND Clave = '$pass' ");
		
		$resultPass = mysqli_num_rows($queryPass);
		
		if( $resultPass < 1){
			
			if( $email == "web000@ehu.es"){
				
				echo "<center>La clave de la cuenta del profesor no es modificable</center>";
				
				die('');
				
			}
			
			die('La clave vieja no es correcta');
			
		}
	
		if( $_POST['pass1'] != $_POST['pass2'] ){
		
			echo "<script> alert ('Las contrase&ntildeas no coinciden'); </script>";
		
			die('');
		
		}
	
		$clave = $_POST['pass1'] ;
		
		//comprobar que cumple la condiciones 
		
		$soapclient2 = new nusoap_client ("http://palomoymiguel.esy.es/Lab-8//ComprobarContrasenya.php?wsdl",true) or die('No se ha podido invocar al SW');

		$result2 = $soapclient2->call('passVal', array('password'=> '$clave') ); //<--NO NOS ESTA DEVOLVIENDO NADA
		
		if(  $result2 != "VALIDA"){ //no hacer
			
			echo "<script>La password no cumple las condiciones de seguridad minimas</script>";
			
			die('');
			
		}

		//hacer update 
		
		$clave = sha1($_POST['pass1']);
	
		$update = "UPDATE usuario SET Clave='$clave' WHERE Email='$email'";
	
		$query2 = mysqli_query($mysqli, $update);
	
		if( $query2 == true ){
		
			echo "<center>";
		
			echo "¡Contrase&ntildea actualizada!";
		
			echo "</center>";
		
			die('');
		
		}else{
		
			echo "<center>";
		
			echo "No se ha podido actualizar la contrase&ntildea";
		
			echo "</center>";
		
			die('');
		
		}
	}//cierra el isset
		
?>
