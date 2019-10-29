<?php

/**
 * 
 */
class folios extends padreM
{
	
		public function __construct()
	{
		parent::__construct();

	}

	public function ultimo(){
		$query="SELECT * FROM folios order by id_folio desc limit 1;";
		$datos=$this->con->consultaRetorno($query);
		$fila=mysqli_fetch_array($datos);
		return $fila;
	}
	public function update($columna, $value , $where){
		$query="UPDATE  menus SET  $columna='$value' where id_columna='$where';";
		$datos=$this->con->consultaRetorno($query);
		return $datos;

	}
	public function auntentifica($usu, $psw){
		$query="SELECT * FROM folios where folios='$usu' and pasword= BINARY '$psw';";
		$datos=$this->con->consultaRetorno($query);
		return $datos;

	}
	public function insert($folio ){
		$query="INSERT INTO folios (folio) values('$folio');";
		$datos=$this->con->consultainsert($query);
		return $datos;
	} 
	public function verifica($parametros){
		$query="SELECT * FROM folios WHERE {columna} like '$parametros';";
		$datos=$this->con->consultaRetorno($query);
		return $datos;

	} 
	

}

?>