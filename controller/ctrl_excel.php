<?php

/**
 * 
 */
class ctrl_excel extends padre
{

	public function __construct()
	{
		parent::__construct('excel');


	}
	
	public function verifica($parametros){
		$data=$this->excel->verifica($parametros);
		return self::rtn_data($data);

	}
	public function read_excel2(){
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');
		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
		/** Include PHPExcel */
		require_once ruta_config.'/Classes/PHPExcel.php';
		// Create new PHPExcel object
		$archivo = ruta_config."/libro1.xlsx";
		$inputFileType = PHPExcel_IOFactory::identify($archivo);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($archivo);
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();
		for ($row = 2; $row <= $highestRow; $row++){ 
				echo $sheet->getCell("A".$row)->getValue()." - ";
				echo $sheet->getCell("B".$row)->getValue()." - ";
				echo $sheet->getCell("C".$row)->getValue();
				echo "<br>";
		}

	}

	public function create_dictamen_cfm($noaprobacion, $noacreditacion, $semestre, $resulado, $tiposervicio, $fecha, $fecha_anterior, $id_direccion,$folio, $id_cliente, $id_unidad, $id_usuario, $comentario, $firma, $type, $fecha_prox, $economico, $cancelado){

		include(ruta_models.'/clientes.php');
		include(ruta_models.'/unidades.php');
		include(ruta_models.'/usuarios.php');
		include(ruta_models.'/orden_trabajo.php');
		$cli=new clientes();
		$data_cli=$cli->verifica_id($id_cliente);
		$fila_cli=mysqli_fetch_array($data_cli);
		$uni=new unidades();
		$data_uni=$uni->selec_id($id_unidad);
		$fila_uni=mysqli_fetch_array($data_uni);
		$usu=new usuarios();
		$data_usu=$usu->user_id($id_usuario);
		$fila_usu=mysqli_fetch_array($data_usu);
		$orden=new orden_trabajo();
		$data_ord=$orden->verifica($folio);
		$fila_orden=mysqli_fetch_array($data_ord);
		$data_dir=$cli->get_id_direccion($id_direccion);
		$fila_dir=mysqli_fetch_array($data_dir);
		if(strtoupper($cancelado)=='TRUE'){
			$resulado='cancelado';
		}
	
		require ruta_config.'/Classes/PHPExcel/IOFactory.php';
			$objPHPExcel = new PHPExcel();
			$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			if($type=='CFMM'){
					$objPHPExcel = $objReader->load(templates.'/cfmmnuevo.xlsx');
						$objPHPExcel->setActiveSheetIndex(0);
							$valorasumar=19;
							$tres=3;
							$cinco=5;
							$seis=6;
							$nueve=9;
							$once=11;
							$doce=12;
							//$doce=13;
							$ocho=8;
						//Modificamos los valoresde las celdas A2, B2 Y C2
						$valor=$objPHPExcel->getActiveSheet();
						for ($i = 0; $i <= 2; $i++) {

								if($i==1){
							$objPHPExcel->getActiveSheet()->SetCellValue('G31', $fila_uni['placas']);
							$objPHPExcel->getActiveSheet()->SetCellValue('G32', $fecha);

								}

							$objPHPExcel->getActiveSheet()->SetCellValue('A'.$tres, $noaprobacion);
							$objPHPExcel->getActiveSheet()->SetCellValue('B'.$tres, $noacreditacion);
							$objPHPExcel->getActiveSheet()->SetCellValue('C'.$tres, $semestre);
							$objPHPExcel->getActiveSheet()->SetCellValue('D'.$tres, $resulado);
							$objPHPExcel->getActiveSheet()->SetCellValue('E'.$tres, $tiposervicio);
							$objPHPExcel->getActiveSheet()->SetCellValue('F'.$tres, $fecha);
							$objPHPExcel->getActiveSheet()->SetCellValue('G'.$tres, $fila_orden['hora']);
							$objPHPExcel->getActiveSheet()->SetCellValue('H'.$tres, date("H:i:s"));
							$objPHPExcel->getActiveSheet()->SetCellValue('I'.$tres, $fecha_anterior);

							$objPHPExcel->getActiveSheet()->SetCellValue('A'.$cinco, $fila_cli['nombre'].$fila_cli['ape_pat'].$fila_cli['ape_mat']);
							$objPHPExcel->getActiveSheet()->SetCellValue('D'.$cinco, $fila_cli['rfc']);
							$objPHPExcel->getActiveSheet()->SetCellValue('F'.$cinco, $fila_dir['calle'].' '.$fila_dir['no_ext'].' '.$fila_dir['no_int']);
							$objPHPExcel->getActiveSheet()->SetCellValue('D'.$seis, $fila_dir['municipio']);

							$objPHPExcel->getActiveSheet()->SetCellValue('F'.$seis, $fila_dir['estado']);
							$objPHPExcel->getActiveSheet()->SetCellValue('I'.$seis, $fila_dir['cp']);

							$objPHPExcel->getActiveSheet()->SetCellValue('A'.$nueve, $fila_uni['placas']);
							$objPHPExcel->getActiveSheet()->SetCellValue('B'.$nueve, $fila_uni['niv']);
							$objPHPExcel->getActiveSheet()->SetCellValue('E'.$nueve, $fila_uni['tipo_motor']);
							$objPHPExcel->getActiveSheet()->SetCellValue('F'.$nueve, $fila_uni['marca']);
							$objPHPExcel->getActiveSheet()->SetCellValue('I'.$nueve, $fila_uni['modelo']);
							$objPHPExcel->getActiveSheet()->SetCellValue('A'.$once, $fila_uni['folio_tarjeta']);
							$objPHPExcel->getActiveSheet()->SetCellValue('C'.$once, $fila_uni['odometro']);
							$objPHPExcel->getActiveSheet()->SetCellValue('E'.$once, $fila_uni['presento']);

						//	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$once, $fecha_prox);
							$objPHPExcel->getActiveSheet()->SetCellValue('G'.$once, $fecha_prox);
							$objPHPExcel->getActiveSheet()->SetCellValue('H'.$once, $economico);

							$objPHPExcel->getActiveSheet()->SetCellValue('E'.$doce, $valor->getCell("F".$doce)->getValue()."\n ".$fila_usu['nombre']." ".$fila_usu['apellido']);
							//$objPHPExcel->getActiveSheet()->getStyle('E'.$doce)->getAlignment()->setWrapText(true);

								$objDrawing = new PHPExcel_Worksheet_Drawing (); // crear objeto para el dibujo de la hoja de trabajo
								$objDrawing-> setName ('Firma del tecnico'); // establecer el nombre a la imagen
								$objDrawing-> setDescription ('Firma del tecnico'); // establecer la descripción a la imagen
								//$imagePath=ruta_request.'/firma.txt';
								$imagentemporal="firma-$folio.png";
				 				file_put_contents($imagentemporal, base64_decode($firma));
								//$imagen=base64_decode($firma);
								$signature = $imagentemporal; // Ruta a la firma archivo .jpg 
								$objDrawing-> setPath ($signature);
								$objDrawing-> setOffsetX (25); // setOffsetX funciona correctamente
								$objDrawing-> setOffsetY (10); // setOffsetY funciona correctamente
								$objDrawing-> setCoordinates ('E'.$doce); // establece la imagen en la celda
								$objDrawing-> setWidth (62); // establecer ancho, altura
								$objDrawing-> setHeight (52);  
								$objDrawing-> setWorksheet ($objPHPExcel-> getActiveSheet ()); //salvar

								$tres=$tres+$valorasumar;
								$cinco=$cinco+$valorasumar;
								$seis=$seis+$valorasumar;
								$nueve=$nueve+$valorasumar;
								$once=$once+$valorasumar;
								$doce=$doce+$valorasumar;
								//$doce=$doce+$valorasumar;
								$ocho=$ocho+$valorasumar;

							}
							$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
							$foli2=str_replace(" ", "", $folio);;
							$ruta_save_excel=pdfs."/dictamen cfmm/dictamenM-$foli2-$fecha.xlsx";
							$objWriter->save($ruta_save_excel);
							unlink($imagentemporal);//borramos imagen de la firma
							$name_dictamen="dictamenM-$foli2-$fecha.xlsx";
							if (file_exists($ruta_save_excel)) {
								self::guarda_dictamen($folio, $name_dictamen, $resulado);
								$array = array('status' =>'1' ,
												'descripción'=>'Al parecer todo salio bien',
												'ruta'=> "/dictamen cfmm/dictamenM-$foli2-$fecha.xlsx");
							} else {
								$array = array('status' =>'0' ,
												'descripción'=>'Al parecer no se creo el archivo',
												'ruta'=> "sin ruta");
							}
							return $array;






			}else{//cfma

						$objPHPExcel = $objReader->load(templates.'/cfmanuevo.xlsx');
						// Indicamos que se pare en la hoja uno del libro
						$objPHPExcel->setActiveSheetIndex(0);
						//Modificamos los valoresde las celdas A2, B2 Y C2
						$valor=$objPHPExcel->getActiveSheet();
							$valorasumar=19;
							$tres=3;
							$cinco=5;
							$seis=6;
							$nueve=9;
							$once=11;
							$doce=12;
							$trece=13;
						for ($i = 0; $i <= 2; $i++) {
							if($i==1){
							$objPHPExcel->getActiveSheet()->SetCellValue('B30', $fila_uni['marca']);
							$objPHPExcel->getActiveSheet()->SetCellValue('D30', $fila_uni['modelo']);
							$objPHPExcel->getActiveSheet()->SetCellValue('D31', $fila_usu['nombre']." ".$fila_usu['apellido']);

							}

								$objPHPExcel->getActiveSheet()->SetCellValue('A'.$tres, $noaprobacion);
								$objPHPExcel->getActiveSheet()->SetCellValue('B'.$tres, $noacreditacion);
								$objPHPExcel->getActiveSheet()->SetCellValue('C'.$tres, $semestre);
								$objPHPExcel->getActiveSheet()->SetCellValue('D'.$tres, $resulado);
								$objPHPExcel->getActiveSheet()->SetCellValue('E'.$tres, $tiposervicio);
								$objPHPExcel->getActiveSheet()->SetCellValue('F'.$tres, $fecha);

								$objPHPExcel->getActiveSheet()->SetCellValue('G'.$tres, $fila_orden['hora']);
								$objPHPExcel->getActiveSheet()->SetCellValue('H'.$tres, date("H:i:s"));
								$objPHPExcel->getActiveSheet()->SetCellValue('I'.$tres, $fecha_anterior);

								$objPHPExcel->getActiveSheet()->SetCellValue('A'.$cinco, $fila_cli['nombre']);
								$objPHPExcel->getActiveSheet()->SetCellValue('D'.$cinco, $fila_cli['rfc']);
								$objPHPExcel->getActiveSheet()->SetCellValue('F'.$cinco,  $fila_dir['calle'].' '.$fila_dir['no_ext'].' '.$fila_dir['no_int']);
								$objPHPExcel->getActiveSheet()->SetCellValue('D'.$seis, $fila_dir['municipio']);

								$objPHPExcel->getActiveSheet()->SetCellValue('F'.$seis, $fila_dir['estado']);
								$objPHPExcel->getActiveSheet()->SetCellValue('I'.$seis, $fila_dir['cp']);
					//id_unidad, niv, marca, modelo, n_motor, tipo_motor, clase, modalidad, capacidad, ejes, presento, odometro, folio_tarjeta, placas, fecha_register, id_tipo, id_cliente, unidad_medida
								$objPHPExcel->getActiveSheet()->SetCellValue('A'.$nueve, $fila_uni['placas']);
								$objPHPExcel->getActiveSheet()->SetCellValue('B'.$nueve, $fila_uni['niv']);
								$objPHPExcel->getActiveSheet()->SetCellValue('E'.$nueve, $fila_uni['tipo']);
								if($i!=1){
									$objPHPExcel->getActiveSheet()->SetCellValue('F'.$nueve, $fila_uni['marca']);
									$objPHPExcel->getActiveSheet()->SetCellValue('I'.$nueve, $fila_uni['modelo']);
								}
								$objPHPExcel->getActiveSheet()->SetCellValue('A'.$once, $fila_uni['folio_tarjeta']);
								$objPHPExcel->getActiveSheet()->SetCellValue('E'.$once, $fila_uni['presento']);
							//	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$once, $fecha_prox);

								if($i!=1){
									$objPHPExcel->getActiveSheet()->SetCellValue('G'.$once, $fecha_prox);
									$objPHPExcel->getActiveSheet()->SetCellValue('H'.$once, $economico);

									$objPHPExcel->getActiveSheet()->SetCellValue('E'.$doce, $fila_usu['nombre']." ".$fila_usu['apellido']);
								}
								//$objPHPExcel->getActiveSheet()->getStyle('F'.$doce)->getAlignment()->setWrapText(true);


									$objDrawing = new PHPExcel_Worksheet_Drawing (); // crear objeto para el dibujo de la hoja de trabajo
									$objDrawing-> setName ('Firma del tecnico'); // establecer el nombre a la imagen
									$objDrawing-> setDescription ('Firma del tecnico'); // establecer la descripción a la imagen
									//$imagePath=ruta_request.'/firma.txt';
									$imagentemporal="firma-$folio.png";
					 				file_put_contents($imagentemporal, base64_decode($firma));
									//$imagen=base64_decode($firma);
									$signature = $imagentemporal; // Ruta a la firma archivo .jpg 
									$objDrawing-> setPath ($signature);
									$objDrawing-> setOffsetX (25); // setOffsetX funciona correctamente
									$objDrawing-> setOffsetY (10); // setOffsetY funciona correctamente
									if($i==2){
										$objDrawing-> setCoordinates ('G'.$doce); // establece la imagen en la celda
									}else if($i==1){
										$objDrawing-> setCoordinates ('D33'); // establece la imagen en la celda

									}
									else{
										$objDrawing-> setCoordinates ('D'.$doce); // establece la imagen en la celda

									}
									$objDrawing-> setWidth (62); // establecer ancho, altura
									$objDrawing-> setHeight (52);  
									$objDrawing-> setWorksheet ($objPHPExcel-> getActiveSheet ()); //salvar

								$tres=$tres+$valorasumar;
								$cinco=$cinco+$valorasumar;
								$seis=$seis+$valorasumar;
								$nueve=$nueve+$valorasumar;
								$once=$once+$valorasumar;
								$doce=$doce+$valorasumar;
								$trece=$trece+$valorasumar;
							}
						//$objPHPExcel->getActiveSheet()->SetCellValue('G18', $cp);
						$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						$foli2=str_replace(" ", "", $folio);;
						$ruta_save_excel=pdfs."/dictamen cfmm/dictamenA-$foli2-$fecha.xlsx";
						$objWriter->save($ruta_save_excel);
						unlink($imagentemporal);//borramos imagen de la firma
						$name_dictamen="dictamenA-$foli2-$fecha.xlsx";
						if (file_exists($ruta_save_excel)) {
							self::guarda_dictamen($folio, $name_dictamen, $resulado);
							$array = array('status' =>'1' ,
											'descripción'=>'Al parecer todo salio bien',
											'ruta'=> "/dictamen cfmm/dictamenA-$foli2-$fecha.xlsx");
						} else {
							$array = array('status' =>'0' ,
											'descripción'=>'Al parecer no se creo el archivo',
											'ruta'=> "sin ruta");
						}
						return $array;
			}
	}
	public function create_orden($fecha,$hora, $folio, $precio, $numserie, $clase, $tipo, $marca, $placa, $year, $motor, $modalidad, $dictamen, $periodo, $no_centro, $firma, $ec, $array, $id_cliente, $rechazado){

		include(ruta_models.'/clientes.php');
		$cli=new clientes();
		$data_cli=$cli->verifica_id($id_cliente);
		$fila_cli=mysqli_fetch_array($data_cli);


			require ruta_config.'/Classes/PHPExcel/IOFactory.php';
			$objPHPExcel = new PHPExcel();
			$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			if($ec=='TRUE'){
						$objPHPExcel = $objReader->load(templates.'/ordentrabajo.xlsx');
			}else{

						$objPHPExcel = $objReader->load(templates.'/ordentrabajosinatras.xlsx');
			}
			// Indicamos que se pare en la hoja uno del libro
			$objPHPExcel->setActiveSheetIndex(0);
			//Modificamos los valoresde las celdas A2, B2 Y C2
			$valor=$objPHPExcel->getActiveSheet();

			$objPHPExcel->getActiveSheet()->SetCellValue('B7', $valor->getCell("B7")->getValue().' '.$fila_cli['nombre'].' '.$fila_cli['ape_pat'].' '. $fila_cli['ape_mat'] );

			$objPHPExcel->getActiveSheet()->SetCellValue('B6', $valor->getCell("B6")->getValue().' '.$fecha);
			$objPHPExcel->getActiveSheet()->SetCellValue('E6', $valor->getCell("E6")->getValue().' '.$hora);
			if(strtoupper($rechazado)=='FALSE'){
				//echo $rechazo;
				$objPHPExcel->getActiveSheet()->SetCellValue('H6', $valor->getCell('H6')->getValue().' '.$folio);
			}
			$objPHPExcel->getActiveSheet()->SetCellValue('L6', $valor->getCell('L6')->getValue().' '.$precio);

			$objPHPExcel->getActiveSheet()->SetCellValue('B9', $valor->getCell("B9")->getValue().' '.$numserie);
			$objPHPExcel->getActiveSheet()->SetCellValue('K9', $valor->getCell("K9")->getValue().' '.$tipo);//ACTUALIZADO
			$objPHPExcel->getActiveSheet()->SetCellValue('H9', $valor->getCell('H9')->getValue().' '.$clase);
			$objPHPExcel->getActiveSheet()->SetCellValue('B10', $valor->getCell('B10')->getValue().' '.$marca);
			$objPHPExcel->getActiveSheet()->SetCellValue('F10', $valor->getCell('F10')->getValue().' '.$placa);
			$objPHPExcel->getActiveSheet()->SetCellValue('I10', $valor->getCell('I10')->getValue().' '.$year);
			$objPHPExcel->getActiveSheet()->SetCellValue('L10', $valor->getCell('L10')->getValue().' '.$motor);
			$objPHPExcel->getActiveSheet()->SetCellValue('B11', $valor->getCell('B11')->getValue().' '.$modalidad);

			$objPHPExcel->getActiveSheet()->SetCellValue('B13', $valor->getCell('B13')->getValue().' '.$dictamen);
			$objPHPExcel->getActiveSheet()->SetCellValue('F13', $valor->getCell('F13')->getValue().' '.$periodo);
			$objPHPExcel->getActiveSheet()->SetCellValue('I13', $valor->getCell('I13')->getValue().' '.$no_centro);
				$objDrawing = new PHPExcel_Worksheet_Drawing (); // crear objeto para el dibujo de la hoja de trabajo
				$objDrawing-> setName ('Firma del cliente'); // establecer el nombre a la imagen
				$objDrawing-> setDescription ('Firma del cliente'); // establecer la descripción a la imagen
				//$imagePath=ruta_request.'/firma.txt';
				$imagentemporal="firma-$folio.png";
 				file_put_contents($imagentemporal, base64_decode($firma));
				//$imagen=base64_decode($firma);
				$signature = $imagentemporal; // Ruta a la firma archivo .jpg 
				$objDrawing-> setPath ($signature);
				$objDrawing-> setOffsetX (25); // setOffsetX funciona correctamente
				$objDrawing-> setOffsetY (10); // setOffsetY funciona correctamente
				$objDrawing-> setCoordinates ('C22'); // establece la imagen en la celda
				$objDrawing-> setWidth (62); // establecer ancho, altura
				$objDrawing-> setHeight (52);  
				$objDrawing-> setWorksheet ($objPHPExcel-> getActiveSheet ()); //salvar

			if($ec=='TRUE'){
				self::create_check_ec($valor, $array, $objPHPExcel);
			}

			//Guardamos los cambios
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$foli2=str_replace(" ", "", $folio);;
			$ruta_save_excel=pdfs."/ordentrabajoexcel/$foli2-$fecha.xlsx";
			$objWriter->save($ruta_save_excel);
			unlink($imagentemporal);//borramos imagen de la firma
			$name_orden="$folio-$fecha.xlsx";

			if (file_exists($ruta_save_excel)) {
				self::guarda_orden($folio, $name_orden);
				$array = array('status' =>'1' ,
								'descripción'=>'Al parecer todo salio bien',
								'ruta'=> "/ordentrabajoexcel/$foli2-$fecha.xlsx");
			} else {
				$array = array('status' =>'0' ,
								'descripción'=>'Al parecer no se creo el archivo',
								'ruta'=> "sin ruta");
			}
			return $array;
	}
	public function create_rechazo( $tiposervicio, $fecha,  $id_direccion, $folio, $id_cliente, $id_unidad, $id_usuario, $firma, $type){
		include(ruta_models.'/clientes.php');
		include(ruta_models.'/unidades.php');
		include(ruta_models.'/usuarios.php');
		$cli=new clientes();
		$data_cli=$cli->verifica_id($id_cliente);
		$fila_cli=mysqli_fetch_array($data_cli);
		$uni=new unidades();
		$data_uni=$uni->selec_id($id_unidad);
		$fila_uni=mysqli_fetch_array($data_uni);

			$data_dir=$cli->get_id_direccion($id_direccion);
		$fila_dir=mysqli_fetch_array($data_dir);

		$usu=new usuarios();
		$data_usu=$usu->user_id($id_usuario);
		$fila_usu=mysqli_fetch_array($data_usu);
		require ruta_config.'/Classes/PHPExcel/IOFactory.php';
			$objPHPExcel = new PHPExcel();
			$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			$objPHPExcel = $objReader->load(templates.'/rechazonuevo.xlsx');
			// Indicamos que se pare en la hoja uno del libro
			$objPHPExcel->setActiveSheetIndex(0);
			//Modificamos los valoresde las celdas A2, B2 Y C2
			$valor=$objPHPExcel->getActiveSheet();
							$valorasumar=27;
							$valorasumar2=21;
							$valorasumar3=26;
							$valorasumar4=25;
							$one=1;
							$tres=3;
							$cinco=5;
							$siete=7;
							$ocho=8;
							$nueve=9;
							$diecinueve=19;
							$diesiocho=18;

						//Modificamos los valoresde las celdas A2, B2 Y C2

						for ($i = 0; $i <= 1; $i++) {
						//id_unidad, niv, marca, modelo, n_motor, tipo_motor, clase, modalidad, capacidad, ejes, presento, odometro, folio_tarjeta, placas, fecha_register, id_tipo, id_cliente, unidad_medida
							$objPHPExcel->getActiveSheet()->SetCellValue('C'.$one, $fila_uni['niv']);
							$objPHPExcel->getActiveSheet()->SetCellValue('A'.$tres, $fila_uni['marca']);
							$objPHPExcel->getActiveSheet()->SetCellValue('D'.$tres, $fila_uni['modelo']);
							$objPHPExcel->getActiveSheet()->SetCellValue('G'.$tres, $fila_uni['placas']);

							$objPHPExcel->getActiveSheet()->SetCellValue('A'.$cinco, $type);
							$objPHPExcel->getActiveSheet()->SetCellValue('E'.$cinco, $tiposervicio);

							$objPHPExcel->getActiveSheet()->SetCellValue('B'.$siete, ' '.$fila_cli['nombre'].' '.$fila_cli['ape_pat']. ' '. $fila_cli['ape_mat']);
							$objPHPExcel->getActiveSheet()->SetCellValue('A'.$ocho, $fila_cli['rfc']);
							$objPHPExcel->getActiveSheet()->SetCellValue('D'.$ocho,  $fila_dir['calle'].' '.$fila_dir['no_ext'].' '.$fila_dir['no_int']);
							$objPHPExcel->getActiveSheet()->SetCellValue('A'.$nueve, $fila_dir['estado']);
							$objPHPExcel->getActiveSheet()->SetCellValue('D'.$nueve, $fila_cli['movil']);
							$objPHPExcel->getActiveSheet()->SetCellValue('G'.$nueve, $fila_dir['cp']);

							$objPHPExcel->getActiveSheet()->SetCellValue('D'.$diecinueve, $fila_usu['nombre']." ".$fila_usu['apellido']);
							$objPHPExcel->getActiveSheet()->SetCellValue('G'.$diecinueve, $fecha);
								$objDrawing = new PHPExcel_Worksheet_Drawing (); // crear objeto para el dibujo de la hoja de trabajo
								$objDrawing-> setName ('Firma del tecnico'); // establecer el nombre a la imagen
								$objDrawing-> setDescription ('Firma del tecnico'); // establecer la descripción a la imagen
								//$imagePath=ruta_request.'/firma.txt';
								$imagentemporal="firma-$folio.png";
				 				file_put_contents($imagentemporal, base64_decode($firma));
								//$imagen=base64_decode($firma);
								$signature = $imagentemporal; // Ruta a la firma archivo .jpg 
								$objDrawing-> setPath ($signature);
								$objDrawing-> setOffsetX (25); // setOffsetX funciona correctamente
								$objDrawing-> setOffsetY (10); // setOffsetY funciona correctamente
								$objDrawing-> setCoordinates ('D'.$diecinueve);// establece la imagen en la celda
								$objDrawing-> setWidth (62); // establecer ancho, altura
								$objDrawing-> setHeight (52);  
								$objDrawing-> setWorksheet ($objPHPExcel-> getActiveSheet ()); //salvar
							//$objPHPExcel->getActiveSheet()->SetCellValue('G18', $cp);

								$one=$one+$valorasumar;
								$tres=$tres+$valorasumar;
								$cinco=$cinco+$valorasumar3;
								$siete=$siete+$valorasumar4;
								$ocho=$ocho+$valorasumar4;
								$nueve=$nueve+$valorasumar4;
								$diecinueve=$diecinueve+$valorasumar2;
						}
		
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$foli2=str_replace(" ", "", $folio);;
			$ruta_save_excel=pdfs."/dictamen cfmm/rechazo-$foli2-$fecha.xlsx";
			$objWriter->save($ruta_save_excel);

			unlink($imagentemporal);//borramos imagen de la firma
			$name_dictamen="rechazo-$folio-2fecha.xlsx";
			if (file_exists($ruta_save_excel)) {
				self::guarda_dictamen($folio, $name_dictamen, 'rechazado');
				$array = array('status' =>'1' ,
								'descripción'=>'Al parecer todo salio bien',
								'ruta'=> "/dictamen cfmm/rechazo-$foli2-$fecha.xlsx");
			} else {
				$array = array('status' =>'0' ,
								'descripción'=>'Al parecer no se creo el archivo',
								'ruta'=> "sin ruta");
			}
			return $array;

			

	}
	private function guarda_orden($folio, $ruta){
		$data=$this->excel->set_ruta_orden($folio, $ruta);
		return $data;
	}
	private function guarda_dictamen($folio, $ruta, $status){
		$data=$this->excel->set_ruta_dictamen($folio, $ruta, $status);
		return $data;
	}

