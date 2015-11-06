<?php
require '../oculto/librerias/cabeceras.php';
require '../oculto/librerias/Seguridad.class.php';
$s = new Seguridad();
$res = array("error"=>"Token incorrecto");
if($s->validarToken($_POST['token']) === true){
	require dirname(__FILE__).'/../oculto/controlador/sesion.php';
	$uSes = new Sesion();
	$res = $uSes->cerrarSesion();
}
header('Content-Type: application/json');
echo json_encode($res);
?>