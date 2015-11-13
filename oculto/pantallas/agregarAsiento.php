<?php
require_once(dirname(__FILE__)."/../librerias/funciones.php");
require_once(dirname(__FILE__)."/../librerias/cabeceraPrivados.php");
//require_once(dirname(__FILE__)."/../modelo/asiento.php");

//$plan = new Asiento();

$datosModulo['titulo'] = "Nuevo asiendo diario";
if(comprobarFechaEjercicio()){
$datosModulo['contenido'] = <<<EOT
	<div class="bloqueCentrado" id="formularioLlenado">
		<div id="cargando"></div>
		<div class="grupo" id="rutaNuevaCuenta">
			<fieldset class="caja total" style="border: 1px #000 solid;padding-bottom:10px;">
				<legend>Define la ruta</legend>
				<div id="contenedorRowsCuentasAsiento"></div>
				<div class="caja total">
					<div class="caja total">
						<input disabled id="inputValorCuenta" type="text" placeholder="Valor:" style="width:100%; margin-top: 15px;">
						<button disabled id="btnRegistrarCuenta" onclick="registrarCuenta()" style="width:100%; margin-top: 15px;">Registrar cuenta en asiento</button>
					</div>
				</div>
			</fieldset>
		</div>


		<hr>
		<div class="grupo">
			<fieldset class="caja total" style="border: 1px #000 solid;padding-bottom:10px;">
				<legend>Asiento #$_SESSION[actualAsiento]&nbsp;<small><small>(Previsualización)</small></small></legend>
				<div class="caja total">
					<div class="caja total">
						<table style="width: 100%;" border="1">
							<thead>
								<tr>
									<th>#</th>
									<th>Asiento</th>
									<th style="width: 16.67%;"></th>
									<th style="width: 16.67%;">Debe</th>
									<th style="width: 16.67%;">Haber</th>
								</tr>
							</thead>
							<tbody id="cuentas">
								<tr>
									<td colspan="5" style="background: #000; color: #fff; text-align: center;font-size:1rem;font-weight:bold;">$_SESSION[actualAsiento]</td>
								</tr>
							</tbody>
						</table><br>
						<button onclick="enviarAsiento()">REGISTRAR AL LIBRO DIARIO</button>
					</div>
				</div>
			</fieldset>
		</div>
	<script>
	var contenidoAsiento = [];
	var insertarArreglo = function(arr){
		console.log(arr);
					indice = 0;
					while(contenidoAsiento.length > 0 &&contenidoAsiento[x][0] <= arr[0]){
						if(contenidoAsiento[x][0] === arr[0] && arr[1] === "cuenta"){
							contenidoAsiento[x][3] += arr[3];
							break;
						}
						indice++;
					}
					if(!(contenidoAsiento.length > 0 &&contenidoAsiento[x][0] <= arr[0]))
						contenidoAsiento.splice(indice, 0, arr);
				}
	var carga = document.getElementById("cargando");
	var contenedorRows = document.getElementById("contenedorRowsCuentasAsiento"),
		contenedorCuentasAsiento = document.getElementById("cuentas"),
		inputValorCuenta = document.getElementById("inputValorCuenta"),
		btnRegistrarCuenta = document.getElementById("btnRegistrarCuenta");
	var contadorRows = -1;
	var codigoSeleccionado = '';
	var predecesorSeleccionado = '';
	var d = 0;
	var siguienteIndice = function(cod){
		cod = cod.split('');
		
		cod[cod.length-1]=(parseInt(cod[cod.length-1])+1)+"";
		
		return cod.join("");
	},
	enviarAsiento = function(){
		
	}
	obtenerNodos = function(domobj){
		var nodos = domobj.childNodes;
		var nodosf = [];
		for(i in nodos){
			if(nodos[i].nodeType === 1){
				nodosf.push(nodos[i]);
			}
		}
		return nodosf;
	},
	eliminarElementosDebajoDe = function(indice,c){
		indice = parseInt(indice);
			var longi = contenedorRows.children.length;
			for(var i = indice+1;(contenedorRows.children.length-1 > indice);i){
				if(contenedorRows.children.length === 1) break;
				contenedorRows.removeChild(obtenerNodos(contenedorRows)[i]);
			}
		contadorRows = contenedorRows.children.length-1;
		c();
	},
	agregarSelectHijos = function(predecesor,indiceActual){
		carga.style.display = "block";
		eliminarElementosDebajoDe(indiceActual,function(){
			enviarPost('procesos/obtenerCuentas.php',{'token':'$variablesModulo[token]','predecesor':predecesor},function(res){
				
				if(typeof(res) === "string"){
					res = JSON.parse(res);
				}

				if(res.length > 0){
					inputValorCuenta.disabled=true;
					btnRegistrarCuenta.disabled=true;
					var cajaTotal = document.createElement('div');
					cajaTotal.className = "caja total";

					var cajaSelect = document.createElement('div');
					cajaSelect.className = "caja total";

					var selectInput = document.createElement('select');
					selectInput.setAttribute('data-nivel',++contadorRows);
					selectInput.onchange = function(){
						codigoSeleccionado = this.value;
						agregarSelectHijos(this.value,this.getAttribute('data-nivel'));
					}
					var opt = document.createElement('option');
						opt.value='';
						opt.setAttribute("data-tipo",res[0][2].toLowerCase());
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
				}else{
					inputValorCuenta.disabled=false;
					inputValorCuenta.focus();
					btnRegistrarCuenta.disabled=false;
				}
				
			});

		});

		carga.style.display = "none";
	}
	agregarSelectHijos('');

	var registrarCuenta = function(){
		if(/^[0-9\.]+$/.test(inputValorCuenta.value)){
			if(confirm("SEGURIDAD\\nDeseas agregar la cuenta al asiento?\\n(Si te equivocas deberas reiniciar el registro)")){
				var nodos = obtenerNodos(contenedorRows);
				
				for(var i = 1; i < nodos.length; i++){
					var selActual = nodos[i].children[0].children[0],
						txtSelActual = selActual.options[selActual.selectedIndex].innerHTML.split(". ");
						txtSelActual.shift();
						txtSelActual = txtSelActual.join("");
					insertarArreglo([parseInt(selActual.value),selActual.options[selActual.selectedIndex].getAttribute('data-tipo'),txtSelActual,parseFloat(inputValorCuenta.value)])
				}
				console.log(contenidoAsiento);
			}
		}else{
			alert("El valor de la cuenta no es válido!");
		}
		/*console.log(codigoSeleccionado);
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
			
			enviarPost('procesos/registrarCuenta.php',{'token':'$variablesModulo[token]','predecesor':codigoSeleccionado,'codigo':codigo,'nombre':document.getElementById('nombreNuevaCuenta').value},function(v){
				if(typeof(v) === "string"){
					v = JSON.parse(v);
				}
				swal({   title: "perfecto",   text: "Se ha registrado la nueva subcuenta",   type: "success",   showCancelButton: false,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Aceptar",   closeOnConfirm: false }, function(){ mostrarSeccion('agregarCuenta','$variablesModulo[token]'); });
			});
			
		});*/
	};
</script>
	<center><!--img src="img/mockupRegistroAsientos.png" alt=""--></center>
EOT;
}else{
$datosModulo['contenido'] = <<<EOT
	<div class="mensaje error">
		<i class="fa fa-exclamation-triangle"></i>No puedes registrar mas asientos hasta que no cierres el ejercicio.
	</div>
EOT;
}


?>