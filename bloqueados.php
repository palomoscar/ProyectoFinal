<!DOCTYPE html>

<html>
  <head>
  
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Gestion de Cuentas</title>
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
		
		if( !isset($_SESSION['user']) ){
			header("location : login.php");
			
		}

		if( empty($_SESSION['user']) ){//ANONIMO
				
				 header("location: login.php");
				
		}if( $_SESSION['user'] != "web000@ehu.es"){ //IKASLE
				
				header("location: GestionPreguntas.php");
				
		}
			
	?>
	
  <div id='page-wrap'>
	<header class='main' id='h1'>
      		<span class="right"><a href="Logout.php">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
		<p>Bienvenido de nuevo <?php echo $_SESSION['user']; ?></p>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Inicio</a></span>
		<span><a href='layout.php'>Inicio</a></span>
		<span><a href='VerPreguntas.php'>Preguntas</a></span>
		<span><a href='RevisarPreguntas.php'>RevisarPreguntas</a></span>
		<span><a href='GestionCuentas.php'>Gestion de Cuentas</a></span>
	</nav>
    <section class="main" id="s1">
    
	<div>

	<?php 
	
		$dat="SELECT * FROM blocked";
		
		$query= mysqli_query($mysqli,$dat);
		
		?>
		<form name= "bloqueados" id = "bloqueados" action = "bloqueados.php"  method = "POST" >
		
		Selecciona una un usuario para desbloquear : <select name= "desplegable" id = "desplegable" size="1">
		
		<option value = "0" selected>Selecciona un usuario</option>
		
		<?php
		
		while( $lista = mysqli_fetch_array($query) ){
			
			echo "<option  value='".$lista['Id']."'>".$lista["Email"]."</option>"; 
		}
		?>
		</select>	
		<br></br>
		<center>
		<table>
		
			<tr>
			<td>Confirmar correo a desbloquear: </td><td><input type="text" id = "confirmar" name="confirmar"></td>
			</tr>
			
		</table>
		<br></br>		
		<input type="submit" name="desbloquear"  class = "boton" value="Desbloquear" ></input>
		
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
<?php

	if ( isset( $_POST['desplegable'] ) ){

		 if( $_POST['desplegable'] == "0"){ 
			 
			 die('<center>No has seleccionado un usuario a desbloquear</center>');
			 //hacerlo con js mas adelante
			 
		 }
		 
		$id = $_POST['desplegable']; //lo selecciona bien
		 
		$str = " SELECT * FROM blocked WHERE Id = '$id' ";
		
		$query2= mysqli_query($mysqli,$str);
		
		$cont2 = mysqli_num_rows($query2);
		
		$seleccionado = mysqli_fetch_array($query2);
		
		$ikasle = $seleccionado['Email'];
	
		$query3= false; //por defecto se lo dejamos en falso
		
		if( $cont2 > 0 && ($_POST['confirmar'] == $ikasle) ){

			$str3 = "DELETE FROM blocked WHERE Id = '$id'";
		
			$query3 = mysqli_query($mysqli,$str3) or die('<center>No se ha podido desbloquear al usuario</center>'); 
			
		}

		if( $query3 == true){
			
			echo "<br></br>";
			echo "<center>";
			echo "Usuario desbloqueado con exito";
			echo "</center>";

		}else{
			echo "<br></br>";
			echo "<center>";
			echo "No se ha podido desbloquear el usuario seleccionado";
			echo "</center>";
		}
		
	}//cierra el isset
		
	?>