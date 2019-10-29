total_litros=(periodo, id_edificio, int)=>{
	let url_amrada=url+'total_lt';
	let parametros={
		"id_edificio": id_edificio,
		"periodo": periodo
		//"test":'1devciru'

	};
	$.ajax({
			url: url_amrada,
			type: "GET",
			data: parametros,
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
				let data=JSON.parse(response);
				$('#strongperiodo'+int).html(periodo)
				$('#bperiodo'+int).html(': '+ parseFloat(data[0].data[0].total).toFixed(2));
			}
	 });

}
get_historial_todos=(dato1, dato2, id_edificio)=>{
	if(dato2=='%'){
		$('#mostrando').html('Mostrando el bimestre : '+ dato1  )

	}else{
		$('#mostrando').html('Mostrando el bimestre : '+ dato1 +'-->'+ dato2 )
	}
	periodo1=dato1;
	periodo2=dato2;
	let url_amrada=url+'historial2_todos';
	let parametros={
		"periodo2" :dato1,
		"periodo1" :dato2,
		"id_edificio": 'todos',
		//"test":'1devciru'
	};
	console.log(dato1);
	$.ajax({
			url: url_amrada,
			type: "GET",
			data: parametros,
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
				table(JSON.parse(response));
				total_litros(periodo1, id_edificio, '1');
				total_litros(periodo2, id_edificio, '2');

			}
	 });

}

