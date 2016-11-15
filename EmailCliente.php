<?php

require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

$cliente = new nusoap_client("http://cursodssw.hol.es/comprobarmatricula.php?wsdl",true);

echo $cliente->call("comprobar", array("x"=> $_POST['mail'])); //no podemos usar variables de sesion, se supone que aun esta sin registrar!!!

?>