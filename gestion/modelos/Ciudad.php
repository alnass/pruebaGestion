<?php 
// # encoded by @Francisco Monsalve

// Incluir la conexion a BDs
require '../config/conexion.php';

Class Ciudad {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar($ciu_id, $ciu_nombre, $ciu_departamento, $ciu_descripcion){

		$sql = "INSERT INTO ciudad (ciu_id, ciu_nombre, ciu_departamento, ciu_descripcion)
			VALUES (null, '$ciu_nombre', '$ciu_departamento', '$ciu_descripcion')";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar($ciu_id, $ciu_nombre, $ciu_departamento, $ciu_descripcion){

		$sql = "UPDATE ciudad 
				SET ciu_nombre = '$ciu_nombre', 
					ciu_departamento = '$ciu_departamento', 
					ciu_descripcion = '$ciu_descripcion' 
				WHERE ciu_id = '$ciu_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($ciu_id){
		$sql = "UPDATE ciudad 
				SET ciu_estado = '0'
				WHERE ciu_id = '$ciu_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($ciu_id){
		$sql = "UPDATE ciudad 
				SET ciu_estado = '1'
				WHERE ciu_id = '$ciu_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($ciu_id){
		$sql = "SELECT * FROM ciudad
				WHERE ciu_id = '$ciu_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM ciudad";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM ciudad
				where ciu_estado = 1";

		return ejecutarConsulta($sql);
	}

}


?>