	public function create_check_ec($valor, $array, $objPHPExcel ){
		function cordenada($key){
			switch ($key) {
				case 0:
					$fila=6;
					break;
				case 1:
					$fila=8;
					break;
				case 2:
					$fila=10;
					break;
				case 3:
					$fila=12;
					break;
				case 4:
					$fila=14;
					break;
				case 5:
					$fila=17;
					break;
				case 6:
					$fila=19;
					break;
				case 7:
					$fila=21;
					break;
				case 8:
					$fila=23;
					break;
				case 9:
					$fila=25;
					break;
				default:
					$fila=6;
					break;
			}
			return $fila;
		}
		function colm($valor){
			switch ($valor) {
				case 1:
					$col='I';
					break;
				case 2:
					$col='J';
					break;
				case 3:
					$col='K';
					break;
				case 4:
					$col='L';
					break;
				case 5:
					$col='M';
					break;
				case 6:
					$col='N';
					break;		

				default:
					$col='I';
					# code...
					break;
			}
			return $col;

		}
			$contador=0;
			$columna='';
			$objPHPExcel->setActiveSheetIndex(1);
			//Modificamos los valoresde las celdas A2, B2 Y C2
			$valor=$objPHPExcel->getActiveSheet();
			$arraydecode= json_decode($array);
			//var_dump($arraydecode);
			foreach ($arraydecode[0] as $valor) {
				if($valor>0 and $valor!=''){
					$fila=cordenada($contador);
					$respuestas = explode("-", $valor);
					   foreach ($respuestas as $respuesta) {
					   		$columna=colm($respuesta);
					   		$celda=$columna. $fila;
					   		//echo $celda.'<br>';
							//$objPHPExcel->getActiveSheet()->SetCellValue($celda, 'x');
							//$objPHPExcel->getActiveSheet()->SetCellValue('B9', $valor->getCell("B9").' '.$numserie);

								$objDrawing = new PHPExcel_Worksheet_Drawing (); // crear objeto para el dibujo de la hoja de trabajo
								$objDrawing-> setName ('check'); // establecer el nombre a la imagen
								$objDrawing-> setDescription ('check'); // establecer la descripción a la imagen
								//$imagePath=ruta_request.'/firma.txt';
								$imagentemporal=templates."/flechita.png";
				 				//file_put_contents($imagentemporal, base64_decode($firma));
								//$imagen=base64_decode($firma);
								$signature = $imagentemporal; // Ruta a la firma archivo .jpg 
								$objDrawing-> setPath ($signature);
								$objDrawing-> setOffsetX (10); // setOffsetX funciona correctamente
								$objDrawing-> setOffsetY (10); // setOffsetY funciona correctamente
								$objDrawing-> setCoordinates ($celda);// establece la imagen en la celda
								$objDrawing-> setWidth (22); // establecer ancho, altura
								$objDrawing-> setHeight (22);  
								$objDrawing-> setWorksheet ($objPHPExcel-> getActiveSheet ()); //salvar
							//$objPHPExcel->getActiveSheet()->SetCellValue('G18', $cp);

						}
				}
					$contador++;


			}


	}
	public function  read_excel($name){
	    require ruta_config.'/Classes/PHPExcel/IOFactory.php';
		$archivo = templates.'/'.$name;
		$inputFileType = PHPExcel_IOFactory::identify($archivo);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($archivo);
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();

		function type_preg($cadena){

					$mystring = $cadena;
					$findme   = '{abierta}';
					$pos1 = strpos($mystring, $findme);

					$findme2   = '{opciones}';
					$pos2 = strpos($mystring, $findme2);
					
					$findme3   = '{time}';
					$pos3 = strpos($mystring, $findme3);

					$input='';
					if($pos1!== false){
							$cadena = str_replace($findme, "", $cadena);
							$input=$cadena."<input type='text'>";

					}
					if($pos2!== false){
						$cadena = str_replace($findme2, "", $cadena);
							$input=$cadena;
					}
					if($pos3!== false){
						$cadena = str_replace($findme3, "", $cadena);
						$input=  $cadena.'<input type="time" id="appt-time" name="appt-time"
             				  min="9:00" max="18:00" required />';
					}
					else if($pos1=== false and $pos2=== false and $pos3=== false){
						$input=$cadena."<input type='text'>";

					}
					return $input;

		}

		function type_respuesta($cadena){

					$mystring = $cadena;
					$findme   = '{option}';
					$pos1 = strpos($mystring, $findme);

					$input='';
					if($pos1!== false){
							$cadena = str_replace($findme, "", $cadena);
							$input=$cadena."<input type='checkbox' name=''>";
					}

					return $input;

		}
				function add_etiquetahtml($cadena){
					$mystring = $cadena;
					$findme   = '{titulo}';
					$pos1 = strpos($mystring, $findme);

					$findme2   = '{seccion}';
					$pos2 = strpos($mystring, $findme2);
					
					$findme3   = '{pregunta}';
					$pos3 = strpos($mystring, $findme3);

					$findme4   = '{respuesta}';
					$pos4 = strpos($mystring, $findme4);



					$etiqueta=$cadena;
					
					if($pos1!== false){//titulo
							$cadena = str_replace($findme, "", $cadena);
							$etiqueta="<strong>$cadena</strong>";

					}
					if($pos2!== false){//seccion
						$cadena = str_replace($findme2, "", $cadena);
							$etiqueta="<u>$cadena</u>";
					}
					if($pos3!== false){//pregunta
						$cadena = str_replace($findme3, "", $cadena);
						$etiqueta=type_preg($cadena);
					}
					if($pos4!== false){
						$cadena = str_replace($findme4, "", $cadena);
						$etiqueta=type_respuesta($cadena);;
					}

					return $etiqueta;


				}

		for ($row = 0; $row <= $highestRow; $row++){ 
				
				foreach( range('A', $highestColumn) as $tmp )
				{


				
						if($sheet->getCell($tmp.$row)->getValue()!=''){
							$cadena= $sheet->getCell($tmp.$row)->getValue();
								
								echo add_etiquetahtml($cadena);

						}
					
				}
				$x=$row;
				$x=$x-1;
				if($x==-1){
					$x=0;
				}

				$COPARAME= $sheet->getCell($tmp.$x)->getValue();
					//echo "<h1>$COPARAME</h1>";
				if($COPARAME!=''){
					//echo "<br><br>";

						//echo $sheet->getCell($tmp.$row)->getValue()." ete es el valor de $tmp.$row  ";
				}
				echo '<br>';
		}

	}

	public function sube_archivo($nombre, $nombre_temporal, $name_form){
		$new_nombre=$name_form.'.xlsx';
		$ruta=templates.'/'.$new_nombre;
		move_uploaded_file($nombre_temporal, $ruta );
		self::guarda_excel($new_nombre, $name_form);
		self::read_excel($new_nombre);
	}
	public function guarda_excel($ruta, $name_form){
		$data=$this->excel->verifica($name_form);
		if(mysqli_num_rows($data)>0){
			$this->excel->update($ruta, $name_form);
		}else{
			$this->excel->insert($ruta, $name_form);
		}
	}


}


?>