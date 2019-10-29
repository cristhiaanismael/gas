get_historial_cliente=()=>{
	console.log(localStorage.getItem('id_cliente'));
	let url_amrada=url+'historial_cliente';
	let parametros={
		"id_cliente": localStorage.getItem('id_cliente')
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
				table(JSON.parse(response));
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
				modal(JSON.parse(response));
			}
	 });
}


