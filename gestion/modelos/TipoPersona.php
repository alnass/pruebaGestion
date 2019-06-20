<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	tipo_persona

// CAMPOS DE LA TABLA 
// 	tip_per_id
// 	tip_per_nombre
// 	tip_per_descripcion
// 	tip_per_estado

// NOMBRE DE LA CLASE 
// 	TipoPersona

// Incluir la conexion a BDs
require '../config/conexion.php';

Class TipoPersona {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar($tip_per_id, $tip_per_nombre, $tip_per_descripcion){

		$sql = "INSERT INTO tipo_persona (tip_per_id, tip_per_nombre, tip_per_descripcion)
			VALUES (null, '$tip_per_nombre', '$tip_per_descripcion')";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar($tip_per_id, $tip_per_nombre, $tip_per_descripcion){

		$sql = "UPDATE tipo_persona 
				SET tip_per_nombre = '$tip_per_nombre', 
					tip_per_descripcion = '$tip_per_descripcion' 
				WHERE tip_per_id = '$tip_per_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($tip_per_id){
		$sql = "UPDATE tipo_persona 
				SET tip_per_estado = '0'
				WHERE tip_per_id = '$tip_per_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($tip_per_id){
		$sql = "UPDATE tipo_persona 
				SET tip_per_estado = '1'
				WHERE tip_per_id = '$tip_per_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($tip_per_id){
		$sql = "SELECT * FROM tipo_persona
				WHERE tip_per_id = '$tip_per_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM tipo_persona";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM tipo_persona
				where tip_per_estado = 1";

		return ejecutarConsulta($sql);
	}

}


?>