<?php

/**
 * 
 */
class ctrl_{name} extends padre
{
	public $tabla;
	public function __construct()
	{
		parent::__construct('{name}');
		$this->tabla=pref.'{name}';


	}
	public function autentifica($parametros){
		$data=$this->{name}->auntentifica($parametros);
		return self::rtn_data($data);
	}
	public function insert({parametros}){
		$data=$this->{name}->insert({paramteros});
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

	public function verifica($parametros){
		$data=$this->{name}->verifica($parametros);
		return self::rtn_data($data);

	}


}
?>