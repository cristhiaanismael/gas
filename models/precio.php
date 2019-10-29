<?php

/**
 * 
 */
class precio extends padreM
{
	
		public function __construct()
	{
		parent::__construct();

	}

	public function selec(){
		$query="SELECT * FROM precio_litros order by fecha_register desc limit 1;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function price_desde_dep($id_departamento){
		$query="SELECT edi.id_edificio, dep.id_departamento, pre.costo  from
				edificios as edi,
				departamentos as dep,
				precio_litros as pre
				where
				dep.id_edificio=edi.id_edificio
				and
				pre.id_edificio=edi.id_edificio
				and
				id_departamento=$id_departamento
				order by pre.fecha_register desc limit 1;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
				
	}
	

}

?>
