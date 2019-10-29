<?php

/**
 * 
 */
class usuarios extends padreM
{
	
		public function __construct()
	{
		parent::__construct();

	}

	public function selec(){
		$query="SELECT * FROM usuarios;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function update($columna, $newvalor , $where){
		$query="UPDATE  app_users SET  $columna='$newvalor' where id_user='$where';";
		//echo($query);
		$datos=$this->con->consultasimple($query);
		return $datos;

	}
	public function auntentifica($usu, $psw){
		$query="SELECT * FROM usuarios where usuario='$usu' and password= BINARY '$psw' ;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;

	}
	public function insert($name, $correo, $celular, $pasword, $rol, $hora_complete, $lada ){
		//id_user, name, ape_mat, ape_pat, correo, celular, pasword, rol, fecha_register, fecha_update
		$query="INSERT INTO app_users (name, correo, celular, pasword, rol, fecha_register, status, lada) values('$name', '$correo', '$celular', '$pasword', '$rol', '$hora_complete', 'activo', '$lada' );";
		$datos=$this->con->consultainsert($query);
		return $datos;
	} 
	public function verifica($correo, $celular){
		$query="SELECT * FROM app_users WHERE correo like '$correo' or  concat_ws('',lada, celular)='$celular' and status='activo';";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function verifica_id($id_user){
		$query="SELECT * FROM app_users WHERE id_user = $id_user;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}  
	

}

?>
