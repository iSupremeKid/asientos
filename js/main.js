"use strict";
var bodyLogueado = document.getElementById('bodyLogu');
var cerrarSesion = function(token) {
    swal({
        title: "Confirma",
        text: "Seguro que quieres cerrar tu sesion?",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    }, function() {
       enviarPost("procesos/cerrarSesion.php", {
	        token: token
	    }, function(f) {
	        if (typeof f === "string") {
	            f = JSON.parse(f);
	        }
	        if (f[0] === true) {
	        	document.location.href = "index.php";
	        }
	    });
    });
};

if(bodyLogueado !== null){
	var contenedorAjax = bodyLogueado.children[0].children[2];
	var mostrarSeccion = function(seccion,token){
		if(/^[a-zA-z0-9\-]+$/.test(seccion)){
			enviarGet('pantallas/'+seccion+'.php',{'token':token},function(datos){
				contenedorAjax.innerHTML = datos;
			});
		}
	};

	bodyLogueado.onload = function(){
		mostrarSeccion('datosUsuario',bodyLogueado.getAttribute('data-token'));
	}

	bodyLogueado.onbeforeunload = function(e){
		//mostrarSeccion('datosUsuario',bodyLogueado.getAttribute('data-token'));
		console.log(e);
	}
}