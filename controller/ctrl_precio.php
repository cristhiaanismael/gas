<?php

/**
 * 
 */
class ctrl_precio extends padre
{
	public $tabla;
	public function __construct()
	{
		parent::__construct('precio');
		$this->tabla=pref.'precio';


	}
	
	

	public function price_desde_dep($parametros){
		$data=$this->precio->price_desde_dep($parametros);
		return self::rtn_data($data);

	}


}
?>