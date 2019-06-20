<?php 
// session_start();
// # encoded by @Anderson Ferrucho 

//  equi_est_id 		
//  equi_est_nombre
//  equi_est_descripcion
//  equi_est_estado		

// Incluir la conexion a BDs
require '../config/conexion.php';

Class EquipoEstado
	{
		// Implimentacion de constructor
		public function __construct(){
	}

	// Implementacion de metodo de registro
	public function insertar(
			$equi_est_id, 
			$equi_est_nombre, 
			$equi_est_descripcion 
			){

		$sql = "INSERT INTO equipo_estado (
					equi_est_id, 
					equi_est_nombre, 
					equi_est_descripcion)
				VALUES (
					null, 
					'$equi_est_nombre', 
					'$equi_est_descripcion')";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar(
			$equi_est_id, 
			$equi_est_nombre, 
			$equi_est_descripcion){

		$sql = "UPDATE equipo_estado 
				SET 
					equi_est_nombre 		= 	'$equi_est_nombre', 
					equi_est_descripcion 	= 	'$equi_est_descripcion'
				WHERE
					equi_est_id 			= 	'$equi_est_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($equi_est_id){
		$sql = "UPDATE equipo_estado 
				SET equi_est_estado = '0'
				WHERE equi_est_id = '$equi_est_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($equi_est_id){
		$sql = "UPDATE equipo_estado 
				SET equi_est_estado = '1'
				WHERE equi_est_id = '$equi_est_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($equi_est_id){
		$sql = "SELECT * FROM equipo_estado
				WHERE equi_est_id = '$equi_est_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros
	public function listar(){
		$sql = "SELECT * FROM equipo_estado";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros activos
	public function listarActivos(){
		$sql = "SELECT * FROM equipo_estado
				WHERE equi_est_estado = 1";

		return ejecutarConsulta($sql);
	}
	

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM equipo_estado
				where equi_est_estado = 1";

		return ejecutarConsulta($sql);
	}


}


?>