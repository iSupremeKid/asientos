<?php 
date_default_timezone_set('America/Lima');
header('Content-Type: text/html; charset=UTF-8'); 

function getUltimoDiaMes($elAnio,$elMes) {
  return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
}

function comprobarFechaEjercicio(){
	$ultimo_dia_diciembre = getUltimoDiaMes(date('Y'),12);
	$time_ultimo_dia_anio = strtotime("".$ultimo_dia_diciembre."-12-".date("Y"));
	return ($time_ultimo_dia_anio >= time());
}
 ?>
