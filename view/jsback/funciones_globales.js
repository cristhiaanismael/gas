var url = "../request/index.php?funcion=";
var url_request = "request/upload/";
var url_ticket = "request/tickets/";

var url_temp = "request/temp/";

var testeo = 'TRUE'; //TRUE CON MAYUSCULA
var imageback = 'img/' + getcookie('imagen_back') + '.jpg';
function anio_actual() {
    var fecha = new Date();
    var ano = fecha.getFullYear();
    return ano;
}
function load_ajax(parametros, div, gif, service, testeo, funcion) {
    var url_amrada = url + '/' + service;
    $.ajax({
        url: url_amrada,
        type: "POST",
        /* or type:"GET" or type:"PUT" */
        //    dataType: "json",
        data: parametros,
        beforeSend: function() {
            //$('#carga').html("<img width='10%' src='images/carga.gif'>");
        },
        success: function(response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
            if(testeo.toUpperCase()=='TRUE'){
                console.log(response);
            }
        }
    });
}
function logOu() {
    localStorage.clear();
    sessionStorage.clear();
    location.href = 'index.html';
}
function oculta(elemento) {
    $(elemento).hide();
    setTimeout(function() {
        $(elemento).show();
    }, 1500);
}
function ocultar(elemento){
        $(elemento).hide();
}
function mostrar(elemento){
        $(elemento).show();
}
function muestra(elemento) {
    $(elemento).show();
    setTimeout(function() {
        $(elemento).hide();
    }, 3500);
}
function warning(mensaje) {
    var alerta = '<div style="width:40%;" align="center" class="right" id="aler"> <div class="alert alert-warning alert-dismissible fade show" role="alert">' +
        ' <strong>Atencion!</strong> ' + mensaje + '.' +
        ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '   <span aria-hidden="true">&times;</span>' +
        ' </button>' +
        '</div></div>';
    $('body').append(alerta);

    setTimeout(function() {
        $('#aler').fadeOut(4000);
    }, 2200);
}
function error(mensaje) {
    var alerta = '<div style="width:40%;" align="center" class="right" id="aler"> <div class="alert alert-warning alert-dismissible fade show" role="alert">' +
        ' <strong>Error!</strong> ' + mensaje + '.' +
        ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '   <span aria-hidden="true">&times;</span>' +
        ' </button>' +
        '</div></div>';
    $('body').append(alerta);

    setTimeout(function() {
        $('#aler').fadeOut(4000);
    }, 2200);
}
function error_swal(titulo, texto) {
    swal({
        icon: "error",
        title: titulo,
        text: texto,
    })
}
function warning_swal(titulo, texto) {
    swal({
        icon: "info",
        title: titulo,
        text: texto,
    })
}
function succes_swal(titulo, texto) {
    swal({
        icon: "success",
        title: titulo,
        text: texto,
    })
}
function error_plataforma(titulo, texto) {
    error_swal(titulo, texto);
    setTimeout(function() {
        //location.href='index.html';
    }, 3500)
}
function disabled_button(input, valor) {
    if(valor=='true' || valor=='TRUE'){
        $(input).attr("disabled", valor);
    }else{
        $(input).removeAttr("disabled");
    }
    /*
    */
}
function obtener_get(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (pair[0] == variable) {
            return pair[1];
        }
    }
    return false;
}
function mes_actual() {
    var fecha = new Date();
    var ano = fecha.getMonth();
    return ano;
}
function getcookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function create_cookie(name, valor) {
    var x = name + '=' + valor + '; expires=Thu, 31 Dec ' + parseInt(anio_actual + 5) + ' 12:00:00 UTC';
    document.cookie = x;
}
function create_cookietemp(name, valor) {
    var x = name + '=' + valor + ';';
    document.cookie = x;
}
function isEmail(email) {
    console.log(email);
    return /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(email);
}
function deletecookie(name) {
    document.cookie = name + '=; Max-Age=-99999999;';
    /*
    */
}
function getBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}
function delay(milisegundos) {
    for (i = 0; i <= milisegundos; i++) {
        console.log("entro");
        setTimeout('return 0', 1);
    }
}
function add_magic(div) {
    $(div).addClass('magictime puffIn');
    setTimeout(function() {
        $(div).removeClass('magictime puffIn');
    }, 800);
}
function llena_dias(select) {
    $(select).html('<option disabled="disabled" selected="selected" value="Día" >Día</option>');
    var dia = 1;
    for (i = 1; i < 32; i++) {
        dia = i;
        if (i < 10) {
            dia = '0' + i;
        }
        $(select).append('<option value="' + dia + '">' + dia + '</option>');
    }
}
function get_mes_letra(mes) {
    var mes_letra = '';
    switch (mes) {
        case 1:
            mes_letra = 'Ene';
            break;
        case 2:
            mes_letra = 'Feb';
            break;
        case 3:
            mes_letra = 'Mar';
            break;
        case 4:
            mes_letra = 'Abr';
            break;
        case 5:
            mes_letra = 'May';
            break;
        case 6:
            mes_letra = 'Jun';
            break;
        case 7:
            mes_letra = 'Jul';
            break;
        case 8:
            mes_letra = 'Ago';
            break;
        case 9:
            mes_letra = 'Sep';
            break;
        case 10:
            mes_letra = 'Oct';
            break;
        case 11:
            mes_letra = 'Nov';
            break;
        case 12:
            mes_letra = 'Dic';
            break;
        default:
            mes_letra = 'faill';
    }
    return mes_letra;
}

