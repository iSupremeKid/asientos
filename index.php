<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
require_once('oculto/librerias/cabeceras.php');
require_once('oculto/librerias/Seguridad.class.php');
require_once('oculto/librerias/error.php');
require_once('oculto/controlador/sesion.php');
$sec = new Seguridad();
$err = new Error();
$sesion = new Sesion();
$titulo = "Proyecto final | Contabilidad General";
if($sesion->sesionIniciada() === true){
	$titulo = ucwords($_SESSION['nombre']) . " | " . $titulo;
}
?><!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<link type="text/css" href="css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link href='https://fonts.googleapis.com/css?family=Muli|Fjalla+One' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <link href="css/ed-grid.css" rel="stylesheet" type="text/css" />
	<title><?=$titulo;?></title>
</head>
<?php
if($sesion->sesionIniciada() === true && !$err->existeError()){
	if($sec->validarToken($_GET['token']) === false){
		$err->generarError('Token inválido, inicia sesion para regenerarlo');
		header("Location: index.php");
	}
	$usuario = $sesion->obtenerDatosUsuario();
	$token = $sec->generarToken();
?>
<body id="bodyLogu" data-token="<?=$token;?>">
<div class="grupo">
	<div id="tituloGen" class="caja total"><h1>Asientos contables</h1><h2>Proyecto final de contabilidad general</h2></div>
	<div id="menuIzq" class="caja movil-1-3">
		<p class="tituloBloque"><i class="fa fa-bars"></i>&nbsp;Libro diario</p>
			<button data-token="<?=$token;?>" onclick="mostrarSeccion('');" class="btnResaltado opcBloque"><i class="fa fa-caret-right"></i>&nbsp;Registrar asiento</button>
			<button data-token="<?=$token;?>" onclick="mostrarSeccion('');" class="opcBloque"><i class="fa fa-caret-right"></i>&nbsp;Cerrar ejercicio</button>

		<p class="tituloBloque"><i class="fa fa-table"></i>&nbsp;Reportes</p>
			<button data-token="<?=$token;?>" onclick="mostrarSeccion('');" class="opcBloque"><i class="fa fa-caret-right"></i>&nbsp;Ver cierres realizados</button>

		<p class="tituloBloque"><i class="fa fa-cog"></i>&nbsp;Asientos contables</p>
			<button data-token="<?=$token;?>" onclick="mostrarSeccion('');" class="opcBloque"><i class="fa fa-caret-right"></i>&nbsp;Añadir asiento personalizado</button>

		<p class="tituloBloque"><i class="fa fa-eye"></i>&nbsp;Plan contable</p>
			<button data-token="<?=$token;?>" onclick="mostrarSeccion('');" class="opcBloque"><i class="fa fa-caret-right"></i>&nbsp;Ver Mi plan contable</button>

		<p class="tituloBloque"><i class="fa fa-user"></i>&nbsp;Usuario</p>
			<button data-token="<?=$token;?>" onclick="mostrarSeccion('datosUsuario');" class="opcBloque"><i class="fa fa-caret-right"></i>&nbsp;Ver mis datos de usuario</button>
			<button data-token="<?=$token;?>" class="opcBloque" onclick="cerrarSesion('<?=$token;?>')"><i class="fa fa-caret-right"></i>&nbsp;Cerrar sesión</button>
	</div>
	<div id="contenedor" class="caja movil-2-3">
		

	</div>
	<div id="pieGen" class="caja total"></div>
</div>
<?php
}else{
	$token = $sec->generarToken();
?>

<body>
<div id="cajaLogin">
	<?php
	if($err->existeError() === true){
	?>
	<div class="mensaje error">
		<i class="fa fa-exclamation-triangle"></i>&nbsp;<?=$err->obtenerMensajeError();?>
	</div>
	<?php
	$err->depurarError();
	}
    setcookie('error', null, -1, '/');
	?>
	<p><i class="fa fa-lock"></i>&nbsp;Identifícate</p>
	<form id="formuLogin" action="index.php" method="post">
		<div class="campo">
			<label for="usuario"><i class="fa fa-user"></i></label>
			<input type="text" id="usuario" name="usuario" autofocus required placeholder="Tu nombre de usuario">
		</div>
		<div class="campo">
			<label for="clave"><i class="fa fa-key"></i></label>
			<input type="password" id="clave" name="clave" required placeholder="Tu contraseña">
		</div>
		<div class="campo">
			<input type="hidden" name="token" value="<?=$token;?>">
			<input type="submit" value="Acceder">
		</div>	
	</form>
	<p>Si no tienes un usuario, puedes <button><small><i class="fa fa-user-plus"></i>&nbsp;registrarte</button></small></p>
</div>
<script>
	var formulario = document.getElementById('formuLogin');
	formulario.onsubmit = function(e){
		e.preventDefault();
		console.log(formulario);
		var datos = {'usuario':formulario.usuario.value,'clave':formulario.clave.value,'token':formulario.token.value}
		enviarPost('procesos/iniciarSesion.php',datos,function(d){
			if(typeof(d) === "string"){
				d = JSON.parse(d);
			}
			if(d.error){
				swal("Error",d.error,"error");
			}else{
				if(d[0] === false){
					swal("Error",d[1],"error");
				}else{
					document.location.href = "index.php?token=<?=$token;?>";
					//swal("Exito",d[1],"success");
				}
			}
		});
	}
</script>
<?php
}
?>
	<script src="js/sweetalert.min.js"></script>
	<script src="js/ajax.js"></script>
	<script src="js/main.js"></script>
</body>
</html>