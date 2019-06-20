<?php
/*
oper_id
oper_nombre
oper_descripcion
oper_estado
*/

require '../config/conexion.php';

class Operacion
{
	public function __construct()
	{

	}

	public function insertar(
		$oper_id,
		$oper_nombre,
		$oper_descripcion
		)
	{
		$sql 	= 	"INSERT INTO operacion(
						oper_id,
						oper_nombre,
						oper_descripcion
					)
					VALUES(
						null,
						'$oper_id',
						'$oper_nombre',
						'$oper_descripcion'
					)";

		return ejecutarConsulta($sql);
	}

	public function editar(
		$oper_id,
		$oper_nombre,
		$oper_descripcion
	)
	{
		$sql	= 	"UPDATE operacion 
					SET 
						oper_nombre 		= 	'$oper_nombre',
						oper_descripcion	= 	'$oper_descripcion'
					WHERE 
						oper_id 			= 	'$oper_id'";

		return ejecutarConsulta($sql);
	}

	public function mostrar($oper_id)
	{
		$sql 	= 	"SELECT * FROM operacion 
					WHERE oper_id 	= 	'$oper_id'";

		return 	ejecutarConsulta($sql);
	}

	public 	function select()
	{
		$sql 	= 	"SELECT * FROM operacion
					WHERE oper_estado = 1";

		return ejecutarConsulta($sql);
	}
}



?>