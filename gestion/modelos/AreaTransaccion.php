<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	area_transaccion

// NOMBRE DE LOS CAMPOS
// 	are_tran_id
// 	are_tran_nombre	
// 	are_are_tran_estado
// 	are_tran_estado

// NOMBRE DE LOS INPUTS
// 	are_tran_id
// 	aretrannombre	
// 	aretrandescripcion

// NOMBRE DE LA CLASE 
// 	AreaTransaccion 

// NOMBRE DEL AJAX
// 	areatRansaccion

// Incluir la conexion a BDs
require '../config/conexion.php';

Class AreaTransaccion {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar(
		$are_tran_id, 
		$are_tran_nombre, 
		$are_tran_estado
	){

		$sql = "INSERT INTO area_transaccion (
			are_tran_id, 
			are_tran_nombre, 
			are_tran_estado
			)
		VALUES (
			null, 
			'$are_tran_nombre', 
			'$are_tran_estado'
		)";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar(
		$are_tran_id, 
		$are_tran_nombre, 
		$are_tran_estado
	){

		$sql = "UPDATE area_transaccion 
				SET are_tran_nombre = '$are_tran_nombre', 
					are_tran_estado = '$are_tran_estado' 
				WHERE are_tran_id = '$are_tran_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($are_tran_id){
		$sql = "UPDATE area_transaccion 
				SET are_tran_estado = '0'
				WHERE are_tran_id = '$are_tran_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($are_tran_id){
		$sql = "UPDATE area_transaccion 
				SET are_tran_estado = '1'
				WHERE are_tran_id = '$are_tran_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($are_tran_id){
		$sql = "SELECT * FROM area_transaccion
				WHERE are_tran_id = '$are_tran_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM area_transaccion";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM area_transaccion
				where are_tran_estado = 1";

		return ejecutarConsulta($sql);
	}

}

?>