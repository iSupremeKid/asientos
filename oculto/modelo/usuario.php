<?php
class Usuario{
	private $bd = null;
	public function Usuario(){
		$mysqli = new mysqli("localhost", "pFinalContab", "k7swurUc", "asientosSis");
		if(!$mysqli->connect_errno) {
			$this->bd = $mysqli;
		}
	}

	public function obtenerDatosUsuario($usr,$psw){
		if($this->bd !== null){
			$psw = md5($psw);
			$r = $this->bd->query("SELECT codigo,nombre,apePat,apeMat,usuario FROM usuario WHERE usuario = '".$usr."' AND clave = '".$psw."'");
			if($r->num_rows === 1){
				return $r->fetch_assoc();
			}else{
				return 1;
			}
		}else{
			return 0;
		}
	}
	public function actualizarUltimoIngreso(){
		if (session_status() === PHP_SESSION_NONE){session_start();}
		return $this->bd->query("UPDATE usuario SET ultima_conexion = ".time()." WHERE codigo = ".intval($_SESSION['codigo'])."");
	}
}
?>