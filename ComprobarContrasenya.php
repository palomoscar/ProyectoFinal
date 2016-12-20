 <?php

//incluimos la clase nusoap.php

require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

//creamos el objeto de tipo soap_server --->>>>???????

$ns="./samples";
$server = new soap_server;
$server->configureWSDL('passVal',$ns); 
$server->wsdl->schemaTargetNamespace = $ns;


//registramos la función que vamos a implementar

$server->register('passVal'); 

function passVal($password){
	
	  $file = fopen("toppasswords.txt", "r") or die("Error de lectura en el fichero");
	  
        while(!feof($file))
        {        
                $line = fgets($file);
				
                if (strstr($line,$pass)){
                
					return "INVALIDA";
                }        
        }
        
        fclose($file);
 
        return "VALIDA";
}

//nusoap service method

//$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';

$rawPostData = file_get_contents("php://input");

$server->service($rawPostData);

?>
