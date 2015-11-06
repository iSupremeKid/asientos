<?php
class Error{
	public function generarError($msj){
		session_start();
		$_SESSION['error'] = $msj;
	}
	public function existeError(){
		session_start();
		if(isset($_SESSION['error'])){
			if($_SESSION['error'] === "" || $_SESSION['error'] === null){
				return false;
			}
			return true;
		}
		return false;
	}
	public function obtenerMensajeError(){
		session_start();
		return $_SESSION['error'];
	}

	public function depurarError(){
		session_start();
		$_SESSION['error'] = null;
		unset($_SESSION['error']);
	}
}
?>