<?php 
// # encoded by @Anderson Ferrucho
// maintenance effectuee par Anderson Ferrucho
require '../config/conexion.php';

Class Traslado {

	// Implimentacion de constructor
	public function __construct(){

	}

	public function insertar($usu_id, $sed_id, $concepto, $tip_matrl, $id_tabla)
	{
		$sql	= 	"INSERT INTO traslados (
						trasl_id,
						trasl_usu_id,
						trasl_sed_id,
						trasl_concepto,
						trasl_matrl_id,
						id_tabla
					)VALUES(
						null, 
						'$usu_id',
						'$sed_id',
						'$concepto',
						'$tip_matrl',
						'$id_tabla'
					)";

		if(ejecutarConsulta($sql))
		{
			return 	true;
		}
		else
		{
			return 	false;	
		}

	}

	public function trasladar_equipo(
			$equi_det_id, 
			$equi_det_sed_id){

		$sql = "UPDATE equipo_detalle 
				SET 
					equi_det_sede 			= 	'$equi_det_sed_id'	
				WHERE
					equi_det_id 			= 	'$equi_det_id'";

		return ejecutarConsulta($sql);
	}

	public function listarTraslados(){

		$sql = "SELECT * FROM traslados
				ORDER BY trasl_id DESC limit 1";

		return ejecutarConsultaSimpleFila($sql);
	}

}