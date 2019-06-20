<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	tipo_vivienda

// CAMPOS DE LA TABLA 
// 	tip_viv_id
// 	tip_viv_nombre
// 	tip_viv_descripcion
// 	tip_viv_estado

// NOMBRE DE LA CLASE 
// 	TipoVivienda

// Incluir la conexion a BDs
require '../config/conexion.php';

Class TipoVivienda {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar($tip_viv_id, $tip_viv_nombre, $tip_viv_descripcion){

		$sql = "INSERT INTO tipo_vivienda (tip_viv_id, tip_viv_nombre, tip_viv_descripcion)
			VALUES (null, '$tip_viv_nombre', '$tip_viv_descripcion')";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar($tip_viv_id, $tip_viv_nombre, $tip_viv_descripcion){

		$sql = "UPDATE tipo_vivienda 
				SET tip_viv_nombre = '$tip_viv_nombre', 
					tip_viv_descripcion = '$tip_viv_descripcion' 
				WHERE tip_viv_id = '$tip_viv_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($tip_viv_id){
		$sql = "UPDATE tipo_vivienda 
				SET tip_viv_estado = '0'
				WHERE tip_viv_id = '$tip_viv_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($tip_viv_id){
		$sql = "UPDATE tipo_vivienda 
				SET tip_viv_estado = '1'
				WHERE tip_viv_id = '$tip_viv_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($tip_viv_id){
		$sql = "SELECT * FROM tipo_vivienda
				WHERE tip_viv_id = '$tip_viv_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM tipo_vivienda";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM tipo_vivienda
				where tip_viv_estado = 1";

		return ejecutarConsulta($sql);
	}

}


?>