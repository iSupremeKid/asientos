/*var cuentasAsiento = $("#contenedorRowsCuentasAsiento");





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
	}
	var eliminarElementosDebajoDe = function(indice,c){
		
		indice = parseInt(indice);
			var longi = contenedorRows.children.length;
			for(var i = indice+1;(contenedorRows.children.length-1 > indice);i){
				
				contenedorRows.removeChild(contenedorRows.childNodes[i]);
			}
		
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
		
	};*/