<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA
// 		usuario_log

// MONBRE DE LOS CAMPOS
// 		usu_id
// 		usu_ciudad_id
// 		usu_sede_id
// 		usu_area_id
// 		usu_cargo_id
// 		usu_alianza_id
// 		usu_tipo_documento_id
// 		usu_num_documento
// 		usu_nombre
// 		usu_apellido
// 		usu_fecha_nacimiento
// 		usu_telefono_1
// 		usu_telefono_2
// 		usu_direccion
// 		usu_correo_personal
// 		usu_correo_cop
// 		usu_login
// 		usu_pass
// 		usu_permiso
// 		usu_estado

// NOMBRES DE LOS INPUTS DEL HTMPL
// 		usu_id
// 		ciudad
// 		sede
// 		area
// 		cargo
//      alianza
// 		tipoDoc
// 		numDoc
// 		nombre
// 		apellido
// 		nacimiento
// 		tel1
// 		tel2
// 		direccion
// 		correoPer
// 		correoCorp
// 		login
// 		pass
// 		permiso 
// 		estado 


// Incluir la conexion a BDs
require '../config/conexion.php';

Class Usuario {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar(
			$usu_id,
			$usu_ciudad_id,
			$usu_sede_id,
			$usu_area_id,
			$usu_cargo_id,
			$usu_alianza_id,
			$usu_tipo_documento_id,
			$usu_num_documento,
			$usu_nombre,
			$usu_apellido,
			$usu_fecha_nacimiento,
			$usu_telefono_1,
			$usu_telefono_2,
			$usu_direccion,
			$usu_correo_personal,
			$usu_correo_cop,
			$usu_login,
			$usu_pass,
			$usu_imagen,
			$usu_permiso,
			$permisos){

		$sql = "INSERT INTO usuario_log (
				usu_id,
		 		usu_ciudad_id,
		 		usu_sede_id,
		 		usu_area_id,
		 		usu_cargo_id,
		 		usu_alianza_id,
		 		usu_tipo_documento_id,
		 		usu_num_documento,
		 		usu_nombre,
		 		usu_apellido,
		 		usu_fecha_nacimiento,
		 		usu_telefono_1,
		 		usu_telefono_2,
		 		usu_direccion,
		 		usu_correo_personal,
		 		usu_correo_cop,
		 		usu_login,
		 		usu_pass,
		 		usu_imagen,
		 		usu_permiso)
			VALUES (
				null,
				'$usu_ciudad_id',
				'$usu_sede_id',
				'$usu_area_id',
				'$usu_cargo_id',
				'$usu_alianza_id',
				'$usu_tipo_documento_id',
				'$usu_num_documento',
				'$usu_nombre',
				'$usu_apellido',
				'$usu_fecha_nacimiento',
				'$usu_telefono_1',
				'$usu_telefono_2',
				'$usu_direccion',
				'$usu_correo_personal',
				'$usu_correo_cop',
				'$usu_login',
				'$usu_pass',
				'$usu_imagen',
				'$usu_permiso')";

		// return ejecutarConsulta($sql);
		$idusuarionew = ejecutarConsulta_retornaID($sql);

		$num_elementos = 0;

		$sw = true;

		while ($num_elementos < count($permisos)) {
			
			$sql_detalle = "INSERT INTO usuario_permiso(usu_per_usuario_id, usu_per_permiso_id)
					VALUES('$idusuarionew', '$permisos[$num_elementos]') ";

			ejecutarConsulta($sql_detalle) or $sw = false;

			$num_elementos = $num_elementos + 1;

		}

		return $sw;
	}

	// Implementacion de metodo de edicion
	public function editar(
			$usu_id,
			$usu_ciudad_id,
			$usu_sede_id,
			$usu_area_id,
			$usu_cargo_id,
			$usu_alianza_id,
			$usu_tipo_documento_id,
			$usu_num_documento,
			$usu_nombre,
			$usu_apellido,
			$usu_fecha_nacimiento,
			$usu_telefono_1,
			$usu_telefono_2,
			$usu_direccion,
			$usu_correo_personal,
			$usu_correo_cop,
			$usu_login,
			$usu_pass,
			$usu_imagen,
			$usu_permiso,
			$permisos){

		$sql = "UPDATE usuario_log 
				SET usu_ciudad_id 			= '$usu_ciudad_id',
					usu_sede_id 			= '$usu_sede_id',			
			 		usu_area_id 			= '$usu_area_id',
			 		usu_cargo_id 			= '$usu_cargo_id',
			 		usu_alianza_id			= '$usu_alianza_id',
			 		usu_tipo_documento_id 	= '$usu_tipo_documento_id',
			 		usu_num_documento 		= '$usu_num_documento',
			 		usu_nombre 				= '$usu_nombre',
			 		usu_apellido 			= '$usu_apellido',
			 		usu_fecha_nacimiento 	= '$usu_fecha_nacimiento',
			 		usu_telefono_1 			= '$usu_telefono_1',
			 		usu_telefono_2 			= '$usu_telefono_2',
			 		usu_direccion 			= '$usu_direccion',
			 		usu_correo_personal 	= '$usu_correo_personal',
			 		usu_correo_cop 			= '$usu_correo_cop',
			 		usu_login 				= '$usu_login',
			 		usu_pass 				= '$usu_pass',
			 		usu_imagen				= '$usu_imagen',
			 		usu_permiso 			= '$usu_permiso'
				
				WHERE usu_id = '$usu_id'";

		ejecutarConsulta($sql);

		// Eliminar todos los permisos asignados 
		$sqldel ="DELETE FROM usuario_permiso WHERE usu_per_usuario_id = '$usu_id'";

		ejecutarConsulta($sqldel);	

		$num_elementos = 0;

		$sw = true;

		while ($num_elementos < count($permisos)) {
			
			$sql_detalle = "INSERT INTO usuario_permiso(usu_per_usuario_id, usu_per_permiso_id)
					VALUES('$usu_id', '$permisos[$num_elementos]') ";

			ejecutarConsulta($sql_detalle) or $sw = false;

			$num_elementos = $num_elementos + 1;

		}

		return $sw;
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($usu_id){
		$sql = "UPDATE usuario_log 
				SET usu_estado = '0'
				WHERE usu_id = '$usu_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($usu_id){
		$sql = "UPDATE usuario_log 
				SET usu_estado = '1'
				WHERE usu_id = '$usu_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($usu_id)
	{
	
		$sql = "SELECT * FROM usuario_log
				WHERE usu_id = '$usu_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros

//  DESCRIPCION DE RELACION DE CAMPOS
//  -----------------------------------------------------------------
// 	| ALIAS	| TABLA 	    | CAMPO 		|MUESTRA |		RELACION				|	
//  -----------------------------------------------------------------
// 	|	u	|				|				|				|usu_id 				|
// 	|	c	|ciudad 		| ciu_id 		|ciu_nombre 	|usu_ciudad_id			|
// 	|	s	|sede 			| sed_id 		|sed_nombre 	|usu_sede_id			|
// 	|	a	|area   		| are_id 		|are_nombre 	|usu_area_id			|
// 	|	g	|cargo  		| car_id 		|car_nombre 	|usu_cargo_id			|
// 	|	t	|tipo_documento | tip_doc_id 	|tip_doc_nombre |usu_tipo_documento_id	|
//  |		|				|				|				|usu_num_documento		|
// 	|		|				|				|				|usu_nombre				|
// 	|		|				|				|				|usu_apellido			|
// 	|		|				|				|				|usu_fecha_nacimiento	|
// 	|		|				|				|				|usu_telefono_1			|
// 	|		|				|				|				|usu_telefono_2			|
// 	|		|				|				|				|usu_direccion			|
// 	|		|				|				|				|usu_correo_personal	|
// 	|		|				|				|				|usu_correo_cop			|
// 	|		|				|				|				|usu_login				|
// 	|		|				|				|				|usu_pass				|
// 	|		|				|				|				|usu_permiso			|
//  -----------------------------------------------------------------

	public function listar(){
		$sql = "SELECT
				u.usu_id,
				u.usu_nombre,
				u.usu_apellido,
				u.usu_num_documento,
				u.usu_direccion,
				u.usu_telefono_1,
				u.usu_correo_personal,
				u.usu_estado,
				u.usu_imagen,
				u.usu_permiso,
				a.ali_nombre,
				c.ciu_nombre,
				s.sed_nombre
				FROM usuario_log u 
				INNER JOIN alianza a 
				ON u.usu_alianza_id = a.ali_id
				INNER JOIN ciudad c 
				ON u.usu_ciudad_id = c.ciu_id
				INNER JOIN sede s 
				ON u.usu_sede_id = s.sed_id";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM usuario_log
				where usu_estado = 1";

		return ejecutarConsulta($sql);
	}

	// Implementacion del metodo que trae los permisos asignados 
	public function listamarcados($usu_id){
		$sql = "SELECT * FROM usuario_permiso WHERE usu_per_usuario_id = '$usu_id'";
		return ejecutarConsulta($sql);
	}

	public function verificar($usu_login, $usu_pass){

		$sql = "SELECT usu_id, 
					usu_area_id,
					usu_sede_id,
					usu_alianza_id,
					usu_nombre, 
					usu_apellido, 
					usu_num_documento, 
					usu_telefono_1, 
					usu_correo_personal, 
					usu_cargo_id,
					usu_imagen,
					usu_login,
					usu_grupo_tecnica,
					usu_permiso
				FROM usuario_log
				WHERE usu_login = '$usu_login'
				AND usu_pass = '$usu_pass'
				AND usu_estado = '1'";

		return ejecutarConsulta($sql);

	}

}


?>