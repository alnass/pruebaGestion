<?php 
// # encoded by @Francisco Monsalve


// Incluir la conexion a BDs
require '../config/conexion.php';

Class Consultas {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Impementacion de metodo para listar registros

//  DESCRIPCION DE RELACION DE CAMPOS
//  -------------------------------------------------------------------------------------
// 	| ALIAS	| TABLA 	   | CAMPO 		 | RELACION			|							|
//  -------------------------------------------------------------------------------------
		// 	| pq	|XXXXXXXXXXXXX | XXXXXXXXXXX | 					|reg_pqr_id 				|
		// 	| c 	|canal 		   | can_id 	 |can_nombre 		|reg_pqr_canal_id 			|
		// 	| t 	|tipo_canal    | tip_can_id  |tip_can_nombre 	|reg_pqr_tipo_canal_id 		|
		// 	| p 	|producto      | prod_id 	 |prod_nombre 		|reg_pqr_producto_id 		|
		// 	| q 	|tipo_pqr      | tip_pqr_id  |tip_pqr_nombre 	|reg_pqr_tipo_pqr_id 		|
		// 	| a 	|categoria_pgr | cat_pqr_id  |cat_pqr_nombre 	|reg_pqr_categoria_pqr_id 	|
		// 	| e 	|persona       | per_id 	 |per_num_documento	|reg_pqr_persona_id 		|
		// 	| r 	|area          | are_id		 |are_nombre 		|reg_pqr_remitido_id 		|
		// 	| pq	|XXXXXXXXXXXXX | XXXXXXXXXXX | 					|reg_pqr_num_radicado 		|
		// 	| pq	|XXXXXXXXXXXXX | XXXXXXXXXXX | 					|reg_pqr_fecha_inicio 		|
		// 	| pq	|XXXXXXXXXXXXX | XXXXXXXXXXX | 					|reg_pqr_fecha_remision 	|
		// 	| pq	|XXXXXXXXXXXXX | XXXXXXXXXXX | 					|reg_pqr_fecha_fin 			|
		// 	| pq	|XXXXXXXXXXXXX | XXXXXXXXXXX | 					|reg_pqr_ticket_interno 	|
		// 	| u 	|usuario_log   | usu_id		 | usu_num_documento|reg_pqr_operador_id 		|
		// 	| pq	|XXXXXXXXXXXXX | XXXXXXXXXXX | 					|reg_pqr_dias_respuesta 	|
		// 	| pq	|XXXXXXXXXXXXX | XXXXXXXXXXX | 					|reg_pqr_observacion 		|
		// 	| s 	|estado_pqr    | est_pqr_id	 | est_pqr_nombre 	|reg_pqr_estado_id 			|
		//  -------------------------------------------------------------------------------------

	public function pqrfecha($fechq_inicio, $fecha_fin){
		
		$sql = "SELECT
			pq.reg_pqr_id,
			c.can_nombre,
			t.tip_can_nombre,
			p.prod_nombre,
			q.tip_pqr_nombre,
			a.cat_pqr_nombre,
			e.per_num_documento,
			e.per_nombre,
			e.per_apellido,
			pq.reg_pqr_num_radicado,
			pq.reg_pqr_fecha_inicio,
			DATE(pq.reg_pqr_fecha_inicio),
			pq.reg_pqr_fecha_remision,
			pq.reg_pqr_fecha_fin,
			pq.reg_pqr_ticket_interno,
			u.usu_nombre,
			u.usu_apellido,
			pq.reg_pqr_dias_respuesta,
			pq.reg_pqr_observacion,
			s.est_pqr_nombre

			FROM registro_pqr pq
			INNER JOIN canal c
			ON pq.reg_pqr_canal_id = c.can_id
			INNER JOIN tipo_canal t
			ON pq.reg_pqr_tipo_canal_id = t.tip_can_id
			INNER JOIN producto p
			ON pq.reg_pqr_producto_id = p.prod_id
			INNER JOIN tipo_pqr  q 
			ON pq.reg_pqr_tipo_pqr_id = q.tip_pqr_id
			INNER JOIN categoria_pgr a
			ON pq.reg_pqr_categoria_pqr_id = a.cat_pqr_id
			INNER JOIN persona e
			ON pq.reg_pqr_persona_id = e.per_id
			INNER JOIN area r
			ON pq.reg_pqr_remitido_id = r.are_id
			INNER JOIN usuario_log u
			ON pq.reg_pqr_operador_id = u.usu_id
			INNER JOIN estado_pqr s
			ON pq.reg_pqr_estado_id = s.est_pqr_id
			WHERE DATE(pq.reg_pqr_fecha_inicio)>= '$fechq_inicio'
			AND DATE(pq.reg_pqr_fecha_inicio)<= '$fecha_fin'
			";

		return ejecutarConsulta($sql);
	}

	public function consultapagosefectivohoy($fechq_inicio, $fecha_fin){

		$sql = "SELECT
					ec.est_cta_fecha_transacc,
					DATE(ec.est_cta_fecha_transacc),
					p.per_num_documento,
					p.per_nombre,
					p.per_apellido,
					ct.con_tran_nombre,
					ec.est_cta_haber,
					ec.est_cta_debe,
					u.usu_nombre,
					u.usu_apellido
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN concepto_transaccion ct
			ON ec.est_cta_concep_trans_id = ct.con_tran_id
			INNER JOIN usuario_log u
			ON ec.est_cta_usuario_id = u.usu_id
			WHERE(ct.con_tran_reporte_id = 1)
			-- OR (est_cta_concep_trans_id = 2) 
			AND DATE(est_cta_fecha_transacc)>= '$fechq_inicio'
			AND DATE(est_cta_fecha_transacc)<= '$fecha_fin'

			-- WHERE DATE(est_cta_fecha_transacc)>= '$fechq_inicio'
			-- AND DATE(est_cta_fecha_transacc)<= '$fecha_fin'
			-- AND est_cta_concep_trans_id = 2
			-- OR ct.con_tran_transaccion_id = 6
			";

		return ejecutarConsulta($sql);
	}

	public function totalefectivo($fechq_inicio, $fecha_fin){
		$sql = "SELECT SUM(est_cta_debe)
			AS est_cta_debe
			FROM estado_cuenta_fin 
			WHERE est_cta_transaccion_id = 2
			AND DATE(est_cta_fecha_transacc)>= '$fechq_inicio'
			AND DATE(est_cta_fecha_transacc)<= '$fecha_fin'
			";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function totaledescuento($fechq_inicio, $fecha_fin){
		$sql = "SELECT SUM(est_cta_debe)
			AS est_cta_debe
			FROM estado_cuenta_fin 
			WHERE est_cta_transaccion_id = 6
			AND DATE(est_cta_fecha_transacc)>= '$fechq_inicio'
			AND DATE(est_cta_fecha_transacc)<= '$fecha_fin'

			";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function efectivoensedes($fechq_inicio, $fecha_fin){

		$sql = "SELECT 
				s.sed_nombre,
				c.ciu_nombre,
				COUNT(ec.est_cta_debe) AS registros,
				SUM(ec.est_cta_debe) AS efectivo
				FROM estado_cuenta_fin ec 
				INNER JOIN sede s
				ON ec.est_cta_sede_id = s.sed_id
				INNER JOIN ciudad c 
				ON c.ciu_id = s.sed_ciudad_id
				WHERE est_cta_transaccion_id = 2
				AND DATE(est_cta_fecha_transacc)>= '$fechq_inicio'
				AND DATE(est_cta_fecha_transacc)<= '$fecha_fin'
				GROUP BY est_cta_sede_id
				";

		return ejecutarConsulta($sql);
	}


	
}
?>