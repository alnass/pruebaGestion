<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	tipo_pqr

// CAMPOS DE LA TABLA 
// 	tip_pqr_id
// 	tip_pqr_nombre
// 	tip_pqr_descripcion	
// 	tip_pqr_estado

// NOMBRE DE LA CLASE 
// 	TipoPqr

// Incluir la conexion a BDs
require '../config/conexion.php';

Class TipoPqr {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar($tip_pqr_id, $tip_pqr_nombre, $tip_pqr_descripcion){

		$sql = "INSERT INTO tipo_pqr (tip_pqr_id, tip_pqr_nombre, tip_pqr_descripcion)
			VALUES (null, '$tip_pqr_nombre', '$tip_pqr_descripcion')";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar($tip_pqr_id, $tip_pqr_nombre, $tip_pqr_descripcion){

		$sql = "UPDATE tipo_pqr 
				SET tip_pqr_nombre = '$tip_pqr_nombre', 
					tip_pqr_descripcion = '$tip_pqr_descripcion' 
				WHERE tip_pqr_id = '$tip_pqr_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($tip_pqr_id){
		$sql = "UPDATE tipo_pqr 
				SET tip_pqr_estado = '0'
				WHERE tip_pqr_id = '$tip_pqr_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($tip_pqr_id){
		$sql = "UPDATE tipo_pqr 
				SET tip_pqr_estado = '1'
				WHERE tip_pqr_id = '$tip_pqr_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($tip_pqr_id){
		$sql = "SELECT * FROM tipo_pqr
				WHERE tip_pqr_id = '$tip_pqr_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM tipo_pqr";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM tipo_pqr
				where tip_pqr_estado = 1";

		return ejecutarConsulta($sql);
	}

}


?>