(function (){
'use strict'


    var regalo = document.getElementById('regalo');


document.addEventListener('DOMContentLoaded', function(){ 
	//campos datos usuario
	var nombre = document.getElementById('nombre');
	var apellido = document.getElementById('apellido');
	var email = document.getElementById('email');

	// campos pases

	var pase_dia = document.getElementById('pase_dia');
	var pase_dosdias = document.getElementById('pase_dosdia');
	var pase_completo = document.getElementById('pase_completo');

	// botones

	var calcular = document.getElementById('calcular');
	var errorDiv = document.getElementById('error');
	var btnRegistro = document.getElementById('btnRegistro');
	var lista_productos = document.getElementById('lista-productos');
	var suma = document.getElementById('suma-total');

//extras

	var etiquetas = document.getElementById('etiquetas');
	var camisas = document.getElementById('camisa_evento');
	

	

	calcular.addEventListener('click', calcularMontos);
	pase_dia.addEventListener('blur',mostrarDias);
	pase_dosdias.addEventListener('blur',mostrarDias);
	pase_completo.addEventListener('blur',mostrarDias);


nombre.addEventListener('blur', validarCampos);
apellido.addEventListener('blur', validarCampos);
email.addEventListener('blur', validarCampos);

	function validarCampos(){
		if(this.value ==''){
			errorDiv.style.display = 'block';
			errorDiv.innerHTML ="este campo poner gooooo";
			this.style.border ='1px solid red';
			errorDiv.style.border = '1px solid red';
		} else {
			errorDiv.style.display ='none';
			this.style.border ='1px solid #cccccc';
		}
	}

		 



	function calcularMontos(event){
		event.preventDefault();
		if(regalo.value ===''){
			alert("debes elegir un regalo");
			regalo.focus();
		} else {
			


			var boletosDia = parseInt( pase_dia.value)|| 0,
				boletos2Dias = parseInt(pase_dosdias.value)|| 0,
				boletoCompleto = parseInt(pase_completo.value)|| 0,
				cantCamisas = parseInt(camisas.value)|| 0,
				cantEtiquetas = parseInt(etiquetas.value)|| 0;

			var totalPagar = (boletosDia*30) +(boletos2Dias*45)+(boletoCompleto*50)+ ((cantCamisas*10)*.93)	+(cantEtiquetas*2)
			console.log(totalPagar)
				

				//CREAR UNA RREGLO PARA EL RESUMEN
				var listadoProductos = [];
				if(boletosDia>=1){
					listadoProductos.push (boletosDia + 'pase por dia');
				}
				if(boletos2Dias>=1){
					listadoProductos.push (boletos2Dias + 'pases dos dias');
				}
				if(boletoCompleto>=1){
					listadoProductos.push (boletoCompleto + 'pases completos');
				}
				if(cantCamisas>=1){
					listadoProductos.push (cantCamisas + 'camisas');
				}
				if(cantEtiquetas>=1){
					listadoProductos.push (cantEtiquetas + 'etiquetas');
				}

				console.log(listadoProductos);


				lista_productos.innerHTML = '';
				for(var i = 0; i < listadoProductos.length; i++){
					lista_productos.innerHTML += listadoProductos[i] + '<br/>';
				}
				

				suma.innerHTML ="s/. paga joven" + totalPagar;
				


			
		}

	}




	function mostrarDias(){
		
		var boletosDia = parseInt( pase_dia.value)|| 0,
				boletos2Dias = parseInt(pase_dosdias.value)|| 0,
				boletoCompleto = parseInt(pase_completo.value)|| 0;



				var diasElegidos = [];
				if(boletosDia > 0){
					diasElegidos.push ('viernes');
					console.log(diasElegidos);
				}
				if(boletos2Dias > 0){
					diasElegidos.push ('viernes','sabado');
					console.log(diasElegidos);
				}
				if(boletoCompleto > 0){
					diasElegidos.push ('viernes','sabado','domingo');
					console.log(diasElegidos);
				}


				for (var i = 0; i <diasElegidos.length; i++){
					document.getElementById (diasElegidos[i]).style.display ='block';
				}

		}






}); //

})();