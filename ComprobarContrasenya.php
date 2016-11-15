<?php

//incluimos la clase nusoap.php

require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

//creamos el objeto de tipo soap_server --->>>>???????

$ns="http://swmiguel.esy.es/ProyectoQuiz/samples";
$server = new soap_server;
$server->configureWSDL('passVal',$ns); 
$server->wsdl->schemaTargetNamespace = $ns;


//registramos la función que vamos a implementar

$server->register('passVal', array('password'=>'xsd:String'), array('x'=>'xsd:String'), $ns); //la x ?

function passVal($password){
	
	$file = fopen("http://swmiguel.esy.es/ProyectoQuiz/toppasswords.txt", "r") or die("Error al abrir el fichero toppasswords.txt");
	
	$err = "INVALIDA";
	
	$val = "VALIDA";
	
	while(!feof($file)){
		
		$line = fgets($file);
		
		if ( (strcmp(substr($line, 0, strlen($line) - 2), $password) == 0)){ //hacemos aqui lo de la longitud asi luego evitamos la comprobacion 
		//en el propio registro.php con js

			//mirar si esta en toppasswords.txt
			
			fclose($file);
			
			return $err;
			
		}	
	}
	
	fclose($file);
	
	return $val;
}

//nusoap service method

//$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';

$rawPostData = file_get_contents("php://input");

$server->service($rawPostData);

?>
