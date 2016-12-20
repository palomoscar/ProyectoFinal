<!DOCTYPE HTML>
		
		
	<?php
	
	include("./conexionbd.php");

	session_start();
	
	//comprobamos que lo introducido esta en la bd sino return
	
	$email = $_GET['mail'];//SE SUPONE QUE DESDE EL JS DE LOGIN2.PHP LE PASAMOS ESTO : xmlhttp.open("GET","loginAjax.php?mail="+str,true);
	
	//hacemos el query

	$queryMail = mysqli_query($mysqli, "SELECT * FROM usuario WHERE Email = '$email'");
	
	$cont = mysqli_num_rows($queryMail);
	
	if($cont < 1 ){
		
		die(" CORREO NO REGISTRADO ");
		
	}
	
	?>
	<html>
	
	<head>
	
	<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	
	<title>Login Ajax</title>
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

	<form id = "loginajax" name = "loginajax"  method="post" action = "loginAJAX.php">
	
	<center>
	
		<table>
		<tr>
		<td>Clave de Usuario : </td> <td> <input type = "password" id = "pass" name = "pass" ></td>
		</tr>

		</table>	
		
		<input type="submit" name="login"  id = "login" class = "boton" value="Login" ></input>

	</center>
	</form>
	</body>
	</html>
	<?php
	
	if( isset($_POST['pass']) ){
		
		$pass = $_POST['pass']; //para los nuevos usuarios hay que cifrar con sha1
			
		$query1 =  mysqli_query($mysqli, "SELECT * FROM usuario WHERE Email = '$email' AND Clave = '$pass'" );
	
		$query2 = mysqli_query($mysqli, "SELECT * FROM blocked WHERE Email = '$email' " );
			
		$cont1 = mysqli_num_rows($query1);
	
		$cont2 = mysqli_num_rows($query2);
	
		$acierto = false;
	
		$_SESSION['intentos'] = 0;
	
		//las redirecciones dan problema porque estamos visualizando una semipagina
	
		if( $cont2 > 1){ //en caso de que se encuentre en la bd de bloqueadoss
		
			echo "<script> alert('Su cuenta ha sido bloqueada, pongase en contacto con el profesor'); </script>";
			
			header("location: layout.html");
		
		}
			//lo que antes haciamos con un while, ahora hacemos redirigiendo y aumentando el contador "global"
		
		$query1 =  mysqli_query($mysqli, "SELECT * FROM usuario WHERE Email = '$email' AND Clave = '$pass'" );
		
		$cont1 = mysqli_num_rows($query1);
		
		if( $cont1 < 1 && $_SESSION['intentos'] > 3 ){//aqui bloqueamos	
			
			$bloquear = "INSERT INTO blocked(Email) VALUES('$email') ";
		
			$query3 = mysqli_query($mysqli, $bloquear);
		
			die('El email ha sido bloqueado hasta que el profesor lo decida. Motivo : Demasiados intentos fallidos');
			
		}
		if($cont1 < 1 && $_SESSION['intentos'] < 4){ //si fallamos pero nos quedan intentos
			
			$_SESSION['intentos']++;
			
			header("location: login2.php");
			
		}
		
		if($email == "web000@ehu.es"){
		
			$_SESSION['user'] = $email;
		
			$_SESSION['intentos'] = 0 ;
			
			echo "<a href='RevisarPreguntas.php'>Acceder</a>";
		
		}else{
		
			$_SESSION['user'] = $email;
		
			$_SESSION['intentos'] = 0 ;
			
			echo "<a href='GestionPreguntas.php'>Acceder</a>";
			
		}
		
		
	}
	
	?>