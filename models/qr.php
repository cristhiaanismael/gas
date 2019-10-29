<?php

/**
 * 
 */
class qr extends padreM
{
	
		public function __construct()
	{
		parent::__construct();

	}

	public function selec(){
		$query="SELECT * FROM qr;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function get_todo($id_departamento){
		$query="SELECT * FROM
		edificios as edi,
		departamentos as dep			
		LEFT JOIN clientes
		ON dep.id_cliente= clientes.id_cliente
		where  dep.id_departamento=$id_departamento
		AND
		edi.id_edificio=dep.id_edificio;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}

	public function update($columna, $value , $where){
		$query="UPDATE  menus SET  $columna='$value' where id_columna='$where';";
		$datos=$this->con->consultaRetorno($query);
		return $datos;

	}
	public function auntentifica($usu, $psw){
		$query="SELECT * FROM qr where qr='$usu' and pasword= BINARY '$psw';";
		$datos=$this->con->consultaRetorno($query);
		return $datos;

	}
	public function insert($name, $app, $usu, $psw, $rol ){
		$query="INSERT INTO qr (nombre, apellido, usuario, pasword, rol) values('$name', '$app', '$usu', '$psw', '$rol');";
		$datos=$this->con->consultainsert($query);
		return $datos;
	} 
	public function verifica($parametros){
		$query="SELECT * FROM qr WHERE {columna} like '$parametros';";
		$datos=$this->con->consultaRetorno($query);
		return $datos;

	} 
	

}

?>
