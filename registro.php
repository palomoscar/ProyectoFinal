
<!DOCTYPE html>
<html>
  <head>
  
	<title>Formulario de Registro</title>
	
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
	<script src="./js/validaciones_cliente.js"></script>
	<meta name="author" content="Oscar y Miguel">
	<meta name="description" content="Formulario de registro de usuarios">
  
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">

    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>

      		<span class="right"><a href="login.php">Login</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Inicio</a></span>
		<span><a href='VerPreguntas.php'>Preguntas</a></span>
		<span><a href='creditos.html'>Creditos</a></span>
	</nav>
    <section class="main" id="s1">
    
	<div>
	
			<h2>Formulario de Registro</h2>

		<center>
		<form id='registro' name='formulario' onSubmit= "return validar()" action = "registro.php" method = "POST" > 
			<hr/>
			<table>
				<tr>
					<td>Nombre*: </td> <td>
					<input type="text" id = "nombre" name="nombre"> </td>
					<td>Nickname*: </td> <td>
					<input type="text" id = "nick" name="nick" size="10"> </td>
				</tr>				
				<tr>
					<td>Apellidos*: </td> <td>
					<input type="text" id = "apellidos" name="apellidos"> </td>
					<td>Contrase&ntildea*: </td> <td>
					<input type = "password"   id = "pass" name= "pass" > <!--onchange = "contrasenyaAJAX()"-->  </td>
				</tr>
				<tr>
					<td>Email*: </td> <td>
					<input type="text"  id = "mail" name="mail" > <!--onchange = "mailAJAX()"--> </td>
					<td>Confirmar contrase&ntildea*: </td> <td>
					<input type = "password" id = "pass2" name= "pass2"> </td>
				</tr>
				<tr>
					<td>Sexo: </td> <td>
					<select name="sexo" id = "sexo" size="1">
					<option value = "0" selected>Selecciona tu sexo</option>
					<option value = "Hombre">Hombre</option>
					<option value = "Mujer">Mujer</option>
					<option value = "Otro">Otro</option>
					</select> </td>
					<td>N&uacutemero de tel&eacutefono*:</td> <td>
					<input type="number" id = "telf" name="telf" size="9"> </td>
				</tr>
				<tr>
				<td>Especialidad*: </td> <td>
					<select name="esp"  id = "esp" size="1">
					<option value = "0" selected>Selecciona una especialidad</option>
					<option value = "Ing. del Software">Ing. del Software</option>
					<option value = "Ing. de Computadores">Ing. de Computadores</option>
					<option value = "Computacion">Computaci&oacuten </option>
					</select> </td>
				</tr>
				<tr>
				</tr>
				<tr>
				</tr>	
				<tr><td>                      </td>
				<td><input type="submit" class = "boton" value="Registrarse" ></input></td>
				
				<td><input type="reset" class="boton" value="Borrar" ></input></td>
				
				</tr>
		</table>
		</form>
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




<?php

	require_once('lib/nusoap.php');
	
	require_once('lib/class.wsdlcache.php');

	//las comprobaciones se haran una vez rellenados los campos

	if( isset($_POST['nombre'])&& isset($_POST['apellidos']) && isset($_POST['nick'])&& isset($_POST['pass']) && isset($_POST['mail'])&& isset($_POST['telf']) ){
	
	include("./conexionbd.php");
	
	
	//extraemos los valores introducidos y los guardamos en variables para trabajar mas facil
	
		$nombre = $_POST['nombre'];
		
		$apellidos = $_POST['apellidos'];
		
		$nick = $_POST['nick'];
		
		$pass = sha1($_POST['pass']); //encriptamos la clave
		
		$mail = $_POST['mail'];
		
		$queryBloqueado = mysqli_query($mysqli, "SELECT * FROM blocked WHERE Email = '$mail' " );
		
		$resultado = mysqli_num_rows($queryBloqueado);
		
		if($resultado > 0){
			
			die("<center>Este email se encuentra bloqueado temporalmente</center>");
		
		}
		
		$telf = $_POST['telf'];
		
		$sexo = $_POST['sexo'];
		
		$esp = $_POST['esp'];
	
	///////////////////////////////////quitar los onchange////////////////////
	
	
	$soapclient1 = new nusoap_client('http://cursodssw.hol.es/comprobarmatricula.php?wsdl',true);

	$result1 = $soapclient1->call('comprobar', array('x'=>$_POST['mail']));

	$soapclient2 = new nusoap_client("http://palomoymiguel.esy.es/Lab-8/ComprobarContrasenya.php?wsdl",true);

	$result2 = $soapclient2->call('passVal', array('password'=>$_POST['pass']));
	
	//NO HAREMOS COMPROBACIONES SI EL MAIL ES INCORRECTO
	
		if( $result1 != "SI" ){
		
		 echo "<script languaje='javascript'>alert('DEBES ESTAR MATRICULADO PARA REGISTRARTE ')</script>";
		 
		 die('');
		
		}
	
		if( $result2 != "VALIDA"){
		
		echo "<script languaje='javascript'>alert('INTRODUZCA UNA CONTRASEÑA MAS SEGURA')</script>";
		 
		die('');
		
		}

	//SI PASA DE AQUI COMENZAMOS A COMPROBAR EL RESTO
	
		function comprobarDatos(){
		
			$patron_mail = '/^[a-zA-Z]+[0-9]{3}@ikasle.ehu.(es|eus)$/';	
		
			$patron_telf = '/^[0-9]{9}$/';
		
			$patron_apellidos = '/^([a-zA-Z][a-zA-Z]*) ([a-zA-Z][a-zA-Z]*)$/';
		
			return preg_match( $patron_mail, $_POST['mail'] );
		
		}
		
		function comprobarPass(){
			
			$okay = true;
		
			if(strlen($_POST['pass']) <= 6  ){
			
				$okay = false;
			
				echo "<p><a id='parUsers'>Tu contraseña debe tener al menos 6 caracteres</a> ";	
			
			}if( $_POST['pass'] != $_POST['pass2']){
				
				$okay = false;
				
				echo "<p><a id='parUsers'>ERROR: Tus contraseñas no coinciden </a> ";	
				
			}
		
			return $okay;
		}
		
		if( !comprobarPass()){
		
			echo "<p> <a href='registro.php'> Volver al registro </a>";
			
			die('Se ha abortado la ejecucion de programa' );
			
			
		}
		//EN CASO DE QUE TODO HAYA IDO BIEN
			
			 $sql = "INSERT INTO usuario(Nombre,Apellidos,Nickname,Clave,Email,Telefono,Especialidad) VALUES('$nombre','$apellidos','$nick','$pass','$mail',$telf,'$esp')";
	
			if(!mysqli_query($mysqli ,$sql)){
		
				die('' . mysql_error());
				
			}
			
			echo "<center>";
	
			echo "¡Usuario registrado con exito!";
		
			echo "<p> <a href='VerUsuarios.php'> VER USUARIOS </a>";
			
			echo "<p> <a href='layout.php'> INICIO </a></center>";
			
		
			mysqli_close($mysqli);
			
		
		
		} 	
?>