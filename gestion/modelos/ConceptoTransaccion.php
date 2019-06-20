<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
	// concepto_transaccion
// 
// NOMBRE DE LOS CAMPOS
	// con_tran_id
	// con_tran_area_trans_id	
	// con_tran_transaccion_id
	// con_tran_nombre
	// con_tran_descripcion
	// con_tran_estado
// 
// NOMBRE DE LOS INPUTS 
	// con_tran_id 
	// tipo_trans
	// transaccion
	// tran_nombre
	// descripcion
// 
// NOMBRE DE LA CLASE 
	// ConceptoTransaccion 
// 
// NOMBRE DEL AJAX
	// conceptoTransaccion 
// 
// Incluir la conexion a BDs
require '../config/conexion.php';

Class ConceptoTransaccion {

	// Implimentacion de constructor
	public function _construct(){

	}

	// Implementacion de metodo de registro
	public function insertar(
		$con_tran_id,
		$con_tran_area_trans_id	,
		$con_tran_transaccion_id,
		$con_tran_nombre,
		$con_tran_descripcion
	){
		$sql = "INSERT INTO concepto_transaccion 
		(
			con_tran_id,
			con_tran_area_trans_id	,
			con_tran_transaccion_id,
			con_tran_nombre,
			con_tran_descripcion
		)
			 VALUES 
		(
			null,
			'$con_tran_area_trans_id',
			'$con_tran_transaccion_id',
			'$con_tran_nombre',
			'$con_tran_descripcion'	
		)";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar(
		$con_tran_id,
		$con_tran_area_trans_id	,
		$con_tran_transaccion_id,
		$con_tran_nombre,
		$con_tran_descripcion
	){

		$sql = "UPDATE concepto_transaccion 
				SET
				con_tran_area_trans_id	='$con_tran_area_trans_id',
				con_tran_transaccion_id	='$con_tran_transaccion_id',
				con_tran_nombre			='$con_tran_nombre',	
				con_tran_descripcion	='$con_tran_descripcion'
				
				WHERE con_tran_id = '$con_tran_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($con_tran_id){
		$sql = "UPDATE concepto_transaccion 
				SET con_tran_estado = '0'
				WHERE con_tran_id = '$con_tran_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($con_tran_id){
		$sql = "UPDATE concepto_transaccion 
				SET con_tran_estado = '1'
				WHERE con_tran_id = '$con_tran_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($con_tran_id){
		$sql = "SELECT * FROM concepto_transaccion
				WHERE con_tran_id = '$con_tran_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM concepto_transaccion";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function selectcaja(){
		$sql = "SELECT * FROM concepto_transaccion
				where con_tran_area_trans_id = 2";

		return ejecutarConsulta($sql);
	}
// Impementacion de metodo para listar registros y mostrar en el select
	public function selectntacredito(){
		$sql = "SELECT * FROM concepto_transaccion
				where con_tran_transaccion_id = 6";

		return ejecutarConsulta($sql);
	}
// Impementacion de metodo para listar registros y mostrar en el select
	public function selectntadebito(){
		$sql = "SELECT * FROM concepto_transaccion
				where con_tran_transaccion_id = 5";

		return ejecutarConsulta($sql);
	}

}


?>