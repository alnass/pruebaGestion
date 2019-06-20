<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	cargo

// CAMPOS DE LA TABLA 
// 	car_id
// 	car_nombre
// 	car_descripcion
// 	car_estado

// NOMBRE DE LA CLASE 
// 	Cargo

// AJAX
// 	cargo 

// Incluir la conexion a BDs
require '../config/conexion.php';

Class Cargo {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar($car_id, $car_nombre, $car_descripcion){

		$sql = "INSERT INTO cargo (car_id, car_nombre, car_descripcion)
			VALUES (null, '$car_nombre', '$car_descripcion')";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar($car_id, $car_nombre, $car_descripcion){

		$sql = "UPDATE cargo 
				SET car_nombre = '$car_nombre', 
					car_descripcion = '$car_descripcion' 
				WHERE car_id = '$car_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($car_id){
		$sql = "UPDATE cargo 
				SET car_estado = '0'
				WHERE car_id = '$car_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($car_id){
		$sql = "UPDATE cargo 
				SET car_estado = '1'
				WHERE car_id = '$car_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($car_id){
		$sql = "SELECT * FROM cargo
				WHERE car_id = '$car_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM cargo";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM cargo
				where car_estado = 1";

		return ejecutarConsulta($sql);
	}

}


?>