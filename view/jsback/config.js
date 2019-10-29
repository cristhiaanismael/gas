insert_datos=()=>{
    let parametros={
        "calle"   :         $('#calle').val(),
        "colonia" :         $('#colonia').val(),
        "num_ext" :         $('#num_ext').val(),
        "num_int" :         $('#num_int').val(),
        "codigo_postal":    $('#codigo_postal').val(),
        "delegacion":       $('#delegacion').val(),
        "estado":           $('#estado').val(),
        "telefono":         $('#telefono').val(),
        "email":            $('#email').val(),
        "web":              $('#web').val(),
        "giro":             $('#giro').val()
    };
    consumo_datos_empresa(parametros);
}
imprime_data=(data)=>{
    let datos=data[0].data[0];
    $('#calle').val(datos.calle);
    $('#colonia').val(datos.colonia);
    $('#num_ext').val(datos.num_ext);
    $('#num_int').val(datos.num_int);
    $('#codigo_postal').val(datos.codigo_postal);
    $('#delegacion').val(datos.delegacion);
    $('#estado').val(datos.estado);
    $('#telefono').val(datos.telefono);
    $('#email').val(datos.email);
    $('#web').val(datos.web);
    $('#giro').val(datos.giro);
}
$('#save').click(()=>{
    swal(  {title: '¿Estos datos son correctos?',
            text: "Asegurate que los datos ingresados sean los correctos",
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
        insert_datos();//consumo que enviaa la informacion del preregistro
            swal("Exito!", "Sus datos se han actualizado ", "success");
        break;
        default:
        swal("No se ha actualizo ningun dato");
        }
        });
});
$('#save_litro').click(()=>{
    if($('#precio').val()!='' && $('#precio').val()!=' ' && $('#edificio5').val()!=' ' && $('#edificio5').val()!=null){
        swal(  {title: 'Este sera el precio del litro desde ahora?',
        text: "El precio del litro que coloque sera valido desde este momento",
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
        consumo_insert_litro();//consumo que enviaa la informacion del preregistro
            swal("Exito!", "Sus datos se han actualizado ", "success");
        break;
        default:
        swal("No se ha actualizo ningun dato");
        }
        });
    }else{
        $('#precio').focus();
    }
});

$('#save_periodo').click(()=>{
    if($('#periodo').val()!='' && $('#periodo').val()!=' '){
        swal(  {title: 'Este sera el corte de este mes?',
        text: "Este corte sera asignado desde este momento",
        icon: 'warning',
        buttons: {
            cancel: "No",
            catch: {
            text: "Si ",
            value: "catch",
            },
        },
        })
        .then((value) => {
        switch (value) {
        case "catch":
        consumo_insert_corte();//consumo que enviaa la informacion del preregistro
            swal("Exito!", "Sus datos se han actualizado ", "success");
        break;
        default:
        swal("No se ha actualizo ningun dato");
        }
        });
    }else{
        $('#periodo').focus();
    }
})
$('#save_cuota').click(()=>{
    if($('#cuota').val()!='' && $('#cuota').val()!=' '){
        swal(  {title: 'Este sera el la cuota de aministración?',
        text: "Esta cuota de administración sera asignado desde este momento",
        icon: 'warning',
        buttons: {
            cancel: "No",
            catch: {
            text: "Si ",
            value: "catch",
            },
        },
        })
        .then((value) => {
        switch (value) {
        case "catch":
        consumo_insert_cuota();//consumo que enviaa la informacion del preregistro
            swal("Exito!", "Sus datos se han actualizado ", "success");
        break;
        default:
        swal("No se ha actualizo ningun dato");
        }
        });
    }else{
        $('#cuota').focus();
    }
})
$('#valor_save').click(()=>{
    if($('#valor').val()!='' && $('#valor').val()!=' '){
        swal(  {title: 'Este sera el factor de gas ..?',
        text: "Este factor  sera asignado desde este momento",
        icon: 'warning',
        buttons: {
            cancel: "No",
            catch: {
            text: "Si ",
            value: "catch",
            },
        },
        })
        .then((value) => {
        switch (value) {
        case "catch":
        consumo_insert_factor();//consumo que enviaa la informacion del preregistro
            swal("Exito!", "Sus datos se han actualizado ", "success");
        break;
        default:
        swal("No se ha actualizo ningun dato");
        }
        });
    }else{
        $('#valor').focus();
    }
});
$('#edificio5').change(()=>{
    get_data_price();
    get_cuota();
    get_factor();


});
$('#periodo').keypress(()=>{
    $('#periodo').val($('#periodo').val().replace("/", "-"));
    $('#periodo').val($('#periodo').val().replace('\\', "-"));

});
$(document).ready(()=>{
    get_data_empresa();
    //get_data_price();
    get_corte();
});