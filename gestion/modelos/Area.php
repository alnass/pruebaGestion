<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	area

// CAMPOS DE LA TABLA 
// 	are_id
// 	are_nombre
// 	are_descripcion
//  are_correo
// 	are_estado

// NOMBRE DE LA CLASE
// 	Area 
	
// Incluir la conexion a BDs
require '../config/conexion.php';

Class Area {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar($are_id, $are_nombre, $are_descripcion, $are_correo){

		$sql = "INSERT INTO area (are_id, are_nombre, are_descripcion, are_correo)
			VALUES (null, '$are_nombre', '$are_descripcion', '$are_correo')";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar($are_id, $are_nombre, $are_descripcion, $are_correo){

		$sql = "UPDATE area 
				SET are_nombre = '$are_nombre', 
					are_descripcion = '$are_descripcion',
					are_correo = '$are_correo' 
				WHERE are_id = '$are_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($are_id){
		$sql = "UPDATE area 
				SET are_estado = '0'
				WHERE are_id = '$are_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($are_id){
		$sql = "UPDATE area 
				SET are_estado = '1'
				WHERE are_id = '$are_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($are_id){
		$sql = "SELECT * FROM area
				WHERE are_id = '$are_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM area";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM area
				where are_estado = 1";

		return ejecutarConsulta($sql);
	}

}


?>