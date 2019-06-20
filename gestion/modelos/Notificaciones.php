<?php 
/**
 * 
 */

require "../config/conexion.php";

Class Notificaciones
{
	
	public function __construct()
	{
		# code...
	}

	public function cantidad(){

		$area = $_SESSION['usu_area_id'];

		$sql = "SELECT COUNT(not_id) AS cantidad FROM notificacones
			WHERE not_area_recibe_id = '$area' 
			AND not_leido = 0";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function mostrarnotificacion(){

		$area  = $_SESSION['usu_area_id'];

		$sql = "SELECT n.not_id,
			n.not_area_recibe_id,
			n.not_observación_id,
			n.not_leido,
			a.are_id,
			a.are_nombre,
			c.cat_pqr_id,
			c.cat_pqr_nombre
			FROM notificacones n 
			INNER JOIN area a 
			ON n.not_area_recibe_id = a.are_id
			INNER JOIN categoria_pgr c 
			ON c.cat_pqr_id = n.not_observación_id
			WHERE n.not_leido = 0 
			AND n.not_area_recibe_id = '$area' 
			ORDER BY n.not_id DESC";

		return ejecutarConsulta($sql);

	}

	public function leernotificacion($not_id){
		$sql = "UPDATE notificacones
				SET not_leido = '1'
				WHERE not_id = '$not_id'";

		return ejecutarConsulta($sql);

	}
}

 ?>