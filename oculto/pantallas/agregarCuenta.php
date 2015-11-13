<?php
require_once(dirname(__FILE__)."/../librerias/cabeceraPrivados.php");
require_once(dirname(__FILE__)."/../modelo/plancontable.php");

$plan = new PlanContable();
$cuentas = $plan->obtenerCuentasJSON();


$datosModulo = [];

$datosModulo['titulo'] = "Nueva cuenta en plan contable";
$datosModulo['contenido'] = <<<EOT
<div class="bloqueCentrado" id="formularioLlenado">
	<div id="cargando"></div>
	<div class="grupo" id="rutaNuevaCuenta">
		<div class="caja total"><h4>Define la ruta</h4></div>
		<div class="caja total" id="contenedorRows">
			
		</div>
		</div>
	</div>


	<div class="grupo" id="valoresNuevaCuenta">
		<div class="caja total"><h4>Define el nombre de la nueva cuenta</h4></div>
	  	<div class="caja total">
	  		<label for="nombreNuevaCuenta">Nombre de la nueva cuenta</label>
			<input type="text" id="nombreNuevaCuenta" name="nombreNuevaCuenta">
	  	</div>
	</div>


	<div class="grupo" id="valoresNuevaCuenta">
		<div class="caja total">
			<button onclick=enviarDatos();>Registrar cuenta</button>
		</div>
	</div>
</div>
<script>
	var carga = document.getElementById("cargando");
	var contenedorRows = document.getElementById("contenedorRows");
	var contadorRows = -1;
	var codigoSeleccionado = '';
	var predecesorSeleccionado = '';
	var d = 0;
	var siguienteIndice = function(cod){
		cod = cod.split('');
		
		cod[cod.length-1]=(parseInt(cod[cod.length-1])+1)+"";
		
		return cod.join("");
	},
	obtenerNodos = function(domobj){
		var nodos = domobj.childNodes;
		var nodosf = [];
		for(i in nodos){
			if(nodos[i].nodeType === 1){
				nodosf.push(nodos[i]);
			}
		}
		console.log(nodosf);
		return nodosf;
	}
	var eliminarElementosDebajoDe = function(indice,c){
		indice = parseInt(indice);
			var longi = contenedorRows.children.length;
			for(var i = indice+1;(contenedorRows.children.length-1 > indice);i){
				if(contenedorRows.children.length === 1) break;
				contenedorRows.removeChild(obtenerNodos(contenedorRows)[i]);
			}
		contadorRows = contenedorRows.children.length-1;
		c();
	}

	var agregarSelectHijos = function(predecesor,indiceActual){
		carga.style.display = "block";
		eliminarElementosDebajoDe(indiceActual,function(){
			enviarPost('procesos/obtenerCuentas.php',{'token':'$variablesModulo[token]','predecesor':predecesor},function(res){
				
				if(typeof(res) === "string"){
					res = JSON.parse(res);
				}

				if(res.length > 0){
					var cajaTotal = document.createElement('div');
					cajaTotal.className = "caja total";

					var cajaSelect = document.createElement('div');
					cajaSelect.className = "caja movil-7-8";

					var selectInput = document.createElement('select');
					selectInput.setAttribute('data-nivel',++contadorRows);
					selectInput.onchange = function(){
						codigoSeleccionado = this.value;
						agregarSelectHijos(this.value,this.getAttribute('data-nivel'));
					}
					var opt = document.createElement('option');
						opt.value='';
						opt.appendChild(document.createTextNode("- SELECCIONA "+res[0][2]+" -"));
						selectInput.appendChild(opt);

					for(x in res){
						opt = document.createElement('option');
						opt.value=res[x][0];
						opt.appendChild(document.createTextNode(res[x][0]+". "+res[x][1]));
						selectInput.appendChild(opt);
					}
				
					cajaSelect.appendChild(selectInput);
					cajaTotal.appendChild(cajaSelect);
					contenedorRows.appendChild(cajaTotal);
				}
				
			});
		  	//<div class="caja movil-1-8"><button class="elim"><i class="fa fa-times"></i></button></div>

		});

		carga.style.display = "none";
	}
	agregarSelectHijos('');

	var enviarDatos = function(){
		console.log(codigoSeleccionado);
		enviarPost('procesos/obtenerCuentas.php',{'token':'$variablesModulo[token]','predecesor':""+codigoSeleccionado+""},function(res){
			if(typeof(res) === "string"){
				res = JSON.parse(res);
			}
			if(res.length === 0){
				var codigo = ""+codigoSeleccionado+"1";
			}else{
				var r = res.pop();
				var codigo = siguienteIndice(r[0]);
			}
			
			
			console.log(codigoSeleccionado);
			console.log(codigo);
			console.log(document.getElementById('nombreNuevaCuenta').value);
			enviarPost('procesos/registrarCuenta.php',{'token':'$variablesModulo[token]','predecesor':codigoSeleccionado,'codigo':codigo,'nombre':document.getElementById('nombreNuevaCuenta').value},function(v){
				if(typeof(v) === "string"){
					v = JSON.parse(v);
				}
				swal({   title: "perfecto",   text: "Se ha registrado la nueva subcuenta",   type: "success",   showCancelButton: false,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Aceptar",   closeOnConfirm: false }, function(){ mostrarSeccion('agregarCuenta','$variablesModulo[token]'); });
			});
			
		});
		
	};
</script>
EOT;
?>