function mes_nombre(mes) {
    var mes_letra = '';
    switch (mes) {
        case 1:
            mes_letra = 'Enero';
            break;
        case 2:
            mes_letra = 'Febrero';
            break;
        case 3:
            mes_letra = 'Marzo';
            break;
        case 4:
            mes_letra = 'Abril';
            break;
        case 5:
            mes_letra = 'Mayo';
            break;
        case 6:
            mes_letra = 'Junio';
            break;
        case 7:
            mes_letra = 'Julio';
            break;
        case 8:
            mes_letra = 'Agosto';
            break;
        case 9:
            mes_letra = 'Septiembre';
            break;
        case 10:
            mes_letra = 'Octubre';
            break;
        case 11:
            mes_letra = 'Noviembre';
            break;
        case 12:
            mes_letra = 'Diciembre';
            break;
        default:
            mes_letra = 'faill';
    }
    return mes_letra;
}

function llena_meses(select) {
    var mes = 1;
    for (i = 1; i < 13; i++) {
        mes = i;
        if (i < 10) {
            mes = '0' + i;
        }
        $(select).append('<option value="' + mes + '">' + get_mes_letra(i) + '</option>');
    }
}
function llena_meses2(select) {
    var mes = 1;
    for (i = 1; i < 13; i++) {
        mes = i;
        if (i < 10) {
            mes = '0' + i;
        }
        $(select).append('<option value="' + i + '">' + get_mes_letra(i) + '</option>');
    }
}
function llena_anios(select) {
    $(select).html('<option disabled="disabled" selected="selected" value="Año">Año</option>');
    $(select).append('<option>' + anio_actual + '</option>');
}
function llena_minutos(select) {
    $(select).html('<option disabled="disabled" selected="selected" value="">Min</option>');
    for (var i = 0; i <= 60; i++) {
        $(select).append('<option value="' + i + '">' + i + '</option>');
    }
}
function convertDate(inputFormat) {
    function pad(s) { return (s < 10) ? '0' + s : s; }
    var d = new Date(inputFormat);
    var dia = d.getDate() + 1;
    if (dia > 31) {
        dia = '1';
    }
    var mes = d.getMonth() + 2;
    if (mes > 12) {
        mes = 1;
    }
    return [pad(dia), pad(mes), anio_actual].join('/');
}
function getCleanedString(cadena) {
    // Definimos los caracteres que queremos eliminar
    var specialChars = "!@#$^&%*()+=-[]\/{}|:<>?,.";

    // Los eliminamos todos
    for (var i = 0; i < specialChars.length; i++) {
        cadena = cadena.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
    }

    // Lo queremos devolver limpio en minusculas
    cadena = cadena.toLowerCase();

    // Quitamos espacios y los sustituimos por _ porque nos gusta mas asi
    // cadena = cadena.replace(/ /g,"");

    // Quitamos acentos y "ñ". Fijate en que va sin comillas el primer parametro
    cadena = cadena.replace(/á/gi, "a");
    cadena = cadena.replace(/é/gi, "e");
    cadena = cadena.replace(/í/gi, "i");
    cadena = cadena.replace(/ó/gi, "o");
    cadena = cadena.replace(/ú/gi, "u");
    cadena = cadena.replace(/ñ/gi, "n");
    // cadena = cadena.replace(' ',"");
    return cadena;
}
function limpiar(text) {
    var text = text.toLowerCase(); // a minusculas
    text = text.replace(/[áàäâå]/, 'a');
    text = text.replace(/[éèëê]/, 'e');
    text = text.replace(/[íìïî]/, 'i');
    text = text.replace(/[óòöô]/, 'o');
    text = text.replace(/[úùüû]/, 'u');
    text = text.replace(/[ýÿ]/, 'y');
    text = text.replace(/[ñ]/, 'n');
    text = text.replace(/[ç]/, 'c');
    text = text.replace(/['"]/, '');
    text = text.replace(/[^a-zA-Z0-9-]/, '');
    text = text.replace(/\s+/, '-');
    //text = text.replace(/''/, '-');
    text = text.replace(/(_)$/, '');
    text = text.replace(/^(_)/, '');
    return text;
}
function vaciar(array){
    console.log(array)
    for (x=0;x<array.length;x++){
        $('#'+array[x]).val('');
    }
}
/*variables que ocupen de una funcion*/
var mes_actual = mes_actual();
mes_actual = mes_actual + 1;
var anio_actual = anio_actual();

$(document).ready(function() {
     $('.salir').click(function() {
            deletecookie('id_cliente');
            deletecookie('id_cliente');
            deletecookie('id_cliente');
            deletecookie('id_cliente');
            deletecookie('id_cliente');
            setTimeout(function() {
                location.href = 'login.html';
            }, 1500);

    })
});
activ=(id)=>{
    $('.active').removeClass('active');
    console.log(id);
    $('#'+id).addClass('active');
}
/*error: function(xhr, ajaxOptions, thrownError) {
                add_coment_fav(ContentId, ContentType)
},*/
