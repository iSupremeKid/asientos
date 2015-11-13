<?php
error_reporting(0);
require '../oculto/librerias/cabeceras.php';
require '../oculto/librerias/Seguridad.class.php';
$s = new Seguridad();
$res = array("error"=>"Token incorrecto");
if($s->validarToken($_POST['token']) === true){
	require dirname(__FILE__).'/../oculto/modelo/plancontable.php';
	$cuentas = new PlanContable();
	$_POST['codigo']=''.intval($_POST['codigo']);
	$_POST['predecesor']=''.intval($_POST['predecesor']);
	$res = $cuentas->registrarCuentaPersonalizada($_POST['codigo'],$_POST['predecesor'],$_POST['nombre']);
}

header('Content-Type: application/json');
echo json_encode($res);
//echo $_POST['codigo'];
?>