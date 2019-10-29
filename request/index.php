<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('America/Mexico_City');
$_SESSION['fecha']=date("Y-m-d");
$_SESSION['year']=date("Y");
$_SESSION['hora_complete']=$_SESSION['fecha']." ".date("H:i:s");
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
function validate($array){
	foreach ($array  as $valor) {
			if(!isset($_REQUEST[$valor])){
				$error=error();
				echo  json_encode([$error], true);
				exit;
			}
			
	}
	
	return 0;
}
/**desde aqui */
function login_get(){
			$response= ini_general('usuarios')->autentifica($_REQUEST['usu'], $_REQUEST['psw']);
			$response=$response;
			return $response;
	
}
function autentifica_cliente_get(){
	$response= ini_general('usuarios')->autentifica_cliente($_REQUEST['edificio'], $_REQUEST['convenio']);
	$response=$response;
	return $response;

}

function edificios_get(){
	$response=ini_general('atajo')->select('edificios');
	return $response;
}
function departamentos_get(){
	if(isset($_REQUEST['id_edificio'])){
		$response=ini_general('departamentos')->get_data($_REQUEST['id_edificio']);
		return $response;
	}else{
		return error();
	}
}
function edificios_id_get(){
	if(isset($_REQUEST['id_edificio'])){
		$response=ini_general('atajo')->get_data('edificios', 'id_edificio', $_REQUEST['id_edificio']);
		return $response;
	}else{
		return error();
	}
}
 function historial_cliente_get(){
	 $response=ini_general('atajo')->get_data('departamentos', 'id_cliente',$_REQUEST['id_cliente']);
	 $id_departamento=$response[0]['data'][0]['id_departamento'];
	 return $response=ini_general('atajo')->get_data('lectura', 'id_departamento',$id_departamento);
 }
function update_edificio_post(){
	//id_edificio, num_edificio, calle, num_ext, municipio, colonia, codigo_p

	$response= ini_general('atajo')->update('num_edificio',   $_REQUEST['num_edificio'] ,  $_REQUEST['id_edificio'], 'edificios');
	$response= ini_general('atajo')->update('calle',  $_REQUEST['calle'] ,  $_REQUEST['id_edificio'], 'edificios');
	$response= ini_general('atajo')->update('num_ext',  $_REQUEST['num_ext'] ,  $_REQUEST['id_edificio'], 'edificios');
	$response= ini_general('atajo')->update('municipio', $_REQUEST['municipio'] ,  $_REQUEST['id_edificio'], 'edificios');
	$response= ini_general('atajo')->update('colonia', $_REQUEST['colonia'] ,  $_REQUEST['id_edificio'], 'edificios');
	return $response= ini_general('atajo')->update('codigo_p', $_REQUEST['codigo_p'] ,  $_REQUEST['id_edificio'], 'edificios');
}
function delete_departamento_post(){
	return $response= ini_general('atajo')->delete($_REQUEST['id_departamento'], 'departamentos');

}

