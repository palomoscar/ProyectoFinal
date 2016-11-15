<?php
//incluimos la clase nusoap.php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');
//creamos el objeto de tipo soap_server
$ns="http://localhost/ProyectoQuiz/samples";
$server = new soap_server;
$server->configureWSDL('ticketVal',$ns);
$server->wsdl->schemaTargetNamespace = $ns;
//registramos la función que vamos a implementar
$server->register('ticketVal', array('ticket'=>'xsd:String'), $ns);
//implementamos la función
function ticketVal($ticket)
{
	
	if($ticket < 4000 || $ticket > 4021){
		
		return "INVALIDO";
	}
	
	return "VALIDO";
}
//llamamos al método service de la clase nusoap

$rawPostData = file_get_contents("php://input");

$server->service($rawPostData);

?>