<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	tipo_cliente	

// CAMPOS DE LA TABLA 
// 	tip_cli_id
// 	tip_cli_nombre
// 	tip_cli_descripcion
// 	tip_cli_estado

// NOMBRE DE LA CLASE
// 	TipoCliente

// Incluir la conexion a BDs
require '../config/conexion.php';

Class TipoCliente {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar($tip_cli_id, $tip_cli_nombre, $tip_cli_descripcion){

		$sql = "INSERT INTO tipo_cliente (tip_cli_id, tip_cli_nombre, tip_cli_descripcion)
			VALUES (null, '$tip_cli_nombre', '$tip_cli_descripcion')";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar($tip_cli_id, $tip_cli_nombre, $tip_cli_descripcion){

		$sql = "UPDATE tipo_cliente 
				SET tip_cli_nombre = '$tip_cli_nombre', 
					tip_cli_descripcion = '$tip_cli_descripcion' 
				WHERE tip_cli_id = '$tip_cli_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($tip_cli_id){
		$sql = "UPDATE tipo_cliente 
				SET tip_cli_estado = '0'
				WHERE tip_cli_id = '$tip_cli_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($tip_cli_id){
		$sql = "UPDATE tipo_cliente 
				SET tip_cli_estado = '1'
				WHERE tip_cli_id = '$tip_cli_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($tip_cli_id){
		$sql = "SELECT * FROM tipo_cliente
				WHERE tip_cli_id = '$tip_cli_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM tipo_cliente";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM tipo_cliente
				where tip_cli_estado = 1";

		return ejecutarConsulta($sql);
	}

}


?>