
<?php

	session_start();
	
	$_SESSION = array();
	
	session_unset();
	
	session_destroy();
	
	$_SESSION['intentos'] = 0; //reseteamos y volvemos a crearla <-- esto es para lo del login y los alumnos
	
	header("location: ./login.php");
?>