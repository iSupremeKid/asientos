<?php
//error_reporting(0);
require '../oculto/librerias/cabeceras.php';
require '../oculto/librerias/Seguridad.class.php';
$s = new Seguridad();
$res = array("error"=>"Token incorrecto");
if($s->validarToken($_POST['token']) === true){
	require dirname(__FILE__).'/../oculto/modelo/plancontable.php';
	$cuentas = new PlanContable();
	$res = $cuentas->obtenerCuentasDe($_POST['predecesor']);
}
header('Content-Type: application/json');
echo json_encode($res);
//echo $_POST['predecesor'];
?>