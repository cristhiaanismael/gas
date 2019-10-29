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
      if(data.periodomenor[i]==null  ){
         let dep= data.periodomayor[i].num_departamento;
         if($('#edis').val()=='todos'){
            dep= `${data.periodomayor[i].num_edificio} - ${data.periodomayor[i].num_departamento} `;
         }
                           tabla1+=`<tr>
                           <td class="th">Edi: ${dep}</td>
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
            color1=' <i class="fa fa-circle" style="font-size:20px;color:#FE2A2A"></i>';
            //todos los datos pero nada de pago
         }
         else if(parseFloat(data.periodomenor[i].total_a_pagar) > parseFloat(data.periodomenor[i].pagado) ){
            color1=' <i class="fa fa-circle" style="font-size:20px;color:#E8F633"></i>';//tiene adeudo amarillo
         }
        else if(parseFloat(data.periodomenor[i].pagado)== parseFloat(data.periodomenor[i].total_a_pagar)){
            color1=' <i class="fa fa-circle" style="font-size:20px;color:#A3F871"></i>';//esta pagado
         }
         else if(parseFloat(data.periodomenor[i].pagado)> parseFloat(data.periodomenor[i].total_a_pagar)){
            color1='<i class="fa fa-circle" style="font-size:20px;color:#0693E3"></i>';//tiene a favor
         }
         let dep= data.periodomenor[i].num_departamento;
         if($('#edis').val()=='todos'){
            dep= `${data.periodomenor[i].num_edificio} - ${data.periodomenor[i].num_departamento}`;
         }
                              tabla1+=`
                              <tr>
                                 <td class="th">Edi: ${data.periodomenor[i].num_edificio} - ${data.periodomenor[i].num_departamento} </td>
                                 <td class="th">${data.periodomenor[i].nombre} </td>
                                 <td class="th" >${data.periodomenor[i].lectura_ini} </td>
                                 <td class="th" id="lect_ant${data.periodomenor[i].id_departamento}">${data.periodomenor[i].lectura_fin}</td>
                                 <td class="th">${parseFloat( (data.periodomenor[i].consumos_mes) + 0).toFixed(2) }  </td>
                                 <td class="th">${parseFloat((data.periodomenor[i].consumos_litros)+ 0).toFixed(2)}</td>
                                 <td class="th">${parseFloat((data.periodomenor[i].total_a_pagar) + 0).toFixed(2)} ${color1}</td>
                                 <td style="background-color:#9AFEFD"></td>   
                                `;  
      }  
      if(data.periodomayor[i]!=null ){
            let index_upload="";
            let array_consumo="";
            let hide="";
            let hide2="";
            if(data.periodomayor[i].lectura_fin==null || data.periodomayor[i].lectura_fin=='' || data.periodomayor[i].lectura_fin==0 ){
               hide="class='invisible'";
            }else{
               hide="class=''";
            }
            if(data.periodomayor[i].foto!=null){
               array_consumo=data.periodomayor[i].foto.split('/');
               index_upload=array_consumo.indexOf('upload');
               hide2='';

            }else{
               hide2="class='invisible'";

            }
               let ticket="";
               let color="";
                  if(data.periodomayor[i].ticket_pago!='null' && data.periodomayor[i].ticket_pago!=null && data.periodomayor[i].ticket_pago!=''){
                     ticket=`<a href="../${url_ticket}${data.periodomayor[i].ticket_pago}" target="_blank">Ver ticket</a>`;
                  }
                  if(data.periodomayor[i].total_a_pagar!=' ' && data.periodomayor[i].total_a_pagar!=null && data.periodomayor[i].pagado==0 || data.periodomayor[i].pagado==null ){
                     if(data.periodomayor[i].saldo_favor>0 && data.periodomayor[i].saldo_favor > data.periodomayor[i].total_a_pagar){
                        color='<i class="fa fa-circle" style="font-size:20px;color:#0693E3"></i>';//tiene a favor
                     }else{
                        color=' <i class="fa fa-circle" style="font-size:20px;color:#FE2A2A"></i>';//todos los datos pero nada de pago
                     }
                  }
                  else if(parseFloat(data.periodomayor[i].total_a_pagar) > parseFloat(data.periodomayor[i].pagado) ){
                     color=' <i class="fa fa-circle" style="font-size:20px;color:#E8F633"></i>';//tiene adeudo
                  }
                  else if(parseFloat(data.periodomayor[i].pagado)== parseFloat(data.periodomayor[i].total_a_pagar)){
                     color=' <i class="fa fa-circle" style="font-size:20px;color:#A3F871"></i>';//esta pagado
                  }
                  else if(parseFloat(data.periodomayor[i].pagado)> parseFloat(data.periodomayor[i].total_a_pagar)){
                     color='<i class="fa fa-circle" style="font-size:20px;color:#0693E3"></i>';//tiene a favor
                  }
                     //id_lectura, foto, periodo, id_departamento, fecha_register, lectura, 
                     //litros, consumo m3, fecha_limite, recargo, ticket_pago
                     let ad=data.periodomayor[i].adeudos;
                     let pag=data.periodomayor[i].total_a_pagar;
                     let afav=data.periodomayor[i].saldo_favor;
                     if(data.periodomayor[i].adeudos!=''){
                        ad=parseFloat(data.periodomayor[i].adeudos).toFixed(2);
                     } 
                     if(data.periodomayor[i].total_a_pagar!=''){
                        pag=0;
                        if(data.periodomayor[i].total_a_pagar>0){
                            pag=parseFloat(data.periodomayor[i].total_a_pagar).toFixed(2);
                        }
                        
                     }
                     if(data.periodomayor[i].saldo_favor!=''){
                        afav=parseFloat(data.periodomayor[i].saldo_favor).toFixed(2);
                     }                  
                     tabla1+=`
                                       <td class="th">
                                       <a href="#" ${hide}  onclick="btn_delete(${data.periodomayor[i].id_lectura})"         class="ml-2" style="color: red"   ><i class="nc-icon nc-simple-remove"></i></a>
                                       <a href="#" ${hide}  onclick="btn_pdf(${data.periodomayor[i].id_lectura}, ${data.periodomayor[i].id_departamento})"           class="ml-2" style="color: blue"><i class="fa fa-file-pdf-o"></i></a>
                                       <a href="#" ${hide}   onclick="traer_historial_id(${data.periodomayor[i].id_lectura})"           class="ml-2" style="color: blue"><i class="fa fa-edit"></i></a>
                                       </td>
                                       <td class="th">
                                          <a ${hide2}  href="../${url_request+array_consumo[index_upload+1]}" target="_blank">Ver consumo</a>  
                                       </td>
                                       <td class="th">${pag} ${color} </td>
                                       <td class="th">${parseFloat( (data.periodomayor[i].consumos_mes) + 0).toFixed(2) }</td>
                                       <td class="th">${ data.periodomayor[i].lectura_ini}</td>
                                       <td class="th">${ data.periodomayor[i].lectura_fin}</td>
                                       <td class="th">${parseFloat( (data.periodomayor[i].consumos_litros) + 0).toFixed(2)}</td>
                                       <td class="th">${parseFloat( (ad) + 0).toFixed(2) }</td>
                                       <td class="th">${parseFloat( (afav) + 0).toFixed(2)}</td>
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
          "bDestroy": true,
          "pageLength": 25
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
   console.log(data);
   /*id_lectura, foto, periodo, id_departamento, fecha_register, 
   lectura_ini, consumos_litros, consumo_m3, fecha_limite, adeudos, ticket_pago, monto, 
   consumos_mes, saldo_favor, cuota_admin, cargos_add, lectura_fin*/
   let datos=data[0].data[0];
   $('#id_historial').val(datos.id_lectura);
   if(datos.lectura_ini=='' || datos.lectura_ini==null){
      $('#lectura_ini').val($('#lect_ant'+datos.id_departamento).html());
   }else{
      $('#lectura_ini').val(parseFloat(datos.lectura_ini));
   }
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
      get_cuota_costo(datos.id_edificio);
   }
   let fecha_limit=datos.fecha_limite;
   if(fecha_limit==''){
      fecha_limit='15-'+(mes_actual() +2)+'-'+anio_actual();
   }
   $('#fecha_limit').val(fecha_limit);


   $('#monto').val(datos.monto);
   $('#pagado').val(datos.pagado);
   get_precio_gas(datos.id_departamento);
   get_factor_costo(datos.id_edificio);

   get_adeudo(datos.id_departamento);
   $('#modalhis').modal('show');
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
   var factor="";
   var cuota_admin="";
   $("#table_id").css("background-color");

});
$('#edis').change(function(){
   if($('#select_periodo').val()!='x'){
         var x="";
         //$('#body_table').html('');
      setTimeout(()=>{
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
         }
      }, 1500);
   }else{
      $('#select_periodo').focus();
   }

});
$('#lectura_fin').focusout(()=>{
      if($('#lectura_ini').val()!='' && $('#lectura_fin').val()){
         let mesm3=parseFloat($('#lectura_fin').val()) - parseFloat($('#lectura_ini').val());
         $('#mes').val( mesm3 );
         let lt=parseFloat(mesm3 * factor);
         $('#lt').val(lt.toFixed(2) );
         let mnto=lt * parseFloat($('#litro_price').val());
         $('#monto').val(mnto.toFixed(2));
         //console.log(parseFloat($('#monto').val()) +' ->'+ parseFloat($('#afavor').val())   +' ->'+parseFloat ($('#adeudos').val())   +' ->'+ parseFloat ($('#admon').val()) +' ->'+    parseFloat ($('#cargos_add').val()) )        
         $('#adeudo_total').val( mnto -  parseFloat($('#afavor').val()) + parseFloat ($('#adeudos').val()) + parseFloat ($('#admon').val()) + parseFloat ($('#cargos_add').val()) );
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

$('#select_periodo').change(function(){
   $('#edis').val(0);
});

$('#cargos_add').blur(()=>{
  // alert($('#cargos_add').val());
  calculo();
});
$('#fac').blur(()=>{
   // alert($('#cargos_add').val());
   factor=$('#fac').val();
   calculo();
 });
 $('#admon').blur(()=>{
   // alert($('#cargos_add').val());
   calculo();
 });
 
calculo=()=>{
   if($('#cargos_add').val()==""  || $('#cargos_add').val()==" " ){
      $('#cargos_add').val(0);
   }
   //$('#adeudo_total').val(parseFloat($('#adeudo_total').val()) + parseFloat($('#cargos_add').val()) );
   let mesm3=parseFloat($('#lectura_fin').val()) - parseFloat($('#lectura_ini').val());
   $('#mes').val(mesm3.toFixed(2) );
   let ltmes=mesm3 * factor;
   $('#lt').val(ltmes.toFixed(2) );
   let monto="";
   setTimeout(()=>{
          monto=ltmes * $('#litro_price').val();
      $('#monto').val(monto.toFixed(2));
   },450);
   setTimeout(()=>{
      let x=parseFloat( $('#cargos_add').val()) + parseFloat(  monto) -  $('#afavor').val() + parseFloat($('#adeudos').val()) + parseFloat ($('#admon').val()) 
        $('#adeudo_total').val(parseFloat(x).toFixed(2)  );
   },850);
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
btn_pdf=(id, id_departamento)=>{
   datos_graficas(id, id_departamento);
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
      setTimeout(()=>{
         enviar_grafica(id );
         

      }, 1500)
      setTimeout(()=>{
        
         crear_recibo(id);//consumo que enviaa la informacion del preregistro

      }, 2500)
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
   $('#select_periodo').append('<option value="x">Eliga un periodo</option>');
   for (x=0;x<lengt;x++){
      $('#select_periodo').append(`<option value="${x}">  ${data[0].data[x].periodo} </option>`);
   }
   //if(data[0].data[lengt-2] !=undefined){//si esta definido
      /*$('#mostrando').html('Mostrando el bimestre : '+ data[0].data[lengt-2].periodo +'-->'+ data[0].data[lengt-1].periodo )
         get_historial( data[0].data[lengt-2].periodo, data[0].data[lengt-1].periodo);
    }else{
         $('#mostrando').html('Mostrando el bimestre : '+ data[0].data[lengt-1].periodo  )
         get_historial( data[0].data[lengt-1].periodo, data[0].data[lengt-1].periodo);

    }*/
   /*$('#table_id').DataTable({
      responsive:true
   })*/
   $('#select_periodo').focus();
  // $('#edis').focus();

}
function mes_actual() {
   var fecha = new Date();
   var ano = fecha.getMonth();
   return ano;
}
function anio_actual() {
   var fecha = new Date();
   var ano = fecha.getFullYear();
   return ano;
}
///grafica//////////////////
 // on the submit event, generate a image from the canvas and save the data in the textarea
creat_grafica=(id, periodos, consumos)=>{

   var ctx = document.getElementById("chart1");
   var data = {
           labels: periodos.split(','),
           datasets: [{
               label: 'Historial',
               data: consumos.split(','),
               backgroundColor: [
                   'rgba(255, 87, 51, 0.99)',
                   'rgba(93, 65, 189, 0.99)',
                   'rgba(189, 91, 65 , 0.99)',
                   'rgba(65, 189, 166 , 0.99)',

               ],
               borderColor: [
                   'rgba(200,200,200,1)',
                   'rgba(200,200,200,1)',
                   'rgba(200,200,200,1)',
                   'rgba(200,200,200,1)',

               ],
               borderWidth: 2
           }]
       };
   var options = {
           scales: {
               yAxes: [{
                   ticks: {
                       beginAtZero:true
                   }
               }]
           }
       };
   var chart1 = new Chart(ctx, {
       type: 'bar',
       data: data,
       options: options
   });
   
   var dataURL = ctx.toDataURL('image/png');
   setTimeout(()=>{
      var image = ctx.toDataURL(); // data:image/png....
      document.getElementById('base64').value = image;
   
   }, 1500);
}


   enviar_grafica=(id)=>{
    
      let url_amrada=url+'crea_img';
      let parametros={
         "base64": document.getElementById('base64').value ,
         "id":id
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