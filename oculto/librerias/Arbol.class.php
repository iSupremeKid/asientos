<?php
class Arbol{
	private $arrayArbolGlobal;

	public function Arbol($arrayBruto,$nombreCampoIdentificador,$nombreCampoPredecesor){
		//$this->arrayArbolGlobal = array();
		$arrayAuxFinal = array();
		$arrayAuxiliar = array();
		$cantidadElementos = count($arrayBruto);
		$longitudActual = null;
		$comenzarPushHijos = false;
		$predecesorActual = null;

		//Recorre el array en bruto
		for($i = $cantidadElementos - 1; $i >= 0; $i--){
			if($longitudActual === null){
				$longitudActual = strlen($arrayBruto[$i][$nombreCampoPredecesor]);
			}else{
				if($longitudActual > strlen($arrayBruto[$i][$nombreCampoPredecesor])){
					$longitudActual = strlen($arrayBruto[$i][$nombreCampoPredecesor]);
					$comenzarPushHijos = true;
					$arrayAuxiliar = $arrayAuxFinal;
					$arrayAuxFinal = array();
				}
			}
			if($predecesorActual !== $arrayBruto[$i][$nombreCampoPredecesor]){
				$predecesorActual = $arrayBruto[$i][$nombreCampoPredecesor];
				$arrayAuxFinal[$predecesorActual] = array();
			}

			$elementoNuevo = $this->sacarElemento($i,$arrayBruto);

			if($comenzarPushHijos === true){
				$elementoNuevo['hijos'] = array();
				if(array_key_exists($elementoNuevo[$nombreCampoIdentificador],$arrayAuxiliar)){
					array_push($elementoNuevo['hijos'], array_reverse($arrayAuxiliar[$elementoNuevo[$nombreCampoIdentificador]]));
				}
			}

			array_push($arrayAuxFinal[$predecesorActual], $elementoNuevo);
		}

		$this->arrayArbolGlobal = array_reverse($arrayAuxFinal[$predecesorActual]);
	}

	public function obtenerArrayArbol(){
		//return print_r($this->arrayArbolGlobal,true);
		return $this->arrayArbolGlobal;
	}

	public function obtenerJSONArbol(){
		//return print_r($this->arrayArbolGlobal,true);
		return json_encode($this->arrayArbolGlobal);
	}

	private function sacarElemento($indice,&$array){
		$aux = $array[$indice];
		return $aux;
	}
}
?>