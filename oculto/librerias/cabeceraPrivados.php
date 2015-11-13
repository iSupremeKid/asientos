<?php
require_once(dirname(__FILE__).'/../controlador/sesion.php');
require_once(dirname(__FILE__).'/../librerias/Seguridad.class.php');
header('Content-Type: text/html; charset=UTF-8'); 
$s = new Sesion();
$sec = new Seguridad();
if($s->sesionIniciada() === false){
	exit("No haz iniciado sesión");
}

if($sec->validarToken($variablesModulo['token']) === false){
	exit("Token incorrecto");
}
?>