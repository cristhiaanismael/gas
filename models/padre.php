<?php


/**
 * 
 */
class padreM
{
	public $con;
	
	public function __construct()
	{
		if(!class_exists('Conectar')){
			include('../core/conexion.php');
		}
		$this->con=new Conectar();

	}

}


?>