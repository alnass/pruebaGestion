<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	alianza

// CAMPOS DE LA TABLA 
// 	ali_id
// 	ali_nombre
// 	ali_descripcion
// 	ali_estado

// NOMBRE DE LA CLASE
// 	Alianza

// AJAX
// 	alianza

// Incluir la conexion a BDs
require '../config/conexion.php';

Class Alianza {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar(
		$ali_id, 
		$ali_nombre,
		$ali_no_documento,
		$ali_descripcion,
		$ali_num_contacto,
		$ali_nombre_contacto,
		$ali_apellido_contacto,
		$ali_correo_contacto,
		$ali_correo_corporativo,
		$ali_telefono_oficina,
		$ali_direccion_oficina,
		$ali_ciudad_id,
		$ali_barrio,
		$ali_cobertura
	){

		$sql = "INSERT INTO alianza 
		(
			ali_id,
			ali_nombre,
			ali_no_documento,
			ali_descripcion,
			ali_num_contacto,
			ali_nombre_contacto,
			ali_apellido_contacto,
			ali_correo_contacto,
			ali_correo_corporativo,
			ali_telefono_oficina,
			ali_direccion_oficina,
			ali_ciudad_id,
			ali_barrio,
			ali_cobertura
		)
			 VALUES 
		(
			null,
			'$ali_nombre',
			'$ali_no_documento',
			'$ali_descripcion',
			'$ali_num_contacto',
			'$ali_nombre_contacto',
			'$ali_apellido_contacto',
			'$ali_correo_contacto',
			'$ali_correo_corporativo',
			'$ali_telefono_oficina',
			'$ali_direccion_oficina',
			'$ali_ciudad_id',
			'$ali_barrio',
			'$ali_cobertura'			
		)";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar(
		$ali_id, 
		$ali_nombre,
		$ali_no_documento,
		$ali_descripcion,
		$ali_num_contacto,
		$ali_nombre_contacto,
		$ali_apellido_contacto,
		$ali_correo_contacto,
		$ali_correo_corporativo,
		$ali_telefono_oficina,
		$ali_direccion_oficina,
		$ali_ciudad_id,
		$ali_barrio,
		$ali_cobertura
	){

		$sql = "UPDATE alianza 
				SET
				ali_nombre 				= '$ali_nombre',
				ali_no_documento		= '$ali_no_documento',
				ali_descripcion 		= '$ali_descripcion',
				ali_num_contacto		= '$ali_num_contacto',
				ali_nombre_contacto 	= '$ali_nombre_contacto',
				ali_apellido_contacto	= '$ali_apellido_contacto',
				ali_correo_contacto		= '$ali_correo_contacto',
				ali_correo_corporativo	= '$ali_correo_corporativo',
				ali_telefono_oficina	= '$ali_telefono_oficina',
				ali_direccion_oficina	= '$ali_direccion_oficina',
				ali_ciudad_id			= '$ali_ciudad_id',
				ali_barrio				= '$ali_barrio',
				ali_cobertura			= '$ali_cobertura'

				WHERE ali_id = '$ali_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($ali_id){
		$sql = "UPDATE alianza 
				SET ali_estado = '0'
				WHERE ali_id = '$ali_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($ali_id){
		$sql = "UPDATE alianza 
				SET ali_estado = '1'
				WHERE ali_id = '$ali_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($ali_id){
		$sql = "SELECT * FROM alianza
				WHERE ali_id = '$ali_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM alianza";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM alianza
				where ali_estado = 1";

		return ejecutarConsulta($sql);
	}

}


?>