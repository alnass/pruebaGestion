<?php 
// session_start();
// # encoded by 

//  equi_id 		
//  equi_referencia
//  equi_tipo_id	
//  equi_descripcion		
//  equi_fabricante_id_id		
//  equi_estado

// Incluir la conexion a BDs
require '../config/conexion.php';

Class Referencia 
{
		// Implimentacion de constructor
	public function __construct(){
	}

	// Implementacion de metodo de registro
	public function insertar(
			$equi_id, 
			$equi_referencia, 
			$equi_tipo_id, 
			$equi_descripcion,
			$equi_fabricante_id){

		$sql = "INSERT INTO equipo (
					equi_id, 
					equi_referencia, 
					equi_tipo_id, 
					equi_descripcion,
					equi_fabricante_id)
				VALUES (
					null, 
					'$equi_referencia', 
					'$equi_tipo_id', 
					'$equi_descripcion',
					'$equi_fabricante_id')";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar(
			$equi_id, 
			$equi_referencia, 
			$equi_tipo_id, 
			$equi_descripcion,
			$equi_fabricante_id){

		$sql = "UPDATE equipo 
				SET 
					equi_referencia 	= 	'$equi_referencia', 
					equi_tipo_id 		= 	'$equi_tipo_id', 
					equi_descripcion 	= 	'$equi_descripcion',
					equi_fabricante_id	= 	'$equi_fabricante_id' 
				WHERE
					equi_id 			= 	'$equi_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($equi_id){
		$sql = "UPDATE equipo 
				SET equi_estado = '0'
				WHERE equi_id = '$equi_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($equi_id){
		$sql = "UPDATE equipo 
				SET equi_estado = '1'
				WHERE equi_id = '$equi_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($equi_id){
		$sql = "SELECT * FROM equipo
				WHERE equi_id = '$equi_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	// public function listar(){
	// 	$sql = "SELECT * FROM equipo";

	// 	return ejecutarConsulta($sql);
	// }

	// Impementacion de metodo para listar registros activos
	public function listarActivos(){
		$sql = "SELECT * FROM equipo
				WHERE equi_estado = 1";

		return ejecutarConsulta($sql);
	}
	

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM equipo
				where equi_estado = 1";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros
	// RELACION DE LA TABLA equipo
	// ---------------------------------------------------------
	// |ALIAS 	|	TABLA 	 	|	CAMPO 	|RELACION			|
	// ---------------------------------------------------------
	// |c 		|equipo_tipo	|equi_tip_id|equi_tip_id		|
	// ---------------------------------------------------------
	// |a 		|fabricante		|fab_id 	|equi_fabricante_id	|
	// ---------------------------------------------------------

	public function listar(){
		$sql = "SELECT s.equi_id,
					s.equi_referencia,
					c.equi_tip_nombre,
					s.equi_descripcion,
					a.fab_nombre,
					s.equi_estado
					FROM equipo s
					INNER JOIN equipo_tipo c
					ON c.equi_tip_id =  s.equi_tipo_id
					INNER JOIN fabricante a
					ON a.fab_id =  s.equi_fabricante_id";

		return ejecutarConsulta($sql);
	}


	public function mostrarItems($equi_det_equipo_id)
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
					s.equi_det_equipo_id
					FROM equipo_detalle s
					INNER JOIN equipo a
					ON a.equi_id =  s.equi_det_equipo_id
					INNER JOIN equipo_estado c
					ON c.equi_est_id =  s.equi_det_estado_id
					INNER JOIN usuario_log d
					ON d.usu_id =  s.equi_det_usuario_id 
				WHERE equi_det_equipo_id = '$equi_det_equipo_id'";

		return ejecutarConsulta($sql);
	}

}


?>