

<?php


include("./conexionbd.php");

session_start(); 

	if( $_GET['valor'] == 0){ //fallo
	
		$_SESSION['fallos']++;		
		
		if( $_SESSION['fallos'] < 3){
			
			echo "¡HAS FALLADO!";
	
		}
	
	}else{ //acierto

		$_SESSION['pts'] = $_SESSION['pts'] + $_SESSION['lvl'] ;
		
		echo "¡CORRECTO!";	
		
	}
	
	$restantes = 3 - $_SESSION['fallos'];
	
	echo "Tienes ".$_SESSION['pts']." puntos ";
	
	echo "y te quedan ".$restantes." fallos por cometer";
	

?>