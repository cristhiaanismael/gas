<?php

/**
 * 
 */
class historial extends padreM
{
	
		public function __construct()
	{
		parent::__construct();

	}

	public function selec($periodo, $periodoanterior){
		$query="SELECT * FROM lectura
				as lec,
				departamentos as dep,
				edificios as edi
				where
				dep.id_departamento=lec.id_departamento
				and
				dep.id_edificio=edi.id_Edificio

				;
				";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function data(){
		$query="SELECT * FROM lectura
				as lec,
				departamentos as dep,
				edificios as edi
				where
				dep.id_departamento=lec.id_departamento
				and
				dep.id_edificio=edi.id_Edificio
				;
				";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function x_periodo($periodo){
		$query="SELECT * FROM lectura
				as lec,
				departamentos as dep,
				edificios as edi,	
				clientes as cli
				where
        		dep.id_cliente=cli.id_cliente
				and
				dep.id_departamento=lec.id_departamento
				and
				dep.id_edificio=edi.id_Edificio
				and
				periodo 
				like '$periodo';
				";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function full_year(){
		$query="SELECT * FROM lectura
				where
				periodo like '%$_SESSION[year]%';";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	} 
	

}

?>
