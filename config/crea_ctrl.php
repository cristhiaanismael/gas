<?php

function crea_ctrl($name){

//cargo el archivo 
$archivo = file_get_contents('readme_ctrl.txt'); 
// reemplazo: 
$archivo_nuevo = str_replace('{name}', $name, $archivo); 
// envío al navegador 
//echo $archivo_nuevo;  



  $nombre_archivo = "../controller/ctrl_".$name.".php"; 
 
    if(file_exists($nombre_archivo))
    {
        $mensaje = "El Archivo $nombre_archivo se ha modificado";
    }
 
    else
    {
        $mensaje = "El Archivo $nombre_archivo se ha creado";
    }
 
    if($archivo = fopen($nombre_archivo, "a"))
    {
        if(fwrite($archivo, $archivo_nuevo))
        {
            echo "Se ha ejecutado correctamente el controllador";
        }
        else
        {
            echo "Ha habido un problema al crear el archivo";
        }
 
        fclose($archivo);
    }
 
}


function crea_model($name){

//cargo el archivo 
$archivo = file_get_contents('reademe_model.txt'); 
// reemplazo: 
$archivo_nuevo = str_replace('{name}', $name, $archivo); 
// envío al navegador 
//echo $archivo_nuevo;  



  $nombre_archivo = "../models/".$name.".php"; 
 
    if(file_exists($nombre_archivo))
    {
        $mensaje = "El Archivo $nombre_archivo se ha modificado";
    }
 
    else
    {
        $mensaje = "El Archivo $nombre_archivo se ha creado";
    }
 
    if($archivo = fopen($nombre_archivo, "a"))
    {
        if(fwrite($archivo, $archivo_nuevo))
        {
            echo "Se ha ejecutado correctamente el model";
        }
        else
        {
            echo "Ha habido un problema al crear el archivo";
        }
 
        fclose($archivo);
    }
 
}

function crea_view_ctrl($name){

//cargo el archivo 
$archivo = file_get_contents('readme_view_controller.txt'); 
// reemplazo: 
$archivo_nuevo = str_replace('{name}', $name, $archivo); 
// envío al navegador 
//echo $archivo_nuevo;  



  $nombre_archivo = "../view_controllers/view_".$name.".php"; 
 
    if(file_exists($nombre_archivo))
    {
        $mensaje = "El Archivo $nombre_archivo se ha modificado";
    }
 
    else
    {
        $mensaje = "El Archivo $nombre_archivo se ha creado";
    }
 
    if($archivo = fopen($nombre_archivo, "a"))
    {
        if(fwrite($archivo, $archivo_nuevo))
        {
            echo "Se ha ejecutado correctamente el controllador";
        }
        else
        {
            echo "Ha habido un problema al crear el archivo";
        }
 
        fclose($archivo);
    }
 
}


if(isset($_REQUEST['c'])){
		crea_ctrl($_REQUEST['c']);
}
if(isset($_REQUEST['m'])){
		crea_model($_REQUEST['m']);	
}
if(isset($_REQUEST['v'])){
        crea_view_ctrl($_REQUEST['v']);


}
else if(isset($_REQUEST['instancia'])){
	crea_ctrl($_REQUEST['instancia']);
	crea_model($_REQUEST['instancia']);
    crea_view_ctrl($_REQUEST['instancia']);
}

echo "instancia=name <br> c=name_controler <br> m=name_model <br> v=name_view_c   "

?>