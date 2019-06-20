<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA
// 	categoria_pgr

// CAMPOS DE LA TABLA CATEGORIA
// 	cat_pqr_id
// 	cat_pqr_nombre
// 	cat_pqr_descripcion
// 	cat_pqr_tiempo_h
// 	cat_pqr_estado

// Incluir la conexion a BDs
require '../config/conexion.php';

Class Categoria {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar($cat_pqr_id, $cat_pqr_nombre, $cat_pqr_descripcion, $cat_pqr_tiempo_h){

		$sql = "INSERT INTO categoria_pgr (cat_pqr_id, cat_pqr_nombre, cat_pqr_descripcion, cat_pqr_tiempo_h)
			VALUES (null, '$cat_pqr_nombre', '$cat_pqr_descripcion', '$cat_pqr_tiempo_h')";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar($cat_pqr_id, $cat_pqr_nombre, $cat_pqr_descripcion, $cat_pqr_tiempo_h){

		$sql = "UPDATE categoria_pgr 
				SET cat_pqr_nombre = '$cat_pqr_nombre', 
					cat_pqr_descripcion = '$cat_pqr_descripcion', 
					cat_pqr_tiempo_h = '$cat_pqr_tiempo_h' 
				WHERE cat_pqr_id = '$cat_pqr_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($cat_pqr_id){
		$sql = "UPDATE categoria_pgr 
				SET cat_pqr_estado = '0'
				WHERE cat_pqr_id = '$cat_pqr_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($cat_pqr_id){
		$sql = "UPDATE categoria_pgr 
				SET cat_pqr_estado = '1'
				WHERE cat_pqr_id = '$cat_pqr_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($cat_pqr_id){
		$sql = "SELECT * FROM categoria_pgr
				WHERE cat_pqr_id = '$cat_pqr_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM categoria_pgr";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM categoria_pgr
				where cat_pqr_estado = 1";

		return ejecutarConsulta($sql);
	}

}


?>