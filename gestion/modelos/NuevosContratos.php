<?php  
// maintenance effectuee par Anderson Ferrucho
require "../config/conexion.php";

/**
 * 
 */
class NuevosContratos
{
	
	function __construct()
	{
		# code...
	}

	function traerMes(){
		$sql = "SELECT MONTH(cc_est_ser_fecha)
				AS fecha
				FROM cc_estado_servicio
				GROUP BY fecha";

		return ejecutarConsulta($sql);

	}
	// Début maintenance

	function nvoBogotaTv($mes){
		$sql = "SELECT COUNT(cnt.cont_id)
				AS cuenta,
				cnt.cont_estado_servicio_id,
				u.usu_id,
				u.usu_sede_id
				FROM contrato cnt 
				INNER JOIN usuario_log u
				ON u.usu_id = cnt.cont_usuario_id
				WHERE cnt.cont_sede_id = 3
				AND cnt.cont_estado_servicio_id = 2
				AND MONTH(cont_fecha_transaccion) = '$mes'
				AND cnt.cont_tv_analogica 	= 1";

		return ejecutarConsultaSimpleFila($sql);
	}

	function nvoPaipaTv($mes){
		$sql = "SELECT COUNT(cnt.cont_id)
				AS cuenta,
				cnt.cont_estado_servicio_id,
				u.usu_id,
				u.usu_sede_id
				FROM contrato cnt 
				INNER JOIN usuario_log u
				ON u.usu_id = cnt.cont_usuario_id
				WHERE cnt.cont_sede_id = 9
				AND cnt.cont_estado_servicio_id = 2
				AND MONTH(cont_fecha_transaccion) = '$mes'
				AND cnt.cont_tv_analogica 	= 1";

		return ejecutarConsultaSimpleFila($sql);
	}

	function nvoFiraTv($mes){
		$sql = "SELECT COUNT(cnt.cont_id)
				AS cuenta,
				cnt.cont_estado_servicio_id,
				u.usu_id,
				u.usu_sede_id
				FROM contrato cnt 
				INNER JOIN usuario_log u
				ON u.usu_id = cnt.cont_usuario_id
				WHERE cnt.cont_sede_id = 8
				AND cnt.cont_estado_servicio_id = 2
				AND MONTH(cont_fecha_transaccion) = '$mes'
				AND cnt.cont_tv_analogica 	= 1";

		return ejecutarConsultaSimpleFila($sql);
	}

	function nvoTibasosaTv($mes){
		$sql = "SELECT COUNT(cnt.cont_id)
				AS cuenta,
				cnt.cont_estado_servicio_id,
				u.usu_id,
				u.usu_sede_id
				FROM contrato cnt 
				INNER JOIN usuario_log u
				ON u.usu_id = cnt.cont_usuario_id
				WHERE cnt.cont_sede_id = 6
				AND cnt.cont_estado_servicio_id = 2
				AND MONTH(cont_fecha_transaccion) = '$mes'
				AND cnt.cont_tv_analogica 	= 1";

		return ejecutarConsultaSimpleFila($sql);
	}

	function nvoIzaTv($mes){
		$sql = "SELECT COUNT(cnt.cont_id)
				AS cuenta,
				cnt.cont_estado_servicio_id,
				u.usu_id,
				u.usu_sede_id
				FROM contrato cnt 
				INNER JOIN usuario_log u
				ON u.usu_id = cnt.cont_usuario_id
				WHERE cnt.cont_sede_id = 10
				AND cnt.cont_estado_servicio_id = 2
				AND MONTH(cont_fecha_transaccion) = '$mes'
				AND cnt.cont_tv_analogica 	= 1";

		return ejecutarConsultaSimpleFila($sql);
	}

	function nvoFomequeTv($mes){
		$sql = "SELECT COUNT(cnt.cont_id)
				AS cuenta,
				cnt.cont_estado_servicio_id,
				u.usu_id,
				u.usu_sede_id
				FROM contrato cnt 
				INNER JOIN usuario_log u
				ON u.usu_id = cnt.cont_usuario_id
				WHERE cnt.cont_sede_id = 4
				AND cnt.cont_estado_servicio_id = 2
				AND MONTH(cont_fecha_transaccion) = '$mes'
				AND cnt.cont_tv_analogica 	= 1";

		return ejecutarConsultaSimpleFila($sql);
	}

	function nvoSnAntonioTv($mes){
		$sql = "SELECT COUNT(cnt.cont_id)
				AS cuenta,
				cnt.cont_estado_servicio_id,
				u.usu_id,
				u.usu_sede_id
				FROM contrato cnt 
				INNER JOIN usuario_log u
				ON u.usu_id = cnt.cont_usuario_id
				WHERE cnt.cont_sede_id = 5
				AND cnt.cont_estado_servicio_id = 2
				AND MONTH(cont_fecha_transaccion) = '$mes'
				AND cnt.cont_tv_analogica 	= 1";

		return ejecutarConsultaSimpleFila($sql);
	}

	function nvoCorpTv($mes){
		$sql = "SELECT COUNT(cnt.cont_id)
				AS cuenta,
				cnt.cont_estado_servicio_id,
				u.usu_id,
				u.usu_sede_id
				FROM contrato cnt 
				INNER JOIN usuario_log u
				ON u.usu_id = cnt.cont_usuario_id
				WHERE cnt.cont_sede_id = 11
				AND cnt.cont_estado_servicio_id = 2
				AND MONTH(cont_fecha_transaccion) = '$mes'
				AND cnt.cont_tv_analogica 	= 1";

		return ejecutarConsultaSimpleFila($sql);
	}
	/// FIN CONTRATOS INTERNET

