<?php
require_once(dirname(__FILE__)."/../librerias/cabeceraPrivados.php");
$datosModulo = [];

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