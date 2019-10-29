<?php

/**
 * 
 */
class ctrl_atajo extends padre
{
	public $tabla;
	public function __construct()
	{
		parent::__construct('atajo');
		//$this->tabla=pref.'atajo';
	}
	/**updates */
	public function update($columna, $value , $where, $tabla){
		$data=$this->atajo->update($columna, $value , $where, $tabla);
		if($data=='null'){
			$response=[array('status' =>'1' ,
				 				'descripcion'=>'Todo salio bien')];
		}else{
				$response=[array('status' =>'0' ,
				 				'descripcion'=>'Eroor'.$data)];
		}
		return $response;
		//return $data;
	}




	public function update2($columna, $value , $where, $tabla, $idcolumna){
		$data=$this->atajo->update2($columna, $value , $where, $tabla, $idcolumna);
		if($data=='null'){
			$response=[array('status' =>'1' ,
				 				'descripcion'=>'Todo salio bien')];
		}else{
				$response=[array('status' =>'0' ,
				 				'descripcion'=>'Eroor'.$data)];
		}
		return $response;
		//return $data;
	}

	public function update_whera_and($columna_set, $value_new , $value_where, $tabla, $columna_where, $columna_where2, $value_where2){
		$data=$this->atajo->update_whera_and($columna_set, $value_new , $value_where, $tabla, $columna_where, $columna_where2, $value_where2);
		if($data==''){
			$response=[array('status' =>'1' ,
				 				'descripcion'=>'Todo salio bien')];
		}else{
				$response=[array('status' =>'0' ,
				 				'descripcion'=>'Eroor'.$data)];
		}
		return $response;
		//return $data;
	}

	/**SELECTS */
	public function get_data($tabla, $columna_where, $valor_where){
		$data=$this->atajo->get_data($tabla, $columna_where, $valor_where);
		return self::rtn_data($data);
	}
	public function select($tabla){
		$data=$this->atajo->select($tabla);

		return self::rtn_data($data);
	}
	public function selec_query($tabla, $query){
		$data=$this->atajo->selec_query($tabla, $query);
		return self::rtn_data($data);
	}
	public function selec_query_And($tabla, $conditions){
		$data=$this->atajo->selec_query_And($tabla, $conditions);
		return self::rtn_data($data);
	}
	public function select_or($tabla, $conditions){
		$string="";
		if(count($conditions)>0){//SI EL AARRAY EN MAY A 1 ELEMENTO
			foreach ($conditions as $clave => $valor) {
				$string .= "$clave='$valor' or ";// AGRAGA LA PALABRA RESERVADA OR AL FINAL DE CADA LINSEA PARA ACOMPLETAR UNA SENTENCIA SQL
												//Y hara UN STRING  "CAMPO='valor' or campo2='$valor2' or "
			}
			$string=substr($string, 0,-3);//QUITALE EL ULTIMO OR YA QUE ESTA DE SOBRA
			$data=$this->atajo->selec_query($tabla, $string);//EJECUTA EL SQL ARMADO
		}else{//SI EL ARRAY SOLO TIENE UN ELEMETNO HAY QUE HACER UN QUERI SIN OR
			foreach ($conditions as $clave => $valor) {
				$string .= "$clave='$valor' ";//STRING PARA COMPARAR
			}
			$data=$this->atajo->selec_query($tabla, $string);//ejecuta consuta
		}
			return self::rtn_data($data);//resultado

	}
	public function selec_query_order_limit($table){
		$data=$this->atajo->selec_query_order_limit($table);
		return self::rtn_data($data);
	}
	public function selec_where_order_limit($table, $where){
		$data=$this->atajo->selec_where_order_limit($table, $where);
		return self::rtn_data($data);
	}

	/**INSERTS */
	public function insert_define($tabla, $dentrode, $values){//insert en columnas
		$string="";
		foreach ($values as $valor) {
			$string .= "'$valor',";
		}
		$string=substr($string, 0,-1);
		$data=$this->atajo->insert_define($tabla, $dentrode, $string);
		$response = array(  'status' =>  '1',
								'descripcion'=> 'insertado',
								'id'=>$data		 );
		return $response;
	}
	public function insert_unique($tabla, $dentrode, $values, $verificar){//insert en columnas
		$existe=self::select_or($tabla, $verificar);//consulta si exite
		if($existe[0]['status']=='0'){//no existe
			$string="";
			foreach ($values as $valor) {
				$string .= "'$valor',";//cadena para insertar ''value1','value2,'
			}
			$string=substr($string, 0,-1);//quita la ultima coma
			$data=$this->atajo->insert_define($tabla, $dentrode, $string);//inserta
			$response = array(  'status' =>  '1',
								'descripcion'=> 'insertado',
								'id'=>$data		 );
		}else{//el usuario ya exite
			$response=array('status' =>'0' ,
							'descripcion'=>'usuario ya existente');
		}
		return [$response];



		

	}

		/**DELETES */
	public function delete( $where, $tabla){
		$data=$this->atajo->delete($where, $tabla);
		if($data=='null'){
			$response=[array('status' =>'1' ,
				 				'descripcion'=>'Todo salio bien')];
		}else{
				$response=[array('status' =>'0' ,
				 				'descripcion'=>'Eroor'.$data)];
		}
		return $response;
		//return $data;
	}
	public function delete_table($tabla){
		$data=$this->atajo->delete_table($tabla);
		if($data=='null'){
			$response=[array('status' =>'1' ,
				 				'descripcion'=>'Todo salio bien')];
		}else{
				$response=[array('status' =>'0' ,
				 				'descripcion'=>'Eroor'.$data)];
		}
		return $response;
		//return $data;
	}
	public function upload_img($base64, $name, $ruta){
		/*$baseFromJavascript = $foto;
		$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript));
		$filepath = "upload/$id_user.png"; // or image.jpg
		file_put_contents($filepath,$data);*/
		$target_path=$ruta;
        $imagen= $base64;
 		$path = $target_path."/$name.png";
 		$img = filter_input(INPUT_POST, "foto");
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		file_put_contents($path, base64_decode($img));
		if(file_exists($path)){
			$array = array('name'  => "$name.png",
							'ruta' => $target_path,
							'status'=>'1' );
		}else{
			$array = array('status' => '0'  );

		}
		return $array;
	}
	

}
?>