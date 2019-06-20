<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	tipo_documento

// CAMPOS DE LA TABLA 
// 	tip_doc_id
// 	tip_doc_nombre
// 	tip_doc_descripcion
// 	tip_doc_estado

// NOMBRE DE LA CLASE 
// 	TipoDocumento
	
// NAMES DE LOS INPUTS DEL FORM 
// 	tip_doc_id
// 	nombre
// 	desc

// Incluir la conexion a BDs
require '../config/conexion.php';

Class TipoDocumento {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar($tip_doc_id, $tip_doc_nombre, $tip_doc_descripcion){

		$sql = "INSERT INTO tipo_documento (tip_doc_id, tip_doc_nombre, tip_doc_descripcion)
			VALUES (null, '$tip_doc_nombre', '$tip_doc_descripcion')";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar($tip_doc_id, $tip_doc_nombre, $tip_doc_descripcion){

		$sql = "UPDATE tipo_documento 
				SET tip_doc_nombre = '$tip_doc_nombre', 
					tip_doc_descripcion = '$tip_doc_descripcion' 
				WHERE tip_doc_id = '$tip_doc_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($tip_doc_id){
		$sql = "UPDATE tipo_documento 
				SET tip_doc_estado = '0'
				WHERE tip_doc_id = '$tip_doc_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($tip_doc_id){
		$sql = "UPDATE tipo_documento 
				SET tip_doc_estado = '1'
				WHERE tip_doc_id = '$tip_doc_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($tip_doc_id){
		$sql = "SELECT * FROM tipo_documento
				WHERE tip_doc_id = '$tip_doc_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM tipo_documento";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM tipo_documento
				where tip_doc_estado = 1";

		return ejecutarConsulta($sql);
	}

}


?>