function todos_departamentos_get(){
	$array_val =  array('id_edificio' );
	if(validate($array_val)==0){
		$response=ini_general('atajo')->get_data('departamentos', 'id_edificio', $_REQUEST['id_edificio']);
		return $response;
	}
}
function full_departamentos_get(){
		$response=ini_general('departamentos')->full_departamentos();
		return $response;
}
function departamentos_clientes_get(){
	if(isset($_REQUEST['id_cliente'])){
		$response=ini_general('atajo')->get_data('departamentos', 'id_cliente', $_REQUEST['id_cliente']);
		return $response;
	}else{
		return error();
	}
}
function clientes_get(){
		$response=ini_general('atajo')->select('clientes');
		return $response;
}
function clientes_id_get(){
	if(isset($_REQUEST['id_cliente'])){
		$response=ini_general('atajo')->get_data('clientes', 'id_cliente', $_REQUEST['id_cliente']);
		return $response;
	}else{
		return error();
	}
}
function customers_register_post(){
	//id_cliente, nombre, ape_pat, ape_mat, telefono, convenio, referencia
	$array_val =  array('nombre', 'paterno', 'materno',
					 	'telefono', 'convenio', 
					 	'referencia', 'correo' );
	if(validate($array_val)==0){
		$array =  array( $_REQUEST['nombre'] , $_REQUEST['paterno'], $_REQUEST['materno'],
						 $_REQUEST['telefono'],$_REQUEST['telefono2'],
						 $_REQUEST['convenio'], 
						 $_REQUEST['referencia'], $_REQUEST['correo'],
						 $_REQUEST['correo2'], $_SESSION['hora_complete'], 
						 );
		$comparar=array(
						'referencia' => $_REQUEST['referencia'] );
		$response=ini_general('atajo')->insert_unique('clientes', 
													  'nombre, 
													  ape_pat, 
													  ape_mat, 
													  telefono,  
													  telefono_2, 
													  convenio, 
													  referencia, 
													  correo,  
													  correo_2, 
													  fecha_register', 
													 $array,
														$comparar);
		if(isset($response[0]['id'])){
			$response= ini_general('atajo')->update('id_cliente',   $response[0]['id'] ,  $_REQUEST['id_departamento'], 'departamentos');
		}
		return $response;
	}
	
}
function customers_update_post(){
	$array_val =  array('nombre' , 'paterno', 'materno',
	'convenio', 
	'referencia', 'id_departamento', 'id_cliente' );
	if(validate($array_val)==0){
		//id_cliente, nombre, ape_pat, ape_mat, telefono, convenio, referencia, correo, fecha_register
		$response= ini_general('atajo')->update('nombre',   $_REQUEST['nombre'] ,  $_REQUEST['id_cliente'], 'clientes');
		$response= ini_general('atajo')->update('ape_pat',  $_REQUEST['paterno'] ,  $_REQUEST['id_cliente'], 'clientes');
		$response= ini_general('atajo')->update('ape_mat',  $_REQUEST['materno'] ,  $_REQUEST['id_cliente'], 'clientes');
		$response= ini_general('atajo')->update('telefono', $_REQUEST['telefono'] ,  $_REQUEST['id_cliente'], 'clientes');
		$response= ini_general('atajo')->update('convenio', $_REQUEST['convenio'] ,  $_REQUEST['id_cliente'], 'clientes');
		$response= ini_general('atajo')->update('referencia', $_REQUEST['referencia'] ,  $_REQUEST['id_cliente'], 'clientes');
		$response= ini_general('atajo')->update('correo', $_REQUEST['correo'] ,  $_REQUEST['id_cliente'], 'clientes');
		$response= ini_general('atajo')->update('correo_2', $_REQUEST['correo2'] ,  $_REQUEST['id_cliente'], 'clientes');
		$response= ini_general('atajo')->update('telefono_2', $_REQUEST['telefono2'] ,  $_REQUEST['id_cliente'], 'clientes');
		$response= ini_general('atajo')->update2('id_cliente', '',  $_REQUEST['id_cliente'], 'departamentos', 'id_cliente');
		$response= ini_general('atajo')->update('id_cliente', $_REQUEST['id_cliente'],  $_REQUEST['id_departamento'], 'departamentos');
	}
}
function upload_img_post(){
	$array_val =  array('foto' , 'id_departamento', 'periodo', 'lectura_actual' );
	if(validate($array_val)==0){
		$data=ini_general('atajo')->selec_query_order_limit('cortes');
		$datos=$data[0]['data'][0];
		$periodo=$datos['periodo'];
		 $response= ini_general('atajo')->upload_img($_REQUEST['foto'], "$_REQUEST[id_departamento]_$periodo", user_foto);
		 if($response['status']=='1'){
			 $values = array($response['ruta'].$response['name'],
								$periodo,
								$_REQUEST['id_departamento'],
								$_SESSION['hora_complete'],
								$_REQUEST['lectura_actual']);
            $conditions= array('campo1' => 'id_departamento' ,
						   'value1' => $_REQUEST['id_departamento'],
						   'campo2' => 'periodo' ,
						   'value2' => $periodo,
							 );
			
			$data_2=ini_general('atajo')->selec_query_And('lectura', $conditions );

			//
			if($data_2[0]['status']<1){
				$response=ini_general('atajo')->insert_define('lectura', 'foto, periodo, id_departamento, fecha_register, lectura_fin', $values);
				$id=$response['id'];
				//ir al controlador para hacer el calculo
				ini_general('historial')->calculo($id);
			}else{
				$datoss_2=$data_2[0]['data'][0];
				ini_general('atajo')->update2('lectura_fin', $_REQUEST['lectura_actual'] , $datoss_2['id_lectura'], 'lectura', 'id_lectura');
				ini_general('atajo')->update2('foto', $response['ruta'].$response['name'], $datoss_2['id_lectura'],  'lectura', 'id_lectura');
				$id=$datoss_2['id_lectura'];
				//ir al controlador para hacer el calculo
				ini_general('historial')->calculo($id);
				$response = array( 'status' =>  '1',
				'descripcion'=> 'insertado',
				'id'=>	$datoss_2['id_lectura']);
			}
			return $response;
			//si es necesario validar que no se duplique ay que cmabir por insert_unique
		 }
	}
}
function pr_get(){
	return ini_general('historial')->calculo(227);
}

