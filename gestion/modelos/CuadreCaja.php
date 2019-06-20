<?php  
// session_start();
// maintenance effectuee par Anderson Ferrucho
require "../config/conexion.php";

/**
 * 
 */
class Cuadrecaja
{
	
	function __construct()
	{
		
	}

	// début maintenance 
	public function insertarConsecutivo($tabla, $id_salida, $id_tabla, $tabla_dato1)
	{
		$sql ="INSERT INTO $tabla($id_tabla, $tabla_dato1)
				VALUES(null, '$id_salida')"; 

		return ejecutarConsulta($sql);

	}

	public function seleccionarID($tabla, $id_select)
	{
		$sql ="SELECT * FROM $tabla ORDER BY $id_select DESC"; 

		return ejecutarConsultaSimpleFila($sql);

	}

	public function mostrarID($tabla, $dato_select, $id_select)
	{
		$sql ="SELECT * FROM $tabla WHERE $dato_select = '$id_select'"; 

		return ejecutarConsultaSimpleFila($sql);

	}
	// fin maintenance 

	public function insertarSalida(
		$sal_tipo_sal_id,
		$sal_num_doc,
		$sal_descripcion,
		$sal_valor,
		$sal_usuario_id,
		$sal_sede_id,
		$doc_imagen
	){
		$sql ="INSERT INTO salidas(
			sal_id,	
			sal_tipo_sal_id,
			sal_num_doc,
			sal_descripcion,
			sal_valor,
			sal_usuario_id,
			sal_sede_id,
			sal_evidencia
		)VALUES(
			null,
			'$sal_tipo_sal_id',
			'$sal_num_doc',
			'$sal_descripcion',
			'$sal_valor',
			'$sal_usuario_id',
			'$sal_sede_id',
			'$doc_imagen'
		)"; 

