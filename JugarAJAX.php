

<?php

include("./conexionbd.php");

session_start(); 


$nivel = $_GET['nivel'] ;

$_SESSION['lvl'] = $nivel;

//creamos diferentes ids para evitar problemas al variar el nivel

$id1 = $_SESSION['id1']; $id2 = $_SESSION['id2'];$id3 = $_SESSION['id3'];$id4 = $_SESSION['id4'];$id5 = $_SESSION['id5'];

/*VAMOS A ASIGNAR EL ARRAY DE PREGUNTAS Y DE RESPUESTAS ACORDE AL NIVEL****************************************************************/

$id = $_SESSION['id'];

$max1 = sizeof($_SESSION['p1']); $max2 = sizeof($_SESSION['p2']); $max3 = sizeof($_SESSION['p3']); $max4 = sizeof($_SESSION['p4']); $max5 = sizeof($_SESSION['p5']); 

$terminar = false;

	if( $max1 == $id1 && $max2 == $id2 && $max3 == $id3 && $max4 == $id4 && $id5 == $max5 ){ //en caso de que no queden mas preguntas por responder
	
		$terminar = true;
	}

	if($_SESSION['fallos'] == 3 || $terminar == true ){ 
			
		$jugador = $_SESSION['jugador'];
				
		$pts = $_SESSION['pts'];
		
		if( $terminar == true ){
			
			echo "<center>¡Wow!, ¡has completado todas las preguntas!";
			
		}else{
			
			echo "<center>Has agotado el numero de fallos posibles ";
		
			echo "<br>";	
		
		}
			
		if( isset( $_SESSION['jugador'] )){ //logeado
			
			$mejores = mysqli_query($mysqli, "INSERT INTO mejores(Puntos, Nick) VALUES('$pts','$jugador')") or die ('No se te ha podido insertar en la BD de jugadores');
		
		}
		
		$mejores = mysqli_query($mysqli, "Select top 5 Nick and Puntos from mejores order by Puntos desc" ) or die('Error al mostrar los Top Scores');
			
			echo '<table border=1>
				<caption>Mejores Jugadores</caption>
				<tr> 
				<th> Puntos </th>
				<th> Nick </th>
				</tr>';
		
			$cont = 0;
			
			while( $row = mysqli_fetch_array($mejores) ){
				
				echo '<tr>
					  <td>'.$row['Puntos'].'</td>
					  <td>'.$row['Nick'].'</td>
					</tr>';
					
				$cont++;
				
				if($cont == 5){
					
					die('');
					
				}
			
			}
		
			echo '</table></center>';
			
			session_destroy();
			
			die('');
		
		
	}



switch ($nivel) {
    case 1:
		if( $id1 < $max1 ){
			
			$_SESSION['pregunta'] = $_SESSION['p1'][$id1];
			
			$_SESSION['respuesta'] = $_SESSION['r1'][$id1];
			
			$_SESSION['id1']++;
			
		}else{
			
			die('<center>No quedan mas preguntas en este nivel</center>');
			
		}
       
        break;
    case 2:
		if( $id2 < $max2 ){
			
			$_SESSION['pregunta'] = $_SESSION['p2'][$id2];
			
			$_SESSION['respuesta'] = $_SESSION['r2'][$id2];
			
			$_SESSION['id2']++;
			
		}else{
			
			die('<center>No quedan mas preguntas en este nivel</center>');
			
		}

        break;
    case 3:
		if( $id3 < $max3 ){
			
			$_SESSION['pregunta'] = $_SESSION['p3'][$id3];
			
			$_SESSION['respuesta'] = $_SESSION['r3'][$id3];	
			
			$_SESSION['id3']++;
			
		}else{
			
			die('<center>No quedan mas preguntas en este nivel</center>');
			
		}
       
        break;
	case 4:
		if( $id4 < $max4 ){
					
			$_SESSION['pregunta'] = $_SESSION['p4'][$id4];
			
			$_SESSION['respuesta'] = $_SESSION['r4'][$id4];	
			
			$_SESSION['id4']++;
			
		}else{
		
			die('<center>No quedan mas preguntas en este nivel</center>');
			
		}

        break;
    case 5:
		if( $id5 < $max5 ){
			
			$_SESSION['pregunta'] = $_SESSION['p5'][$id5];
			
			$_SESSION['respuesta'] = $_SESSION['r5'][$id5];
			
			$_SESSION['id5']++;
			
		}else{
			
			die('<center>No quedan mas preguntas en este nivel</center>');
			
		}

        break;
	}
	
	 //ACTUALIZAMOS EL ID PARA LA SIGUIENTE PREGUNTA

	echo "<br>";
	
	$_SESSION['currentanswer'] = $_SESSION['respuesta'];
	
	$_SESSION['currentquestion'] = $_SESSION['pregunta'];
	
	
	echo "<center><h2>".$_SESSION['currentquestion']."</h2></center>"; 
	
 
?>

<form id = "respuesta" name = "respuesta" method = "POST">
			<br>

			<tr>
				<td>Introduce tu respuesta: </td> <td> <input type="text" id = "answer" name="answer" ></td>
			</tr>
			
			<br>

			<tr>
				<br><input type="button" name="enter"  id = "enter" class = "boton" value="Comprobar" onClick = "check()" >
			</tr>

				<input type="hidden" name="resp"  id = "resp"  value="<?php echo $_SESSION['currentanswer'];?>" >

</form>
