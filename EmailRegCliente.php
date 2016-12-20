<?php

require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

$cliente = new nusoap_client("./ComprobarEmail.php",true);

echo $cliente->call("mailVal", array("email"=> $_POST['mail'] ));

?>