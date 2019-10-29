<?php

/**
 * 
 */
class historial extends padreM
{
	
		public function __construct()
	{
		parent::__construct();

	}

	public function selec($periodo, $periodoanterior){
		$query="SELECT * FROM lectura
				as lec,
				departamentos as dep,
				edificios as edi
				where
				dep.id_departamento=lec.id_departamento
				and
				dep.id_edificio=edi.id_Edificio

				;
				";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function data(){
		$query="SELECT * FROM lectura
				as lec,
				departamentos as dep,
				edificios as edi
				where
				dep.id_departamento=lec.id_departamento
				and
				dep.id_edificio=edi.id_Edificio
				;
				";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function x_periodo_todos($periodo){
		$query="SELECT 
				coalesce(dep.id_departamento, 0) as id_departamento,
	coalesce(dep.num_departamento, 0) as num_departamento,
	coalesce(dep.id_edificio, 0) as id_edificio,
	coalesce(dep.id_cliente, 0) as id_cliente,
	coalesce(id_lectura, 0) as id_lectura,
	coalesce(foto, 0) as foto,
	coalesce(periodo, 0) as periodo,
	coalesce(lectura_ini, '') as lectura_ini,
	coalesce(consumos_litros, 0) as consumos_litros,
	coalesce(consumo_m3, 0) as consumo_m3,
	coalesce(fecha_limite, 0) as fecha_limite,
	coalesce(adeudos, 0) as adeudos,
	coalesce(ticket_pago, null) as ticket_pago,
	coalesce(monto, 0) as monto,
	coalesce(consumos_mes, 0) as consumos_mes,
	coalesce(saldo_favor, 0) as saldo_favor,
	coalesce(cuota_admin, 0) as cuota_admin,
	coalesce(cargos_add, 0) as cargos_add,
	coalesce(lectura_fin, '') as lectura_fin,
	coalesce(ruta_pdf, 0) as ruta_pdf,
	coalesce(pagado, 0) as pagado,
	coalesce(fecha_pago, 0) as fecha_pago,
	coalesce(total_a_pagar, 0) as total_a_pagar,
	coalesce(nombre, 0) as nombre,
	coalesce(ape_pat, 0) as ape_pat,
	coalesce(ape_mat, 0) as ape_mat,
	coalesce(telefono, 0) as telefono,
	coalesce(telefono_2, 0) as telefono_2,
	coalesce(convenio, 0) as convenio,
	coalesce(referencia, 0) as referencia,
	coalesce(correo, 0) as correo,
	coalesce(correo_2, 0) as correo_2,
	coalesce(num_edificio, 0) as num_edificio,
	coalesce(calle, 0) as calle,
	coalesce(num_ext, 0) as num_ext,
	coalesce(municipio, 0) as municipio,
	coalesce(colonia, 0) as colonia,
	coalesce(codigo_p, 0), codigo_p,
 	id_cuenta
			FROM
			departamentos as dep
	 		LEFT JOIN lectura as lect
   			ON dep.id_departamento = lect.id_departamento and
			periodo like '$periodo'
			LEFT JOIN clientes as cli
  			ON dep.id_cliente = cli.id_cliente
			LEFT JOIN edificios as edi
     		ON dep.id_edificio = edi.id_edificio
			 order by dep.id_departamento asc
			;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
		
	}
	public function x_periodo($periodo, $id_departamento){
	/*	$query="SELECT * FROM
		edificios as edi,	
		clientes as cli,
		departamentos as dep
		left join lectura
		on
		lectura.id_departamento=dep.id_departamento
		where
		dep.id_cliente=cli.id_cliente
		and
		dep.id_edificio=edi.id_Edificio
		and
		periodo
		like '$periodo'
		order by dep.id_departamento asc
		;";*/
		$query="SELECT * FROM
		edificios as edi,	
		clientes as cli,
		departamentos as dep,
		lectura as lect
		where
		lect.id_departamento=dep.id_departamento
		and
		dep.id_cliente=cli.id_cliente
		and
		dep.id_edificio=edi.id_Edificio
		and
		periodo
		like '$periodo'
		and lect.id_departamento=$id_departamento
		order by dep.id_departamento asc
		;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	public function full_year(){
		$query="SELECT * FROM lectura
				where
				periodo like '%$_SESSION[year]%';";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	} 
	public function consumos($id_departamento){
		$query="SELECT * FROM lectura
		where
		id_departamento=$id_departamento order by id_lectura asc limit 4;";
		$datos=$this->con->consultaRetorno($query);
		return $datos;
	}
	

}

?>
