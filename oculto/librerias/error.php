<?php
class Error{
	public function generarError($msj){
		if (session_status() === PHP_SESSION_NONE){session_start();}
		$_SESSION['error'] = $msj;
	}
	public function existeError(){
		if (session_status() === PHP_SESSION_NONE){session_start();}
		if(isset($_SESSION['error'])){
			if($_SESSION['error'] === "" || $_SESSION['error'] === null){
				return false;
			}
			return true;
		}
		return false;
	}
	public function obtenerMensajeError(){
		if (session_status() === PHP_SESSION_NONE){session_start();}
		return $_SESSION['error'];
	}

	public function depurarError(){
		if (session_status() === PHP_SESSION_NONE){session_start();}
		$_SESSION['error'] = null;
		unset($_SESSION['error']);
	}
}
?>