get_historial=( dato1, dato2, id_edificio)=>{
	if(dato2=='%'){
		$('#mostrando').html('Mostrando el bimestre : '+ dato1  )

	}else{
		$('#mostrando').html('Mostrando el bimestre : '+ dato1 +'-->'+ dato2 )
	}
	periodo1=dato1;
	periodo2=dato2;
	let url_amrada=url+'historial2';
	let parametros={
		"periodo2" :dato1,
		"periodo1" :dato2,
		"id_edificio": id_edificio
		//"test":'1devciru'

	};
	console.log(dato1);
	$.ajax({
			url: url_amrada,
			type: "GET",
			data: parametros,
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
				total_litros(periodo1, id_edificio, '1');
				total_litros(periodo2, id_edificio, '2');
				table(JSON.parse(response));
			}
	 });
}
get_precio_gas=(id_departamento)=>{
	let url_amrada=url+'price_gas_actual_dep';
	let parametros={
		'id_departamento': id_departamento,
	};
	$.ajax({
			url: url_amrada,
			type: "GET",
			data: parametros,
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
				let data=JSON.parse(response);
				if(data[0].status==0){
					$('#litro_price').val(0);
				}else{
					let precio_gas=data[0].data[0].costo;
					$('#litro_price').val(precio_gas);
				}
			}
	 });
}
traer_historial_id=(id)=>{
	let url_amrada=url+'historial_id'
	let parametros={
		"id": id
	};
	$.ajax({
			url: url_amrada,
			data: parametros,
			type: "GET",
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
				modal2(JSON.parse(response));
			}
	 });
}
actualizar_historial=()=>{
	let url_amrada=url+'update_historial';
	let afavor=0;
	let adeudo=0;
	if(parseFloat( $('#pagado').val()) > $('#adeudo_total').val()){
		 afavor = $('#pagado').val() -  $('#adeudo_total').val();
	}
	 if ( $('#adeudo_total').val() > parseFloat($('#pagado').val())) {
		 adeudo= $('#adeudo_total').val() - $('#pagado').val();

	} 
	let parametros={
		"id_lectura"   : $('#id_historial').val(),
		"lectura_ini"  : $('#lectura_ini').val(),
		"lectura_fin"  : $('#lectura_fin').val(),
		"m3"           : $('#mes').val(),
		"lt"           : $('#lt').val(),
		"mes"          : $('#mes').val(),
		"afavor"       : afavor,
		"adeudos"      : adeudo,
		"cargos_add"   : $('#cargos_add').val(),
		"admon"        : $('#admon').val(),
		"fecha_limit"  : $('#fecha_limit').val(),
		"monto"        : $('#monto').val(),
		"pagado"	   : $('#pagado').val(),
		"total_a_pagar": $('#adeudo_total').val()

	};
	$.ajax({
		url: url_amrada,
		data: parametros,
		type: "POST",
	   beforeSend: function () {
			$('#carga').html("<img width='10%' src='images/carga.gif'>");
		},
		success:  function (response) {
			if(testeo=='TRUE'){console.log(response)}
			$('#modalhis').modal('hide');
			if(arreglo[$('#select_periodo').val()-1]==undefined){
				if($('#edis').val()=='todos'){
	
				  // alert("entro")
				   get_historial_todos(  arreglo[$('#select_periodo').val()].periodo, arreglo[$('#select_periodo').val()].periodo, 'todos');
				}else{   
				   get_historial( arreglo[$('#select_periodo').val()].periodo, arreglo[$('#select_periodo').val()].periodo, $('#edis').val());
				}
			 }else{
				//alert($('#edis').val());
				if($('#edis').val()=='todos'){
				   get_historial_todos(  arreglo[$('#select_periodo').val()-1].periodo, arreglo[$('#select_periodo').val()].periodo, 'todos');
				}else{   
				   get_historial(  arreglo[$('#select_periodo').val()-1].periodo, arreglo[$('#select_periodo').val()].periodo, $('#edis').val());
				}   
			 }		}
 });
}
delete_his=(id)=>{
	let url_amrada=url+'delete_historial';
	 let parametros={
		 "id"   : id
	 };
	 $.ajax({
		 url: url_amrada,
		 data: parametros,
		 type: "POST",
		beforeSend: function () {
			 $('#carga').html("<img width='10%' src='images/carga.gif'>");
		 },
		 success:  function (response) {
			 if(testeo=='TRUE'){console.log(response)}
			get_historial();
		 }
  });
 }
 crear_recibo=(id)=>{
	let url_amrada=url+'recibo';
	let parametros={
		"id_lectura"   : id
	};
	$.ajax({
		url: url_amrada,
		data: parametros,
		type: "get",
	   beforeSend: function () {
			$('#carga').html("<img width='10%' src='images/carga.gif'>");
		},
		success:  function (response) {
			if(testeo=='TRUE'){console.log(response)}
		   
		}
 });
 }
 get_factor_costo=(id_edificio)=>{
	let url_amrada=url+'factor';
	let parametros={
		"id_edificio": id_edificio,
	};
	$.ajax({
			url: url_amrada,
			type: "GET",
			data: parametros,
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
				let data=JSON.parse(response);
				if(data[0].status==0){
					factor=0;
					$('#fac').val(factor);
				}else{
					factor=data[0].data[0].factor;
					$('#fac').val(factor);
				}

			}
	 });	




}
get_cuota_costo=(id_edificio)=>{
    let url_amrada=url+'cuota';
	let parametros={
		"id_edificio": id_edificio,
	};
	$.ajax({
			url: url_amrada,
			type: "GET",
			data: parametros,
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
				let data=JSON.parse(response);
				if(data[0].status==0){
					$('#admon').val('');
				}else{
				    $('#admon').val(data[0].data[0].cuota);
				}

			}
	 });




}
get_adeudo=(id_departamento)=>{
	let url_amrada=url+'adeudo'
	let parametros={
		"id_departamento": id_departamento
	};
	$.ajax({
			url: url_amrada,
			data: parametros,
			type: "GET",
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
				let data=JSON.parse(response);
				//alert(data[0].status);
				if(data[0].status==0 ){
					$('#adeudos').val(0);
					$('#afavor').val(0);
				}else{
				  let adeudos=data[0].data[0];
					if(adeudos.adeudos=='' || adeudos.adeudos==null){
						$('#adeudos').val(0);
					}else{
						$('#adeudos').val(parseFloat(adeudos.adeudos).toFixed(2));
					}
					if(adeudos.saldo_favor=='' || adeudos.saldo_favor==null){
						$('#afavor').val(0);
					}else{
						$('#afavor').val( parseFloat(adeudos.saldo_favor).toFixed(2) );
					}
				}
			}
	 });
}
get_periodos=()=>{
	let url_amrada=url+'periodos'
	$.ajax({
			url: url_amrada,
			type: "GET",
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
				let data=JSON.parse(response);
				selec_periodos(data)
			}
	 });
}

datos_graficas=(id, id_departamento)=>{
	let url_amrada=url+'data_grafica';
	let parametros={
		"id_lectura": id,
		"id_departamento": id_departamento
	};
	$.ajax({
			url: url_amrada,
			type: "GET",
			data: parametros,
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
				let data=JSON.parse(response);
				var cadena=data.split("|");
				console.log(cadena[0]+' -> '+ cadena[1] );
				creat_grafica(id, cadena[0], cadena[1]);
				//creat_grafica(id, periodos, consumos);

			}
	 });
 }