create_qrs=(id_edificio)=>{
	let parametros={
		"id_edificio": id_edificio
	};
	let url_amrada=url+'crete_pdf_qr'
	$.ajax({
			url: url_amrada,
			type: "GET",
			data: parametros,
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
				window.open('../request/htmls/'+id_edificio+'.html', '_blank');
			}
	 });


}
consumo_qr=()=>{
    let url_amrada=url+'full_departamentos'
	$.ajax({
			url: url_amrada,
			type: "GET",
		   beforeSend: function () {
				$('#carga').html("<img width='10%' src='images/carga.gif'>");
			},
			success:  function (response) {
				if(testeo=='TRUE'){console.log(response)}
				table_qr(JSON.parse(response));
			}
	 });

}
consumo_createqr=(id)=>{
	let url_amrada=url+'create_qr';
	let parametros={
		"id_departamento": id
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
				setTimeout(()=>{
					$('#iframe').attr('src', '../'+url_temp+id+'.png');
				},500)

			}
	 });
}