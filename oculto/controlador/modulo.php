<?php
class Modulo{
	private $tituloModulo;
	private $contenidoModulo;

	public function Modulo($nomArchivoModulo,$variablesModulo){
		$this->tituloModulo = "";
		$this->contenidoModulo = "";
		if(preg_match("/^[a-zA-z0-9\-]+$/", $nomArchivoModulo)){
			if(file_exists('../pantallas/'.$nomArchivoModulo.'.php')){
				include dirname(__FILE__).'/../pantallas/'.$nomArchivoModulo.'.php';
			}else{
				include dirname(__FILE__).'/../pantallas/404.php';
			}
		}else{
			include dirname(__FILE__).'/../../pantallas/399.php';
		}
		$this->tituloModulo = $datosModulo['titulo'];
		$this->contenidoModulo = $datosModulo['contenido'];
	}

	public function obtenerDatosModulo(){
		return array('titulo'=>$this->tituloModulo,'contenido'=>$this->contenidoModulo);
	}
}
?>