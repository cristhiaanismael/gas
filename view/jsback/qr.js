table_qr=(data)=>{
    $.each(data[0].data, function(i, item){
        $('#body_qr').append(`<tr>
                                <td>
                                    <a href="#" onclick="create_qrs(${item.id_edificio})">${item.num_edificio}</a>
                                </td>
                                <td>${item.num_departamento}</td>
                                <td>
                                   <a href="#" id="href" onclick="modal(${item.id_departamento}, '${item.num_departamento}')">Ver qr</a>  
                                </td>
                                </td>
                                </tr>`);		            	
     });
     $('#table_qr').DataTable({
        responsive: true,
        "bDestroy": true
     });
     //                                   <a href="#" id="href" onclick="consumo_createqr(${item.id_departamento})">Ver qr</a>  
}

qrcreate=(id)=>{

}

function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}

modal=(id_departamento , num_departamento)=>{
    event.preventDefault();
    consumo_createqr(id_departamento)
    $('#qrmodal').modal('show');
    $('#dep').html('Depto: '+num_departamento)
}
$(document).ready(function(){
    consumo_qr();
});
