<?php


/**
 * 
 */
class padre
{
	public $obj;
	public $view;
	public $ctrl;
	
	public function __construct($model)
	{
		if(!class_exists('Conectar')){
				include(ruta_models.'/padre.php');
		}

		if(!class_exists($model)){
			include(ruta_models.'/'.$model.'.php');
		}

		$name_view='view_'.$model;
		if (file_exists(view_controllers.'/'.$name_view.'.php')) {
			if(!class_exists($name_view)){
				include(view_controllers.'/'.$name_view.'.php');
			}
			$this->$name_view=new $name_view;
		}	

		$this->$model=new $model;
		/**instancia para podder hacer uso de atajos**/
		if(!class_exists('atajo')){
			include(ruta_models.'/atajo.php');
		}
		$this->atajo=new atajo;
	}
	public function num_rows($data){
		//echo json_decode($data);
		//si no hay datos imprimira esto
		if(mysqli_num_rows($data)<1){
			$response=array('status' =>  '0',
							'descripcion'=>'no hay data');
			return [$response];
		}else{
			return 1;
		}

	}

	public function rtn_data($data){
		//verifica que tenfa datos
		$array=self::num_rows($data);
		//$array="";
		//var_dump($data);
		// si hay datos hara esto
		if($array==1){
			$response=array();
			while ($fila=mysqli_fetch_assoc($data)) {

				$response[]=$fila;
			}				
			$array = [array('status'=>'1',
							'descripcion' => 'Todo salio bien',
							'data'=>$response )];
			///array_push($response[0], $array);
		}
		
		return $array;
	}
	public function includ_ctrl($controller){//incluye controllers
		if(!class_exists($controller)){
			include(ruta_controllers.'/ctrl_'.$controller.'.php');
		}
		$clase='ctrl_'.$controller;
		$this->$controller=new $clase;
	}
	public function includ_model($model){//incluye controllers
		if(!class_exists($model)){
			include(ruta_models.'/'.$model.'.php');
		}
		$clase=$model;
		$this->$model=new $clase;
	}

}


?>