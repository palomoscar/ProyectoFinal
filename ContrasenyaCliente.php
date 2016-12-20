<?php

require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

$cliente = new nusoap_client("./ComprobarContrasenya.php",true);

$pass = $_GET['pass'];

echo $cliente->call("passVal", array("password"=> $pass ));

?>