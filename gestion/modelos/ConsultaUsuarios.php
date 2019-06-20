<?php /*session_start();*/

/*
ord_trab_id 
ord_trab_fecha_elaboracion
ord_trab_fecha_programacion	
ord_trab_fecha_vencimiento
ord_trab_operacion_id
ord_trab_contrato_id
ord_trab_responsable_id
ord_trab_observacion
ord_estado
*/

// Se incluye la conexion a la BD

require '../config/conexion.php';

Class ConsultaUsuarios
{
	public function __construct(){
	}

	
	public function listar()
	{
		$sql = "SELECT `cont_estado_servicio_id`, 
				COUNT(*) as total FROM `contrato` 
				WHERE `cont_estado` = 1 
				GROUP BY `cont_estado_servicio_id` 
				ORDER BY cont_estado_servicio_id asc";

		return ejecutarConsulta($sql);
	}

	public function listarSanAntonio($servicio)
	{
		$sql = "SELECT `cont_estado_servicio_id`, 
				COUNT(*) as total FROM `contrato` 
				WHERE `cont_estado` = 1 
				AND cont_sede_id = 5
				AND cont_estado_servicio_id = '$servicio'
				GROUP BY `cont_estado_servicio_id` 
				ORDER BY cont_estado_servicio_id asc";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarFira($servicio)
	{
		$sql = "SELECT `cont_estado_servicio_id`, 
				COUNT(*) as total FROM `contrato` 
				WHERE `cont_estado` = 1 
				AND cont_sede_id = 8
				AND cont_estado_servicio_id = '$servicio'
				GROUP BY `cont_estado_servicio_id` 
				ORDER BY cont_estado_servicio_id asc";

		return ejecutarConsultaSimpleFila($sql);
	}
	
	public function listarIza($servicio)
	{
		$sql = "SELECT `cont_estado_servicio_id`, 
				COUNT(*) as total FROM `contrato` 
				WHERE `cont_estado` = 1 
				AND cont_sede_id = 10
				AND cont_estado_servicio_id = '$servicio'
				GROUP BY `cont_estado_servicio_id` 
				ORDER BY cont_estado_servicio_id asc";

		return ejecutarConsultaSimpleFila($sql);
	}
	public function listarPaipa($servicio)
	{
		$sql = "SELECT `cont_estado_servicio_id`, 
				COUNT(*) as total FROM `contrato` 
				WHERE `cont_estado` = 1 
				AND cont_sede_id = 9
				AND cont_estado_servicio_id = '$servicio'
				GROUP BY `cont_estado_servicio_id` 
				ORDER BY cont_estado_servicio_id asc";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarTiba($servicio)
	{
		$sql = "SELECT `cont_estado_servicio_id`, 
				COUNT(*) as total FROM `contrato` 
				WHERE `cont_estado` = 1 
				AND cont_sede_id = 6
				AND cont_estado_servicio_id = '$servicio'
				GROUP BY `cont_estado_servicio_id` 
				ORDER BY cont_estado_servicio_id asc";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarCorp($servicio)
	{
		$sql = "SELECT `cont_estado_servicio_id`, 
				COUNT(*) as total FROM `contrato` 
				WHERE `cont_estado` = 1 
				AND cont_sede_id = 11
				AND cont_estado_servicio_id = '$servicio'
				GROUP BY `cont_estado_servicio_id` 
				ORDER BY cont_estado_servicio_id asc";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarBogota($servicio)
	{
		$sql = "SELECT `cont_estado_servicio_id`, 
				COUNT(*) as total FROM `contrato` 
				WHERE `cont_estado` = 1 
				AND cont_sede_id = 3
				AND cont_estado_servicio_id = '$servicio'
				GROUP BY `cont_estado_servicio_id` 
				ORDER BY cont_estado_servicio_id asc";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarFomeque($servicio)
	{
		$sql = "SELECT `cont_estado_servicio_id`, 
				COUNT(*) as total FROM `contrato` 
				WHERE `cont_estado` = 1 
				AND cont_sede_id = 4
				AND cont_estado_servicio_id = '$servicio'
				GROUP BY `cont_estado_servicio_id` 
				ORDER BY cont_estado_servicio_id asc";

		return ejecutarConsultaSimpleFila($sql);
	}
	
	public function listarMadrid($servicio)
	{
		$sql = "SELECT `cont_estado_servicio_id`, 
				COUNT(*) as total FROM `contrato` 
				WHERE `cont_estado` = 1 
				AND cont_sede_id = 7
				AND cont_estado_servicio_id = '$servicio'
				GROUP BY `cont_estado_servicio_id` 
				ORDER BY cont_estado_servicio_id asc";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarTotal($servicio)
	{
		$sql = "SELECT `cont_estado_servicio_id`, 
				COUNT(*) as total FROM `contrato` 
				WHERE `cont_estado` = 1 
				AND cont_estado_servicio_id = '$servicio'
				GROUP BY `cont_estado_servicio_id` 
				ORDER BY cont_estado_servicio_id asc";

		return ejecutarConsultaSimpleFila($sql);
	}	

	
}


?>