function create_qr_get(){
	$array_val =  array('id_departamento');
	if(validate($array_val)==0){
		return $response= ini_general('qr')->obtener_data($_REQUEST['id_departamento']);
	}
}
function price_gas_get(){
	$response=ini_general('atajo')->select('precio_litros');
	return $response;
}
function price_gas_actual_get(){
	$query=" id_edificio=$_REQUEST[id_edificio] order by fecha_register desc limit 1";
	$response=ini_general('atajo')->selec_query('precio_litros', $query);
	return $response;
}
function price_gas_actual_dep_get(){
	$response=ini_general('precio')->price_desde_dep($_REQUEST['id_departamento']);
	return $response;
}
function corte_get(){
	$response=ini_general('atajo')->selec_query_order_limit('cortes');
	return $response;
}
function update_price_gas_post(){
	$array_val =  array('costo' );
	if(validate($array_val)==0){
		$response= ini_general('atajo')->update('costo',   $_REQUEST['costo'] ,  1, 'precio_litros');
	}
}
function data_clientes_get(){
	$response= ini_general('clientes')->traer_clientes();
	return $response;
}
function delete_clientes_post(){
	return $response= ini_general('atajo')->delete($_REQUEST['id_cliente'], 'clientes');
}
function historial2_get(){
	return $response=ini_general('historial')->select($_REQUEST['periodo1'], $_REQUEST['periodo2'], $_REQUEST['id_edificio']);

}
function historial2_todos_get(){
	return $response=ini_general('historial')->select_todos($_REQUEST['periodo1'], $_REQUEST['periodo2'], $_REQUEST['id_edificio']);

}

function historial_get(){
	return $response=ini_general('historial')->get_data();

}

function cliente_get(){
	$array_val =  array('id_cliente' );
	if(validate($array_val)==0){
		$response=ini_general('clientes')->cliente_id($_REQUEST['id_cliente']);
		return $response;
	}
}
function historial_id_get(){
	$array_val =  array('id');
	if(validate($array_val)==0){
		return $response=ini_general('historial')->get_historial_id($_REQUEST['id']);
	}
}
function update_historial_post(){
	$response= ini_general('atajo')->update('lectura_ini',    $_REQUEST['lectura_ini'] ,    $_REQUEST['id_lectura'], 'lectura');
	$response= ini_general('atajo')->update('lectura_fin',    $_REQUEST['lectura_fin'] ,    $_REQUEST['id_lectura'], 'lectura');
	$response= ini_general('atajo')->update('consumo_m3',     $_REQUEST['m3']    	   ,    $_REQUEST['id_lectura'], 'lectura');
	$response= ini_general('atajo')->update('consumos_litros',$_REQUEST['lt']   	   ,    $_REQUEST['id_lectura'], 'lectura');
	$response= ini_general('atajo')->update('consumos_mes',   $_REQUEST['mes']         ,    $_REQUEST['id_lectura'], 'lectura');
	$response= ini_general('atajo')->update('saldo_favor',    $_REQUEST['afavor']      ,    $_REQUEST['id_lectura'], 'lectura');
	$response= ini_general('atajo')->update('adeudos',        $_REQUEST['adeudos']     ,    $_REQUEST['id_lectura'], 'lectura');
	$response= ini_general('atajo')->update('cargos_add',     $_REQUEST['cargos_add']  ,    $_REQUEST['id_lectura'], 'lectura');
	$response= ini_general('atajo')->update('cuota_admin',    $_REQUEST['admon']       ,    $_REQUEST['id_lectura'], 'lectura');
	$response= ini_general('atajo')->update('fecha_limite',   $_REQUEST['fecha_limit'] ,    $_REQUEST['id_lectura'], 'lectura');
	$response= ini_general('atajo')->update('monto',          $_REQUEST['monto'] ,          $_REQUEST['id_lectura'], 'lectura');
	$response= ini_general('atajo')->update('pagado',         $_REQUEST['pagado'] ,         $_REQUEST['id_lectura'], 'lectura');
	$response= ini_general('atajo')->update('total_a_pagar',  $_REQUEST['total_a_pagar'] ,  $_REQUEST['id_lectura'], 'lectura');

}
function delete_historial_post(){
	$response= ini_general('atajo')->delete($_REQUEST['id'], 'lectura'); 
}

