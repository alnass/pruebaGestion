<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA
// 	sede

// CAMPOS DE LA TABLA 
// 	sed_id
// 	sed_nombre
// 	sed_direccion
// 	sed_barrio
// 	sed_ciudad_id
// 	sed_telefono_1
// 	sed_telefono_2
// 	sed_descripcion
// 	sed_estado

// NOMBRE DE LA CLASE 
// 	Sede 

// AJAX
// 	sede

// Incluir la conexion a BDs
require '../config/conexion.php';

Class Sede {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar(
			$sed_id,
			$sed_nombre,
			$sed_direccion,
			$sed_barrio,
			$sed_ciudad_id,
			$sed_telefono_1,
			$sed_telefono_2,
			$sed_descripcion,
			$productos
		){

		$sql = "INSERT INTO sede (
					sed_id,
			 		sed_nombre,
			 		sed_direccion,
			 		sed_barrio,
				 	sed_ciudad_id,
				 	sed_telefono_1,
				 	sed_telefono_2,
			 		sed_descripcion)
				VALUES (
					null, 
					'$sed_nombre',
					'$sed_direccion',
					'$sed_barrio',
					'$sed_ciudad_id',
					'$sed_telefono_1',
					'$sed_telefono_2',
					'$sed_descripcion')";

		$idsede =  ejecutarConsulta_retornaID($sql);

		$num_elementos = 0;

		$sw = true;

		while ($num_elementos < count($productos)) {
			
			$sql_detalle = "INSERT INTO sede_producto(sed_prod_sede_id, sed_prod_producto_id)
					VALUES('$idsede', '$productos[$num_elementos]') ";

			ejecutarConsulta($sql_detalle) or $sw = false;

			$num_elementos = $num_elementos + 1;

		}

		return $sw;
	}

	// Implementacion de metodo de edicion
	public function editar(
			$sed_id,
			$sed_nombre,
			$sed_direccion,
			$sed_barrio,
			$sed_ciudad_id,
			$sed_telefono_1,
			$sed_telefono_2,
			$sed_descripcion,
			$productos
		){

		$sql = "UPDATE sede 
				SET sed_nombre = '$sed_nombre',
					sed_direccion = '$sed_direccion',
			 		sed_barrio = '$sed_barrio',
				 	sed_ciudad_id = '$sed_ciudad_id',
				 	sed_telefono_1 = '$sed_telefono_1',
				 	sed_telefono_2 = '$sed_telefono_2',
				 	sed_descripcion = '$sed_descripcion'

				WHERE sed_id = '$sed_id'";

		ejecutarConsulta($sql);

		$sqldel = "DELETE FROM sede_producto WHERE sed_prod_sede_id = '$sed_id'";

		ejecutarConsulta($sqldel);

		$num_elementos = 0;

		$sw = true;

		while ($num_elementos < count($productos)) {
			
			$sql_detalle = "INSERT INTO sede_producto(sed_prod_sede_id, sed_prod_producto_id)
					VALUES('$sed_id', '$productos[$num_elementos]') ";

			ejecutarConsulta($sql_detalle) or $sw = false;

			$num_elementos = $num_elementos + 1;

		}

		return $sw;

	}

	// Implementacion de metodo de desactivacion
	public function desactivar($sed_id){
		$sql = "UPDATE sede 
				SET sed_estado = '0'
				WHERE sed_id = '$sed_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($sed_id){
		$sql = "UPDATE sede 
				SET sed_estado = '1'
				WHERE sed_id = '$sed_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($sed_id){
		$sql = "SELECT * FROM sede
				WHERE sed_id = '$sed_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros
	// RELACION DE LA TABLA SEDE
	// ------------------------------------------
	// |ALIAS 	|TABLA 	|CAMPO 	|RELACION		|
	// ------------------------------------------
	// |c 		|ciudad |ciu_id |sed_ciudad_id	|
	// ------------------------------------------

	public function listar(){
		$sql = "SELECT s.sed_id,
					s.sed_nombre,
					s.sed_direccion,
					s.sed_barrio,
					c.ciu_nombre,
					s.sed_telefono_1,
					s.sed_telefono_2,
					s.sed_descripcion,
					s.sed_estado
					FROM (sede s
					INNER JOIN ciudad c
					ON c.ciu_id =  s.sed_ciudad_id)";

		return ejecutarConsulta($sql);
	}

	public function listarSedeUsuario($sede_id){
		$sql = "SELECT s.sed_id,
					s.sed_nombre,
					s.sed_direccion,
					s.sed_barrio,
					c.ciu_nombre,
					s.sed_telefono_1,
					s.sed_telefono_2,
					s.sed_descripcion,
					s.sed_estado
					FROM sede s
					INNER JOIN ciudad c
					ON c.ciu_id =  s.sed_ciudad_id
					WHERE s.sed_id = '$sede_id'";

		return ejecutarConsulta($sql);
	}


	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM sede
				where sed_estado = 1";

		return ejecutarConsulta($sql);
	}

	// Implementacion del metodo los productos asignados a la sede  
	public function listamarcados($sed_id){
		$sql = "SELECT * FROM sede_producto WHERE sed_prod_sede_id = '$sed_id'";
		return ejecutarConsulta($sql);
	}


}


?>