<?php 
// # encoded by @Francisco Monsalve
// 
// NOMBRE DE LA TABLA
		// transaccion
// 
// NOMBRE DE LOS CAMPOS
		// tran_id	
		// tran_nombre		
		// tran_descripcion
		// tran_estado
// 
// NOMBRE DE LOS INPUTS
		// tran_id
		// nombre 
		// descripcion 
// 
// NOMBRE DE LA CLASE 
		// Transaccion
// 
// NOMBRE DEL AJAX
		// transaccion

// Incluir la conexion a BDs

require '../config/conexion.php';

Class Transaccion {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar(
		$tran_id, 
		$tran_nombre, 
		$tran_descripcion
	){

		$sql = "INSERT INTO transaccion (
			tran_id, 
			tran_nombre, 
			tran_descripcion
			)
		VALUES (
			null, 
			'$tran_nombre', 
			'$tran_descripcion'
		)";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar(
		$tran_id, 
		$tran_nombre, 
		$tran_descripcion
	){

		$sql = "UPDATE transaccion 
				SET tran_nombre = '$tran_nombre', 
					tran_descripcion = '$tran_descripcion' 
				WHERE tran_id = '$tran_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($tran_id){
		$sql = "UPDATE transaccion 
				SET tran_estado = '0'
				WHERE tran_id = '$tran_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($tran_id){
		$sql = "UPDATE transaccion 
				SET tran_estado = '1'
				WHERE tran_id = '$tran_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($tran_id){
		$sql = "SELECT * FROM transaccion
				WHERE tran_id = '$tran_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM transaccion";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM transaccion
				where tran_estado = 1";

		return ejecutarConsulta($sql);
	}

}


?>