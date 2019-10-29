select_edificios=(edificios)=>{
	$('.edificios').html('');
		$('.edificios').append(`<option disabled="" selected="selected" >Elige Edificio</option>`);		            	
		$.each(edificios[0].data, function(i, item){
			$('.edificios').append(`<option value="${item.id_edificio}">${item.num_edificio} </option>`);		            	
		});
		$('.edificios2').html('');
		$('.edificios2').append(`<option disabled="" selected="selected" >Elige Edificio</option>`);		            	
		$.each(edificios[0].data, function(i, item){
			$('.edificios2').append(`<option value="${item.id_edificio}">${item.num_edificio} </option>`);		            	
		});
		$('.edificios3').append(`<option disabled="" selected="selected" >Elige Edificio</option>`);		            	
		$.each(edificios[0].data, function(i, item){
			$('.edificios3').append(`<option value="${item.id_edificio}">${item.num_edificio} </option>`);		            	
		});
		$('.edificios4').append(`<option disabled="" selected="selected" >Elige Edificio</option>`);		            	
		$.each(edificios[0].data, function(i, item){
			$('.edificios4').append(`<option value="${item.id_edificio}">${item.num_edificio} </option>`);		            	
		});
		$('.edificios5').append(`<option disabled="" selected="selected" >Elige Edificio</option>`);		            	
		$.each(edificios[0].data, function(i, item){
			$('.edificios5').append(`<option value="${item.id_edificio}">${item.num_edificio} </option>`);		            	
		});

		$('.edificios6').append(`<option disabled="" selected="selected" value='0' >Elige Edificio</option>`);		            	
		$.each(edificios[0].data, function(i, item){
			$('.edificios6').append(`<option value="${item.id_edificio}">${item.num_edificio} </option>`);		            	
		});
		$('.edificios6').append(`<option value="todos">todos </option>`);		            	



}
llena_data_edifico=(data)=>{
	//id_edificio, num_edificio, calle, num_ext, municipio, colonia, codigo_p
	console.log(data[0].data[0].num_edificio);
	$('#num_Edi_edit').val(data[0].data[0].num_edificio);
	$('#calle_edit').val(data[0].data[0].calle);
	$('#num_ext_edit').val(data[0].data[0].num_ext);
	$('#num_depto_edit').val(data[0].data[0].municipio);
	$('#colonia_edit').val(data[0].data[0].colonia);
	$('#cp_edit').val(data[0].data[0].codigo_p);
	traer_departamentos();

}
select_departamentos=(departamentos)=>{
	$('.departamentos').html('');
	$('.departamentos').append(`<option disabled="" selected="selected" >Elige departamento</option>`);		            	
	$.each(departamentos[0].data, function(i, item){
		$('.departamentos').append(`<option value="${item.id_departamento}">${item.num_departamento}</option>`);		            	
	});

	
}
alta_customer=()=>{
	let parametros={
		'nombre': 	$('#nombre').val(),
		'paterno': 	$('#paterno').val(),
		'materno': 	$('#materno').val(),
		'telefono': $('#telefono').val(),
		'convenio': $('#convenio').val(),
		'referencia':$('#referencia').val(),
		'correo': 	$('#email').val(),
		'id_departamento': $('#departamento').val(),
		'telefono2': $('#telefono2').val(),
		'correo2': 	$('#email2').val(),
	};
	disabled_button('#btn_cliente', 'true');
	vaciar(['nombre', 'paterno', 'materno', 'telefono', 'convenio', 'referencia', 'email', 'telefono2', 'email2' ]);
	consumo_customers_register(parametros);
}
insertado=(response)=>{
	disabled_button('#btn_cliente', 'false');
	if(response[0]['status']=='1'){
		swal("Exito!", "El cliente ha sido guardado con exito", "success");

	}else{
		warning_swal("Error!", response[0]['descripcion'], "success");

	}
}
table_cientes=(response)=>{
	$('#tbody_clientes').html('');
	let content='';
	$.each(response[0].data, function(i, item){
		if(item.id_edificio==$('#edificios_clientes').val()){
		content+=`<tr>
										<td> ${item.nombre} ${item.ape_pat}  </td>
										<td>${item.telefono}</td>
										<td>${item.telefono_2}</td>

										<td>${item.convenio}</td>
										<td>${item.referencia}</td>
										<td>${item.correo}</td>
										<td>${item.correo_2}</td>

										<td>Edi: ${item.num_edificio}</td>
										<td>${item.num_departamento}</td>
										<td>
												<a href="#" style="color:green"><i class="nc-icon nc-refresh-69"  onclick="data_(${item.id_cliente})"></i></a>
												<a href="#" style="color:red"><i class="nc-icon nc-simple-remove" onclick="delete_cliente(${item.id_cliente})"></i></a>
										</td>
									</tr>
								 `;
		}						 
	});

	let tabla=`<table  class="table_clientes display " data-order='[[ 8, "asc" ]]' >
							<thead class="">
							<tr>
							<th>
								Nombre
							</th>
							<th>
								Telefono
							</th>
							<th>
								Telefono 2
								</th>

							<th>
								Convenio
							</th>
							<th class="">
								Referencia
							</th>
							<th>
								Correo
							</th>
							<th>
								Correo 2
								</th>

							<th>
								Edificio
							</th>
							<th>
								Departamento
							</th>
							<th>
								Opciones
								</th>
							</tr>
							</thead>
							<tbody id="tbody_clientes">
							${content}
							</tbody>
							<tfoot class="">
							<tr>
							<th>
								Nombre
							</th>
							<th>
								Telefono
							</th>
							<th>
								Telefono 2
								</th>

							<th>
								Convenio
							</th>
							<th class="">
								Referencia
							</th>
							<th>
								Correo
							</th>
							<th>
								Correo 2
								</th>

							<th>
								Edificio
							</th>
							<th>
								Departamento
							</th>
							<th>
								Opciones
								</th>
							</tr>
							</tfoot>
						</table>
								`;

	$('#aquitabla').html(tabla)

	$('.table_clientes').DataTable({
		"order": [[ 8, "asc" ]],
		"bDestroy": true

 	 }); 



}

