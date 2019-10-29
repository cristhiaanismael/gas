<?php

/**
 * 
 */
class ctrl_departamentos extends padre
{
	public $tabla;
	public function __construct()
	{
		parent::__construct('departamentos');
		$this->tabla=pref.'departamentos';


	}
	public function get_data($id){
		$data=$this->departamentos->selec($id);
		return self::rtn_data($data);
	}
	public function full_departamentos(){
		$data=$this->departamentos->full_departamentos();
		return self::rtn_data($data);

	}




}
?>