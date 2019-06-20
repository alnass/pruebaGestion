<?php 

/**
 * Developed by @Francisco Monsalve
 */
require "../config/conexion.php";

class Apertura 
{
	
	public function __construct()
	{
		
	}

	public function listar($fecha){

		$sql = "SELECT MIN(lu.log_usu_id) AS log_id,
			DATE(lu.log_usu_fechahora),
			lu.log_usu_fechahora,
			lu.log_usu_usuario_id,
			lu.log_usu_ip,
			u.usu_id,
			u.usu_nombre,
			u.usu_apellido,
			u.usu_sede_id,
			s.sed_id,
			s.sed_nombre
			FROM log_usuario lu
			INNER JOIN usuario_log u
			ON lu.log_usu_usuario_id = u.usu_id
			INNER JOIN sede s
			ON u.usu_sede_id = s.sed_id
			WHERE DATE(lu.log_usu_fechahora)>='$fecha'
			AND DATE(lu.log_usu_fechahora)<='$fecha'
			GROUP BY usu_id	";

		return ejecutarConsulta($sql);
	}

}

?>