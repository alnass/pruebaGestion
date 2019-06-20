<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	tipo_canal

// CAMPOS DE LA TABLA 
// 	tip_can_id
// 	tip_can_nombre
// 	tip_can_descripcion
// 	tip_can_estado

// NOMBRE DE LA CLASE 
// 	TipoCanal

// Incluir la conexion a BDs
require '../config/conexion.php';

Class TipoCanal {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar($tip_can_id, $tip_can_nombre, $tip_can_descripcion){

		$sql = "INSERT INTO tipo_canal (tip_can_id, tip_can_nombre, tip_can_descripcion)
			VALUES (null, '$tip_can_nombre', '$tip_can_descripcion')";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar($tip_can_id, $tip_can_nombre, $tip_can_descripcion){

		$sql = "UPDATE tipo_canal 
				SET tip_can_nombre = '$tip_can_nombre', 
					tip_can_descripcion = '$tip_can_descripcion' 
				WHERE tip_can_id = '$tip_can_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($tip_can_id){
		$sql = "UPDATE tipo_canal 
				SET tip_can_estado = '0'
				WHERE tip_can_id = '$tip_can_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($tip_can_id){
		$sql = "UPDATE tipo_canal 
				SET tip_can_estado = '1'
				WHERE tip_can_id = '$tip_can_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($tip_can_id){
		$sql = "SELECT * FROM tipo_canal
				WHERE tip_can_id = '$tip_can_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM tipo_canal";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM tipo_canal
				where tip_can_estado = 1";

		return ejecutarConsulta($sql);
	}
}


?>