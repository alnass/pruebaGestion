<?php  

require "../config/conexion.php";

/**
 * 
 */
class BdGeneral
{
	
	function __construct()
	{
		# code...
	}

	public function listar(){

		$sql = "SELECT
				c.cont_id,
				c.cont_no_contrato,
				c.cont_estado,
				c.cont_direccion_serv,
				c.cont_barrio,
				c.cont_estado_servicio_id,
				c.cont_valor_total_mes,
				c.cont_tv_analogica,
				c.cont_tv_digital,
				c.cont_internet,
				c.cont_sede_id,
				p.per_id,
				p.per_nombre,
				p.per_apellido,
				p.per_num_documento,
				p.per_telefono_1,
				s.sed_id,
				s.sed_nombre
			FROM contrato c 
			INNER JOIN persona p 
			ON c.cont_persona_id = p.per_id
			INNER JOIN sede s 
			ON s.sed_id = c.cont_sede_id
			";

		return ejecutarConsulta($sql);
	}

	public function saldos($cont_id){
		$sqlsaldos = "SELECT *	FROM estado_cuenta_fin
						WHERE est_cta_contrato_id = '$cont_id'
						ORDER BY est_cta_id DESC 
						LIMIT 1
						";

		return ejecutarConsultaSimpleFila($sqlsaldos);
	}



}

?>