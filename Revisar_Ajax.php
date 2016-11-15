<?php

	$pregunta = $_GET['oldpregunta'];
	
	$newpregunta=$_POST['pregunta'];
		
	$respuesta=$_POST['respuesta'];
		
	$tema=$_POST['tema'];
		
	$dificultad=$_POST['dificultad'];
		
		if( !empty($pregunta)){ //aqui le estamos obligando a que modifique todos los campos
		//hay que hacer otros 3 ifs por si solo quiere cambiar la dificultad o el tema
			
		$sql="UPDATE preguntas SET Pregunta='$newpregunta', Respuesta='$respuesta', Dificultad='$dificultad', Tema='$tema'  WHERE Pregunta='$pregunta'";
		
		$query= mysqli_query($mysqli,$sql);
		
		if( $query === TRUE){
			
			echo "Pregunta modificada con exito";
			
		}else{
			
			echo "No se ha podido modificar la pregunta";
		}
		
?>