<?php

        $HOSTINGER=1;
	
	if ($HOSTINGER==1)
        {
	$host = "mysql.hostinger.es";
	$user = "u204349316_root";
	$password = "gabriel3";
	$dbname = "u204349316_users";
        }
        else
        {
        $host = "localhost";
		$user = "root";
		$password = "";
		$dbname = "quiz";
        }
	
	$mysqli = mysqli_connect($host, $user, $password, $dbname);
	
	if ($mysqli->connect_errno)
	{
		die ( 'Error al conectar con la Base de Datos' . mysqli_connect_error() . PHP_EOL);	
	}
?>