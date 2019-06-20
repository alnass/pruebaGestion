<?php 

// maintenance effectuee par Anderson Ferrucho

require "../config/conexion.php";

/**
 * 
 */
class CuentaCobro 
{
	
	function __construct()
	{
		
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
				p.per_tipo_persona_id,
				p.per_num_documento,
				p.per_nombre,
				p.per_apellido,
				p.per_num_documento,
				p.per_telefono_1,
				s.sed_id,
				s.sed_nombre,
				s.sed_direccion,
				es.est_serv_id,
				es.est_serv_cobro,
				c.cont_fecha_transaccion
			FROM contrato c 
			INNER JOIN persona p 
			ON c.cont_persona_id = p.per_id
			INNER JOIN sede s 
			ON c.cont_sede_id = s.sed_id
			INNER JOIN estado_servicio es
			ON es.est_serv_id = c.cont_estado_servicio_id
			WHERE c.cont_estado = 1
			AND p.per_tipo_persona_id = 1";

		return ejecutarConsulta($sql);
	}

// Début maintenance
	public function listarFiltrado(){

		$sede_id 	= 	$_SESSION['usu_sede_id'];

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
				p.per_tipo_persona_id,
				p.per_num_documento,
				p.per_nombre,
				p.per_apellido,
				p.per_num_documento,
				p.per_telefono_1,
				s.sed_id,
				s.sed_nombre,
				s.sed_direccion,
				es.est_serv_id,
				es.est_serv_cobro,
				c.cont_fecha_transaccion
			FROM contrato c 
			INNER JOIN persona p 
			ON c.cont_persona_id = p.per_id
			INNER JOIN sede s 
			ON c.cont_sede_id = s.sed_id
			INNER JOIN estado_servicio es
			ON es.est_serv_id = c.cont_estado_servicio_id
			WHERE p.per_tipo_persona_id = 1
			AND c.cont_estado_servicio_id = 2
			AND c.cont_sede_id = '$sede_id'";

		return ejecutarConsulta($sql);
	}

// fin maintenance

	public function prontopago($cont_id){

		$sql = "SELECT SUM(p.prod_valor_pronto_pago) 
				AS prod_valor_pronto_pago
				FROM producto p 
				INNER JOIN contrato_producto cp
				ON cp.cont_prod_producto_id = p.prod_id
				WHERE cont_prod_contrato_id = '$cont_id'
				";
		return  ejecutarConsultaSimpleFila($sql);
	}

	public function saldos($cont_id){
			$sql = "SELECT * FROM estado_cuenta_fin
						WHERE est_cta_contrato_id = '$cont_id'
						ORDER BY est_cta_id DESC 
						LIMIT 1
						";
			return ejecutarConsultaSimpleFila($sql);
	}


}



 ?>