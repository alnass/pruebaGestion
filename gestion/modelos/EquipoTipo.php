<?php 
// # encoded by @Anderson Ferrucho 

// NOMBRE DE LA TABLA
// 	equipo_tipo

/*

// CAMPOS DE LA TABLA EQUIPOTIPO
equi_tip_id int				
equi_tip_nombre	varchar(45)				
equi_tip_descripcion	varchar(256)				
equi_tip_estado	defecto = 1

*/


// Incluir la conexion a BDs
require '../config/conexion.php';

Class EquipoTipo {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar($equi_tip_id, $equi_tip_nombre, $equi_tip_descripcion){

		$sql = "INSERT INTO equipo_tipo (equi_tip_id, equi_tip_nombre, equi_tip_descripcion)
			VALUES (null, '$equi_tip_nombre', '$equi_tip_descripcion')";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar($equi_tip_id, $equi_tip_nombre, $equi_tip_descripcion){

		$sql = "UPDATE equipo_tipo 
				SET equi_tip_nombre = '$equi_tip_nombre', 
					equi_tip_descripcion = '$equi_tip_descripcion'
				WHERE equi_tip_id = '$equi_tip_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($equi_tip_id){
		$sql = "UPDATE equipo_tipo 
				SET equi_tip_estado = '0'
				WHERE equi_tip_id = '$equi_tip_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($equi_tip_id){
		$sql = "UPDATE equipo_tipo 
				SET equi_tip_estado = '1'
				WHERE equi_tip_id = '$equi_tip_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($equi_tip_id){
		$sql = "SELECT * FROM equipo_tipo
				WHERE equi_tip_id = '$equi_tip_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM equipo_tipo";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM equipo_tipo
				where equi_tip_estado = 1";

		return ejecutarConsulta($sql);
	}

	public function selectPorId($equi_tip_id){
		$sql = "SELECT * FROM equipo_tipo
				where equi_tip_id = '$equi_tip_id'";

		return ejecutarConsulta($sql);
	}

}


?>