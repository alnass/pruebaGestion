<?php 

require '../config/conexion.php';

Class Promocion {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar( 
			$prom_nombre_corto, 
			$prom_descripcion, 
			$prom_usu_id
		){

		$sql = "INSERT INTO promocion (
					prom_id, 
					prom_nombre_corto, 
					prom_descripcion, 
					prom_usu_id,	
					prom_estado
 					)
				VALUES (
					null, 
					'$prom_nombre_corto', 
					'$prom_descripcion', 
					'$prom_usu_id',
					1
 				)";

 		print_r($sql);
 		die();
		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar(
			$prom_id, 
			$prom_nombre_corto, 
			$prom_descripcion, 
			$prom_usu_id
		){

		$sql = "UPDATE promocion 
				SET prom_nombre_corto = '$prom_nombre_corto', 
					prom_descripcion = '$prom_descripcion', 
					prom_usu_id = '$prom_usu_id',
				WHERE prom_id = '$prom_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($prom_id){
		$sql = "UPDATE promocion 
				SET prom_estado = '0'
				WHERE prom_id = '$prom_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($prom_id){
		$sql = "UPDATE promocion 
				SET prom_estado = '1'
				WHERE prom_id = '$prom_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($prom_id){
		$sql = "SELECT * FROM promocion
				WHERE prom_id = '$prom_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM promocion";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros activos
	public function listarActivos(){
		$sql = "SELECT * FROM promocion
				WHERE prom_estado = 1";

		return ejecutarConsulta($sql);
	}

}


?>