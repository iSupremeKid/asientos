<?php
header('Content-Type: text/html; charset=UTF-8'); 
require_once dirname(__FILE__).'/../librerias/Arbol.class.php';
class PlanContable{
	private $arbol;
	private $bd = null;
	public function PlanContable(){
		$mysqli = new mysqli("localhost", "root", "", "asientossis");
		if(!$mysqli->connect_errno) {
			$this->bd = $mysqli;
		}
		if (!$mysqli->set_charset("utf8")) {
		    printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
		    exit();
		}
	}

	public function obtenerCuentas(){
		$planContable = array();
		if($this->bd !== null){
			//$qElem = $this->bd->query("SELECT nombre FROM PlanContable WHERE predecesor IS NULL");
			$qElem = $this->bd->query("SELECT * FROM plancontable WHERE usuario IN (3,".$_SESSION['codigo'].") ORDER BY LENGTH(predecesor),predecesor ASC");
			//$qElem = $this->bd->query("SELECT * FROM plancontable WHERE usuario = 3 ORDER BY LENGTH(predecesor),predecesor ASC");
			$elementos = $qElem->fetch_all(MYSQLI_ASSOC);
			$cantElementos = count($elementos);
			$arbol = new Arbol($elementos,'codigo','predecesor');
			return $arbol->obtenerArrayArbol();

		}else{
			return 0;
		}
	}
	public function obtenerCuentasDe($predecesor){
		$planContable = array();
		if($this->bd !== null){
			//$qElem = $this->bd->query("SELECT nombre FROM PlanContable WHERE predecesor IS NULL");
			if($predecesor !== "")
				$predecesor = intval($predecesor);
			$qElem = $this->bd->query("SELECT codigo,nombre,tipo FROM plancontable WHERE predecesor = '".$predecesor."' ORDER BY codigo ASC");
			//$qElem = $this->bd->query("SELECT codigo,nombre,tipo FROM planContable ORDER BY codigo ASC");
			$elementos = $qElem->fetch_all(MYSQLI_NUM);
			return $elementos;

		}else{
			return 0;
		}
	}
	public function registrarCuentaPersonalizada($codigo,$predecesor,$nombre){
		$planContable = array();
		if($this->bd !== null){
			//$qElem = $this->bd->query("SELECT nombre FROM PlanContable WHERE predecesor IS NULL");
			$qElem = $this->bd->query("INSERT INTO plancontable(codigo,predecesor,tipo,nombre,usuario) VALUES ('".$codigo."','".$predecesor."','SUBCUENTA P','".$nombre."','".$_SESSION['codigo']."')");
			if($qElem){
			    return json_encode(array('condicion'=>'exito'));
			}else{
			    return json_encode(array('condicion'=>'error'));
			}
		}else{
			return 0;
		}
	}
	public function obtenerCuentasJSON(){
		$planContable = array();
		if($this->bd !== null){
			//$qElem = $this->bd->query("SELECT nombre FROM PlanContable WHERE predecesor IS NULL");
			$qElem = $this->bd->query("SELECT * FROM plancontable ORDER BY LENGTH(predecesor),predecesor ASC");
			$elementos = $qElem->fetch_all(MYSQLI_ASSOC);
			$cantElementos = count($elementos);
			$arbol = new Arbol($elementos,'codigo','predecesor');
			return $arbol->obtenerJSONArbol();

		}else{
			return 0;
		}
	}
}
?>