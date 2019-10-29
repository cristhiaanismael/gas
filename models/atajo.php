<?php

/**
 * 
 */
class atajo extends padreM
{
	
		public function __construct()
	{
		parent::__construct();

	}

	public function select($tabla){
		$query="SELECT * FROM $tabla;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function selec_query($tabla, $query){
		$query="SELECT * FROM $tabla where $query;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function selec_query_And($tabla, $conditions){
		$query="SELECT * FROM $tabla where  $conditions[campo1]='$conditions[value1]' and $conditions[campo2]='$conditions[value2]' ;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}

	public function selec_query_or($tabla, $conditions){
		$query="SELECT * FROM $tabla where  $conditions ;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function selec_query_order_limit($tabla){
		$id_columna=self::describe($tabla);
		$query="SELECT * FROM $tabla ORDER BY $id_columna desc limit 1;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function selec_where_order_limit($tabla, $where){
		$id_columna=self::describe($tabla);
		$query="SELECT * FROM $tabla where $where ORDER BY $id_columna desc limit 1;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	protected function describe($tabla){
		$query="DESCRIBE $tabla;";
		$datos=$this->con->consultaRetorno($query);
		$fila=mysqli_fetch_array($datos);
		return $fila[0];
	}
	public function update($columna, $value , $where, $tabla){

		$id_columna=self::describe($tabla);
		$query="UPDATE  $tabla SET  $columna='$value' where $id_columna='$where';";
		
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function update2($columna, $value , $where, $tabla, $id_columna){
		$query="UPDATE  $tabla SET  $columna='$value' where $id_columna='$where';";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function update_whera_and($columna_set, $value_new , $value_where, $tabla, $columna_where, $columna_where2, $value_where2){
		$query="UPDATE  $tabla SET  $columna_set='$value_new' where $columna_where='$value_where' AND $columna_where2='$value_where2' ;";
		$datos=$this->con->consultasimple($query);
		return $datos;
	}
	public function delete($where, $tabla){

		$id_columna=self::describe($tabla);
		$query="DELETE  FROM $tabla  where $id_columna='$where';";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function delete_table($tabla){
		$query="DELETE  FROM $tabla;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}

	public function get_data($tabla, $columna_where, $valor_where){
		$query="SELECT * FROM $tabla where $columna_where='$valor_where';";
		$datos=$this->con->consultaRetorno($query);
		return $datos;

	}
	public function insert_define($tabla, $dentrode, $values){
		$query="INSERT INTO $tabla ($dentrode) values($values);";
		$datos=$this->con->consultainsert($query);
		return $datos;
	}
	
	

}

?>
