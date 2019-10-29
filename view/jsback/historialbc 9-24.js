var arreglo=[];
var periodo1="";
var periodo2="";
var table2="";
table=(data)=>{
  //$('#body_table').html('')
      $('#aquivatabla').html('');
  var tabla1="";
   var mayor=0;
   if(data.periodomayor.length> data.periodomenor.length){
      mayor=data.periodomayor.length;
   }else{
       mayor=data.periodomenor.length;
   }
   console.log(data);
   for (var i = 0; i < mayor; i++) {
          if(data.periodomenor[i]==null){
                           tabla1+=`<tr>
                           <td class="th">${data.periodomayor[i].num_departamento}</td>
                           <td class="th">${data.periodomayor[i].nombre}</td>

                                 <td class="th"></td>
                                 <td class="th"></td>
                                 <td class="th"></td>
                                 <td class="th"></td>
                                 <td class="th"></td>
                                 <td style="background-color:#9AFEFD"></td>
                                `;  
      }else{
         let color1="";
         if(data.periodomenor[i].total_a_pagar!=' ' && data.periodomenor[i].total_a_pagar!=null && data.periodomenor[i].pagado==0 || data.periodomenor[i].pagado==null ){
            color1=' <i class="fa fa-circle" style="font-size:20px;color:#FE2A2A"></i>';//todos los datos pero nada de pago
       x  }
         else if(parseFloat(data.periodomenor[i].total_a_pagar) > parseFloat(data.periodomenor[i].pagado) ){
            color1=' <i class="fa fa-circle" style="font-size:20px;color:#E8F633"></i>';//tiene adeudo amarillo
         }
        else if(parseFloat(data.periodomenor[i].pagado)== parseFloat(data.periodomenor[i].total_a_pagar)){
            color1=' <i class="fa fa-circle" style="font-size:20px;color:#A3F871"></i>';//esta pagado
         }
         else if(parseFloat(data.periodomenor[i].pagado)> parseFloat(data.periodomenor[i].total_a_pagar)){
            color1='<i class="fa fa-circle" style="font-size:20px;color:#0693E3"></i>';//tiene a favor
         }

                              tabla1+=`
                              <tr>
                                 <td class="th">${data.periodomenor[i].num_departamento}</td>
                                 <td class="th">${data.periodomenor[i].nombre}</td>

                                 <td class="th">${data.periodomenor[i].lectura_ini}</td>
                                 <td class="th">${data.periodomenor[i].lectura_fin}</td>
                                 <td class="th">${data.periodomenor[i].consumos_mes} </td>
                                 <td class="th">${data.periodomenor[i].consumos_litros}</td>
                                 <td class="th">${data.periodomenor[i].total_a_pagar} ${color1}</td>
                                 <td style="background-color:#9AFEFD"></td>   
                                `;  
      }  

      if(data.periodomayor[i]!=null){
       //  console.log(data.periodomayor[i]);
         let array_consumo=data.periodomayor[i].foto.split('/');
         let index_upload=array_consumo.indexOf('upload');
         let ticket="";
         let color="";
            if(data.periodomayor[i].ticket_pago!='null' && data.periodomayor[i].ticket_pago!=null && data.periodomayor[i].ticket_pago!=''){
               ticket=`<a href="../${url_ticket}${data.periodomayor[i].ticket_pago}" target="_blank">Ver ticket</a>`;
            }
            if(data.periodomayor[i].total_a_pagar!=' ' && data.periodomayor[i].total_a_pagar!=null && data.periodomayor[i].pagado==0 || data.periodomayor[i].pagado==null ){
               color=' <i class="fa fa-circle" style="font-size:20px;color:#FE2A2A"></i>';//todos los datos pero nada de pago
            }
            else if(parseFloat(data.periodomayor[i].total_a_pagar) > parseFloat(data.periodomayor[i].pagado) ){
               color=' <i class="fa fa-circle" style="font-size:20px;color:#E8F633"></i>';//tiene adeudo
              // console.log("entra2");
            }
           else if(parseFloat(data.periodomayor[i].pagado)== parseFloat(data.periodomayor[i].total_a_pagar)){
               color=' <i class="fa fa-circle" style="font-size:20px;color:#A3F871"></i>';//esta pagado
               //console.log("entra PAGADO"+ data.periodomayor[i].pagado +" totalapagar:"+ data.periodomayor[i].total_a_pagar);
            }
            else if(parseFloat(data.periodomayor[i].pagado)> parseFloat(data.periodomayor[i].total_a_pagar)){
               color='<i class="fa fa-circle" style="font-size:20px;color:#0693E3"></i>';//tiene a favor
            }
               //id_lectura, foto, periodo, id_departamento, fecha_register, lectura, 
               //litros, consumo m3, fecha_limite, recargo, ticket_pago
                tabla1+=`
                                 <td class="th">
                                 <a href="#"   onclick="btn_delete(${data.periodomayor[i].id_lectura})"         class="ml-2" style="color: red"   ><i class="nc-icon nc-simple-remove"></i></a>
                                 <a href="#"   onclick="btn_pdf(${data.periodomayor[i].id_lectura})"           class="ml-2" style="color: blue"><i class="fa fa-file-pdf-o"></i></a>
                                <a href="#"   onclick="traer_historial_id(${data.periodomayor[i].id_lectura})"           class="ml-2" style="color: blue"><i class="fa fa-edit"></i></a>
                                 </td>
                                 <td class="th">
                                    <a href="../${url_request+array_consumo[index_upload+1]}" target="_blank">Ver consumo</a>  
                                 </td>
                                 <td class="th">${data.periodomayor[i].total_a_pagar} ${color}</td>
                                 <td class="th">${data.periodomayor[i].consumos_mes}</td>
                                 <td class="th">${data.periodomayor[i].lectura_ini}</td>
                                 <td class="th">${data.periodomayor[i].lectura_fin}</td>
                                 <td class="th">${data.periodomayor[i].consumos_litros}</td>
                                 <td class="th">${data.periodomayor[i].adeudos}</td>
                                 <td class="th">${data.periodomayor[i].saldo_favor}</td>
                                 <td class="th">
                                    ${ticket}
                                 </td>
                                 </tr>
                                 `; 
                       
      }else{
         tabla1+=`
                                 <td class="th"></td>
                                 <td class="th"></td>
                                 <td class="th"></td>
                                 <td class="th">  
                                 </td>
                                 <td class="th"></td>
                                 <td class="th"></td>
                                 <td class="th"></td>
                                 <td class="th"></td>
                                 <td class="th"></td>
                                 <td class="th"></td>
                                 <td class="th"></td>
                                 </tr>
          `;
      }
   }            	
      var toda_tabla=` <table id="table_id" class="display" >
                           <thead>
                              <tr>
                              <th>Depto</th>
                              <th>Nombre</th>

                              <th class="th">Lec. anterior</th>
                                 <th class="th">Lec. act</th>
                                 <th class="th">Consumo</th>
                                 <th class="th">Litros</th>
                                 <th class="th">Pago</th>
                                 <th class="th">|</th>



                                 <th class="th">+</th>
                                 <th class="th">Foto</th>
                                 <th class="th">Pago</th>
                                 <th class="th">consumo</th>
                                 <th class="th">lect ant</th>
                                 <th class="th">lect act</th>
                                 <th class="th"> Litros</th>
                                 <th class="th">adeudos</th>
                                 <th class="th"> a favor</th>
                                 <th class="th">Compr de Pago</th>
                                 

                                 




                              </tr>
                        </thead>
                        <tbody id="body_table">
                        ${tabla1}

                        </tbody>
                        <tfoot>
                              <tr>
                              <th class="th">Depto</th>
                              <th class="th">Nombre</th>
                              <th class="th">Lec. anterior</th>
                                 <th class="th">Lec. act</th>
                                 <th class="th">Consumo</th>
                                 <th class="th">Litros</th>
                                 <th class="th">Pago</th>
                                 <th class="th">|</th>
                                 <th class="th">+</th>
                                 <th class="th">Foto</th>
                                 <th class="th">Pago</th>
                                 <th class="th">consumo</th>
                                 <th class="th">lect ant</th>
                                 <th class="th">lect act</th>
                                 <th class="th"> Litros</th>
                                 <th class="th">adeudos</th>
                                 <th class="th"> a favor</th>
                                 <th class="th">Compr de Pago</th>
                                 

                                 
                        </table> `;

  
     // $('#body_table').html('')
      setTimeout(function(){
        $('#aquivatabla').html(toda_tabla);
         $('#table_id').DataTable({
          "bDestroy": true
    }); 

            //    $('#body_table').html(tabla1)
      }, 1500)
      /*$('#table_id').DataTable({
           // responsive: true,
            "bDestroy": true
      });*/
 /*  setTimeout(()=>{
      $('#table_id').DataTable({
        // responsive: true,
         "bDestroy": true
      });
   },300)*/

   
}
modal2=(data)=>{
   /*id_lectura, foto, periodo, id_departamento, fecha_register, 
   lectura_ini, consumos_litros, consumo_m3, fecha_limite, adeudos, ticket_pago, monto, 
   consumos_mes, saldo_favor, cuota_admin, cargos_add, lectura_fin*/
   let datos=data[0].data[0];
   $('#id_historial').val(datos.id_lectura);
   $('#lectura_ini').val(datos.lectura_ini);
   $('#lectura_fin').val(datos.lectura_fin);
   $('#m3').val(datos.consumo_m3);

   $('#lt').val(datos.consumos_litros);
   $('#mes').val(datos.consumos_mes);
   $('#adeudo_total').val(datos.total_a_pagar);
       $('#mes').val(datos.consumo_m3);


   //$('#afavor').val(datos.saldo_favor);
   //$('#adeudos').val(datos.adeudos);
   if(datos.cargos_add !='' && datos.cargos_add !=null ){
      $('#cargos_add').val(datos.cargos_add);
   }else{
      $('#cargos_add').val('0'); 
   }
   if(datos.cuota_admin!=''){
      $('#admon').val(datos.cuota_admin);
   }else{
      get_cuota_costo();
   }
   $('#fecha_limit').val(datos.fecha_limite);
   $('#monto').val(datos.monto);
   $('#pagado').val(datos.pagado);
   get_precio_gas(datos.id_departamento);
   get_adeudo(datos.id_departamento);

   $('#modalhis').modal('show');
   //

   if(datos.ruta_pdf!=''){
      $('#h3').show();
      $('#pdf_recibo').attr('href', '../request/PDF/'+datos.ruta_pdf);
   }else{
      $('#h3').hide();
   }
   setTimeout(function(){
      calculo();
   },800)
}
$(document).ready(()=>{
   get_periodos();
   $('.mes').append(mes_nombre(mes_actual));

   var precio_gas='';
   //get_precio_gas();
   get_factor_costo();
   get_cuota_costo();
   var factor="";
   var cuota_admin="";
   $("#table_id").css("background-color");
});
$('#lectura_fin').focusout(()=>{
      if($('#lectura_ini').val()!='' && $('#lectura_fin').val()){
         $('#mes').val(($('#lectura_fin').val() - $('#lectura_ini').val()).toFixed(2) );
         $('#lt').val(($('#mes').val() * factor).toFixed(2) );
         $('#monto').val(($('#lt').val() * $('#litro_price').val()).toFixed(2));
         //console.log(parseFloat($('#monto').val()) +' ->'+ parseFloat($('#afavor').val())   +' ->'+parseFloat ($('#adeudos').val())   +' ->'+ parseFloat ($('#admon').val()) +' ->'+    parseFloat ($('#cargos_add').val()) )        
         $('#adeudo_total').val( parseFloat($('#monto').val()) -  parseFloat($('#afavor').val()) + parseFloat ($('#adeudos').val()) + parseFloat ($('#admon').val()) + parseFloat ($('#cargos_add').val()) );
      }
});
/*$('#pagado').keyup(()=>{
    if($('#adeudo_total').val()!=''){
       if($('#pagado').val() > $('#adeudo_total').val()){
           $('#afavor').val( $('#pagado').val() - $('#adeudo_total').val());
       }
    }else{
      $('#pagado').val('');
      error_swal('Operacion Incorrecta', 'El hacer esta operacion puede causar inconsitencia en los datos, por lo que se ha denegado la operacion  Intente primero calcular el Adeudo')
    }
});*/
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

