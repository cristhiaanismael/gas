<?php
/**
 * 
 */
class ctrl_usuarios extends padre
{
	public $tabla;
	public function __construct()
	{
		parent::__construct('usuarios');
		$this->tabla=pref.'usuarios';


	}
	public function autentifica($usu, $psw){
		//selecciona cliuente con ese convenio y obten id
		$data_clientes=$this->usuarios->auntentifica($usu, $psw);
		return self::rtn_data($data_clientes);
	}

	public function autentifica_cliente($edificio, $convenio){
		//selecciona cliuente con ese convenio y obten id
		if($edificio==0){
				//aqui buscar en users
					$data_usr=$this->atajo->get_data('usuarios', 'password', $convenio);
					if(mysqli_num_rows($data_usr)>0){
						$fila_user=mysqli_fetch_array($data_usr);
						return array('admin'=>$fila_user['id_user']);
					}else{
						return array('status'=>0);
					}
		}
		$data_clientes=$this->atajo->get_data('clientes', 'referencia', $convenio);
		if(mysqli_num_rows($data_clientes)>0){
		   $fila_clientes=mysqli_fetch_array($data_clientes);
           $data_deptos=$this->atajo->get_data('departamentos', 'id_cliente', $fila_clientes['id_cliente']);
		    if(mysqli_num_rows($data_deptos)>0){
			  $fila_deptos=mysqli_fetch_array($data_deptos);
				if($fila_deptos['id_edificio']==$edificio){
					return array('status'=>$fila_clientes['id_cliente']);
				}
				return array('status'=>0);
			}
			return array('status'=>0);
		}
		return array('status'=>0);

		//seleciona un deartamento con ese id de cliente y edificio
		//retorna
		//return self::rtn_data($data);
	}
	public function insert($name, $correo, $celular, $pasword, $rol, $hora_complete, $lada){
		$data=$this->usuarios->insert($name, $correo, $celular, $pasword, $rol, $hora_complete, $lada);
		if($data>0){
			$response = array('status' =>  '1',
							  'descripcion'=> 'insertado',
							  'id'=>$data		 );
		}else{
				$response = array('status' => '0',
								  'descripcion'=>'algo fallo'	 );
		}
		return [$response];
	}
	public function verifica($correo, $celular){
		$data=$this->usuarios->verifica($correo, $celular);
		return self::rtn_data($data);
	}
	public function verifica_id($id_user){
		$data=$this->usuarios->verifica_id($id_user);
		return self::rtn_data($data);

	}
	public function update($columna, $newvalor, $where){
		$data=$this->usuarios->update($columna, $newvalor, $where);

		return $data;

	}

	public function upload_foto($id_user, $foto){
		/*$baseFromJavascript = $foto;
		$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript));
		$filepath = "upload/$id_user.png"; // or image.jpg
		file_put_contents($filepath,$data);*/
		$target_path=user_foto;
        $imagen= $foto;
 		$path = $target_path."/$id_user.png";
 		$img = filter_input(INPUT_POST, "foto");
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
       	file_put_contents($path, base64_decode($img));
		self::update('foto_perfil', "$id_user.png", $id_user);
		return self::update('ruta', ruta_foto_servidor, $id_user);
	}
	
}
?>