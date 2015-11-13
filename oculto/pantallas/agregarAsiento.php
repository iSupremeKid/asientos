<?php
require_once(dirname(__FILE__)."/../librerias/funciones.php");
require_once(dirname(__FILE__)."/../librerias/cabeceraPrivados.php");
//require_once(dirname(__FILE__)."/../modelo/asiento.php");

//$plan = new Asiento();

$datosModulo['titulo'] = "Nuevo asiendo diario";
if(comprobarFechaEjercicio()){
$datosModulo['contenido'] = <<<EOT
	<fieldset>
		<legend>Formulario</legend>
		<div class="caja total" id="contenedorRowsCuentasAsiento">
			<div id="cargando"></div>
			<div class="caja total"><select name="" id="" style="width:100%">
					<option value="">1</option>
					<option value="">2</option>
					<option value="">3</option>
					<option value="">4</option>
				</select></div>
			<div class="caja total"><select name="" id="" style="width:100%">
					<option value="">1</option>
					<option value="">2</option>
					<option value="">3</option>
					<option value="">4</option>
				</select></div>
			<div class="caja total"><select name="" id="" style="width:100%">
					<option value="">1</option>
					<option value="">2</option>
					<option value="">3</option>
					<option value="">4</option>
				</select></div>
			<div class="caja total"><select name="" id="" style="width:100%">
					<option value="">1</option>
					<option value="">2</option>
					<option value="">3</option>
					<option value="">4</option>
				</select></div>
		</div>

		<div class="caja total">
			<div class="caja total">
				<input type="text" value="Valor:" style="width:100%; margin-top: 15px;">
				<button style="width:100%; margin-top: 15px;">Registrar cuenta en asiento</button>
			</div>
		</div>
	</fieldset>

<br><br>
	<fieldset>
		<legend>Asiento numero $_SESSION[actualAsiento]</legend>
		<div class="caja total" id="contenedorRows">
			<div class="caja total"><select name="" id="" style="width:100%">
					<option value="">1</option>
					<option value="">2</option>
					<option value="">3</option>
					<option value="">4</option>
				</select></div>
			<div class="caja total"><select name="" id="" style="width:100%">
					<option value="">1</option>
					<option value="">2</option>
					<option value="">3</option>
					<option value="">4</option>
				</select></div>
			<div class="caja total"><select name="" id="" style="width:100%">
					<option value="">1</option>
					<option value="">2</option>
					<option value="">3</option>
					<option value="">4</option>
				</select></div>
			<div class="caja total"><select name="" id="" style="width:100%">
					<option value="">1</option>
					<option value="">2</option>
					<option value="">3</option>
					<option value="">4</option>
				</select></div>
		</div>
	</fieldset>
	<center><!--img src="img/mockupRegistroAsientos.png" alt=""--></center>
EOT;
}else{
$datosModulo['contenido'] = <<<EOT
	<div class="mensaje error">
		<i class="fa fa-exclamation-triangle"></i>No puedes registrar mas asientos hasta que no cierres el ejercicio.
	</div>
EOT;
}


?>