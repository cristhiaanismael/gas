
<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('America/Mexico_City');
$_SESSION['fecha']=date("Y-m-d");
$_SESSION['year']=date("Y");
$_SESSION['hora_complete']=$_SESSION['fecha']."-".date("H-i-s");
//para saber si existe sesion
//error_reporting(0);
function url(){
	$ruta=dirname(dirname(__FILE__));//nombre del host url
	$ruta=str_replace("\\", "/", $ruta);
	return $ruta.'/config/rutas.php';
}
require_once(url());
include(ruta_config.'/error_display.php');

function ini_general($controller){
	if(!class_exists('padre')){
			include(ruta_controllers.'/ctrl_padre.php');
	}

	if(!class_exists($controller)){
		include(ruta_controllers.'/ctrl_'.$controller.'.php');
	}
	$clase='ctrl_'.$controller;
	return $controller=new $clase;
}

function error(){
	$response=array('status' =>  0,
					'descripcion'=>'No se estan recibiendo los parametros necesarios' 
						);
	return $response;
}

function index_get(){
	return error();
}


if(isset($_REQUEST['funcion'])){	
		$saltoLinea="\r\n";
		$host= $_SERVER["HTTP_HOST"];
		$url= $_SERVER["REQUEST_URI"];
		$data = file_get_contents('php://input');
		$data = json_decode( $data, true );
		$c=$data;
		$nombre_archivo = "logs.txt"; //variable con el nombre del archivo que vamos a crear
		$D=""; 
		error_reporting(0);
			while ($post = each($_POST)){
				if(!isset($_REQUEST['firma'])){
					$D.= $post[0] . " = " . $post[1];
				}
			}
		$nombre_archivo = "logs.txt"; 
			if($archivo = fopen($nombre_archivo, "a"))
				{
					fwrite($archivo, date("d m Y H:m:s"). " ". $host. $url. $D.$c.$saltoLinea. "\n");
					fclose($archivo);
				}

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$funcion=$_REQUEST['funcion'].'_post';
			echo json_encode( $funcion(), JSON_UNESCAPED_UNICODE);
		}else if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$funcion=$_REQUEST['funcion'].'_get';
			echo json_encode( $funcion(), JSON_UNESCAPED_UNICODE);
		}	
	    
	}else if(isset($_REQUEST['accion'])){
			$funcion=$_REQUEST['accion'];
			echo   ($funcion());
	}else{
		echo json_encode("No estas haciendo referencia a ningun metodo");
				//echo '<META HTTP-EQUIV="REFRESH" CONTENT="4;URL=../view">';

	}


?>