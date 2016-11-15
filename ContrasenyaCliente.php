<?php

require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

$cliente = new nusoap_client("http://swmiguel.esy.es/ProyectoQuiz/ComprobarContrasenya.php?wsdl",true);

echo $cliente->call("passVal", array("password"=> $_POST['pass'] ));

?>