<?php
class Asiento{
	private $bd = null;
	public function Asiento(){
		$mysqli = new mysqli("localhost", "root", "", "asientossis");
		if(!$mysqli->connect_errno) {
			$this->bd = $mysqli;
		}
	}

	public function registrarAsiento($contenido){
		if($this->bd !== null){
			if (session_status() === PHP_SESSION_NONE){session_start();}
			$filas = json_decode($contenido);
			$num = count($filas);
			$cadena = "";

			for($i = 0;$i < $num;$i++){
				$cadena .= "(".$_SESSION['codigo']",".$_SESSION['actualAsiento']",".time().",'DIARIO','".serialize($filas[$i])."'')";
				if($i < $num)
					$cadena .= ",";
			}
			
			if($this->bd->query("INSERT INTO Asientos VALUES ".$cadena)){
				return json_encode(array("estado"=>"exito"));
			}else{
				return json_encode(array("estado"=>"error"));
			}
			
		}else{
			return 0;
		}
	}
}
?>