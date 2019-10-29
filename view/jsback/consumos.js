get_edificios=()=>{
		var url_amrada=url+'edificios';
		$.ajax({
	            url: url_amrada,
			    type: "GET",
	           beforeSend: function () {
	                $('#carga').html("<img width='10%' src='images/carga.gif'>");
	            },
	            success:  function (response) {
	            	if(testeo=='TRUE'){console.log(response)}
	            		select_edificios(JSON.parse(response));
	        	}
	     });
}
get_departamentos=(id_edificio)=>{
	console.log(id_edificio);
	var url_amrada=url+'departamentos';
	let parametros={
		'id_edificio':id_edificio
	}
	$.ajax({
			url: url_amrada,
			type: "GET",
			data: parametros,
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
					select_departamentos(JSON.parse(response));
			}


	 });
}
consumo_customers_register=(parametros)=>{
	let url_amrada=url+'customers_register';
	$.ajax({
			url: url_amrada,
			type: "POST",
			data: parametros,
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
				insertado(JSON.parse(response));
				consumo_data_clientes();

			}
	 });
}
consumo_data_clientes=()=>{
	let url_amrada=url+'data_clientes';
	let parametros={
		"id_edificio": $('#edificios_clientes').val()
	};
	$.ajax({
			url: url_amrada,
			type: "GET",
			data:parametros,
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
				table_cientes(JSON.parse(response));
			}
	 });
}
borra_cliente=(id)=>{
	let url_amrada=url+'delete_clientes';
	let parametros={
		"id_cliente": id
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
				consumo_data_clientes();
			}
	 });
}

get_cliente=(id)=>{
	let url_amrada=url+'cliente';
	let parametros={
		"id_cliente": id
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
				imprimir_modal(JSON.parse(response));
			}
	 });
}
acutualizar_cliente=(parametros)=>{
	let url_amrada=url+'customers_update';
		$.ajax({
			url: url_amrada,
			data: parametros,
			type: "POST",
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
			//	location.href='?usr';
				consumo_data_clientes();
					('EXITO','Se actualizaron correctamente los datos' );

				
			}
	 });
}

alta_edificio=()=>{
	let url_amrada=url+'alta_edificio';
	let parametros={
		 "num_edificio": $('#num_edi').val() , 
		 "calle": $('#calle').val()  , 
		 "num_ext": $('#exterior').val() , 
		 "municipio": $('#municipio').val() , 
		 "colonia": $('#colonia').val() , 
		 "codigo_p": $('#cp').val()
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
			succes_swal('EXITO','Se inserto el edificio correctamente' );
			vaciar(['num_edi', 'calle', 'exterior', 'municipio', 'colonia', 'cp']);
			get_edificios();
		}
 });
}
alta_depto=()=>{
	let url_amrada=url+'alta_depto';
	let parametros={
		 "num_depto": $('#num_depto').val() , 
		 "id_edificio": $('#edificio_dep').val()   
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
			succes_swal('EXITO','Se inserto el departamento correctamente' );
			vaciar(['num_depto']);
		}
 });
}
data_edificio=()=>{
	let url_amrada=url+'edificios_id';
	console.log($('#edificio_edit').val() );
	let parametros={
		 "id_edificio": $('#edificio_edit').val()   
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
			llena_data_edifico(JSON.parse(response));
		}
  });
}
traer_departamentos=()=>{
	let url_amrada=url+'todos_departamentos';
	let parametros={
		"id_edificio": $('#edificio_edit').val()   
	};
	console.log($('#edificio_edit').val() );
	$.ajax({
			url: url_amrada,
			type: "GET",
			data: parametros,
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
				table_departamentos_Edi(JSON.parse(response));
			}
	 });
}
update_edificio=()=>{
	let url_amrada=url+'update_edificio';
	let parametros={
		"id_edificio": $('#edificio_edit').val(),
		"num_edificio": $('#num_Edi_edit').val(), 
		"calle":$('#calle_edit').val(),
		"num_ext":$('#num_ext_edit').val(),
		"municipio":$('#num_depto_edit').val(),
		"colonia":$('#colonia_edit').val(),
		"codigo_p":  $('#cp_edit').val()
	};
	$.ajax({
			url: url_amrada,
			type: "POST",
			data: parametros,
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
			}
	 });
}
delete_dep=(id)=>{
	let url_amrada=url+'delete_departamento';
	let parametros={
		"id_departamento": id,
	};
	$.ajax({
			url: url_amrada,
			type: "POST",
			data: parametros,
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
				traer_departamentos();
			}
	 });
}