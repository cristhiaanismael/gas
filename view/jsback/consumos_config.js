consumo_datos_empresa=(parametros)=>{
    let url_amrada=url+'update_data_empresa';
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
get_data_empresa=()=>{
    let url_amrada=url+'data_empresa';
	$.ajax({
			url: url_amrada,
			type: "GET",
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
                if(testeo=='TRUE'){console.log(response)}
                imprime_data(JSON.parse(response));

			}
	 });
}
consumo_insert_litro=()=>{
    let url_amrada=url+'insert_precio_litro';
    let parametros={
		"precio": $('#precio').val(),
		'id_edificio': $('#edificio5').val()
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
consumo_insert_corte=()=>{
    let url_amrada=url+'insert_corte';
    let parametros={
        "periodo": $('#periodo').val()
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
get_data_price=()=>{
	let url_amrada=url+'price_gas_actual';
	let parametros={
		"id_edificio": $('#edificio5').val(),
	
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
					$('#precio').val('');
				}else{
					$('#precio').val(data[0].data[0].costo);
				}
			}
	 });


}
get_corte=()=>{
	let url_amrada=url+'corte';
	$.ajax({
			url: url_amrada,
			type: "GET",
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
                if(testeo=='TRUE'){console.log(response)}
				let data=JSON.parse(response);
				$('#periodo').val(data[0].data[0].periodo);


			}
	 });
}
consumo_insert_cuota=()=>{
	let url_amrada=url+'cuota';
	let parametros={
		'cuota': $('#cuota').val(),
		'id_edificio': $('#edificio5').val()
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
				get_cuota();
			}
	 });	
}
get_cuota=()=>{
	let url_amrada=url+'cuota';
	let parametros={
		"id_edificio": $('#edificio5').val(),
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
					$('#cuota').val('');
				}else{
				    $('#cuota').val(data[0].data[0].cuota);
				}

			}
	 });	
}
consumo_insert_factor=()=>{
	let url_amrada=url+'factor';
	let parametros={
		'factor': $('#valor').val(),
		"id_edificio": $('#edificio5').val(),

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
				get_factor();
			}
	 });	
}
get_factor=()=>{
	let url_amrada=url+'factor';
	let parametros={
		"id_edificio": $('#edificio5').val(),
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
					$('#valor').val('');
				}else{
				  $('#valor').val(data[0].data[0].factor);
				}

			}
	 });	
}
