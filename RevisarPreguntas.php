
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
	<script>
		function check(){
				var elem = document.getElementById('desplegable');
				var preg = document.getElementById('pregunta');
				var res = document.getElementById('respuesta');
				var tema = document.getElementById('tema');
				var dif = document.getElementById('dificultad');
			
				var aviso = "Por favor, selecciona una pregunta para modificar";
				var aviso2 = "Por favor, modifica alguno de los campos";
				
				var error = 0;
				
				if( elem.value == "0" ){
					
					alert(aviso);
					
					return false;
					
				}if( preg.value == "" && res.value == "" && tema.value == "" && dif.value == ""  ){
					
					alert(aviso2);
					
					return false;
				
				}

				return true;
			}
	
	</script>
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
		<span><a href='VerPreguntas.php'>Preguntas</a></span>
		<span><a href='bloqueados.php'>Cuentas bloqueadas</a></span>
		<span><a href='GestionCuentas.php'>Gestion de Cuentas</a></span>
	</nav>
    <section class="main" id="s1">
    
	<div>

	<?php 
	
		$dat="SELECT * FROM preguntas";
		
		$query= mysqli_query($mysqli,$dat);
		
		?>
		<form name= "preguntas" id = "preguntas" action = "RevisarPreguntas.php" onSubmit = "return check()" method = "POST" >
		
		Selecciona una pregunta para editar: <select name= "desplegable" id = "desplegable" size="1">
		<option value = "0" selected>Selecciona una pregunta</option>
		<?php
		
		while( $lista = mysqli_fetch_array($query) ){
			
			echo "<option  value='".$lista['Id']."'>".$lista["Pregunta"]."</option>"; 
		}
		?>
		</select>	
		<br></br>
		<center>
		<table>
		<tr>
		<td>Nueva Pregunta : </td> <td> <TEXTAREA rows="3" cols="30" maxlength="50" id = "pregunta" name="pregunta"></TEXTAREA></td>
		</tr>
		<td></td><td></td>
		<tr>
		<td>Nueva Respuesta: </td> <td> <input type="text" id = "respuesta" name="respuesta" ></td>
		</tr>
		<td></td><td></td>
		<tr>
		<td>Nuevo Tema: </td> <td> <input type="text" id = "tema" name="tema"></td>
		</tr>
		<td></td><td></td>
		<tr>
		<td>Nuevo Grado de Dificultad : </td> <td> 
		<select name="dificultad" id = "dificultad" size="1" >
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
		<input type="submit" name="modificar"  class = "boton" value="Modificar" ></input>
		
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
		 //hacer un query nuevo, asignar a estas variables y actualizar en los ifs

		 
	if ( isset( $_POST['desplegable'] ) ){

		 
		 if( $_POST['desplegable'] == 0){ 
			 
			 die('No has seleccionado una pregunta a modificar');
			 //se supone que js nos lo hace tambien desde el cliente
			 
		 }
		 
		 //seleccionamos la pregunta elegida
		 
		$id = $_POST['desplegable'];
		 
		$str = " SELECT * FROM preguntas WHERE Id = '$id' ";
		
		$query2= mysqli_query($mysqli,$str);
		
		$lista2 = mysqli_fetch_array($query2);
		
		//asignamos las variables con los valores actuales de la base de datos
		
		$ikasle = $lista2['Email'];
 
		$question = $lista2['Pregunta'];
		
		$answer = $lista2['Respuesta'];
		
		$topic = $lista2['Tema'];
		
		$dificulty = $lista2['Dificultad'];
		
		//ahora comprobamos si se han realizado cambios
		
		if(!empty($_POST['pregunta'])){
			
			$question = $_POST['pregunta']; 
			
		}if(!empty($_POST['respuesta'])){
			
			$answer = $_POST['respuesta'];
			
		}if(!empty($_POST['tema'])){
			
			$topic = $_POST['tema'];
			
		}if(!empty($_POST['dificultad'])){
			
			$dificulty = $_POST['dificultad'];
			
		}
		
		//haremos un update con las nuevas modificaciones
		
		$str3 = "UPDATE preguntas SET Pregunta='$question', Respuesta='$answer', Dificultad='$dificulty', Tema='$topic'  WHERE Id='$id'";
		
		$query3 = mysqli_query($mysqli,$str3);
		
		
		if( $query3 === true){
			
			echo "<br></br>";
			echo "<center>";
			echo "Pregunta modificada con exito";
			echo "</center>";

		}else{
			echo "<br></br>";
			echo "<center>";
			echo "No se ha podido modificar la pregunta";
			echo "</center>";
		}
		
	}//cierra el isset
		
	?>

	