		return ejecutarConsulta_retornaID($sql);

	}

	public function listar($fecha_inicio, $fecha_fin, $sede_id){
		$sql = "SELECT s.sal_id,
				s.sal_fecha_hora,
				s.sal_tipo_sal_id,
				ts.tip_sal_id,
				ts.tip_sal_nombre,
				s.sal_num_doc,
				s.sal_descripcion,
				s.sal_valor,
				s.sal_usuario_id,
				s.sal_sede_id,
				u.usu_id,
				u.usu_nombre,
				u.usu_apellido,
				sd.sed_id,
				sd.sed_nombre,
				s.sal_evidencia
			FROM salidas s 
			INNER JOIN tipo_salida ts 
			ON ts.tip_sal_id = s.sal_tipo_sal_id
			INNER JOIN usuario_log u 
			ON u.usu_id = s.sal_usuario_id
			INNER JOIN sede sd 
			ON sd.sed_id = s.sal_sede_id
			WHERE s.sal_sede_id = '$sede_id' 
			AND DATE(sal_fecha_hora)>= '$fecha_inicio'
			AND DATE(sal_fecha_hora)<='$fecha_fin'
			AND sal_estado = 1
			";

		return ejecutarConsulta($sql);
	}

	public function selectTipoSalida(){
		$sql = "SELECT * FROM tipo_salida
			WHERE 	tip_sal_estado = 1";

		return ejecutarConsulta($sql);
	}
	
	public function efectivoDiaSede($fecha_inicio, $fecha_fin, $sede_id){
		$sql = "SELECT 
				SUM(ec.est_cta_debe) AS efectivo
				FROM estado_cuenta_fin ec 
				INNER JOIN persona p
				ON ec.est_cta_persona_id = p.per_id
				INNER JOIN sede s
				ON ec.est_cta_sede_id = s.sed_id
				INNER JOIN ciudad c 
				ON c.ciu_id = s.sed_ciudad_id
				WHERE est_cta_transaccion_id = 2
				AND DATE(est_cta_fecha_transacc)>= '$fecha_inicio'
				AND DATE(est_cta_fecha_transacc)<= '$fecha_fin'
				AND est_cta_sede_id = '$sede_id'
				AND p.per_tipo_persona_id = 1
				AND ec.est_cta_estado = 1
				";

		return ejecutarConsultaSimpleFila($sql);
	}
	
	public function consignacionDiaSede($fecha_inicio, $fecha_fin, $sede_id){
		$sql = "SELECT 
				SUM(ec.est_cta_debe) AS efectivo
				FROM estado_cuenta_fin ec 
				INNER JOIN persona p
				ON ec.est_cta_persona_id = p.per_id
				INNER JOIN sede s
				ON ec.est_cta_sede_id = s.sed_id
				INNER JOIN ciudad c 
				ON c.ciu_id = s.sed_ciudad_id
				WHERE est_cta_transaccion_id = 3
				AND DATE(est_cta_fecha_transacc)>= '$fecha_inicio'
				AND DATE(est_cta_fecha_transacc)<= '$fecha_fin'
				AND est_cta_sede_id = '$sede_id'
				AND p.per_tipo_persona_id = 1
				AND ec.est_cta_estado = 1
				";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function efectivoDia($fecha_inicio, $fecha_fin, $sede_id){
		$sql = "SELECT 
				SUM(ec.est_cta_debe) AS efectivo
				FROM estado_cuenta_fin ec 
				INNER JOIN persona p
				ON ec.est_cta_persona_id = p.per_id
				INNER JOIN sede s
				ON ec.est_cta_sede_id = s.sed_id
				INNER JOIN ciudad c 
				ON c.ciu_id = s.sed_ciudad_id
				WHERE est_cta_transaccion_id = 2
				AND DATE(est_cta_fecha_transacc)>= '$fecha_inicio'
				AND DATE(est_cta_fecha_transacc)<= '$fecha_fin'
				AND est_cta_sede_id = '$sede_id'
				AND ec.est_cta_estado = 1
				";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function efectivoCorporativo($fecha_inicio, $fecha_fin, $sede_id){
		$sql = "SELECT 
				SUM(ec.est_cta_debe) AS efectivo
				FROM estado_cuenta_fin ec
				INNER JOIN persona p
				ON ec.est_cta_persona_id = p.per_id 
				INNER JOIN sede s
				ON ec.est_cta_sede_id = s.sed_id
				INNER JOIN ciudad c 
				ON c.ciu_id = s.sed_ciudad_id
				WHERE est_cta_transaccion_id = 2
				AND DATE(est_cta_fecha_transacc)>= '$fecha_inicio'
				AND DATE(est_cta_fecha_transacc)<= '$fecha_fin'
				AND est_cta_sede_id = '$sede_id'
				AND p.per_tipo_persona_id = 2
				AND ec.est_cta_estado = 1
				";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function consignacionDia($fecha_inicio, $fecha_fin, $sede_id){
		$sql = "SELECT 
				SUM(ec.est_cta_debe) AS consignacion
				FROM estado_cuenta_fin ec 
				INNER JOIN sede s
				ON ec.est_cta_sede_id = s.sed_id
				INNER JOIN ciudad c 
				ON c.ciu_id = s.sed_ciudad_id
				WHERE est_cta_transaccion_id = 3
				AND DATE(est_cta_fecha_transacc)>= '$fecha_inicio'
				AND DATE(est_cta_fecha_transacc)<= '$fecha_fin'
				AND est_cta_sede_id = '$sede_id'
				AND ec.est_cta_estado = 1";

		return ejecutarConsultaSimpleFila($sql);
	}


	public function totalSalidasDia($fecha_inicio, $fecha_fin, $sede_id){
		$sql = "SELECT SUM(sal_valor)
			AS totalDia
			FROM salidas
			WHERE sal_sede_id = '$sede_id' 
			AND DATE(sal_fecha_hora)>= '$fecha_inicio'
			AND DATE(sal_fecha_hora)<='$fecha_fin'
			AND sal_estado = 1
			";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function totalGeneralIngreso($sede_id){
		$sql = "SELECT 
			SUM(est_cta_debe) 
			AS efectivoGeneral
			FROM estado_cuenta_fin 
			WHERE est_cta_transaccion_id = 2
			AND est_cta_sede_id = '$sede_id'
			AND est_cta_estado = 1";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function totalGeneralSalida($sede_id){
		$sql = "SELECT SUM(sal_valor)
			AS salidaGeneral
			FROM salidas
			WHERE sal_sede_id = '$sede_id' 
			AND sal_estado = 1
			";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function totalRecogida($fecha_inicio, $fecha_fin, $sede_id){
		$sql = "SELECT SUM(sal_valor)
			AS  recogidaTotal
			FROM salidas s
			INNER JOIN tipo_salida ts
            ON tip_sal_id = sal_tipo_sal_id
			WHERE sal_sede_id = '$sede_id'
			AND tip_sal_recogida = 1
			AND DATE(sal_fecha_hora)>= '$fecha_inicio'
			AND DATE(sal_fecha_hora)<='$fecha_fin' 
			AND sal_estado = 1
			";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function otrasSalidas($fecha_inicio, $fecha_fin, $sede_id){
		$sql = "SELECT SUM(sal_valor)
			AS  otrasSalidas
			FROM salidas s
			INNER JOIN tipo_salida ts
            ON tip_sal_id = sal_tipo_sal_id
			WHERE sal_sede_id = '$sede_id'
			AND tip_sal_recogida = 0
			AND DATE(sal_fecha_hora)>= '$fecha_inicio'
			AND DATE(sal_fecha_hora)<='$fecha_fin'
			AND sal_estado = 1 
			";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function recaudoMes($sede_id){
		$mes  = date('m');
		$anio = date('Y');
		$sql = "SELECT SUM(ec.est_cta_debe)
			AS efectivoMes,
			p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			WHERE ec.est_cta_sede_id = '$sede_id'
			AND	ec.est_cta_concep_trans_id = 2
			AND MONTH(ec.est_cta_fecha_transacc) = '$mes'
			AND YEAR(ec.est_cta_fecha_transacc) = 	'$anio'
			AND p.per_tipo_persona_id = 1
			AND ec.est_cta_estado = 1";

		return ejecutarConsultaSimpleFila($sql);
	}

