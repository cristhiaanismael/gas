<?php


/**
 * 
 */
class vew_padre
{
	public $obj;
	
	public function __construct($ctrl)
	{
		if(!class_exists('Conectar')){
				include(ruta_models.'/padre.php');
		}

		if(!class_exists($model)){
			include(ruta_models.'/'.$model.'.php');
		}
		$this->$model=new $model;
	}
	public function num_rows($data){
		//si no hay datos imprimira esto
		if(mysqli_num_rows($data)<1){
			$response=array('status' =>  0,
							'descripcion'=>'no hay data');
			return [$response];
		}else{
			return 1;
		}

	}

	public function rtn_data($data){
		//verifica que tenfa datos
		$response=self::num_rows($data);
		// si hay datos hara esto
		if($response==1){
			$response=array();
			while ($fila=mysqli_fetch_assoc($data)) {
				$response[]=$fila;
			}
		}
		return $response;


	}

}


?>