<?php 
// # encoded by 

// NOMBRE DE LA TABLA
// 	fabricante

// CAMPOS DE LA TABLA 
/*

fab_id int
fab_nombre	varchar
fab_tip_doc_id	int
fab_documento	bigint
fab_direccion	varchar
fab_telefono	varchar
fab_ciudad_id 	int
fab_estado 		tinyint

*/

// NOMBRE DE LA CLASE 
// 	Fabricante 

// AJAX
// fabricante

// Incluir la conexion a BDs
require '../config/conexion.php';

Class Fabricante 
{

	// Implimentacion de constructor
	public function __construct()
	{

	}

	// Implementacion de metodo de registro
	public function insertar(
			$fab_id,
			$fab_nombre,
			$fab_tip_doc_id,
			$fab_documento,
			$fab_direccion,
			$fab_telefono,
			$fab_ciudad_id){

		$sql = "INSERT INTO fabricante (
					fab_id,
					fab_nombre,
			 		fab_tip_doc_id,
			 		fab_documento,
			 		fab_direccion,
				 	fab_telefono,
				 	fab_ciudad_id)
				VALUES (
					null, 
					'$fab_nombre',
					'$fab_tip_doc_id',
					'$fab_documento',
					'$fab_direccion',
					'$fab_telefono',
					'$fab_ciudad_id')";

		return ejecutarConsulta($sql);

	}

	// Implementacion de metodo de edicion
	public function editar(
			$fab_id,
			$fab_nombre,
			$fab_tip_doc_id,
			$fab_documento,
			$fab_direccion,
			$fab_telefono,
			$fab_ciudad_id
			){

		$sql = "UPDATE fabricante 
				SET fab_nombre = '$fab_nombre',
					fab_tip_doc_id = '$fab_tip_doc_id',
					fab_documento = '$fab_documento',
			 		fab_direccion = '$fab_direccion',
				 	fab_telefono = '$fab_telefono',
				 	fab_ciudad_id = '$fab_ciudad_id'

				WHERE fab_id = '$fab_id'";

		return	ejecutarConsulta($sql);

		}

	// Implementacion de metodo de desactivacion
	public function desactivar($fab_id){
		$sql = "UPDATE fabricante 
				SET fab_estado = '0'
				WHERE fab_id = '$fab_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($fab_id){
		$sql = "UPDATE fabricante 
				SET fab_estado = '1'
				WHERE fab_id = '$fab_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($fab_id){
		$sql = "SELECT * FROM fabricante
				WHERE fab_id = '$fab_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros
	// RELACION DE LA TABLA fabricante
	// -------------------------------------------------
	// |ALIAS 	|	TABLA 	 	|	CAMPO 	|RELACION		|
	// -------------------------------------------------
	// |c 		|tipo_documento |tip_doc_id |fab_tip_doc_id	|
	// -------------------------------------------------
	// |a 		|ciudad 		|ciu_id 	|fab_ciudad_id	|
	// -------------------------------------------------

	public function listar(){
		$sql = "SELECT s.fab_id,
					s.fab_nombre,
					c.tip_doc_nombre,
					s.fab_documento,
					s.fab_direccion,
					s.fab_telefono,
					a.ciu_nombre,
					s.fab_estado
					FROM fabricante s
					INNER JOIN tipo_documento c
					ON c.tip_doc_id =  s.fab_tip_doc_id
					INNER JOIN ciudad a
					ON a.ciu_id =  s.fab_ciudad_id";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM fabricante
				where fab_estado = 1";

		return ejecutarConsulta($sql);
	}

}


?>