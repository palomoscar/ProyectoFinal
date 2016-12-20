<?php

$pass = "probando";
$answ = "probando";

$pass2 = sha1($pass);
$answ2 = sha1($answ);

$pass3 = md5($pass);
$answ3 = md5($answ);



if( ($pass2 == $answ2 ) && ($pass3 == $answ3)){
	
	echo "Todo ha sido bien encriptado";
	
}else{
	echo "No desencripta bien";
}

?>