function recibo_get(){
	$response= ini_general('historial')->pdf($_REQUEST['id_lectura']); 
	return $response;
}
function alta_edificio_post(){
	$comparar=array('num_edificio'   => $_REQUEST['num_edificio'] );
	//id_edificio, num_edificio, calle, num_ext, municipio, colonia, codigo_p
	$array =  array( $_REQUEST['num_edificio'] , $_REQUEST['calle'], $_REQUEST['num_ext'],
	$_REQUEST['municipio'], $_REQUEST['colonia'], 
	$_REQUEST['codigo_p'] );
	$response=ini_general('atajo')->insert_unique('edificios', 
									'num_edificio, calle, num_ext, municipio, colonia, codigo_p', 
                                    $array,
									$comparar);
	return $response;
}
function alta_depto_post(){
	$comparar=array('num_departamento'   => $_REQUEST['num_depto'] );
	//id_edificio, num_edificio, calle, num_ext, municipio, colonia, codigo_p
	$array =  array( $_REQUEST['num_depto'] , $_REQUEST['id_edificio']);
	$response=ini_general('atajo')->insert_unique('departamentos', 
									'num_departamento, id_edificio', 
                                    $array,
									$comparar);
	return $response;
}
function update_data_empresa_post(){
	$response= ini_general('atajo')->update('calle',   $_REQUEST['calle'] ,  1, 'datos_empresa');
	$response= ini_general('atajo')->update('colonia',   $_REQUEST['colonia'] ,  1, 'datos_empresa');
	$response= ini_general('atajo')->update('num_ext',   $_REQUEST['num_ext'] ,  1, 'datos_empresa');
	$response= ini_general('atajo')->update('num_int',   $_REQUEST['num_int'] ,  1, 'datos_empresa');
	$response= ini_general('atajo')->update('codigo_postal',   $_REQUEST['codigo_postal'] ,  1, 'datos_empresa');
	$response= ini_general('atajo')->update('delegacion',   $_REQUEST['delegacion'] ,  1, 'datos_empresa');
	$response= ini_general('atajo')->update('estado',   $_REQUEST['estado'] ,  1, 'datos_empresa');
	$response= ini_general('atajo')->update('telefono',   $_REQUEST['telefono'] ,  1, 'datos_empresa');
	$response= ini_general('atajo')->update('email',   $_REQUEST['email'] ,  1, 'datos_empresa');
	$response= ini_general('atajo')->update('web',   $_REQUEST['web'] ,  1, 'datos_empresa');
	$response= ini_general('atajo')->update('giro',   $_REQUEST['giro'] ,  1, 'datos_empresa');

}
function data_empresa_get(){
	return $response=ini_general('atajo')->get_data('datos_empresa', 'id_dato', '1');
}
function insert_corte_post(){
	$values = array(
					$_REQUEST['periodo'],
					);
	return  $response=ini_general('atajo')->insert_define('cortes', 'periodo', $values);

}
function insert_precio_litro_post(){
	$values = array('gas',
		$_REQUEST['precio'],
		$_REQUEST['id_edificio']
	);
	return  $response=ini_general('atajo')->insert_define('precio_litros', 'producto, costo, id_edificio', $values);

}
function upload_post(){
	$target_path = "tickets/";
	$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
		ini_general('atajo')->update('ticket_pago', $_FILES['uploadedfile']['name'], $_REQUEST['id_lectura'], 'lectura');
	} else{
    echo "Ha ocurrido un error, trate de nuevo!";
	}
	header("location:$_SERVER[HTTP_REFERER]");
}
function cuota_post(){
	$values = array(
		$_REQUEST['cuota'],
		$_SESSION['hora_complete'],
		$_REQUEST['id_edificio']
	);
	return  $response=ini_general('atajo')->insert_define('cuota_admin', 'cuota, fecha_register, id_edificio', $values);
}
function cuota_get(){
	$response=ini_general('atajo')->selec_where_order_limit('cuota_admin', "id_edificio=$_REQUEST[id_edificio]");
	return $response;
	
}
function factor_post(){
	$values = array(
		$_REQUEST['factor'],
		$_SESSION['hora_complete'],
		$_REQUEST['id_edificio']

	);
	return  $response=ini_general('atajo')->insert_define('factor', 'factor, fecha_register, id_edificio', $values);
}
function factor_get(){
	$response=ini_general('atajo')->selec_where_order_limit('factor', "id_edificio=$_REQUEST[id_edificio]");
	return $response;

}
function adeudo_get(){
   $query="id_departamento=$_REQUEST[id_departamento] order by fecha_register DESC LIMIT 1, 1;";
   $response=ini_general('atajo')->selec_query('lectura', $query);
   return $response;
}
function periodos_get(){
	$response=ini_general('atajo')->select('cortes');
	return $response;
 
}
function crete_pdf_qr_get(){
	$response=ini_general('qr')->pdf_qr($_REQUEST['id_edificio']);
	return $response;

}
function data_grafica_get(){
	return ini_general('historial')->data_grafica($_REQUEST['id_departamento']);
}
function crea_img_post(){
	$img = $_POST['base64'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$fileData = base64_decode($img);
	$fileName = uniqid().'.png';
	file_put_contents('../view/img/'.$_REQUEST['id'].'.png', $fileData);
}
function total_lt_get(){
	return ini_general('historial')->total_lt($_REQUEST['id_edificio'], $_REQUEST['periodo']);
}
function prueba_get(){
		return $response=ini_general('historial')->select('2019-08-02 a 2019-09-01', '2019-07-01 a 2019-08-01');
}

function get_time_stamp(){
	$response= array('fecha' => date("Y-m-d") ,
					 'hora'=>date('H:i:s'));
	return [$response];
}


	
if(isset($_REQUEST['funcion'])){
	$funcion=$_REQUEST['funcion'];
		
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$funcion=$_REQUEST['funcion'].'_post';
				if(function_exists ($funcion) ){
						echo json_encode( $funcion(), JSON_UNESCAPED_UNICODE);
				}else{
					$response = [array('status' =>  '0',
											'descripcion'=> 'Method not found'.$_REQUEST['funcion'].'_post' )];
						echo json_encode( $response, JSON_UNESCAPED_UNICODE);
				}
			}else if($_SERVER['REQUEST_METHOD'] == 'GET'){
				$funcion=$_REQUEST['funcion'].'_get';
				if(function_exists ($funcion) ){
					echo json_encode( $funcion(), JSON_UNESCAPED_UNICODE);
				}else{
					$response = [array('status' =>  '0',
					'				descripcion'=> 'Method not found'.$_REQUEST['funcion'].'_get' )];
					echo json_encode( $response, JSON_UNESCAPED_UNICODE);

				}
			}else{
				$response = [array('status' =>  '0',
					'				descripcion'=> 'Method not found'.$_REQUEST['funcion'].'_null' )];
					echo json_encode( $response, JSON_UNESCAPED_UNICODE);
			}	
		


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
				$D.= $post[0] . " = " . substr($post[1], 0, 100);
			}
		}
	 $nombre_archivo = "logs.txt"; 
	   if($archivo = fopen($nombre_archivo, "a"))
	    {
	    	fwrite($archivo, date("d m Y H:m:s"). " ". $host. $url. $D.$c.$saltoLinea. "\n");
	        fclose($archivo);
	     }
	    
	}else if(isset($_REQUEST['accion'])){
			$funcion=$_REQUEST['accion'];
			echo   ($funcion());
	}else{
		echo json_encode("No estas haciendo referencia a ningun metodo");
				//echo '<META HTTP-EQUIV="REFRESH" CONTENT="4;URL=../view">';

	}


?>