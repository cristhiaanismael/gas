<?php
/**
 * 
 */
class clientes extends padreM
{
	
		public function __construct()
	{
		parent::__construct();

	}

	public function get_data(){
		$query="SELECT * FROM
				clientes as cli,
				departamentos as dep,
				edificios as edi
				where
				dep.id_edificio=edi.id_edificio
				and
				dep.id_cliente=cli.id_cliente
				;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function cliente_id($id){
		$query="SELECT * FROM
				clientes as cli,
				departamentos as dep,
				edificios as edi
				where
				dep.id_edificio=edi.id_edificio
				and
				dep.id_cliente=cli.id_cliente
				and
				cli.id_cliente=$id;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function cliente_iddepto($id){
		$query="SELECT * FROM
				clientes as cli,
				departamentos as dep,
				edificios as edi
				where
				dep.id_edificio=edi.id_edificio
				and
				dep.id_cliente=cli.id_cliente
				and
				dep.id_departamento=$id;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}


	public function update($columna, $value , $where){
		$query="UPDATE  menus SET  $columna='$value' where id_columna='$where';";
		$datos=$this->con->consultaRetorno($query);
		return $datos;

	}
	public function insert($name, $app, $usu, $psw, $rol ){
		$query="INSERT INTO clientes (nombre, apellido, usuario, pasword, rol) values('$name', '$app', '$usu', '$psw', '$rol');";
		$datos=$this->con->consultainsert($query);
		return $datos;
	} 
	public function verifica($parametros){
		$query="SELECT * FROM clientes WHERE {columna} like '$parametros';";
		$datos=$this->con->consultaRetorno($query);
		return $datos;

	} 
	

}

?>