$('#select_periodo').change(function(){
  //tabla1="";
  var x="";
      //$('#body_table').html('');
     setTimeout(()=>{
        if(arreglo[$('#select_periodo').val()-1]==undefined){

           get_historial( arreglo[$('#select_periodo').val()].periodo, '%');
        }else{   
         get_historial(  arreglo[$('#select_periodo').val()-1].periodo, arreglo[$('#select_periodo').val()].periodo);
        }
     }, 3500)
  // alert("enmedio");
   /*setTimeout(()=>{
       $('#table_id').DataTable({
          "bDestroy": true
        }); 
       alert("final");
   },5500)*/


   
});

$('#cargos_add').focusout(()=>{
  calculo();
});

calculo=()=>{
   if($('#cargos_add').val()==""  || $('#cargos_add').val()==" " ){
      $('#cargos_add').val(0);
   }
  // $('#adeudo_total').val(parseFloat($('#adeudo_total').val()) + parseFloat($('#cargos_add').val()) );
   $('#mes').val(($('#lectura_fin').val() - $('#lectura_ini').val()).toFixed(2) );
   console.log($('#mes').val());
   $('#lt').val(($('#mes').val() * factor).toFixed(2) );
   console.log($('#lt').val());

   $('#monto').val(($('#lt').val() * $('#litro_price').val()).toFixed(2));
   console.log($('#litro_price').val());

   $('#adeudo_total').val( parseFloat($('#monto').val()) -  parseFloat($('#afavor').val()) + parseFloat ($('#adeudos').val()) + parseFloat ($('#admon').val()) + parseFloat ($('#cargos_add').val()) );

}

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
calcula_total_pagar=()=>{
}
selec_periodos=(data)=>{
   let lengt=data[0].data.length;
   arreglo=data[0].data;
   $('#select_periodo').append('<option>Eliga un periodo</option>');
   for (x=0;x<lengt;x++){
      $('#select_periodo').append(`<option value="${x}">  ${data[0].data[x].periodo} </option>`);
   }
   if(data[0].data[lengt-2] !=undefined){//si esta definido
      $('#mostrando').html('Mostrando el bimestre : '+ data[0].data[lengt-2].periodo +'-->'+ data[0].data[lengt-1].periodo )
         get_historial( data[0].data[lengt-2].periodo, data[0].data[lengt-1].periodo);
    }else{
         $('#mostrando').html('Mostrando el bimestre : '+ data[0].data[lengt-1].periodo  )
         get_historial( data[0].data[lengt-1].periodo, data[0].data[lengt-1].periodo);

    }
   /*$('#table_id').DataTable({
      responsive:true
   })*/
}
