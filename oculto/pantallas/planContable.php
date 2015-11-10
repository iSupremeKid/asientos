<?php
require_once(dirname(__FILE__)."/../librerias/cabeceraPrivados.php");
require_once(dirname(__FILE__)."/../modelo/plancontable.php");
$plan = new PlanContable();
$cuentas = $plan->obtenerCuentas();
$datosModulo = [];

$usr = $s->obtenerDatosUsuario();
$datosModulo['titulo'] = "Mi plan contable";

class Corredor{
	public $htmlResultante = "<table>";

	public function recursiva(&$array,$identacion = 0){
		for($f = 0; $f < count($array); $f++){
			$this->htmlResultante .= "<tr><td style=\"padding-left: ".($identacion*15)."px\" class=\"".strtolower($array[$f]['tipo'])."\">".$array[$f]['codigo'].". ".$array[$f]['nombre']."</td></tr>\n";
			try {
 				$this->recursiva($array[$f]['hijos'][0],$identacion+1);
			} catch (Exception $e) {
			    //echo 'Excepción capturada: ',  $e->getMessage(), "\n";
			}
			
		}
	}
}

$d = new Corredor();
$d->recursiva($cuentas);

//$datosModulo['contenido'] = print_r($cuentas);
$datosModulo['contenido'] = $d->htmlResultante."</table>";
?>