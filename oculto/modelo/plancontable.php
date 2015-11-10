<?php
require_once dirname(__FILE__).'/../librerias/Arbol.class.php';
class PlanContable{
	private $arbol;
	private $bd = null;
	public function PlanContable(){
		$mysqli = new mysqli("localhost", "pFinalContab", "k7swurUc", "asientosSis");
		if(!$mysqli->connect_errno) {
			$this->bd = $mysqli;
		}
	}

	public function obtenerCuentas(){
		$planContable = array();
		if($this->bd !== null){
			//$qElem = $this->bd->query("SELECT nombre FROM PlanContable WHERE predecesor IS NULL");
			$qElem = $this->bd->query("SELECT * FROM PlanContable ORDER BY LENGTH(predecesor),predecesor ASC");
			$elementos = $qElem->fetch_all(MYSQLI_ASSOC);
			$cantElementos = count($elementos);
			$arbol = new Arbol($elementos,'codigo','predecesor');
			return $arbol->obtenerArrayArbol();

		}else{
			return 0;
		}
	}
}
?>