//Début maintenance
	public function recaudoMesCorp($sede_id){
		$mes  = date('m');
		$anio = date('Y');
		$sql = "SELECT SUM(ec.est_cta_debe)
			AS efectivoMes,
			p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			WHERE ec.est_cta_sede_id = '$sede_id'
			AND	ec.est_cta_concep_trans_id = 2
			AND MONTH(ec.est_cta_fecha_transacc) = '$mes'
			AND YEAR(ec.est_cta_fecha_transacc) = 	'$anio'
			AND p.per_tipo_persona_id = 2
			AND ec.est_cta_estado = 1
			";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function recaudoMesConsigMsv($sede_id){
		$mes  = date('m');
		$anio = date('Y');
		$sql = "SELECT SUM(ec.est_cta_debe)
			AS consignacionMes,
			p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			WHERE ec.est_cta_sede_id = '$sede_id'
			AND	ec.est_cta_transaccion_id = 3
			AND MONTH(ec.est_cta_fecha_transacc) = '$mes'
			AND YEAR(ec.est_cta_fecha_transacc) = 	'$anio'
			AND p.per_tipo_persona_id = 1
			AND ec.est_cta_estado = 1
			";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function recaudoMesConsigCorp($sede_id){
		$mes  = date('m');
		$anio = date('Y');
		$sql = "SELECT SUM(ec.est_cta_debe)
			AS consignacionMes,
			p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			WHERE ec.est_cta_sede_id = '$sede_id'
			AND	ec.est_cta_transaccion_id = 3
			AND MONTH(ec.est_cta_fecha_transacc) = '$mes'
			AND YEAR(ec.est_cta_fecha_transacc) = 	'$anio'
			AND p.per_tipo_persona_id = 2
			AND ec.est_cta_estado = 1
			";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function ocultar_registro_tabla($sal_id) 
	{

        $sql = "UPDATE salidas 
        		SET	sal_estado 	= 	0
        		WHERE sal_id  	=   '$sal_id'";

        return ejecutarConsulta($sql);
    }

// fin maintenance

}

?>