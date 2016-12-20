<!DOCTYPE html>

<?php
	
		include("./conexionbd.php");
		
		session_start();
		
?>
<html>
  <head>
  
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Gestion de cuentas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wideGestionCuentas.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
		   <style>
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
		
		@session_start(); //le metemos la @ para que no nos de Notice : session has already started...
		
		if( !isset($_SESSION['user']) ){
			
			header("location : login.php");
			
		}if( empty($_SESSION['user']) ){//ANONIMO
				
				 header("location: login.php");
				
		}if( $_SESSION['user'] != "web000@ehu.es"){ //IKASLE
				
				header("location: GestionPreguntas.php");
				
		}
			
	?>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class="right"><a href="registro.php">Registrarse</a></span>
      		<span class="right"><a href="login.php">Login</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
		<p>Bienvenido de nuevo <?php echo $_SESSION['user']; ?></p>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Inicio</a></span>
		<span><a href='creditos.html'>Creditos</a></span>
		<span><a href='RevisarPreguntas.php'>RevisarPreguntas</a></span>
		<span><a href='bloqueados.php'>Cuentas bloqueadas</a></span>
	</nav>
    <section class="main" id="s1">
    
	<div>
	<?php

		echo "<br></br>" ;
		
		$usuarios = mysqli_query($mysqli, "SELECT * FROM usuario " ) or die('No se ha podido conectar a la BD');
		
		echo "<center>";
		echo "<h3>Alumnos Registrados</h3>";
		echo "<br></br>";
		echo '<table border=1> <tr> 
									<th> Nombre </th>
									<th> Apellidos </th>
									<th> Nickname </th>
									<th> Email </th>
								</tr>';
		
		while( $row = mysqli_fetch_array($usuarios) ){
			echo '<tr>
					  <td>'.$row['Nombre'].'</td>
					  <td>'.$row['Apellidos'].'</td>
					  <td>'.$row['Nickname'].'</td>
					  <td>'.$row['Email'].'</td>
				 </tr>';
			
		}
		echo '</table>';
		
		echo "<br></br>";
		
		echo "<h3>Bloquear Cuentas</h3>";

		echo "</center>";
		
		echo "<br></br>";
	
	?>
	
		<form name = "bloqueados" id = "bloqueados" action = "GestionCuentas.php"  method = "POST" >
		
		Selecciona el usuario que deseas bloquear: <select name= "desplegable" id = "desplegable" size="1">
		
		<option value = "0" selected>Selecciona un usuario</option>
		
		<?php
		
		$query = mysqli_query($mysqli,"SELECT * FROM usuario");
		
		while( $lista = mysqli_fetch_array($query) ){
			
			echo "<option  value='".$lista['Email']."'>".$lista["Email"]."</option>"; 
		}
		?>
		
		</select>	
		<br></br>
		<center>
			<table>
		
				<tr>
					<td>Confirma el correo que deseas bloquear: </td><td><input type="text" id = "confirmar" name="confirmar"></td>
				</tr>
			
			</table>
		<br></br>		
			<input type="submit" name="bloquear"  class = "boton" value="Bloquear" ></input>
		
		</div>
		</form>
	</div>
		
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

//extraer el usuario con js hay que hacer que no se sellecione el de valor 0

 //hasta aqui me coge bien los campos

 if( isset( $_POST['confirmar'] ) && $_POST['desplegable'] != "0"){ 
 
		if( $_POST['desplegable'] != $_POST['confirmar'] ){ 
		
			echo "<center>Los campos no coinciden</center>";
		
			die('');
		}
		//si coinciden 2 opciones : ya esta y es indeseado o esta por muchos fallos
		$usuario = $_POST['confirmar'];

		//meter en la BD blocked --> puede que ya este blocked pr e numero d eintentos
		//hacer query para saber si esta
		$consulta = mysqli_query($mysqli, "SELECT * FROM blocked WHERE Email = '$usuario'");
	
		$cont = mysqli_num_rows($consulta);
	
		if($cont > 0 ){
		
			$seleccion = mysqli_fetch_array($consulta);
		
			if( $seleccion['Indeseado'] == "Si" ){ //el acceso a la info es correcto
			
				echo "<center>El usuario seleccionado ya se encuentra bloqueado</center>";
			
				die('');
			
			}else{//hay que decir que SI es indeseado
			
				$indeseado = "Si";
				
				$email = $_POST['confirmar'];
			
				$update = mysqli_query($mysqli, "UPDATE blocked SET Indeseado ='$indeseado' WHERE Email='$email'") or die('Error al bloquear el usuario seleccionado');
			
				echo "<center>¡Usuario bloqueado con exito!</center>";
			
				die('');
			}
		
			//caso en el que no hay que hacer update, hay que insertar
			
			$mail = $_POST['confirmar'];
		
			$query = mysqli_query($mysqli,"INSERT INTO blocked(Email, Indeseado) VALUES('$mail', 'Si' )") or die('Error al bloquear el usuario seleccionado');
		
			$query2 = mysqli_query($mysqli,"DELETE FROM usuario WHERE Email = '$mail'" ) or die('El usuario bloqueado no se ha podido borrar de la base de alumnos');
		
			echo("<center>Usuario bloqueado con exito<center>");
		
			die('');
		}
	
	
 }


?>
