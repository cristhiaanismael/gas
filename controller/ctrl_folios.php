<?php

/**
 * 
 */
class ctrl_folios extends padre
{
	public $tabla;
	public function __construct()
	{
		parent::__construct('folios');
		$this->tabla=pref.'folios';


	}
	public function generate_folios(){
		$data=$this->folios->ultimo();
		$new_folio=$data['folio']+1;
		$data=$this->folios->insert($new_folio);
		if($data>0){
			$response = array('status' =>  1,
							  'descripcion'=> 'insertado',
							  'folio'=>$new_folio		 );
		}else{
				$response = array('status' => 0,
								  'descripcion'=>'algo fallo'	 );
		}
		return [$response];
	}
}
?>