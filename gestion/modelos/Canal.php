<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	canal

// CAMPOS DE LA TABLA 
// 	can_id
// 	can_nombre
// 	can_descripcion
// 	can_estado

// NOMBRE DE LA CLASE 
// 	Canal

// Incluir la conexion a BDs
require '../config/conexion.php';

Class Canal {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar($can_id, $can_nombre, $can_descripcion){

		$sql = "INSERT INTO canal (can_id, can_nombre, can_descripcion)
			VALUES (null, '$can_nombre', '$can_descripcion')";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar($can_id, $can_nombre, $can_descripcion){

		$sql = "UPDATE canal 
				SET can_nombre = '$can_nombre', 
					can_descripcion = '$can_descripcion' 
				WHERE can_id = '$can_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($can_id){
		$sql = "UPDATE canal 
				SET can_estado = '0'
				WHERE can_id = '$can_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($can_id){
		$sql = "UPDATE canal 
				SET can_estado = '1'
				WHERE can_id = '$can_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($can_id){
		$sql = "SELECT * FROM canal
				WHERE can_id = '$can_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM canal";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM canal
				where can_estado = 1";

		return ejecutarConsulta($sql);
	}

}


?>