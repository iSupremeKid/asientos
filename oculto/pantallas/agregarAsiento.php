<?php
require_once(dirname(__FILE__)."/../librerias/cabeceraPrivados.php");
require_once(dirname(__FILE__)."/../modelo/plancontable.php");

$plan = new PlanContable();
$cuentas = $plan->obtenerCuentasJSON();


$datosModulo = [];

$datosModulo['titulo'] = "Nuevo asiento";
$datosModulo['contenido'] = <<<EOT
<div class="bloqueCentrado" id="formularioLlenado">
	
</div>
<script>
var cuentas = $cuentas;
console.log(cuentas);
var formularioLlenado = document.getElementsById('formularioLlenado'),
	agregarSel = function(arr){
		var select = document.createElement("select");
		for(x in arr){
			
		}
	};

</script>
EOT;
?>