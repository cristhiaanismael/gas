<?php

/**
 * 
 */
class departamentos extends padreM
{
	
		public function __construct()
	{
		parent::__construct();

	}

	public function selec($id){
		$query="SELECT * FROM departamentos where id_cliente < 1  and id_edificio=$id ;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function full_departamentos(){
		$query="SELECT * from
				edificios as edi, departamentos as dep
				where
				dep.id_edificio=edi.id_edificio
				order by
				num_edificio
				asc;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;

	}
	public function auntentifica($usu, $psw){
		$query="SELECT * FROM departamentos where departamentos='$usu' and pasword= BINARY '$psw';";
		$datos=$this->con->consultaRetorno($query);
		return $datos;

	}
	public function insert($name, $app, $usu, $psw, $rol ){
		$query="INSERT INTO departamentos (nombre, apellido, usuario, pasword, rol) values('$name', '$app', '$usu', '$psw', '$rol');";
		$datos=$this->con->consultainsert($query);
		return $datos;
	} 
	public function verifica($parametros){
		$query="SELECT * FROM departamentos WHERE {columna} like '$parametros';";
		$datos=$this->con->consultaRetorno($query);
		return $datos;

	} 
	

}

?>
