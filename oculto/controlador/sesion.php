<?php
require dirname(__FILE__).'/../modelo/usuario.php';
class Sesion{
	private $usrG;
	public function Sesion(){
		$this->usrG = new Usuario();
	}
	public function iniciarSesion($usuario,$clave){
		if($this->comprobarSesionExpirada(1800) === false){
			$datosU = $this->usrG->obtenerDatosUsuario($usuario,$clave);
			if(gettype($datosU) === 'array'){
				$this->usrG->actualizarUltimoIngreso() === true;
				session_start();
				$_SESSION['codigo'] = $datosU['codigo'];
				$_SESSION['nombre'] = $datosU['nombre'];
				$_SESSION['apePat'] = $datosU['apePat'];
				$_SESSION['apeMat'] = $datosU['apeMat'];
				$_SESSION['usuario'] = $datosU['usuario'];
				$_SESSION['ultima_actividad'] = time();
				return array(true,"Bienvenid@ ".$_SESSION['nombre']);
			}else{
				if($datosU === 0){
					return array(false,"No hay conexion con la base de datos");
				}

				if($datosU === 1){
					return array(false,"No reconocemos tus datos de conexion, revisalos y vuelve a intentarlo.");
				}
			}
		}
	}
	public function sesionIniciada(){
		session_start();
		return isset($_SESSION['codigo']);
	}
	public function obtenerDatosUsuario(){
		if($this->sesionIniciada() === true){
			session_start();
			return array(
				 'codigo' =>  $_SESSION['codigo'],
				 'nombre' =>  $_SESSION['nombre'],
				 'apePat' =>  $_SESSION['apePat'],
				 'apeMat' =>  $_SESSION['apeMat'],
				 'usuario' => $_SESSION['usuario']
			);
		}else{
			return null;
		}
	}
	public function cerrarSesion($msj = "Cerraste tu sesión"){
		session_start();
		session_regenerate_id(true);
		$_SESSION = array();
		if (ini_get("session.use_cookies")) {
		    $params = session_get_cookie_params();
		    setcookie(session_name(), '', time() - 42000,
		        $params["path"], $params["domain"],
		        $params["secure"], $params["httponly"]
		    );
		}
		session_destroy();
		return array(true,$msj);
	}
	public function comprobarSesionExpirada($tiempo){
		session_start();
		if (isset($_SESSION['ultima_actividad']) && (time() - $_SESSION['ultima_actividad'] > $tiempo)) {
			return $this->cerrarSesion();
		}else{
			session_regenerate_id(true);
			$_SESSION['ultima_actividad'] = time();
			return false;
		}
	}
}
?>