table_departamentos_Edi=(response)=>{
	$('#body_table_deptos').html('');
	
	$('#body_table_deptos').html('<tr>sin data</tr>');
	$('#body_table_deptos').html('');

	$.each(response[0].data, function(i, item){
		$('#body_table_deptos').append(`<tr>
										<td>${item.num_departamento}</td>
										<td>
												<a href="#" style="color:red"><i class="nc-icon nc-simple-remove" onclick="delete_dep(${item.id_departamento})"></i></a>
										</td>
									</tr>
								 `);
	});
	setTimeout(()=>{

	/*	$('#table_deptos').DataTable({
		   responsive: true,
		   "bDestroy": true
		});*/
	 },300)

}

delete_cliente=(id)=>{
	swal(  {title: '¿Estas seguro que deseas borrar este dato?',
  		text: "Una vez borrando al cliente no habra forma de recuperarlo",
 		icon: 'warning',
		buttons: {
			cancel: "No",
			catch: {
			text: "Si correctos",
			value: "catch",
			},
  },
})
.then((value) => {
  switch (value) {
    case "catch":
		borra_cliente(id);//consumo que enviaa la informacion del preregistro
      	swal("Exito!", "El cliente ha sido eliminado por completo", "success");
    break;
    default:
      swal("No se ha borrado ningun dato");
  }
});
}
data_=(id)=>{
	get_cliente(id);
}
imprimir_modal=(data)=>{
	let informacion=data[0].data[0];
	//console.log(informacion.id_departamento);
	$('#oculto_dep').val(informacion.id_departamento);
	$('#myModal').modal('show');
	$('#nombre2').val(informacion.nombre)
	$('#paterno2').val(informacion.ape_pat)
	$('#materno2').val(informacion.ape_mat)
	$('#telefono21').val(informacion.telefono)
	$('#convenio2').val(informacion.convenio)
	$('#referencia2').val(informacion.referencia)
	$('#email21').val(informacion.correo);

	$('#correo22').val(informacion.correo_2)
	$('#telefono22').val(informacion.telefono_2)

	$('#oculto').val(informacion.id_cliente)
	//$("#provincia option[value="+ valor +"]").attr("selected",true);
	$("#edificio2 option[value="+ informacion.id_edificio +"]").attr("selected",true);
	get_departamentos(informacion.id_edificio);
	setTimeout(()=>	$("#departamento2 option[value="+ informacion.id_departamento +"]").attr("selected",true), 700);
}
update_data_cliente=()=>{
	let id_depa=0;
	if($('#departamento2').val()==null){
		id_depa=$('#oculto_dep').val();
	}else{
		id_depa=$('#departamento2').val();
	}
	//console.log(id_depa);
	let parametros={
		'id_cliente' 	 : 	$('#oculto').val(),
		'nombre'		 :	$('#nombre2').val(),
		'paterno'		 :	$('#paterno2').val(),
		'materno'		 :	$('#materno2').val(),
		'telefono'		 :	$('#telefono21').val(),
		'telefono2'		 :	$('#telefono22').val(),
		'convenio'		 :	$('#convenio2').val(),
		'referencia'	 :	$('#referencia2').val(),
		'correo'		 :	$('#email21').val(),
		'correo2'		 :	$('#correo22').val(),
		'id_departamento': id_depa,
	};
	acutualizar_cliente(parametros);
	$('#myModal').modal('hide');

	vaciar(['nombre2', 'paterno2', 'materno2', 'telefono2', 'convenio2', 'referencia2', 'email2']);
	$('#aquitabla').html('');
	consumo_data_clientes();

}
$(document).ready(function(){
	get_edificios();

	
});
$('.edificios').change(function(){
	get_departamentos($('#edificio').val());
})
$('.edificios2').change(function(){
	get_departamentos($('#edificio2').val());
})

$('.edificios6').change(function(){
	$('#table_clientes').html('');
	consumo_data_clientes();

})


$('#form_cliente').submit(function(event){
	event.preventDefault();
	alta_customer();
});
$('#clientes_edit').submit(function(event){
	event.preventDefault();
	update_data_cliente();
});
$('#alta_dep').click(function(){
	$('#div_depto').show();
	$('#div_edi').hide();
	$('#div_table').hide();

});
$('#alta_edi').click(function(){
	$('#div_edi').show();
	$('#div_depto').hide();
	$('#div_table').hide();


});
$('#form_edi').submit(function(event){
	event.preventDefault();
	alta_edificio();
});
$('#form_depto').submit(function(event){
	event.preventDefault();
	alta_depto();
});
$('#table_edificios').click(()=>{
	$('#div_table').show();
	$('#div_edi').hide();
	$('#div_depto').hide();

});
$('#form_update').submit((event)=>{
	event.preventDefault(),

	swal(  {title: '¿Estas seguro que deseas actualizar este dato?',
  		text: "Una vez actualizando el edificio ya no se podran revertir los cambios",
 		icon: 'warning',
		buttons: {
			cancel: "No",
			catch: {
			text: "Si actualizar",
			value: "catch",
			},
  },
})
.then((value) => {
  switch (value) {
    case "catch":
		update_edificio();//consumo que enviaa la informacion del preregistro
      	swal("Exito!", "El edificio ha sido Actualizado", "success");
    break;
    default:
      swal("No se ha actualizo ningun dato");
  }
});

});