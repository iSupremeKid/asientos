<?php
require_once(dirname(__FILE__).'/../../oculto/controlador/sesion.php');
require_once(dirname(__FILE__).'/../../oculto/librerias/Seguridad.class.php');

$datosModulo = [];

$s = new Sesion();
$sec = new Seguridad();
if($s->sesionIniciada() === false){
	exit("No haz iniciado sesión");
}

if($sec->validarToken($variablesModulo['token']) === false){
	exit("Token incorrecto");
}
$usr = $s->obtenerDatosUsuario();
$datosModulo['titulo'] = $usr['nombre'];
$datosModulo['contenido'] = "
<div class=\"bloqueCentrado\" id=\"tarjetausuario\">
	<h3>Bienvenido</h3>
	<h5>
	".$usr['nombre']."
	 ".$usr['apePat']."
	  ".$usr['apeMat']."
	  </h5>
</div>
";
?>