console.log(localStorage.getItem('id_cliente'));
if(localStorage.getItem('id_cliente')==null){
   location.href="login.html"
}
table=(data)=>{
   $.each(data[0].data, function(i, item){
      let index_upload="";
      let array_consumo="";
      let hide="";
      if(item.foto==null || item.foto==''){
         hide="class='invisible'";
      }else{
         hide="class=''";
         array_consumo=data.periodomayor[i].foto.split('/');
         index_upload=array_consumo.indexOf('upload');
      }
   let ticket="";
      let color="";
         if(item.ticket_pago!='null' && item.ticket_pago!=null && item.ticket_pago!=''){
            ticket=`<a href="../${url_ticket}${item.ticket_pago}" target="_blank">Ver ticket</a>`;
            if(item.pagado>= item.monto){
               color='background-color: #A3F871 !important';
            }
            else if(item.pagado>0 ){
               color='background-color: #E8F633 !important';
            }
         }else{
            ticket= `<form enctype="multipart/form-data" action="../request/index.php" method="POST">
            <input name="uploadedfile" type="file" required />
            <input type="hidden" name="funcion" value="upload">
            <input type="hidden" name="id_lectura" value="${item.id_lectura}">
            <input type="hidden" name="periodo" value="${item.periodo}">

            <input type="submit" value="Subir archivo" />
            </form>`;
         }
      //id_lectura, foto, periodo, id_departamento, fecha_register, lectura, 
      //litros, consumo m3, fecha_limite, recargo, ticket_pago
      $('#body_table').append(`<tr>
                              <td>${item.periodo}</td>
                              <td>
                                 <a ${hide} href="../${url_request+array_consumo[index_upload+1]}" target="_blank">Ver consumo</a>  
                              </td>
                              <td>${item.total_a_pagar}</td>
                              <td style="${color}" >
                                 ${ticket}
                              </td>
                              <td>
                              <a href="#" onclick="traer_historial_id(${item.id_lectura})" class="ml-2" style="color: green" ><i class="fa fa-eye"></i></a>

                              </td>

                              </tr>`);		            	
   });
   setTimeout(()=>{
      $('#table_id').DataTable({
         responsive: true,
         "bDestroy": true
      });
   },300)
}
suber_ticket=(id)=>{
   $('#modalticket').show();

}
modal=(data)=>{
   /*id_lectura, foto, periodo, id_departamento, fecha_register, 
   lectura_ini, consumos_litros, consumo_m3, fecha_limite, adeudos, ticket_pago, monto, 
   consumos_mes, saldo_favor, cuota_admin, cargos_add, lectura_fin*/
   let datos=data[0].data[0];
   $('#modalhis').modal('show');
   if(datos.ruta_pdf!='' && datos.ruta_pdf!=null ){
   		console.log(datos.ruta_pdf);
      $('#h3').html('Estado de cuenta.');
      $('#pdf_recibo').show();
      $('#pdf_recibo').attr('src', '../request/PDF/'+datos.ruta_pdf);
   }else{
      $('#h3').html("<h3>Aun no esta listo su estado de cuenta, intentelo mas tarde</h3>");
      $('#pdf_recibo').hide();

   }
}
$(document).ready(()=>{
   $('.mes').append(mes_nombre(mes_actual));
   get_historial_cliente();
});
$('#lectura_fin').focusout(()=>{
      if($('#lectura_ini').val()!='' && $('#lectura_fin').val()){
         $('#mes').val($('#lectura_fin').val() - $('#lectura_ini').val() );
         $('#lt').val($('#mes').val() * 3.85 );
         $('#monto').val($('#lt').val() * precio_gas);
      }
});
$("#asterisco").hover(function(){
   $("#indicaciones").show();
   }, function(){
      $("#indicaciones").hide();
   });
$('#btn_update').click(()=>{
   //validaciones
   swal(  {title: '¿Estas seguro que deseas actulizar los datos?',
   text: "Una vez realizada esta operacion la base de datos sera actualizada con los nuevos valores",
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
      actualizar_historial();//consumo que enviaa la informacion del preregistro
      swal("Exito!", "Los datos se actualizaron correctamente", "success");
   break;
   default:
   swal("No se actualizo ningun dato");
   }
   });
   //envio de datos
});


btn_delete=(id)=>{
   //validaciones
   swal(  {title: '¿Estas seguro que deseas eliminar los datos?',
   text: "Una vez realizada esta operacion no se sera posible recuperar esta informacion",
   icon: 'warning',
   buttons: {
      cancel: "No",
      catch: {
      text: "Si eliminar",
      value: "catch",
      },
   },
   })
   .then((value) => {
   switch (value) {
   case "catch":
         delete_his(id);//consumo que enviaa la informacion del preregistro
      swal("Exito!", "Los datos se actualizaron correctamente", "success");
   break;
   default:
   swal("No se actualizo ningun dato");
   }
   });
   //envio de datos
}
btn_pdf=(id)=>{
   swal(  {title: '¿Quire continuar con la creacion de recibo?',
   text: "Verifique que todos los datos esten completo de lo contrario el formato se creara de manera incorrecta",
   icon: 'warning',
   buttons: {
      cancel: "No",
      catch: {
      text: "Si crear",
      value: "catch",
      },
   },
   })
   .then((value) => {
   switch (value) {
   case "catch":
         crear_recibo(id);//consumo que enviaa la informacion del preregistro
      swal("Exito!", "Los datos se actualizaron correctamente", "success");
   break;
   default:
   swal("No se actualizo ningun dato");
   }
   });
}