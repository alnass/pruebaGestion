<?php 
// # encoded by @Francisco Monsalve
// maintenance effectuee par Anderson Ferrucho

require '../config/conexion.php';

Class Cierres {

	public function __construct(){

	}


	public function insertarcierreparcial($usu_id){

		$sql = "INSERT INTO cierre_parcial (
				cie_par_id,
				cie_par_usuario_id
				)
				VALUES(
				null,
				'$usu_id'
				)
				";
		return ejecutarConsulta($sql);
	}

	public function efectivohoy($fecha_reporte){

		// date_default_timezone_set("America/Bogota");
		// $fecha = date("Y-m-d");

		$sede = $_SESSION['usu_sede_id'];

		$sql = "SELECT
				ec.est_cta_no_transaccion,
				ec.est_cta_debe,
				p.per_nombre,
				p.per_apellido,
				p.per_num_documento
				FROM estado_cuenta_fin ec
				INNER JOIN persona p 
				ON ec.est_cta_persona_id = p.per_id
				WHERE est_cta_sede_id = '$sede'
				AND DATE(est_cta_fecha_transacc) = '$fecha_reporte'
				AND est_cta_transaccion_id = '2'
				AND p.per_tipo_persona_id = 1";// maintenance

		return ejecutarConsulta($sql);
	}
	// Début maintenance

	public function efectivoMes($mes_inicio, $mes_fin){

		// date_default_timezone_set("America/Bogota");
		// $fecha = date("Y-m-d");

		$sede = $_SESSION['usu_sede_id'];

		$sql = "SELECT
				ec.est_cta_no_transaccion,
				ec.est_cta_debe,
				p.per_nombre,
				p.per_apellido,
				p.per_num_documento
				FROM estado_cuenta_fin ec
				INNER JOIN persona p 
				ON ec.est_cta_persona_id = p.per_id
				WHERE est_cta_sede_id = '$sede'
				AND DATE(est_cta_fecha_transacc) BETWEEN '$mes_inicio' AND '$mes_fin'
				AND est_cta_transaccion_id = '2'
				AND p.per_tipo_persona_id = 1";// maintenance

		return ejecutarConsulta($sql);
	}

	public function corporativosMes($mes_inicio, $mes_fin){

		// date_default_timezone_set("America/Bogota");
		// $fecha = date("Y-m-d");

		$sede = $_SESSION['usu_sede_id'];

		$sql = "SELECT
				ec.est_cta_no_transaccion,
				ec.est_cta_debe,
				p.per_nombre,
				p.per_apellido,
				p.per_num_documento,
				ct.con_tran_nombre
				FROM estado_cuenta_fin ec
				INNER JOIN persona p 
				ON ec.est_cta_persona_id = p.per_id
				INNER JOIN concepto_transaccion ct
				ON ec.est_cta_concep_trans_id = ct.con_tran_id
				WHERE est_cta_sede_id = '$sede'
				AND DATE(est_cta_fecha_transacc) BETWEEN '$mes_inicio' AND '$mes_fin'
				AND est_cta_transaccion_id = '3'
				AND p.per_tipo_persona_id = 2";// maintenance

		return ejecutarConsulta($sql);
	}

	public function corporativoshoy($fecha_reporte){

		// date_default_timezone_set("America/Bogota");
		// $fecha = date("Y-m-d");

		$sede = $_SESSION['usu_sede_id'];

		$sql = "SELECT
				ec.est_cta_no_transaccion,
				ec.est_cta_debe,
				p.per_nombre,
				p.per_apellido,
				p.per_num_documento
				FROM estado_cuenta_fin ec
				INNER JOIN persona p 
				ON ec.est_cta_persona_id = p.per_id
				WHERE est_cta_sede_id = '$sede'
				AND DATE(est_cta_fecha_transacc) = '$fecha_reporte'
				AND est_cta_transaccion_id = '2'
				AND p.per_tipo_persona_id = 2";// maintenance

		return ejecutarConsulta($sql);
	}


	public function descuentoshoy($fecha_reporte){

		// date_default_timezone_set("America/Bogota");
		// $fecha = date("Y-m-d");

		$sede = $_SESSION['usu_sede_id'];

		$sql = "SELECT
				ec.est_cta_no_transaccion,
				ec.est_cta_debe,
				p.per_nombre,
				p.per_apellido,
				p.per_num_documento,
				ct.con_tran_nombre
				FROM estado_cuenta_fin ec
				INNER JOIN persona p 
				ON ec.est_cta_persona_id = p.per_id
				INNER JOIN concepto_transaccion ct
				ON ec.est_cta_concep_trans_id = ct.con_tran_id
				WHERE est_cta_sede_id = '$sede'
				AND DATE(est_cta_fecha_transacc) = '$fecha_reporte'
				AND est_cta_transaccion_id = '6'
				";

		return ejecutarConsulta($sql);
	}

	public function bancoshoy($fecha_reporte){

		// date_default_timezone_set("America/Bogota");
		// $fecha = date("Y-m-d");

		$sede = $_SESSION['usu_sede_id'];

		$sql = "SELECT
				ec.est_cta_no_transaccion,
				ec.est_cta_debe,
				p.per_nombre,
				p.per_apellido,
				p.per_num_documento,
				ct.con_tran_nombre
				FROM estado_cuenta_fin ec
				INNER JOIN persona p 
				ON ec.est_cta_persona_id = p.per_id
				INNER JOIN concepto_transaccion ct
				ON ec.est_cta_concep_trans_id = ct.con_tran_id
				WHERE est_cta_sede_id = '$sede'
				AND DATE(est_cta_fecha_transacc) = '$fecha_reporte'
				AND est_cta_transaccion_id = '3'
				";

		return ejecutarConsulta($sql);
	}

	public function sede(){

		$sede = $_SESSION['usu_sede_id'];

		$sql = "SELECT sed_nombre
				FROM sede
				WHERE sed_id = '$sede'
				";
		return ejecutarConsulta($sql);
	}

	public function insertarcierrefinal($usu_id, $cie_fin_fecha, $sede_id, $cie_fin_observacion){

		$sql = "INSERT INTO cierre_final(
				cie_fin_id,
				cie_fin_usuario_id,
				cie_fin_fecha,
				cie_fin_sede_id,
				cie_fin_observacion
				)
				VALUES(
				null,
				'$usu_id',
				'$cie_fin_fecha',
				'$sede_id',
				'$cie_fin_observacion'
				)";

		return ejecutarConsulta($sql);
	}

	public function nombreSede($sede_id){
		$sql = "SELECT sed_nombre FROM sede WHERE sed_id = '$sede_id'";
		return ejecutarConsultaSimpleFila($sql);
	}
}

?>