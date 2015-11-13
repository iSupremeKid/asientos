<?php
require_once(dirname(__FILE__)."/../librerias/cabeceraPrivados.php");

$datosModulo['titulo'] = "Asientos de diario";
$datosModulo['contenido'] = <<<EOT

<div class="bloqueCentrado">
	<table style="width: 100%;" border="1">
		<thead>
			<tr>
				<th>#</th>
				<th>Asiento</th>
				<th style="width: 16.67%;"></th>
				<th style="width: 16.67%;">Debe</th>
				<th style="width: 16.67%;">Haber</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
</div>


EOT;
?>