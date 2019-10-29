<?php

/**
 * 
 */
class ctrl_qr extends padre
{
	public $tabla;
	public function __construct()
	{
		parent::__construct('qr');
		$this->tabla=pref.'qr';
	}
	public function crear_qr($data, $id){

		if (!defined('QR_MODE_NUL')) {
			require ruta_config."/phpqrcode/qrlib.php";    
		}
		$dir = 'temp/';
		//Si no existe la carpeta la creamos
		if (!file_exists($dir))
        	mkdir($dir);
			$filename = $dir.$id.'.png';
			$tamaño = 3; //Tamaño de Pixel
			$level = 'L'; //Precisión Baja
			$framSize = 3; //Tamaño en blanco
			$contenido = $data; //Texto
	        //Enviamos los parametros a la Función para generar código QR 
			QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 
	        //Mostramos la imagen generada
			//echo '<img src="'.$dir.basename($filename).'" /><hr/>';  
			return  array('creado' => 'exito' , );
	}
	public function obtener_data($id_departamento){
		$data=$this->qr->get_todo($id_departamento);
		$fila=mysqli_fetch_array($data);
		$cadena="id_edificio=$fila[id_edificio]&num_edi=$fila[num_edificio]&calle=$fila[calle]&num_ext=$fila[num_ext]&municipio=$fila[municipio]&colonia=$fila[colonia]&codigo_p=$fila[codigo_p]&id_departamento=$fila[id_departamento]&num_departamento=$fila[num_departamento]&convenio=$fila[convenio]&referencia=$fila[referencia]";
		//var_dump($cadena);
		return self::crear_qr($cadena, $id_departamento);
	}
	public function pdf_qr($id_edificio){
		//traer departamentos del edificio
		$data=$this->atajo->selec_query('departamentos', ' id_edificio='.$id_edificio);
		$arreglo=array();
		while($fila=mysqli_fetch_array($data)){
			//guardarlos en arreglo
			$arreglo[]=$fila['id_departamento'].'.png;'.$fila['num_departamento'];
			self::obtener_data($fila['id_departamento']);
		}
		$tabla=self::create_table($arreglo);
		//llamar a la funcio que crea
		//include(ruta_config.'/html2pdf-master/examples/qrs.php');
		//return $arreglo;
		$nombre_archivo = "htmls/$id_edificio.html"; 
		if(file_exists($nombre_archivo ) ){
			unlink($nombre_archivo);
		}
		if($archivo = fopen($nombre_archivo, "a"))
		{
			if(fwrite($archivo, $tabla))
			{
			}
			else
			{
			}
			fclose($archivo);
		}
	}
	public function create_table($arreglo){
		$con=0;
		$tabla="";
        foreach ($arreglo as $img) {
			if($con==0){
				$tabla.="<tr>";
			}
				$array = explode(";", $img);
				$img='<img src="../temp/'.$array[0].'" border="1" alt="" 
						width="150" height="150">';
				$tabla.="<td>
						$array[1]<br>
						$img
						<br>
						</td>";
		   $con++;
		   if($con==3){
			$tabla.="</tr>";
				$con=0;
			}
		}
		if($con<3){
			for($i = $con; $i < 3; $i++){
				$tabla.="<td>
						</td>";
				$con++;
			}	
		}
		if($con==3){
			$tabla.="</tr>";
		}
		$t= "<table border='1' width='100%'> $tabla </table>";
		return $t;
	}


}
?>