<?php

/**
 * 
 */
class ctrl_historial extends padre
{
	public $tabla;
	public function __construct()
	{
		parent::__construct('historial');
		$this->tabla=pref.'historial';
	}
	public function select_todos($periodomayor, $periodomenor, $id_edificio){
		$fila=[];
		$fila2=[];
		$data=$this->historial->x_periodo_todos($periodomayor);
		while($f=mysqli_fetch_array($data)){
			$fila[]=$f;
		}
		$data2=$this->historial->x_periodo_todos($periodomenor);
		while($f2=mysqli_fetch_array($data2)){
			$fila2[]=$f2;
		}

		$arrayperiodomayor = array('periodomayor' =>$fila ,
								   'periodomenor'=>$fila2 );
		return $arrayperiodomayor;
	}
	public function select($periodomayor, $periodomenor, $id_edificio){
		$fila=[];
		$fila2=[];
		$data=$this->historial->x_periodo($periodomayor, $id_edificio);
		while($f=mysqli_fetch_array($data)){
			$fila[]=$f;
		}
		$data2=$this->historial->x_periodo($periodomenor, $id_edificio);
		while($f2=mysqli_fetch_array($data2)){
			$fila2[]=$f2;
		}

		$arrayperiodomayor = array('periodomayor' =>$fila ,
								   'periodomenor'=>$fila2 );
		return $arrayperiodomayor;


	}
	public function get_data(){
		$data=$this->historial->data();
		return self::rtn_data($data);
	}
	public function pdf($id){
		//traer lectura
		$data_lectura=$this->atajo->get_data('lectura', 'id_lectura', $id);
		$fila_lect=mysqli_fetch_array($data_lectura);
		//traer cliente de acuerdo al depto de la lectura
		self::includ_model('clientes');
		$data_cli=$this->clientes->cliente_iddepto($fila_lect['id_departamento']);
		$fila_cli=mysqli_fetch_array($data_cli);
		self::includ_model('precio');
		$data_precio=$this->precio->price_desde_dep($fila_lect['id_departamento']);
		$fila_precio=mysqli_fetch_array($data_precio);
		//folio
		self::includ_ctrl('folios');
		$folio=$this->folios->generate_folios();
		if( $fila_lect['foto']=='' or $fila_lect['foto']==null){
			$fila_lect['foto']=user_foto.'blanco.jpg';
		}
		$array_ruta_img=explode('/', $fila_lect['foto']);
		$key_upload=array_search('upload', $array_ruta_img);
		$historial=$this->historial->full_year();
		$data_empresa=$this->atajo->select('datos_empresa');
		$fila_empresa=mysqli_fetch_array($data_empresa);
		//aun no ocupo
		$cuota_admin=$this->atajo->selec_query_order_limit('cuota_admin');
		$factor=$this->atajo->selec_query_order_limit('factor');
		//historial
		$data=$this->historial->consumos($fila_lect['id_departamento']);
		$his="";
		include (ruta_config.'/numero_mes.php');
		while($fila_h=mysqli_fetch_array($data)){
			$mes11=substr($fila_h['periodo'], 3, 2);
			$mes_l11=letra_mes2($mes11);  
			$his.= " <strong style='padding-top: -50px; padding-bottom: -50px;'>* ".substr($mes_l11, 0,3) .'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$fila_h['consumos_litros'].' </strong> <br><br>';
		}
		//traer precio gas
		$data = array('cliente' =>  $fila_cli,
					  'lectura' =>  $fila_lect,
					  'precio_gas'=>$fila_precio['costo'],
					  'folio'=>     $folio[0]['folio'],
					  'ruta_img'=>  $array_ruta_img[$key_upload+1],
					  'historial'=> $his,
					  'fila_empresa' => $fila_empresa,
					  );
		$folio=$folio[0]['folio'];
		include (ruta_config.'/denumeroaletra.php');
		include(ruta_config.'/html2pdf-master/examples/example10.php');
		if(isset($ok)){
			$this->atajo->update('ruta_pdf', "$folio.pdf" , $id, 'lectura'); 
			self::send_mail($folio, $fila_cli['correo']);		
		}


	}
	public function send_mail($folio ,$destinatario){
		//$this->respuesta=0;
		//$data=$this->usuarios->select_usu_mail($destinatarios);
		//$fila=mysqli_fetch_array($data);
		//$psw='nada';
		require (ruta_config.'/phpmailer/class.phpmailer.php');
		include(ruta_config."/phpmailer/class.smtp.php");
			$mail = new PHPMailer();
			//$mail->SMTPDebug = SMTP::DEBUG_SERVER; para debuguera
			//$mail->SMTPDebug = 4; //Alternative to above constant
			//Luego tenemos que iniciar la validación por SMTP:
			$mail->IsSMTP();
			$mail->Host = "smtp.gmail.com"; // SMTP a utilizar. Por ej. smtp.elserver.com
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "ssl";
			$mail->Username = "grupomarvifetgas@gmail.com"; // Correo completo a utilizar
			$mail->Password = "samanogas"; // Contraseña
			$mail->Port = 465; // Puerto a utilizar
			//Con estas pocas líneas iniciamos una conexión con el SMTP. Lo que ahora deberíamos hacer, es configurar el mensaje a enviar, el //From, etc.
			$mail->From = "grupomarvifetgas@gmail.com"; // Desde donde enviamos (Para mostrar)
			$mail->FromName = "Marvifet ";
			$mail->addBCC('grupomarvifet_gas@yahoo.com');
			//Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: "From: Nombre <correo@dominio.com>") de //correo.
			$mail->AddAddress( $destinatario ); // Esta es la dirección a donde enviamos
			$mail->IsHTML(true); // El correo se envía como HTML
			$mail->Subject = 'Marvifet Gas'; // Este es el titulo del email.
			$mail->Body = 'Marvifet'; // Mensaje a enviar
			$mail->Body.='<br><br>Su estado de cuenta esta listo';
		
			$mail->AddAttachment(ruta_request."/PDF/$folio.pdf","$folio.pdf");
			$exito = $mail->Send(); // Envía el correo.
			//También podríamos agregar simples verificaciones para saber si se envió:
			if($exito){
				$this->respuesta=1;
				return $this->respuesta;
			}else{
				//echo "esta fallando";
				$this->respuesta=0;
				//echo 'Error de correo:'. $mail->ErrorInfo; 
				return $this->respuesta;
			}
	}
	public function data_grafica($id_departamento){
		$data=$this->historial->consumos($id_departamento);
		$periodos="";
		$consumos="";
		$periodos1="";
		$consumos1="";
		$count=1;
		include (ruta_config.'/numero_mes.php');

		while($fila=mysqli_fetch_array($data)){
			$mes1=substr($fila['periodo'], 3, 2);
			$mes_l1=letra_mes2($mes1);  
			$periodos1.=substr($mes_l1, 0,3) .', ';
			if($fila['consumos_litros']==""){
				$fila['consumos_litros']=0;
			}
			$consumos1.="$fila[consumos_litros], ";
			$count++;
		}
		for ($i=$count; $i < 5; $i++) { 
			$periodos.='S/N, ';
			$consumos.="0,";
		}
		return $periodos.$periodos1.'|'.$consumos.$consumos1;
	}
	public function total_lt($id_edificio, $periodo){
		if($id_edificio=='todos'){
			$data=$this->historial->total(">=0", $periodo);
		}else{
			$data=$this->historial->total("=$id_edificio", $periodo);
		}
		 return self::rtn_data($data);
	}
	public function get_historial_id($id_lectura){
		$data=$this->historial->get_historial_id($id_lectura);
		return self::rtn_data($data);
	}
	public function calculo($id_lectura){
		/*
		traer la lectura
		traer los periodos
		traer la lectura de un periodo anterior
		si no hay traer uno antes
		*/
		$data=$this->historial->get_historial_id($id_lectura);
		$fila_lect=mysqli_fetch_array($data);
		$data_lec_anterior=$this->atajo->selec_query('lectura', "id_departamento=$fila_lect[id_departamento] order by periodo DESC LIMIT 1, 1");
		$fila_lect_anterior=mysqli_fetch_array($data_lec_anterior);
		//precio gas
		$data_gas=$this->atajo->selec_query('precio_litros', "id_edificio=$fila_lect[id_edificio] order by fecha_register desc limit 1");
		$fila_gas=mysqli_fetch_array($data_gas);
		$precio_litro=$fila_gas['costo'];
		//factor
		$data_factor=$this->atajo->selec_where_order_limit('factor', "id_edificio=$fila_lect[id_edificio]");
		$fila_factor=mysqli_fetch_array($data_factor);
		$factor=$fila_factor['factor'];
		//cuota-admion
		$data_cuota_admin=$this->atajo->selec_where_order_limit('cuota_admin', "id_edificio=$fila_lect[id_edificio]");
		$fila_cuota_admin=mysqli_fetch_array($data_cuota_admin);
		$cuota_admin=$fila_cuota_admin['cuota'];
		//m3
		$consumom3=number_format($fila_lect['lectura_fin'] - $fila_lect_anterior['lectura_fin'], 2, '.', '');
		//lt
		$lt=number_format($consumom3 * $factor, 2, '.', '');
		//monto
		$monto=number_format($lt * $precio_litro, 2, '.', '');
		//total a pagar
		$formula=( floatval($monto) - floatval($fila_lect_anterior['saldo_favor']) + 
					floatval($fila_lect_anterior['adeudos']) + floatval($cuota_admin)
				  );
		$total_pagar=number_format($formula ,2, '.', '');

		$new_saldo_favor=0;
		if($fila_lect_anterior['saldo_favor'] > $total_pagar){
			$new_saldo_favor=$fila_lect_anterior['saldo_favor'] - $total_pagar;
		}
		$fecha = date('Y-m-j');
		$nuevafecha = strtotime ( '+1 month' , strtotime ( $fecha ) ) ;
		$fecha_limite='15-' .date ( 'm' , $nuevafecha ).'-'.$_SESSION['year'];

		 $response= $this->atajo->update('lectura_ini',    $fila_lect_anterior['lectura_fin'] ,    $id_lectura, 'lectura');
		 $response= $this->atajo->update('consumo_m3',     $consumom3  	   ,    $id_lectura, 'lectura');
		 $response= $this->atajo->update('consumos_litros',$lt	   	       ,    $id_lectura, 'lectura');
		 $response= $this->atajo->update('consumos_mes',   $consumom3      ,    $id_lectura, 'lectura');
		 $response= $this->atajo->update('saldo_favor',    $new_saldo_favor,    $id_lectura, 'lectura');
		 $response= $this->atajo->update('adeudos',        $fila_lect_anterior['adeudos']     ,    $id_lectura, 'lectura');
		 $response= $this->atajo->update('cuota_admin',    $cuota_admin     ,    $id_lectura, 'lectura');
		 $response= $this->atajo->update('fecha_limite',   $fecha_limite ,    $id_lectura, 'lectura');
		 $response= $this->atajo->update('monto',          $monto ,          $id_lectura, 'lectura');
		 $response= $this->atajo->update('total_a_pagar',  $total_pagar ,  $id_lectura, 'lectura');
	 
	}




}
?>