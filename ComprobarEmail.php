 <?php

//incluimos la clase nusoap.php

require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

//creamos el objeto de tipo soap_server --->>>>???????

$ns="./samples";
$server = new soap_server;
$server->configureWSDL('mailVal',$ns); 
$server->wsdl->schemaTargetNamespace = $ns;


//registramos la función que vamos a implementar

$server->register('mailVal', array('email'=>'xsd:String'), $ns);

function mailVal($email){
	
	
	$err = "INVALIDO";
	
	$val = "VALIDO";
	
	//simplemente comprobar que este registrado
	
	$query1 =  mysqli_query($mysqli, "SELECT * FROM usuario WHERE Email = '$email' " );
			
	$cont1 = mysqli_num_rows($query1);

		if($cont1 > 0){
			
			return $val;
		
		}

	return $err;
}

//nusoap service method

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';

$server->service($rawPostData);

?>
