<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	estado_pqr

// CAMPOS DE LA TABLA 
// 	est_pqr_id
// 	est_pqr_nombre
// 	est_pqr_descripcion
//  est_pqr_estado

// NOMBRE DE LA CLASE
// 	EstadoPqr

// AJAX
// 	estadoPqr
	
// Incluir la conexion a BDs
require '../config/conexion.php';

Class EstadoPqr {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar($est_pqr_id, $est_pqr_nombre, $est_pqr_descripcion){

		$sql = "INSERT INTO estado_pqr (est_pqr_id, est_pqr_nombre, est_pqr_descripcion)
			VALUES (null, '$est_pqr_nombre', '$est_pqr_descripcion')";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar($est_pqr_id, $est_pqr_nombre, $est_pqr_descripcion){

		$sql = "UPDATE estado_pqr 
				SET est_pqr_nombre = '$est_pqr_nombre', 
					est_pqr_descripcion = '$est_pqr_descripcion' 
				WHERE est_pqr_id = '$est_pqr_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($est_pqr_id){
		$sql = "UPDATE estado_pqr 
				SET est_pqr_estado = '0'
				WHERE est_pqr_id = '$est_pqr_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($est_pqr_id){
		$sql = "UPDATE estado_pqr 
				SET est_pqr_estado = '1'
				WHERE est_pqr_id = '$est_pqr_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($est_pqr_id){
		$sql = "SELECT * FROM estado_pqr
				WHERE est_pqr_id = '$est_pqr_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM estado_pqr";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM estado_pqr
				where est_pqr_estado = 1";

		return ejecutarConsulta($sql);
	}

}


?>