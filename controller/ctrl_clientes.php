<?php

/**
 * 
 */
class ctrl_clientes extends padre
{
	public $tabla;
	public function __construct()
	{
		parent::__construct('clientes');
		$this->tabla=pref.'clientes';


	}
	public function traer_clientes(){
		$data=$this->clientes->get_data();
		return self::rtn_data($data);
	}

	public function cliente_id($id){
		$data=$this->clientes->cliente_id($id);
		return self::rtn_data($data);
	}
	public function insert($parametros){
		$data=$this->clientes->insert($paramteros);
		if($data>0){
			$response = array('status' =>  1,
							  'descripcion'=> 'insertado',
							  'id'=>$data		 );
		}else{
				$response = array('status' => 0,
								  'descripcion'=>'algo fallo'	 );
		}
		return [$response];
	}



}
?>