	/// CONTRATOS DE TV

	function nvoBogota($mes){
		$sql = "SELECT COUNT(cnt.cont_id)
				AS cuenta,
				cnt.cont_estado_servicio_id,
				u.usu_id,
				u.usu_sede_id
				FROM contrato cnt 
				INNER JOIN usuario_log u
				ON u.usu_id = cnt.cont_usuario_id
				WHERE cnt.cont_sede_id = 3
				AND cnt.cont_estado_servicio_id = 2
				AND MONTH(cont_fecha_transaccion) = '$mes'
				AND cnt.cont_internet = 1";

		return ejecutarConsultaSimpleFila($sql);
	}

	function nvoPaipa($mes){
		$sql = "SELECT COUNT(cnt.cont_id)
				AS cuenta,
				cnt.cont_estado_servicio_id,
				u.usu_id,
				u.usu_sede_id
				FROM contrato cnt 
				INNER JOIN usuario_log u
				ON u.usu_id = cnt.cont_usuario_id
				WHERE cnt.cont_sede_id = 9
				AND cnt.cont_estado_servicio_id = 2
				AND MONTH(cont_fecha_transaccion) = '$mes'
				AND cnt.cont_internet = 1";

		return ejecutarConsultaSimpleFila($sql);
	}

	function nvoFira($mes){
		$sql = "SELECT COUNT(cnt.cont_id)
				AS cuenta,
				cnt.cont_estado_servicio_id,
				u.usu_id,
				u.usu_sede_id
				FROM contrato cnt 
				INNER JOIN usuario_log u
				ON u.usu_id = cnt.cont_usuario_id
				WHERE cnt.cont_sede_id = 8
				AND cnt.cont_estado_servicio_id = 2
				AND MONTH(cont_fecha_transaccion) = '$mes'
				AND cnt.cont_internet = 1";

		return ejecutarConsultaSimpleFila($sql);
	}

	function nvoTibasosa($mes){
		$sql = "SELECT COUNT(cnt.cont_id)
				AS cuenta,
				cnt.cont_estado_servicio_id,
				u.usu_id,
				u.usu_sede_id
				FROM contrato cnt 
				INNER JOIN usuario_log u
				ON u.usu_id = cnt.cont_usuario_id
				WHERE cnt.cont_sede_id = 6
				AND cnt.cont_estado_servicio_id = 2
				AND MONTH(cont_fecha_transaccion) = '$mes'
				AND cnt.cont_internet = 1";

		return ejecutarConsultaSimpleFila($sql);
	}

	function nvoIza($mes){
		$sql = "SELECT COUNT(cnt.cont_id)
				AS cuenta,
				cnt.cont_estado_servicio_id,
				u.usu_id,
				u.usu_sede_id
				FROM contrato cnt 
				INNER JOIN usuario_log u
				ON u.usu_id = cnt.cont_usuario_id
				WHERE cnt.cont_sede_id = 10
				AND cnt.cont_estado_servicio_id = 2
				AND MONTH(cont_fecha_transaccion) = '$mes'
				AND cnt.cont_internet = 1";

		return ejecutarConsultaSimpleFila($sql);
	}

	function nvoFomeque($mes){
		$sql = "SELECT COUNT(cnt.cont_id)
				AS cuenta,
				cnt.cont_estado_servicio_id,
				u.usu_id,
				u.usu_sede_id
				FROM contrato cnt 
				INNER JOIN usuario_log u
				ON u.usu_id = cnt.cont_usuario_id
				WHERE cnt.cont_sede_id = 4
				AND cnt.cont_estado_servicio_id = 2
				AND MONTH(cont_fecha_transaccion) = '$mes'
				AND cnt.cont_internet = 1";

		return ejecutarConsultaSimpleFila($sql);
	}

	function nvoSnAntonio($mes){
		$sql = "SELECT COUNT(cnt.cont_id)
				AS cuenta,
				cnt.cont_estado_servicio_id,
				u.usu_id,
				u.usu_sede_id
				FROM contrato cnt 
				INNER JOIN usuario_log u
				ON u.usu_id = cnt.cont_usuario_id
				WHERE cnt.cont_sede_id = 5
				AND cnt.cont_estado_servicio_id = 2
				AND MONTH(cont_fecha_transaccion) = '$mes'
				AND cnt.cont_internet = 1";

		return ejecutarConsultaSimpleFila($sql);
	}

	function nvoCorp($mes){
		$sql = "SELECT COUNT(cnt.cont_id)
				AS cuenta,
				cnt.cont_estado_servicio_id,
				u.usu_id,
				u.usu_sede_id
				FROM contrato cnt 
				INNER JOIN usuario_log u
				ON u.usu_id = cnt.cont_usuario_id
				WHERE cnt.cont_sede_id = 11
				AND cnt.cont_estado_servicio_id = 2
				AND MONTH(cont_fecha_transaccion) = '$mes'
				AND cnt.cont_internet = 1";

		return ejecutarConsultaSimpleFila($sql);
	}
	// Fin maintenance
}
?>