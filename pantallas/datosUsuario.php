<?php
require_once('../oculto/controlador/sesion.php');
require_once('../oculto/librerias/Seguridad.class.php');
$s = new Sesion();
$sec = new Seguridad();
if($s->sesionIniciada() === false){
	exit("No haz iniciado sesión");
}

if($sec->validarToken($_GET['token']) === false){
	exit("Token incorrecto");
}
$usr = $s->obtenerDatosUsuario();
?>
<div class="bloqueCentrado" id="tarjetausuario">
	<h3>Bienvenido</h3>
	<h5><?=$usr['nombre'].' '.$usr['apePat'].' '.$usr['apeMat'];?></h5>
</div>