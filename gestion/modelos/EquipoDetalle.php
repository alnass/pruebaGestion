<?php 
// session_start();
// # encoded by @Anderson Ferrucho 

/*
equi_det_equipo_id
equi_det_estado_id
equi_det_fecha_entrada
equi_det_fecha_registro
equi_det_id
equi_det_mac
equi_det_sn
equi_det_tip_equi_id
equi_det_usuario_id
*/

// Incluir la conexion a BDs
require '../config/conexion.php';

Class EquipoDetalle
	{
		// Implimentacion de constructor
		public function __construct()
		{
		
		}

	// Implementacion de metodo de registro
	public function insertar(
			$equi_det_id, 
			$equi_det_equipo_id, 
			$equi_det_mac, 
			$equi_det_sn,
			$equi_det_fecha_entrada,
			$equi_det_usuario_id,
			$equi_det_estado_id,
			$equi_det_remision_no,
			$equi_det_movimiento
		){

		$sede_usu 	=	$_SESSION['usu_sede_id'];

		$sql = "INSERT INTO equipo_detalle (
					equi_det_id, 
					equi_det_equipo_id, 
					equi_det_mac, 
					equi_det_sn,
					equi_det_fecha_entrada,
					equi_det_usuario_id,
					equi_det_estado_id,
					equi_det_movimiento_id,
					equi_det_remision_in,
					equi_det_sede
					)
				VALUES (
					null, 
					'$equi_det_equipo_id', 
					'$equi_det_mac', 
					'$equi_det_sn',
					'$equi_det_fecha_entrada',
					'$equi_det_usuario_id',
					'$equi_det_estado_id',
					'$equi_det_movimiento',
					'$equi_det_remision_no',
					'$sede_usu'
				)";
				
				$ultimo		=	ejecutarConsulta_retornaID($sql);

		$sql_cc	=	"INSERT INTO cc_equipo (
					cc_equi_id, 
					cc_equi_equip_id, 
					cc_equi_usu_id,
					cc_equi_mov_inv_id,
					cc_equi_sede_id,
					cc_equi_observacion
					)
				VALUES (
					null, 
					'$ultimo', 
					'$equi_det_usuario_id', 
					'1',
					'$sede_usu',
					'NUEVO EQUIPO'
				)";

		ejecutarConsulta($sql_cc);

		return true;
	}

	// Implementacion de metodo de edicion
	public function editar(
			$equi_det_id, 
			$equi_det_equipo_id, 
			$equi_det_mac, 
			$equi_det_sn,
			$equi_det_fecha_entrada,
			$equi_det_usuario_id,
			$equi_det_estado_id,
			$equi_det_remision_no,
			$equi_det_movimiento){

		$sede_usu 	=	$_SESSION['usu_sede_id'];

		$sql = "UPDATE equipo_detalle 
				SET 
					equi_det_equipo_id 		= 	'$equi_det_equipo_id', 
					equi_det_mac 			= 	'$equi_det_mac', 
					equi_det_sn 			= 	'$equi_det_sn',
					equi_det_fecha_entrada	= 	'$equi_det_fecha_entrada',
					equi_det_usuario_id		= 	'$equi_det_usuario_id',
					equi_det_estado_id		= 	'$equi_det_estado_id',
					equi_det_movimiento_id	= 	'$equi_det_movimiento',
					equi_det_remision_in	= 	'$equi_det_remision_no',
					equi_det_sede 			= 	'$sede_usu'	
				WHERE
					equi_det_id 			= 	'$equi_det_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	// public function desactivar($equi_det_id){
	// 	$sql = "UPDATE equipo_detalle 
	// 			SET equi_det_estado_id = '0'
	// 			WHERE equi_det_id = '$equi_det_id'";

	// 	return ejecutarConsulta($sql);
	// }

	// Implementacion de metodo de activacion
	// public function activar($equi_det_id){
	// 	$sql = "UPDATE equipo_detalle 
	// 			SET equi_det_estado_id = '1'
	// 			WHERE equi_det_id = '$equi_det_id'";

	// 	return ejecutarConsulta($sql);
	// }

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($equi_det_id){
		$sql = "SELECT * FROM equipo_detalle
				WHERE equi_det_id = '$equi_det_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarMovimiento(){
		$sql = "SELECT * FROM movimiento_inventario 
				WHERE mv_inv_tip_mov_id = 1";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros activos
	public function listarActivos(){

		$sede_usu 	=	$_SESSION['usu_sede_id'];

		$sql = "SELECT * FROM equipo_detalle
				WHERE equi_estado = 1
				AND equi_det_sede = '$sede_usu'";

		return ejecutarConsulta($sql);
	}
	

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM equipo_detalle
				where equi_estado = 1";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros
	// RELACION DE LA TABLA equipo
	// -----------------------------------------------------------------
	// |ALIAS 	|	TABLA 	 	|	CAMPO 			|	RELACION		|
	// ------------------------------------------------------------------
	// |a 		|equipo 		|equi_referencia	|equi_det_equipo_id	 |
	// ------------------------------------------------------------------
	// |b 		|equipo_tipo	|equi_tip_nombre	|equi_det_tip_equi_id|
	// ------------------------------------------------------------------
	// |c 		|equipo_estado	|equi_est_nombre	|equi_det_estado_id	 |
	// ------------------------------------------------------------------
	// |d 		|usuario_log	|usu_nombre			|equi_det_usuario_id |
	// ------------------------------------------------------------------

	public function listarSede()
	{

		$sql = "SELECT * FROM sede
					WHERE sed_estado = 1";

		return ejecutarConsulta($sql);
	}	


	public function listar()
	{

		$sede_usu 	=	$_SESSION['usu_sede_id'];

		if($_SESSION['usu_area_id'] == 7 || $_SESSION['usu_area_id'] == 4)
		{
			$sql = "SELECT s.equi_det_id,
						a.equi_referencia,
						s.equi_det_mac,
						s.equi_det_sn,
						s.equi_det_fecha_entrada,
						s.equi_det_fecha_registro,
						d.usu_nombre,
						c.equi_est_nombre,
						s.equi_det_estado_id,
						s.equi_det_equipo_id,
						sed.sed_nombre
						FROM equipo_detalle s
						INNER JOIN equipo a
						ON a.equi_id =  s.equi_det_equipo_id
						INNER JOIN equipo_estado c
						ON c.equi_est_id =  s.equi_det_estado_id
						INNER JOIN usuario_log d
						ON d.usu_id =  s.equi_det_usuario_id
						INNER JOIN sede sed
						ON s.equi_det_sede =  sed.sed_id";

			return ejecutarConsulta($sql);
		}
		else if($_SESSION['usu_area_id'] == 9)
		{
			$sql = "SELECT s.equi_det_id,
						a.equi_referencia,
						s.equi_det_mac,
						s.equi_det_sn,
						s.equi_det_fecha_entrada,
						s.equi_det_fecha_registro,
						d.usu_nombre,
						c.equi_est_nombre,
						s.equi_det_estado_id,
						s.equi_det_equipo_id,
						sed.sed_nombre
						FROM equipo_detalle s
						INNER JOIN equipo a
						ON a.equi_id =  s.equi_det_equipo_id
						INNER JOIN equipo_estado c
						ON c.equi_est_id =  s.equi_det_estado_id
						INNER JOIN usuario_log d
						ON d.usu_id =  s.equi_det_usuario_id
						INNER JOIN sede sed
						ON s.equi_det_sede =  sed.sed_id
						WHERE equi_det_sede = 9
						OR equi_det_sede = 6
						OR equi_det_sede = 8
						OR equi_det_sede = 10";

			return ejecutarConsulta($sql);
		}
		else
		{
			$sql = "SELECT s.equi_det_id,
						a.equi_referencia,
						s.equi_det_mac,
						s.equi_det_sn,
						s.equi_det_fecha_entrada,
						s.equi_det_fecha_registro,
						d.usu_nombre,
						c.equi_est_nombre,
						s.equi_det_estado_id,
						s.equi_det_equipo_id,
						sed.sed_nombre
						FROM equipo_detalle s
						INNER JOIN equipo a
						ON a.equi_id =  s.equi_det_equipo_id
						INNER JOIN equipo_estado c
						ON c.equi_est_id =  s.equi_det_estado_id
						INNER JOIN usuario_log d
						ON d.usu_id =  s.equi_det_usuario_id
						INNER JOIN sede sed
						ON s.equi_det_sede =  sed.sed_id
						WHERE equi_det_sede = '$sede_usu'";

			return ejecutarConsulta($sql);
		}
	}

	public function listarInstalados()
	{
		$sql = "SELECT s.equi_det_id,
					a.equi_referencia,
					s.equi_det_mac,
					s.equi_det_sn,
					d.usu_nombre,
					c.equi_est_nombre,
					s.equi_det_estado_id,
					s.equi_det_equipo_id,
					oted.ot_equi_ord_trab_id,
					oted.ot_equi_fecha_registro,
					ot.ord_trab_contrato_id,
					con.cont_persona_id,
					con.cont_no_contrato,
					p.per_nombre,
					p.per_apellido,
					oted.ot_equi_propiedad
					FROM equipo_detalle s
					INNER JOIN equipo a
					ON a.equi_id =  s.equi_det_equipo_id
					INNER JOIN equipo_estado c
					ON c.equi_est_id =  s.equi_det_estado_id
					INNER JOIN orden_trabajo_equipo oted
					ON oted.ot_equi_equi_det_id =  s.equi_det_id
					INNER JOIN orden_trabajo ot
					ON ot.ord_trab_id =  oted.ot_equi_ord_trab_id
					INNER JOIN contrato con
					ON con.cont_id =  ot.ord_trab_contrato_id
					INNER JOIN persona p
					ON p.per_id =  con.cont_persona_id
					INNER JOIN usuario_log d
					ON d.usu_id =  s.equi_det_usuario_id
					where oted.ot_equi_estado 	= 	1";

		return ejecutarConsulta($sql);
	}

	public function contarItems($equi_det_equipo_id)
	{
		$sql = "SELECT count(equi_det_mac) FROM equipo_detalle 
				WHERE equi_det_equipo_id = '$equi_det_equipo_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

}


?>